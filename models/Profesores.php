<?php

namespace Model;

class Profesores extends ActiveRecord
{
    protected static $tabla = 'profesor';
    protected static $columnasDB = ['profesor_nombre', 'profesor_apellido', 'profesor_email', 'profesor_telefono', 'profesor_direccion', 'profesor_situacion'];
    protected static $idTabla = 'profesor_id';

    public $profesor_id;
    public $profesor_nombre;
    public $profesor_apellido;
    public $profesor_email;
    public $profesor_telefono;
    public $profesor_direccion;
    public $profesor_situacion;

    public function __construct($args = [])
    {
        $this->profesor_id = $args['profesor_id'] ?? null;
        $this->profesor_nombre = $args['profesor_nombre'] ?? '';
        $this->profesor_nombre = $args['profesor_apellido'] ?? '';
        $this->profesor_nombre = $args['profesor_email'] ?? '';
        $this->profesor_telefono = $args['profesor_telefono'] ?? '';
        $this->profesor_nombre = $args['profesor_direccion'] ?? '';
        $this->profesor_situacion = $args['profesor_situacion'] ?? 1;
    }

    
    public static function obtenerProfesores()
    {
        $sql = "SELECT * FROM profesor where profesor_situacion = 1";
        return self::fetchArray($sql);
    }
}
