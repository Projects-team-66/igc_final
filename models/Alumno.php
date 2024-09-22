<?php

namespace Model;

class Alumno extends ActiveRecord{
    protected static $tabla = 'alumnos';
    protected static $columnasDB = ['alumno_nombre','alumno_apellido','alumno_fecha_nacimiento','alumno_direccion','alumno_telefono','alumno_email','alumno_situacion','tutor_id'];
    protected static $idTabla = 'alumno_id';
    
    public $alumno_id;
    public $alumno_nombre;
    public $alumno_apellido;
    public $alumno_fecha_nacimiento;
    public $alumno_direccion;
    public $alumno_telefono;
    public $alumno_email;
    public $alumno_situacion;
    public $tutor_id;

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
        $this->tutor_id = $args['tutor_id'] ?? '';
    }

    public static function obtenerAlumnos()
    {
        $sql = "SELECT * FROM alumnos where alumno_situacion = 1";
        return self::fetchArray($sql);
    }

    public static function find($id = [])
{
    // Asegúrate de que se proporciona un ID en el array
    if (isset($id[static::$idTabla])) {
        $idValor = filter_var($id[static::$idTabla], FILTER_SANITIZE_NUMBER_INT);
        $query = "SELECT * FROM " . static::$tabla . " WHERE " . static::$idTabla . " = " . self::$db->quote($idValor) . " LIMIT 1";
        $resultado = self::consultarSQL($query);
        return !empty($resultado) ? new self($resultado[0]) : null; // Devuelve una instancia de Alumno o null si no se encuentra
    }
    return null; // Retorna null si no se proporcionó un ID
}

}
