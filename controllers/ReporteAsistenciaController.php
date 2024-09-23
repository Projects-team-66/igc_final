<?php

namespace Controllers;

use Exception;
use Model\Asistencia;
use Model\Grado;
use Model\ReporteAsistencia;
use Model\Seccion;
use MVC\Router;

class ReporteAsistenciaController
{
    public static function index(Router $router) {
        $grados = Grado::obtenerGradoconQuery();  
        $secciones = Seccion::obtenerSecciones(); 

        $router->render('reporte_asistencia/index', [
            'grados' => $grados,
            'secciones' => $secciones
        ]);
    }

    public static function buscarAPI()
    {
        try {
            $asistencias = Asistencia::obtenerReporteAsistencia();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos encontrados',
                'detalle' => '',
                'datos' => $asistencias
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar asistencias',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function obtenerAsistencia(Router $router)
    {
        $seccion_id = $_POST['seccion_id'];

        // Realiza la consulta para obtener la asistencia
        $asistencias = Asistencia::obtenerAsistenciaPorSeccion($seccion_id);

        echo json_encode($asistencias);
    }
}
