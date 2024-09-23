<?php

namespace Controllers;

use Model\Asistencia;
use Model\Grado;
use Model\Seccion;
use MVC\Router;

class ReporteAsistenciaController
{
    public static function index(Router $router) {
        $grados = Grado::obtenerGradoconQuery();  
        $secciones = Seccion::obtenerSecciones();  // Usa este método

        $router->render('reporte_asistencia/index', [
            'grados' => $grados,
            'secciones' => $secciones
        ]);
    }


    public static function obtenerAsistencia(Router $router)
    {
        $seccion_id = $_POST['seccion_id'];

        // Realiza la consulta para obtener la asistencia
        $asistencias = Asistencia::obtenerAsistenciaPorSeccion($seccion_id);

        echo json_encode($asistencias);
    }
}
