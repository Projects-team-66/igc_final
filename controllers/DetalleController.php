<?php

namespace Controllers;

use Exception;
use Model\Asistencia; 
use MVC\Router; 

class DetalleController {

    public static function estadistica(Router $router){
        $router->render('grafica/estadistica');
    }


    public static function detalleEnviosAPI(){
        try {

            $sql = 'SELECT 
    al.alumno_nombre AS nombre_alumno, 
    cu.curso_nombre AS nombre_curso, 
    COUNT(a.asistencia_id) AS total_asistencias
FROM 
    asistencia a
JOIN 
    alumnos al ON a.asistencia_alumno = al.alumno_id 
JOIN 
    curso cu ON a.asistencia_curso = cu.curso_id 
GROUP BY 
    al.alumno_nombre, 
    cu.curso_nombre
ORDER BY 
    total_asistencias DESC;';

            $datos = Asistencia::fetchArray($sql);
            
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