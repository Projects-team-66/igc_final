<?php

namespace Controllers;

use Exception;
use Model\Alumno;
use Model\Asistencia;
use Model\Curso;
use MVC\Router;

class AsistenciaController
{
    public static function index(Router $router) {
        $alumnos = Alumno::obtenerAlumnosconQuery();
        $cursos = Curso::obtenerCursos();
        
        $router->render('asistencia/index', [
            'alumnos' => $alumnos,
            'cursos' => $cursos
        ]);
    }

 public static function guardarAPI()
{
    $_POST['asistencia_fecha'] = htmlspecialchars($_POST['asistencia_fecha']);
    $_POST['asistencia_alumno'] = filter_var($_POST['asistencia_alumno'], FILTER_SANITIZE_NUMBER_INT);
    $_POST['asistencia_curso'] = filter_var($_POST['asistencia_curso'], FILTER_SANITIZE_NUMBER_INT);
    $_POST['asistencia_estado'] = htmlspecialchars($_POST['asistencia_estado']);

    try {
        $asistencia = new Asistencia($_POST);
        $resultado = $asistencia->crear();
        if ($resultado) {
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Asistencia registrada exitosamente',
            ]);
        } else {
            throw new Exception('Error al guardar en la base de datos');
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            'codigo' => 0,
            'mensaje' => 'Error al registrar asistencia',
            'detalle' => $e->getMessage(),
        ]);
    }
}


    public static function buscarAPI()
    {
        try {
            $asistencias = Asistencia::obtenerAsistencias();
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

    public static function modificarAPI()
    {
        $_POST['asistencia_fecha'] = htmlspecialchars($_POST['asistencia_fecha']);
        $id = filter_var($_POST['asistencia_id'], FILTER_SANITIZE_NUMBER_INT);
        
        try {
            $asistencia = Asistencia::find($id);
            $asistencia->sincronizar($_POST);
            $asistencia->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos de la asistencia modificados exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al modificar los datos',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function eliminarAPI()
    {
        $id = filter_var($_POST['asistencia_id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            $asistencia = Asistencia::find($id);
            $asistencia->eliminar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Asistencia eliminada exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminar la asistencia',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
