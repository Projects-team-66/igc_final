<?php

namespace Model;

use PDO;

class ReporteConducta extends ActiveRecord
{
    protected static $tabla = 'reporte_conducta';
    protected static $idTabla = 'reporte_conducta_id';
    protected static $columnasDB = ['reporte_alumno', 'reporte_conducta', 'reporte_fecha', 'reporte_situacion'];

    public $reporte_conducta_id;
    public $reporte_alumno;
    public $reporte_conducta;
    public $reporte_fecha;
    public $reporte_situacion;



    public function __construct($args = [])
    {
        $this->reporte_conducta_id = $args['reporte_conducta_id'] ?? null;
        $this->reporte_alumno = $args['reporte_alumno'] ?? null;
        $this->reporte_conducta = $args['reporte_conducta'] ?? null;
        $this->reporte_fecha = $args['reporte_fecha'] ?? null;
        $this->reporte_situacion = $args['reporte_situacion'] ?? 1;
    }

    public static function obtenerReporteConducta()
    {
        $sql = "SELECT 
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
GROUP BY 
    rc.reporte_conducta_id,
    a.alumno_nombre,
    a.alumno_apellido,
    g.grado_nombre,
    s.seccion_nombre,
    rc.reporte_conducta,
    rc.reporte_fecha;
";
        return self::fetchArray($sql);
    }
}
