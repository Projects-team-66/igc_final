<?php

namespace Model;

class AsignacionAlumnos extends ActiveRecord
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
    public $alumno_nombre;
    public $curso_nombre;

    public function __construct($args = [])
    {
        $this->asignacion_id = $args['asignacion_id'] ?? null;
        $this->asignacion_alumno = $args['asignacion_alumno'] ?? '';
        $this->asignacion_seccion = $args['asignacion_seccion'] ?? '';
        $this->asignacion_situacion = $args['asignacion_situacion'] ?? 1;

        // Asignar los nombres ajenos
        $this->alumno_nombre = $args['alumno_nombre'] ?? '';
        $this->curso_nombre = $args['curso_nombre'] ?? '';
    }


    public static function obtenerAsignaciones()
    {
        $sql = "
            SELECT 
    aa.asignacion_id,
    a.alumno_nombre,      -- Primero el nombre del alumno
    a.alumno_apellido,    -- Luego el apellido del alumno
    g.grado_nombre,       -- Luego el grado
    s.seccion_nombre      -- Finalmente la sección
FROM 
    asignacion_alumnos aa
JOIN 
    alumnos a ON aa.asignacion_alumno = a.alumno_id
JOIN 
    seccion s ON aa.asignacion_seccion = s.seccion_id
JOIN 
    grado g ON s.seccion_grado = g.grado_id
WHERE 
    aa.asignacion_situacion = 1
    AND s.seccion_situacion = 1 
    AND g.grado_situacion = 1";
        return self::fetchArray($sql);
    }

    public static function obtenerAsignacionconQuery()
    {
        $sql = "SELECT * FROM asignacion_alumnos WHERE asignacion_situacion = 1";

        return self::fetchArray($sql);
    }
}
