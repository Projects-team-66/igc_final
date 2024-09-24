<?php

namespace Model;

class Alumno extends ActiveRecord
{
    protected static $tabla = 'alumnos';
    protected static $idTabla = 'alumno_id';
    protected static $columnasDB = ['alumno_nombre', 'alumno_apellido', 'alumno_fecha_nacimiento', 'alumno_direccion', 'alumno_telefono', 'alumno_email', 'alumno_situacion', 'alumno_tutor'];

    public $alumno_id;
    public $alumno_nombre;
    public $alumno_apellido;
    public $alumno_fecha_nacimiento;
    public $alumno_direccion;
    public $alumno_telefono;
    public $alumno_email;
    public $alumno_situacion;
    public $alumno_tutor;


    public function __construct($args = [])
    {
        $this->alumno_id = $args['alumno_id'] ?? null;
        $this->alumno_nombre = $args['alumno_nombre'] ?? '';
        $this->alumno_apellido = $args['alumno_apellido'] ?? '';
        $this->alumno_fecha_nacimiento = $args['alumno_fecha_nacimiento'] ?? '';
        $this->alumno_direccion = $args['alumno_direccion'] ?? '';
        $this->alumno_telefono = $args['alumno_telefono'] ?? '';
        $this->alumno_email = $args['alumno_email'] ?? '';
        $this->alumno_situacion = $args['alumno_situacion'] ?? 1;
        $this->alumno_tutor = $args['alumno_tutor'] ?? '';
    }

    public static function obtenerAlumnosconQuery()
    {
        $sql = "SELECT * FROM alumnos where alumno_situacion = 1";
        return self::fetchArray($sql);
    }

    //Funcion para que busque los nombres de los alumnos por medio del ID, el id se iguala como array ya que de no ser asi daba conflicto con la function find($id) del Modelo ActiveRecord
    public static function find($id = [])
    {
        if (isset($id[static::$idTabla])) {
            $idValor = filter_var($id[static::$idTabla], FILTER_SANITIZE_NUMBER_INT);
            $query = "SELECT * FROM " . static::$tabla . " WHERE " . static::$idTabla . " = " . self::$db->quote($idValor) . " LIMIT 1";
            $resultado = self::consultarSQL($query);
            return !empty($resultado) ? new self($resultado[0]) : null; // Devuelve una instancia de Alumno o null si no se encuentra
        }
        return null; // Retorna null si no se le da un ID
    }

    public static function buscar()
    {
        $sql = "SELECT 
    a.alumno_id,
    (a.alumno_nombre || ' ' || a.alumno_apellido) AS reporte_alumno,
    g.grado_nombre,
    s.seccion_nombre
FROM 
    alumnos a
JOIN 
    asignacion_alumnos aa ON a.alumno_id = aa.asignacion_alumno
JOIN 
    seccion s ON aa.asignacion_seccion = s.seccion_id
JOIN 
    grado g ON s.seccion_grado = g.grado_id;";
        return self::fetchArray($sql);
    }
}
