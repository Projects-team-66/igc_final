<?php

namespace Model;

class AsignacionAlumno extends ActiveRecord
{
    protected static $tabla = 'asignacion_alumnos';
    protected static $columnasDB = [
        'asignacion_alumno',
        'asignacion_seccion',
        'asignacion_situacion',

    ];

    protected static $idTabla = 'asignacion_id';

    public $asignacion_id;
    public $asignacion_alumno;
    public $asignacion_seccion;
    public $asignacion_situacion;

    // // Nuevas propiedades para los nombres
    // public $alumno_nombre; // Nombre del alumno
    // public $curso_nombre;  // Nombre del curso

    public function __construct($args = [])
    {
        $this->asignacion_id = $args['asignacion_id'] ?? null;
        $this->asignacion_alumno = $args['asignacion_alumno'] ?? null;
        $this->asignacion_seccion = $args['asignacion_seccion'] ?? null;
        $this->asignacion_situacion = $args['asignacion_situacion'] ?? 1;

        // Asignar los nombres si están presentes
        // $this->alumno_nombre = $args['alumno_nombre'] ?? '';
        // $this->curso_nombre = $args['curso_nombre'] ?? '';
    }

    public static function obtenerAlumnosAsignados()
    {
        $sql = "
            SELECT aa.*, al.alumno_nombre, al.alumno_apellido, s.seccion_nombre, g.grado_nombre
            FROM asignacion_alumnos aa
            JOIN alumnos al ON aa.asignacion_alumno = al.alumno_id
            JOIN seccion s ON aa.asignacion_seccion = s.seccion_id
            JOIN grado g ON s.seccion_grado = g.grado_id
            WHERE aa.asignacion_situacion = 1;
        ";
        return self::fetchArray($sql);
    }
}
