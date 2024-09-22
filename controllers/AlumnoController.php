<?php

namespace Controllers;

use Exception;
use Model\Alumno;
use MVC\Router;

class AlumnoController
{
    public static function index(Router $router)
    {
        $sql = "SELECT * FROM tutor where tutor_situacion = 1";
        $router->render('alumnos/index', []);
    }

    public static function guardarAPI()
    {
        $_POST['alumno_nombre'] = htmlspecialchars($_POST['alumno_nombre']);

        try {
            $alumno = new Alumno($_POST);
            $resultado = $alumno->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Alumno Guardado Exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar Alumno',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function buscarAPI()
     {
         try {
             
             $alumnos = Alumno::obtenerAlumnosconQuery();
             http_response_code(200);
             echo json_encode([
                 'codigo' => 1,
                 'mensaje' => 'Datos encontrados',
                 'detalle' => '',
                 'datos' => $alumnos
             ]);
         } catch (Exception $e) {
             http_response_code(500);
             echo json_encode([
                 'codigo' => 0,
                 'mensaje' => 'Error al buscar Alumnos',
                 'detalle' => $e->getMessage(),
             ]);
         }
     }

     public static function modificarAPI()
     {
         $_POST['alumno_nombre'] = htmlspecialchars($_POST['alumno_nombre']);
         $id = filter_var($_POST['alumno_id'], FILTER_SANITIZE_NUMBER_INT);
         try {

             $alumno = Alumno::find($id);
             $alumno->sincronizar($_POST);
             $alumno->actualizar();
             http_response_code(200);
             echo json_encode([
                 'codigo' => 1,
                 'mensaje' => 'Datos del Alumno Modificados Exitosamente',
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

         $id = filter_var($_POST['alumno_id'], FILTER_SANITIZE_NUMBER_INT);

         try {

             $alumno = Alumno::find($id);
             $alumno->eliminar();
             http_response_code(200);
             echo json_encode([
                 'codigo' => 1,
                 'mensaje' => 'Alumno Eliminado Exitosamente',
             ]);
         } catch (Exception $e) {
             http_response_code(500);
             echo json_encode([
                 'codigo' => 0,
                 'mensaje' => 'Error al Eliminar Alumno',
                 'detalle' => $e->getMessage(),
             ]);
         }
     }
};