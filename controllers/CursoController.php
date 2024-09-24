<?php

namespace Controllers;

use Exception;
use Model\Curso;
use MVC\Router;


class CursoController
{
    public static function index(Router $router)
    {
        $curso = Curso::find(2);
        $router->render('curso/index', [
            'curso' => $curso
        ]);
    }


    public static function guardarAPI()
    {
        $_POST['curso_nombre'] = htmlspecialchars($_POST['curso_nombre']);
        try {
            $curso = new Curso($_POST);
            $resultado = $curso->crear();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Curso registrado exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al registrar Curso',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
    public static function buscarAPI()
    {
        try {
            $cursos = Curso::obtenerCursos();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos encontrados',
                'detalle' => '',
                'datos' => $cursos
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar Cursos',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function modificarAPI()
    {
        $_POST['curso_nombre'] = htmlspecialchars($_POST['curso_nombre']);
        $id = filter_var($_POST['curso_id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            $curso = Curso::find($id);
            $curso->sincronizar($_POST);
            $curso->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos del Curso Modificados Exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al Modificar Datos',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function eliminarAPI()
    {
        $id = filter_var($_POST['curso_id'], FILTER_SANITIZE_NUMBER_INT);

        if (!$id) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'ID de curso no válido',
            ]);
            return;
        }

        try {
            $curso = Curso::find($id);

            if (!$curso) {
                http_response_code(404);
                echo json_encode([
                    'codigo' => 0,
                    'mensaje' => 'Curso no encontrado',
                ]);
                return;
            }

            $curso->eliminar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Curso Eliminado Exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al Eliminar Curso',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
