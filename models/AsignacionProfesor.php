<?php

namespace Model;

class AsignacionProfesor extends ActiveRecord
{
    protected static $tabla = 'profesor_seccion';
    protected static $columnasDB = [
        'profesor_sec',
        'profesor_prof',
        'profesor_situacion',

    ];

    protected static $idTabla = 'profesor_seccion_id';

    public $profesor_seccion_id;
    public $profesor_sec;
    public $profesor_prof;
    public $profesor_situacion;

    // // Nuevas propiedades para los nombres
    public $seccion_nombre;
    public $seccion_grado;
    public $profesor_nombre;
    public $profesor_apellido;

    public function __construct($args = [])
    {
        $this->profesor_seccion_id = $args['profesor_seccion_id'] ?? null;
        $this->profesor_sec = $args['profesor_sec'] ?? '';
        $this->profesor_prof = $args['profesor_prof'] ?? '';
        $this->profesor_situacion = $args['profesor_situacion'] ?? 1;

        // Asignar los nombres ajenos
        $this->seccion_nombre = $args['seccion_nombre'] ?? '';
        $this->seccion_grado = $args['seccion_grado'] ?? '';
        $this->profesor_nombre = $args['profesor_nombre'] ?? '';
        $this->profesor_apellido = $args['profesor_apellido'] ?? '';
    }


    public static function obtenerProfesores()
    {
        $sql = "SELECT 
    ps.profesor_seccion_id,                   -- Agrega el ID de la asignación
    s.seccion_nombre,                          -- Nombre de la sección
    g.grado_nombre,                            -- Nombre del grado
    p.profesor_nombre AS profesor_nombre,      -- Nombre del profesor
    p.profesor_apellido AS profesor_apellido   -- Apellido del profesor
FROM 
    profesor_seccion ps
JOIN 
    profesor p ON ps.profesor_prof = p.profesor_id
JOIN 
    seccion s ON ps.profesor_sec = s.seccion_id
JOIN 
    grado g ON s.seccion_grado = g.grado_id   -- Unir con la tabla de grado
WHERE 
    ps.profesor_situacion = 1                  -- Situación activa del profesor_seccion
    AND p.profesor_situacion = 1               -- Situación activa del profesor
    AND s.seccion_situacion = 1";
        return self::fetchArray($sql);
    }

    public static function obtenerAsignacionconQuery()
    {
        $sql = "SELECT * FROM profesor_seccion WHERE profesor_situacion = 1";

        return self::fetchArray($sql);
    }
}
