<?php

namespace Controllers;

use Exception;
use Model\Cliente; 
use MVC\Router; 

class DetalleController {

    public static function estadisticas(Router $router){
        $router->render('cliente/estadisticas');
    }

    public static function detalleVentasAPI()
    {
        try {
            $sql = "SELECT 
                    a.asistencia_alumno, 
                    a.asistencia_curso, 
                    COUNT(a.asistencia_id) AS total_asistencias
                    FROM 
                    asistencia a
                    GROUP BY 
                    a.asistencia_alumno, 
                    a.asistencia_curso
                    ORDER BY 
                    total_asistencias DESC";

                    $datos = Cliente::fetchArray($sql);
                    echo json_encode($datos);
                    } catch (Exception $e) {
                    echo json_encode([
                    'detalle' => $e->getMessage(),
                    'mensaje' => 'Ocurrió un error', 
                    'codigo' => 0
            ]);
        }
    }
}
