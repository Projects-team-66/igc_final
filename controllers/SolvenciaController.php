<?php

namespace Controllers;

use Mpdf\Mpdf;
use MVC\Router;
use Model\Pago;
use Model\Alumno;
use Model\Grado;
use Exception;

class SolvenciaController
{
    public static function index(Router $router)
    {
        // Usar el método del modelo para obtener los Alumnos
        $alumnos = Alumno::obtenerAlumnosconQuery();
        $grados = Grado::obtenerGradoconQuery();

        // Pasar los alumnos y grados a la vista
        $router->render('solvencia/index', [
            'alumnos' => $alumnos,
            'grados' => $grados
        ]);
    }
    public static function ObtenerPago()
    {
        $sql = "SELECT 
                    p.pago_id,
                    a.alumno_nombre,
                    s.seccion_nombre,
                    g.grado_nombre,
                    g.grado_monto,
                    p.pago_fecha,
                    p.pago_estado,
                    p.pago_mes
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
                    p.pago_situacion = 1;";

        return Pago::fetchArray($sql); // Asegúrate de que esta función esté disponible en la clase Pago
    }

    public static function pdf(Router $router)
    {
        $pagos = static::ObtenerPago(); // Obtén todos los pagos

        // Crear un objeto mPDF
        $mpdf = new Mpdf([
            "orientation" => "P",
            "default_font_size" => 12,
            "default_font" => "arial",
            "format" => "Letter",
            "mode" => 'utf-8'
        ]);
        $mpdf->SetMargins(50, 40, 25);

        // Cargar la vista para el PDF
        $html = $router->load('solvencia/pdf', [
            'pagos' => $pagos
        ]);

        // Escribir el HTML en el documento PDF
        $mpdf->WriteHTML($html);
        $mpdf->Output(); // Salida del PDF
    }
}
