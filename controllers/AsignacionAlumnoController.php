<?php

namespace Controllers;

use Exception;
use Model\Alumno;
use Model\Seccion;
use Model\AsignacionAlumno;
use MVC\Router;

class AsignacionAlumnoController
{
    public static function index(Router $router) {
        $alumnos = Alumno::obtenerAlumnosconQuery();
        $seccion = Seccion::obtenerSeccionconQuery();
        
        $router->render('asignacionalumno/index', [
            'alumnos' => $alumnos,
            'seccion' => $seccion
        ]);
    }

 public static function guardarAPI()
{
    $_POST['asignacion_alumno'] = htmlspecialchars($_POST['asignacion_alumno']);
    $_POST['asignacion_seccion'] = htmlspecialchars($_POST['asignacion_fseccion']);

    try {
        $asignacionalumno = new AsignacionAlumno($_POST);
        $resultado = $asignacionalumno->crear();
        if ($resultado) {
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Alumno Asignado Correctamente',
            ]);
        } else {
            throw new Exception('Error al guardar en la base de datos');
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            'codigo' => 0,
            'mensaje' => 'Error al Asignar Alumno',
            'detalle' => $e->getMessage(),
            'trace' => $e->getTraceAsString() // Agrega esto para más información
        ]);
    }
}


    public static function buscarAPI()
    {
        try {
            $asignaciones = AsignacionAlumno::obtenerAlumnosAsignados();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos encontrados',
                'detalle' => '',
                'datos' => $asignaciones
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar Asignaciones',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function modificarAPI()
    {
        $_POST['asignacion_alumno'] = htmlspecialchars($_POST['asignacion_alumno']);
        $id = filter_var($_POST['asignacion_id'], FILTER_SANITIZE_NUMBER_INT);
        
        try {
            $asignacion = AsignacionAlumno::find($id);
            $asignacion->sincronizar($_POST);
            $asignacion->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Modificacion Exitosa',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al Modificar los datos',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function eliminarAPI()
    {
        $id = filter_var($_POST['asignacion_id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            $asignacion = AsignacionAlumno::find($id);
            $asignacion->eliminar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Asignacion Eliminada',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminar la Asignacion',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
