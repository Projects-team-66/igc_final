<?php

namespace Controllers;

use Exception;
use Model\Permiso;
use MVC\Router;
use Model\Usuario;


class LoginController
{
    public static function login(Router $router)
    {
        isNotAuth();
        $router->render('auth/login', []);
    }

    public static function logout()
    {
        isAuth();
        $_SESSION = [];
        session_destroy();
        header('Location: /igc_final');
    }


    public static function registro(Router $router)
    {
    
        $router->render('auth/registro', []);
    }

    public static function menu(Router $router)
    {
        isAuth();
        hasPermission(['INSTITUTO_ADMIN']);
        $router->render('pages/menu', []);
    }


    public static function registroAPI()
    {
        $_POST['usu_nombre'] = htmlspecialchars($_POST['usu_nombre']);
        $_POST['usu_catalogo'] = filter_var($_POST['usu_catalogo'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['usu_password'] = htmlspecialchars($_POST['usu_password']);
        $_POST['usu_password2'] = htmlspecialchars($_POST['usu_password2']);

        if ($_POST['usu_password'] != $_POST['usu_password2']) {
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Las Contraseñas no Coinciden',
                'detalle' => 'Verifique las contraseñas ingresadas',
            ]);
            exit;
        }

        try {
            $_POST['usu_password'] = password_hash($_POST['usu_password'], PASSWORD_DEFAULT);
            $usuario = new Usuario($_POST);
            if ($usuario->validarUsuarioExistente()) {
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Ya existe un Usuario Registrado',
                    'detalle' => 'Verifique la informacion y catalogo',
                ]);
                exit;
            }
            $usuario->crear();
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Usuario Creado Exitosamente'
            ]);
            exit;
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al Ingresar Usuario',
                'detalle' => $e->getMessage(),
            ]);
            exit;
        }
    }

    public static function loginAPI()
    {
        $_POST['usu_catalogo'] = filter_var($_POST['usu_catalogo'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['usu_password'] = htmlspecialchars($_POST['usu_password']);

        $usuario = new Usuario($_POST);
        //VALIDAR QUE EXISTE EL USUARIO
        if ($usuario->validarUsuarioExistente()) {
            $usuarioBD = $usuario->getUsuarioExistente();

            if (password_verify($_POST['usu_password'], $usuarioBD['usu_password'])) {
                session_start();
                $_SESSION['user'] = $usuarioBD;

                $permisos = Permiso::fetchArray("SELECT * FROM permiso INNER JOIN rol ON permiso_rol = rol_id WHERE permiso_usuario = " . $usuarioBD['usu_id']);

                foreach ($permisos as $permiso) {
                    $_SESSION[$permiso['rol_nombre_ct']] = 1;
                }
                
                http_response_code(200);
                echo json_encode([
                    'codigo' => 1,
                    'mensaje' => 'Bienvenido a la Platarforma de Instituto Guatemalteco Central, ' . $usuarioBD['usu_nombre'],
                ]);
                exit;
            } else {
                http_response_code(404);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'La Contraseña no Coincide',
                    'detalle' => 'Verifique la contraseña ingresada'
                ]);
                exit;
            };
        } else {
            http_response_code(404);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'El Usuario No existe',
                'detalle' => 'Porfavor Contancte al Instituto para más Información'
            ]);
            exit;
        };
        try {
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al Ingresar Usuario',
                'detalle' => $e->getMessage(),
            ]);
            exit;
        }
    }
}
