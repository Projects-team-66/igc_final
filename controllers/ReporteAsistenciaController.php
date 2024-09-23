<?php

namespace Controllers;

use Model\Grado;
use Model\Seccion;
use MVC\Router;

class ReporteAsistenciaController
{
    public static function index(Router $router) {
        $grados = Grado::all();  
        $secciones = Seccion::all();  

        $router->render('reportes/reporte_asistencia', [
            'grados' => $grados,
            'secciones' => $secciones
        ]);

}
}
