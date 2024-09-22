<?php

namespace Controllers;

use Exception;
use Model\Tutor;
use MVC\Router;

class TutorController
{
    public static function index(Router $router)
    {

        $router->render('tutor/index', []);
    }

    public static function guardarAPI()
    {
        $_POST['tutor_nombre'] = htmlspecialchars($_POST['tutor_nombre']);

        try {
            $tutor = new Tutor($_POST);
            $resultado = $tutor->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Tutor Guardado Exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar Tutor',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function buscarAPI()
     {
         try {
             
             $tutores = Tutor::obtenerTutorconQuery();
             http_response_code(200);
             echo json_encode([
                 'codigo' => 1,
                 'mensaje' => 'Datos encontrados',
                 'detalle' => '',
                 'datos' => $tutores
             ]);
         } catch (Exception $e) {
             http_response_code(500);
             echo json_encode([
                 'codigo' => 0,
                 'mensaje' => 'Error al buscar Tutores',
                 'detalle' => $e->getMessage(),
             ]);
         }
     }

     public static function modificarAPI()
     {
         $_POST['tutor_nombre'] = htmlspecialchars($_POST['tutor_nombre']);
         $id = filter_var($_POST['tutor_id'], FILTER_SANITIZE_NUMBER_INT);
         try {

             $tutor = Tutor::find($id);
             $tutor->sincronizar($_POST);
             $tutor->actualizar();
             http_response_code(200);
             echo json_encode([
                 'codigo' => 1,
                 'mensaje' => 'Datos del Tutor Modificados Exitosamente',
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

         $id = filter_var($_POST['tutor_id'], FILTER_SANITIZE_NUMBER_INT);

         try {

             $tutor = Tutor::find($id);
             $tutor->eliminar();
             http_response_code(200);
             echo json_encode([
                 'codigo' => 1,
                 'mensaje' => 'Tutor Eliminado Exitosamente',
             ]);
         } catch (Exception $e) {
             http_response_code(500);
             echo json_encode([
                 'codigo' => 0,
                 'mensaje' => 'Error al Eliminar Tutor',
                 'detalle' => $e->getMessage(),
             ]);
         }
     }
};
