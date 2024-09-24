<?php

namespace Controllers;

use Exception;
use Model\Grado;
use Model\Seccion;
use MVC\Router;

class SeccionController
{
    public static function index(Router $router) {
        $grados = Grado::obtenerGradoconQuery();
        
        $router->render('seccion/index', [
            'grados' => $grados
        ]);
    }

 public static function guardarAPI()
{
    $_POST['seccion_nombre'] = htmlspecialchars($_POST['seccion_nombre']);
    $_POST['seccion_grado'] = filter_var($_POST['seccion_grado'], FILTER_SANITIZE_NUMBER_INT);

    try {
        $seccion = new Seccion($_POST);
        $resultado = $seccion->crear();
        if ($resultado) {
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Seccion Registrada Correctamente',
            ]);
        } else {
            throw new Exception('Error al guardar en la base de datos');
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode([
            'codigo' => 0,
            'mensaje' => 'Error al registrar Seccion',
            'detalle' => $e->getMessage(),
            'trace' => $e->getTraceAsString() // Agrega esto para más información
        ]);
    }
}


    public static function buscarAPI()
    {
        try {
            $secciones = Seccion::obtenerSecciones();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos encontrados',
                'detalle' => '',
                'datos' => $secciones
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al buscar Secciones',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function modificarAPI()
    {
        $_POST['seccion_nombre'] = htmlspecialchars($_POST['seccion_nombre']);
        $id = filter_var($_POST['seccion_id'], FILTER_SANITIZE_NUMBER_INT);
        
        try {
            $seccion = Seccion::find($id);
            $seccion->sincronizar($_POST);
            $seccion->actualizar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Datos de la Seccion modificados exitosamente',
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
        $id = filter_var($_POST['seccion_id'], FILTER_SANITIZE_NUMBER_INT);

        try {
            $seccion = Seccion::find($id);
            $seccion->eliminar();
            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Seccion eliminada exitosamente',
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al eliminar la Seccion',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}
