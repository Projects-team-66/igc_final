<?php
namespace Model;

use PDO;

class Asistencia extends ActiveRecord
{
    protected static $tabla = 'asistencia';
    protected static $columnasDB = [
        'asistencia_alumno', 
        'asistencia_curso', 
        'asistencia_fecha', 
        'asistencia_estado', 
        'asistencia_situacion',
    ];
    protected static $idTabla = 'asistencia_id';

    public $asistencia_id;
    public $asistencia_alumno; // ID del alumno
    public $asistencia_curso; // ID del curso
    public $asistencia_fecha;
    public $asistencia_estado;
    public $asistencia_situacion;

    // Nuevas propiedades para que reconozca los nombres de alumnos y cursos en el select
    public $alumno_nombre; // Nombre del alumno
    public $curso_nombre;  // Nombre del curso

    public function __construct($args = [])
    {
        $this->asistencia_id = $args['asistencia_id'] ?? null;
        $this->asistencia_alumno = $args['asistencia_alumno'] ?? null;
        $this->asistencia_curso = $args['asistencia_curso'] ?? null;
        $this->asistencia_fecha = $args['asistencia_fecha'] ?? '';
        $this->asistencia_estado = $args['asistencia_estado'] ?? null;
        $this->asistencia_situacion = $args['asistencia_situacion'] ?? 1;

        // Asignar los nombres si están presentes en las tablas
        $this->alumno_nombre = $args['alumno_nombre'] ?? '';
        $this->curso_nombre = $args['curso_nombre'] ?? '';
    }

    public static function obtenerAsistencias()
    {
        $sql = "
            SELECT a.*, al.alumno_nombre, al.alumno_apellido, c.curso_nombre
            FROM asistencia a
            JOIN alumnos al ON a.asistencia_alumno = al.alumno_id
            JOIN curso c ON a.asistencia_curso = c.curso_id
            WHERE a.asistencia_situacion = 1
        ";
        return self::fetchArray($sql);
    }

    public static function obtenerAsistenciaPorSeccion($grado_id, $seccion_id)
    {
        $sql = "
            SELECT 
                al.alumno_nombre || ' ' || al.alumno_apellido AS nombre_completo,  
                g.grado_nombre AS grado,
                s.seccion_nombre AS seccion,
                c.curso_nombre AS curso,
                a.asistencia_estado AS asistencia
            FROM asistencia a
            INNER JOIN asignacion_alumnos aa ON a.asistencia_alumno = aa.alumno_id
            INNER JOIN alumnos al ON aa.alumno_id = al.alumno_id
            INNER JOIN seccion s ON aa.seccion_id = s.seccion_id
            INNER JOIN grado g ON s.grado_id = g.grado_id
            INNER JOIN curso c ON a.asistencia_curso = c.curso_id
            WHERE s.seccion_id = :seccion_id AND g.grado_id = :grado_id
        ";

        $params = [
            ':seccion_id' => $seccion_id,
            ':grado_id' => $grado_id
        ];

        return self::fetchArray($sql, $params);
    }
}
