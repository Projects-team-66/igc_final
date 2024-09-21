<?php

namespace Controllers;

use Exception;
use Model\Alumno;
use MVC\Router;

class AlumnoController {
    public static function index(Router $router) {
        $router->render('alumnos/index');
    }

    public static function guardar() {
        $alumno = new Alumno($_POST);
        $resultado = $alumno->guardar();
        echo json_encode($resultado);
    }

    public static function buscar() {
        $alumnos = Alumno::all();
        echo json_encode(['codigo' => 1, 'datos' => $alumnos]);
    }

    public static function modificar() {
        $alumno = Alumno::find($_POST['alumno_id']);
        if (!$alumno) {
            echo json_encode(['codigo' => 0, 'mensaje' => 'Alumno no encontrado']);
            return;
        }

        $alumno->sincronizar($_POST);
        $resultado = $alumno->guardar();
        echo json_encode($resultado);
    }

    public static function eliminar() {
        $alumno = Alumno::find($_POST['id']);
        if (!$alumno) {
            echo json_encode(['codigo' => 0, 'mensaje' => 'Alumno no encontrado']);
            return;
        }

        $resultado = $alumno->eliminar();
        echo json_encode($resultado);
    }
}
