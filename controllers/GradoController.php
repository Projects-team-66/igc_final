<?php

namespace Controllers;

use Exception;
use Model\Grado;
use MVC\Router;

class GradoController
{
    public static function index(Router $router)
    {

        $router->render('grado/index', []);
    }

    public static function guardarAPI()
    {
        $_POST['grado_nombre'] = htmlspecialchars($_POST['grado_nombre']);

        try {
            $grado = new Grado($_POST);
            $resultado = $grado->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Grado Guardado Exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar Grado',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function buscarAPI()
    {
        try {

            $grados = Grado::obtenerGradoconQuery();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos encontrados',
                'detalle' => '',
                'datos' => $grados
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar grados',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function modificarAPI()
    {
        $_POST['grado_nombre'] = htmlspecialchars($_POST['grado_nombre']);
        $id = filter_var($_POST['grado_id'], FILTER_SANITIZE_NUMBER_INT);
        try {
            $grado = Grado::find($id);

            // Verifica si el grado existe
            if (!$grado) {
                http_response_code(404);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Grado no encontrado',
                ]);
                return;
            }

            $grado->sincronizar($_POST);
            $grado->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos del Grado Modificados Exitosamente',
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

        $id = filter_var($_POST['grado_id'], FILTER_SANITIZE_NUMBER_INT);
        var_dump($id);

        try {

            $grado = Grado::find($id);
            $grado->eliminar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Grado Eliminado Exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al Eliminar grado',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
};
