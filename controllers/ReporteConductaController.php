<?php

namespace Controllers;

use Exception;
use Model\ReporteConducta;
use MVC\Router;

class ReporteConductaController
{
    public static function index(Router $router)
    {
        $router->render('reporteconducta/index', []);
    }

   
    public static function guardarAPI()
    {
        $_POST['reporte_alumno'] = filter_var($_POST['reporte_alumno'], FILTER_SANITIZE_NUMBER_INT);
        $_POST['reporte_conducta'] = htmlspecialchars($_POST['reporte_conducta']);
        $_POST['reporte_fecha'] = htmlspecialchars($_POST['reporte_fecha']);

        try {
            $reporte = new ReporteConducta($_POST);
            $resultado = $reporte->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Reporte Guardado Exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar Reporte',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function buscarAPI()
    {
        
        try {
            
            

            $grados = ReporteConducta::obtenerReporteConducta();
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
        $_POST['reporte_conducta'] = htmlspecialchars($_POST['reporte_conducta']);
        $_POST['reporte_fecha'] = htmlspecialchars($_POST['reporte_fecha']);
        $id = filter_var($_POST['reporte_conducta_id'], FILTER_SANITIZE_NUMBER_INT);
        try {
            $grado = ReporteConducta::find($id);

            if (!$grado) {
                http_response_code(404);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Reporte no encontrado',
                ]);
                return;
            }

            $grado->sincronizar($_POST);
            $grado->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos del Reporte Modificados Exitosamente',
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

        $id = filter_var($_POST['reporte_conducta_id'], FILTER_SANITIZE_NUMBER_INT);

        try {

            $grado = ReporteConducta::find($id);
            $grado->eliminar();

            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'reporte Eliminado Exitosamente'
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

}
