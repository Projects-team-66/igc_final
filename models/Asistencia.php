<?php
namespace Model;

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

    public static function obtenerAsistenciaPorSeccion($seccion_id)
    {
        $sql = "
            SELECT 
                a.asistencia_id, 
                a.fecha, 
                a.estado, 
                al.alumno_nombre, 
                al.alumno_apellido, 
                g.grado_nombre, 
                s.seccion_nombre 
            FROM asistencia a
            JOIN asignacion_alumnos aa ON a.alumno_id = aa.alumno_id
            JOIN alumnos al ON aa.alumno_id = al.alumno_id
            JOIN seccion s ON aa.seccion_id = s.seccion_id
            JOIN grado g ON s.grado_id = g.grado_id
            WHERE s.seccion_id = :seccion_id
        ";

        $params = [
            ':seccion_id' => $seccion_id
        ];

        return self::fetchArray($sql, $params);
    }

    public static function obtenerReporteAsistencia()
    {
        $sql = "
            SELECT 
                a.alumno_nombre || ' ' || a.alumno_apellido AS nombre_completo,
                g.grado_nombre AS grado,
                s.seccion_nombre AS seccion,
                c.curso_nombre AS curso,
                asis.asistencia_estado AS asistencia
            FROM
                alumnos a
            INNER JOIN 
                asignacion_alumnos aa ON a.alumno_id = aa.asignacion_alumno
            INNER JOIN 
                seccion s ON aa.asignacion_seccion = s.seccion_id
            INNER JOIN 
                grado g ON s.seccion_grado = g.grado_id
            INNER JOIN 
                asistencia asis ON a.alumno_id = asis.asistencia_alumno
            INNER JOIN 
                curso c ON asis.asistencia_curso = c.curso_id
            WHERE
                a.alumno_situacion = 1
        ";

        return self::fetchArray($sql); // Ejecuta la consulta y retorna los resultados como array
    }
}

