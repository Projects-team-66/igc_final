<?php

namespace Controllers;

use Model\ActiveRecord;
use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use MVC\Router;

class PDFController
{
    public static function pdf(Router $router)
    {

        $id = $_POST['reporte_conducta_id'];
    
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    
        $mpdf = new Mpdf([
            "default_font_size" => "12",
            "default_font" => "arial",
            "orientation" => "P",
            "margin_top" => "30",
            "margin_bottom" => "10",
            "format" => "Letter"
        ]);
        
     
        
       
        $productos = ActiveRecord::fetchArray(" SELECT 
    rc.reporte_conducta_id,
    (a.alumno_nombre || ' ' || a.alumno_apellido) AS reporte_alumno,
    g.grado_nombre,
    s.seccion_nombre,
    rc.reporte_conducta,
    rc.reporte_fecha
FROM 
    reporte_conducta rc
JOIN 
    alumnos a ON rc.reporte_alumno = a.alumno_id
JOIN 
    asignacion_alumnos aa ON a.alumno_id = aa.asignacion_alumno
JOIN 
    seccion s ON aa.asignacion_seccion = s.seccion_id
JOIN 
    grado g ON s.seccion_grado = g.grado_id
WHERE reporte_conducta_id = $id;");
    
        $html = $router->load('pdf/reporte', [
            'productos' => $productos
        ]);
    
        if (empty($html)) {
            die("No se generó contenido para el PDF.");
        }
    
        $css = file_get_contents(__DIR__ . '/../views/pdf/styles.css');
        $header = $router->load('pdf/header');
        $footer = $router->load('pdf/footer');
        $mpdf->SetHTMLHeader($header);
        $mpdf->SetHTMLFooter($footer);
        $mpdf->WriteHTML($css, HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html, HTMLParserMode::HTML_BODY);
    
        // Generar y mostrar el PDF
        $mpdf->Output("reporte.pdf", "I");

    }

}