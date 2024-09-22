<?php

namespace Controllers;

use Exception;
use Model\Seccion;
use MVC\Router;

class SeccionController
{
    public static function index(Router $router)
    {

        $router->render('seccion/index', []);
    }

    public static function guardarAPI()
    {
        $_POST['seccion_nombre'] = htmlspecialchars($_POST['seccion_nombre']);

        try {
            $seccion = new Seccion($_POST);
            $resultado = $seccion->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Seccion Guardado Exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar Seccion',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function buscarAPI()
     {
         try {
             
             $secciones = Seccion::obtenerGradoconQuery();
             http_response_code(200);
             echo json_encode([
                 'codigo' => 1,
                 'mensaje' => 'Datos encontrados',
                 'detalle' => '',
                 'datos' => $secciones
             ]);
         } catch (Exception $e) {
             http_response_code(500);
             echo json_encode([
                 'codigo' => 0,
                 'mensaje' => 'Error al buscar seccion',
                 'detalle' => $e->getMessage(),
             ]);
         }
     }


     public static function eliminarAPI()
     {

         $id = filter_var($_POST['seccion_id'], FILTER_SANITIZE_NUMBER_INT);

         try {

             $seccion = Seccion::find($id);
             $seccion->eliminar();
             http_response_code(200);
             echo json_encode([
                 'codigo' => 1,
                 'mensaje' => 'Seccion Eliminado Exitosamente',
             ]);
         } catch (Exception $e) {
             http_response_code(500);
             echo json_encode([
                 'codigo' => 0,
                 'mensaje' => 'Error al Eliminar seccion',
                 'detalle' => $e->getMessage(),
             ]);
         }
     }
};
