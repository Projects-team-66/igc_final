<?php

namespace Model;

class Tutor extends ActiveRecord
{
    protected static $tabla = 'tutor';
    protected static $idTabla = 'tutor_id';
    protected static $columnasDB = ['tutor_nombre', 'tutor_apellido', 'tutor_telefono', 'tutor_email', 'tutor_direccion', 'tutor_relacion', 'tutor_situacion'];

    public $tutor_id;
    public $tutor_nombre;
    public $tutor_apellido;
    public $tutor_telefono;
    public $tutor_email;
    public $tutor_direccion;
    public $tutor_relacion;
    public $tutor_situacion;


    public function __construct($args = [])
    {
        $this->tutor_id = $args['tutor_id'] ?? null;
        $this->tutor_nombre = $args['tutor_nombre'] ?? '';
        $this->tutor_apellido = $args['tutor_apellido'] ?? '';
        $this->tutor_telefono = $args['tutor_telefono'] ?? '';
        $this->tutor_email = $args['tutor_email'] ?? '';
        $this->tutor_direccion = $args['tutor_direccion'] ?? '';
        $this->tutor_situacion = $args['tutor_situacion'] ?? 1;
    }

    public static function obtenertutorconQuery()
    {
        // Concatenar tutor_nombre y tutor_apellido con un espacio entre ellos
        $sql = "SELECT * FROM tutor WHERE tutor_situacion = 1";

        return self::fetchArray($sql);
    }
}
