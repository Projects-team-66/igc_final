<?php

namespace Controllers;

use Exception;
use Model\Alumno;
use Model\Curso;
use Model\Solvencia;
use MVC\Router;

class SolvenciaController
{
    public static function index(Router $router)
    {
        // Usar el método del modelo para obtener los Alumnos
        $alumnos = Alumno::obtenerAlumnosconQuery();
        $cursos = Curso::obtenerCursos();

        // Pasar los alumnos y cursos a la vista
        $router->render('solvencia/index', [
            'alumnos' => $alumnos,
            'cursos' => $cursos
        ]);
    }

    public static function guardarAPI()
    {
        $_POST['matricula_alumno'] = htmlspecialchars($_POST['matricula_alumno']);

        try {
            $solvencia = new Solvencia($_POST);
            $resultado = $solvencia->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Solvencia Guardada Exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar Solvencia',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function buscarAPI()
     {
         try {
             
             $solvencia = Solvencia::obtenerSolvencia();
             http_response_code(200);
             echo json_encode([
                 'codigo' => 1,
                 'mensaje' => 'Datos encontrados',
                 'detalle' => '',
                 'datos' => $solvencia
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
         $_POST['matricula_alumno'] = htmlspecialchars($_POST['matricula_alumno'], FILTER_SANITIZE_NUMBER_INT);
         $id = filter_var($_POST['matricula_id'], FILTER_SANITIZE_NUMBER_INT);
         try {

             $solvencia = Solvencia::find($id);
             $solvencia->sincronizar($_POST);
             $solvencia->actualizar();
             http_response_code(200);
             echo json_encode([
                 'codigo' => 1,
                 'mensaje' => 'Datos de la Solvencia Modificados Exitosamente',
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

         $id = filter_var($_POST['matricula_id'], FILTER_SANITIZE_NUMBER_INT);

         try {

             $solvencia = Solvencia::find($id);
             $solvencia->eliminar();
             http_response_code(200);
             echo json_encode([
                 'codigo' => 1,
                 'mensaje' => 'Solvencia Eliminado Exitosamente',
             ]);
         } catch (Exception $e) {
             http_response_code(500);
             echo json_encode([
                 'codigo' => 0,
                 'mensaje' => 'Error al Eliminar Solvencia',
                 'detalle' => $e->getMessage(),
             ]);
         }
     }
};