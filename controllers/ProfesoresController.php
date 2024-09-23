<?php

namespace Controllers;

use Exception;
use Model\Profesores;
use MVC\Router;


class ProfesoresController
{
    public static function index(Router $router)
    {
        $profesor = Profesores::find(2);
        $router->render('profesores/index', [
            'profesor' => $profesor
        ]);
    }


    public static function guardarAPI()
    {
        $_POST['profesor_nombre'] = htmlspecialchars($_POST['profesor_nombre']);
        try {
            $profesor = new Profesores($_POST);
            $resultado = $profesor->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Profesor registrado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al registrar profesor',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
    public static function buscarAPI()
    {
        try {
            $profesores = Profesores::obtenerProfesores();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos encontrados',
                'detalle' => '',
                'datos' => $profesores
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar Profesores',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function modificarAPI()
    {
        $_POST['profesor_nombre'] = htmlspecialchars($_POST['profesor_nombre']);
        $id = filter_var($_POST['profesor_id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            $profesor = Profesores::find($id);
            $profesor->sincronizar($_POST);
            $profesor->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos del Profesor Modificados Exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al Modificar Datos',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function eliminarAPI()
    {
        $id = filter_var($_POST['profesor_id'], FILTER_SANITIZE_NUMBER_INT);

        if (!$id) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'ID de profesor no válido',
            ]);
            return;
        }

        try {
            $profesor = Profesores::find($id);

            if (!$profesor) {
                http_response_code(404);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Profesor no encontrado',
                ]);
                return;
            }

            $profesor->eliminar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Profesor Eliminado Exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al Eliminar Profesor',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
