<?php

namespace Models;

use Model\ActiveRecord;
use Model\Asistencia;
use PDO;

class ReporteAsistencia extends ActiveRecord
{
    // Nombre de la tabla asociada
    protected static $tabla = 'reporte_asistencia';
    protected static $columnasDB = ['reporte_asis_grado', 'reporte_asis_seccion', 'reporte_asis_situacion'];
    protected static $idTabla = 'reporte_asistencia_id';

    public $reporte_asistencia_id;
    public $reporte_asis_grado;
    public $reporte_asis_seccion;
    public $reporte_asis_situacion;

    public function __construct($args = [])
    {
        $this->reporte_asistencia_id = $args['reporte_asistencia_id'] ?? null;
        $this->reporte_asis_grado = $args['reporte_asis_grado'] ?? null;
        $this->reporte_asis_seccion = $args['reporte_asis_seccion'] ?? null;
        $this->reporte_asis_situacion = $args['reporte_asis_situacion'] ?? 1;
    }

    // Método para obtener el reporte de asistencia por sección
    public static function obtenerReportePorSeccion($seccion_id)
    {
        return Asistencia::obtenerAsistenciaPorSeccion($seccion_id);
    }

    public static function obtenerReportes()
    {
        $sql = "SELECT * FROM reporte_asistencia WHERE reporte_asis_situacion = 1";
        return self::fetchArray($sql);
    }
}

