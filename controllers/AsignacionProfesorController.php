<?php

namespace Controllers;

use Exception;
use Model\Profesores;
use Model\Seccion;
use Model\AsignacionProfesor;
use MVC\Router;

class AsignacionProfesorController
{
    public static function index(Router $router) {
        $profesores = Profesores::obtenerProfesores();
        $secciones = Seccion::obtenerSecciones();
        
        $router->render('asignacionprofesor/index', [
            'profesores' => $profesores,
            'secciones' => $secciones
        ]);
    }

 public static function guardarAPI()
{
    $_POST['profesor_sec'] = htmlspecialchars($_POST['profesor_sec']);
    

    try {
        $asignacionprofesor = new AsignacionProfesor($_POST);
        $resultado = $asignacionprofesor->crear();
        if ($resultado) {
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Profesor Asignado Correctamente',
            ]);
        } else {
            throw new Exception('Error al guardar en la base de datos');
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            'codigo' => 0,
            'mensaje' => 'Error al Asignar Profesor',
            'detalle' => $e->getMessage(),
            'trace' => $e->getTraceAsString() // Agrega esto para más información
        ]);
    }
}


    public static function buscarAPI()
    {
        try {
            $asignaciones = AsignacionProfesor::obtenerProfesores();
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
        $_POST['profesor_sec'] = htmlspecialchars($_POST['profesor_sec']);
        $id = filter_var($_POST['profesor_seccion_id'], FILTER_SANITIZE_NUMBER_INT);
        
        try {
            $asignacion = AsignacionProfesor::find($id);
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
        $id = filter_var($_POST['profesor_seccion_id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            $asignacion = AsignacionProfesor::find($id);
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
