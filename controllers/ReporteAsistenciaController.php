<?php
namespace Controllers;

use Model\Grado;
use Model\Seccion;
use Models\ReporteAsistencia as ModelsReporteAsistencia;
use MVC\Router;

class ReporteAsistenciaController 
{
    public static function index(Router $router) {
        $secciones = Seccion::obtenerSecciones();
        $grados = Grado::obtenerGradoconQuery();
        
        $router->render('reporte_asistencia/index', [
            'secciones' => $secciones,
            'grados' => $grados
        ]);
    }
    
    public static function buscarAPI(Router $router) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $grado = $_GET['grado'] ?? null;
            $seccion = $_GET['seccion'] ?? null;

            if ($grado && $seccion) {
                // Consulta para obtener el reporte de asistencia
                $sql = "
                    SELECT 
                        alumno_nombre || ' ' || alumno_apellido AS nombre_completo,  
                        grado_nombre AS grado,
                        seccion_nombre AS seccion,
                        curso_nombre AS curso,
                        asistencia_estado AS asistencia
                    FROM
                        alumnos
                    INNER JOIN 
                        asignacion_alumnos ON alumno_id = asignacion_alumno
                    INNER JOIN 
                        seccion ON asignacion_seccion = seccion_id
                    INNER JOIN 
                        grado ON seccion_grado = grado_id
                    INNER JOIN 
                        asistencia ON alumno_id = asistencia_alumno
                    INNER JOIN 
                        curso ON asistencia_curso = curso_id
                    WHERE
                        seccion_id = :seccion_id
                    AND 
                        grado_id = :grado_id
                ";

                $params = [
                    ':seccion_id' => $seccion,
                    ':grado_id' => $grado
                ];

                $reportes = ModelsReporteAsistencia::fetchArray($sql, $params);
                // Aquí puedes devolver los reportes como JSON o manejar la respuesta
            } else {
                // Manejar el caso donde grado o sección no están definidos
            }
        }
    }
}
