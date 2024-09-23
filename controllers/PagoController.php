<?php

namespace Controllers;

use Exception;
use Model\Alumno;
use Model\Grado;
use Model\Pago;
use MVC\Router;

class PagoController
{
    public static function index(Router $router)
    {
        // Usar el método del modelo para obtener los Alumnos
        $alumnos = Alumno::obtenerAlumnosconQuery();
        $grados = Grado::obtenerGradoconQuery();

        // Pasar los alumnos y grados a la vista
        $router->render('pago/index', [
            'alumnos' => $alumnos,
            'grados' => $grados
        ]);
    }

    public static function guardarAPI()
    {
        $_POST['pago_alumno'] = htmlspecialchars($_POST['pago_alumno']);

        try {
            $pago = new Pago($_POST);
            $resultado = $pago->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Pago Registrado Exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al Registrar Pago',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function buscarAPI()
     {
         try {
             
             $pago = Pago::obtenerPago();
             http_response_code(200);
             echo json_encode([
                 'codigo' => 1,
                 'mensaje' => 'Datos encontrados',
                 'detalle' => '',
                 'datos' => $pago
             ]);
         } catch (Exception $e) {
             http_response_code(500);
             echo json_encode([
                 'codigo' => 0,
                 'mensaje' => 'Error al buscar Pagos',
                 'detalle' => $e->getMessage(),
             ]);
         }
     }

     public static function modificarAPI()
     {
         $_POST['pago_alumno'] = htmlspecialchars($_POST['pago_alumno'], FILTER_SANITIZE_NUMBER_INT);
         $id = filter_var($_POST['pago_id'], FILTER_SANITIZE_NUMBER_INT);
         try {

             $pago = Pago::find($id);
             $pago->sincronizar($_POST);
             $pago->actualizar();
             http_response_code(200);
             echo json_encode([
                 'codigo' => 1,
                 'mensaje' => 'Datos del Pago Modificados Exitosamente',
             ]);
         } catch (Exception $e) {
             http_response_code(500);
             echo json_encode([
                 'codigo' => 0,
                 'mensaje' => 'Error al Modificar el Pago',
                 'detalle' => $e->getMessage(),
             ]);
         }
     }

     public static function eliminarAPI()
     {

         $id = filter_var($_POST['pago_id'], FILTER_SANITIZE_NUMBER_INT);

         try {

             $pago = Pago::find($id);
             $pago->eliminar();
             http_response_code(200);
             echo json_encode([
                 'codigo' => 1,
                 'mensaje' => 'Pago Eliminado Exitosamente',
             ]);
         } catch (Exception $e) {
             http_response_code(500);
             echo json_encode([
                 'codigo' => 0,
                 'mensaje' => 'Error al Eliminar Pago',
                 'detalle' => $e->getMessage(),
             ]);
         }
     }
};