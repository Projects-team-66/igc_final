<?php

namespace Controllers;

use Model\ReporteAsistencia;
use MVC\Router;

class ReporteAsistenciaController
{
    public static function index(Router $router)
    {
        $reportes = ReporteAsistencia::obtenerReportes();
        $router->render('reportes/index', [
            'reportes' => $reportes
        ]);
    }

}
