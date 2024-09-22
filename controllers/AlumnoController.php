<?php

namespace Controllers;

use Exception;
use Model\Alumno;
use MVC\Router;

class AlumnoController
{
    public static function index(Router $router)
    {
        $alumnos = Alumno::find(2); // Aquí puedes cambiar el '2' según sea necesario
        $router->render('alumnos/index', [
            'alumnos' => $alumnos
        ]);
    }

    public static function guardarAPI()
    {
        // Saneamiento de los datos recibidos por POST
        $_POST['alumno_nombre'] = htmlspecialchars($_POST['alumno_nombre']);
        $_POST['alumno_apellido'] = filter_var($_POST['alumno_apellido'], FILTER_SANITIZE_STRING);
        $_POST['alumno_fecha_nacimiento'] = filter_var($_POST['alumno_fecha_nacimiento'], FILTER_SANITIZE_STRING);
        $_POST['alumno_direccion'] = filter_var($_POST['alumno_direccion'], FILTER_SANITIZE_STRING);
        $_POST['alumno_telefono'] = filter_var($_POST['alumno_telefono'], FILTER_SANITIZE_STRING);
        $_POST['alumno_email'] = filter_var($_POST['alumno_email'], FILTER_SANITIZE_EMAIL);
        $_POST['tutor_id'] = filter_var($_POST['tutor_id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            // Crear nuevo alumno y guardarlo en la base de datos
            $alumno = new Alumno($_POST);
            $resultado = $alumno->crear();

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Alumno guardado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar alumno',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function buscarAPI()
    {
        try {
            // Obtener todos los alumnos (puedes modificar la consulta según tus necesidades)
            $alumnos = Alumno::all(); 
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos encontrados',
                'detalle' => '',
                'datos' => $alumnos
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar alumnos',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function modificarAPI()
    {
        // Saneamiento de los datos recibidos
        $_POST['alumno_nombre'] = htmlspecialchars($_POST['alumno_nombre']);
        $_POST['alumno_apellido'] = filter_var($_POST['alumno_apellido'], FILTER_SANITIZE_STRING);
        $_POST['alumno_fecha_nacimiento'] = filter_var($_POST['alumno_fecha_nacimiento'], FILTER_SANITIZE_STRING);
        $_POST['alumno_direccion'] = filter_var($_POST['alumno_direccion'], FILTER_SANITIZE_STRING);
        $_POST['alumno_telefono'] = filter_var($_POST['alumno_telefono'], FILTER_SANITIZE_STRING);
        $_POST['alumno_email'] = filter_var($_POST['alumno_email'], FILTER_SANITIZE_EMAIL);
        $id = filter_var($_POST['alumno_id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            // Buscar el alumno por ID y actualizar
            $alumno = Alumno::find($id);
            $alumno->sincronizar($_POST);
            $alumno->actualizar();

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Alumno modificado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al modificar alumno',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function eliminarAPI()
    {
        // Saneamiento del ID del alumno
        $alumno_id = filter_var($_POST['alumno_id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            // Buscar y eliminar el alumno
            $alumno = Alumno::find($alumno_id);
            $alumno->eliminar();

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Alumno eliminado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminar alumno',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
