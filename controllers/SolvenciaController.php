<?php

namespace Controllers;

use Mpdf\Mpdf;
use MVC\Router;
use Model\Pago;
use Exception;

class SolvenciaController
{
    public static function index(Router $router)
    {
        // Renderiza la vista principal de solvencia
        $router->render('solvencia/index', []); // Ajustar el nombre del archivo
    }

    public static function ObtenerPagoPorMes($mes)
    {
        $sql = "SELECT 
                    p.pago_id,
                    a.alumno_nombre,
                    g.grado_nombre,
                    g.grado_monto,
                    p.pago_fecha,
                    p.pago_estado
                FROM 
                    pago p
                JOIN 
                    alumnos a ON p.pago_alumno = a.alumno_id
                JOIN 
                    asignacion_alumnos aa ON a.alumno_id = aa.asignacion_alumno
                JOIN 
                    seccion s ON aa.asignacion_seccion = s.seccion_id
                JOIN 
                    grado g ON s.seccion_grado = g.grado_id
                WHERE 
                    p.pago_situacion = 1 AND MONTH(p.pago_fecha) = ?"; // Filtra por mes

        return Pago::fetchArray($sql, [$mes]); // Pasa el mes como parámetro
    }

    public static function generarPdf(Router $router)
    {
        try {
            // Obtener el mes desde el POST
            $mesSeleccionado = $_POST['pago_mes'];

            // Obtener los pagos correspondientes al mes
            $pagos = static::ObtenerPagoPorMes($mesSeleccionado);

            // Crear un objeto mPDF
            $mpdf = new Mpdf([
                "orientation" => "P",
                "default_font_size" => 12,
                "default_font" => "arial",
                "format" => "Letter",
                "mode" => 'utf-8'
            ]);
            $mpdf->SetMargins(50, 40, 25);

            // Capturar el HTML generado por la vista para el PDF
            ob_start(); // Iniciar buffer de salida
            $router->render('solvencia/generarPdf', [
                'pagos' => $pagos,
                'mes' => $mesSeleccionado
            ]);
            $html = ob_get_clean(); // Obtener el HTML generado

            // Escribir el HTML en el documento PDF
            $mpdf->WriteHTML($html);
            $mpdf->Output(); // Salida del PDF

        } catch (Exception $e) {
            // Manejo de error
            echo 'Se produjo un error al generar el PDF: ',  $e->getMessage();
        }
    }
}
