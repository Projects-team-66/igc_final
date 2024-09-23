<?php
namespace Model;

use PDO;

class ReporteConducta extends ActiveRecord
{
    protected static $tabla = 'reporte_conducta';
    protected static $columnasDB = [
        'reporte_alumno', 
        'reporte_conducta', 
        'reporte_situacion',
    ];
    protected static $idTabla = 'reporte_conducta_id';

    public $reporte_conducta_id;
    public $reporte_alumno; 
    public $reporte_conducta;
    public $reporte_situacion;

    
    public $alumno_nombre; 
    public $seccion_nombre; 
    public $grado_nombre; 


    public function __construct($args = [])
    {
        $this->reporte_conducta_id = $args['reporte_conducta_id'] ?? null;
        $this->reporte_alumno = $args['reporte_alumno'] ?? null;
        $this->reporte_conducta = $args['reporte_conducta'] ?? null;
        $this->reporte_situacion = $args['reporte_situacion'] ?? 1;

        // Asignar los nombres si están presentes en las tablas
        $this->alumno_nombre = $args['alumno_nombre'] ?? '';
        $this->seccion_nombre = $args['seccion_nombre'] ?? '';
        $this->grado_nombre = $args['grado_nombre'] ?? '';

    }

    // public static function obtenerAsistencias()
    // {
    //     $sql = "
    //         SELECT a.*, al.alumno_nombre, al.alumno_apellido, c.curso_nombre
    //         FROM asistencia a
    //         JOIN alumnos al ON a.asistencia_alumno = al.alumno_id
    //         JOIN curso c ON a.asistencia_curso = c.curso_id
    //         WHERE a.asistencia_situacion = 1
    //     ";
    //     return self::fetchArray($sql);
    // }

    // public static function obtenerAsistenciaPorSeccion($grado_id, $seccion_id)
    // {
    //     $sql = "
    //         SELECT 
    //             al.alumno_nombre || ' ' || al.alumno_apellido AS nombre_completo,  
    //             g.grado_nombre AS grado,
    //             s.seccion_nombre AS seccion,
    //             c.curso_nombre AS curso,
    //             a.asistencia_estado AS asistencia
    //         FROM asistencia a
    //         INNER JOIN asignacion_alumnos aa ON a.asistencia_alumno = aa.alumno_id
    //         INNER JOIN alumnos al ON aa.alumno_id = al.alumno_id
    //         INNER JOIN seccion s ON aa.seccion_id = s.seccion_id
    //         INNER JOIN grado g ON s.grado_id = g.grado_id
    //         INNER JOIN curso c ON a.asistencia_curso = c.curso_id
    //         WHERE s.seccion_id = :seccion_id AND g.grado_id = :grado_id
    //     ";

    //     $params = [
    //         ':seccion_id' => $seccion_id,
    //         ':grado_id' => $grado_id
    //     ];

    //     return self::fetchArray($sql, $params);
    // }
}
