<?php

namespace Model;

class Alumno extends ActiveRecord{
    protected static $tabla = 'alumnos';
    protected static $columnasDB = ['alumno_nombre','alumno_apellido','alumno_fecha_nacimiento','alumno_direccion','alumno_telefono','alumno_email','alumno_situacion'];
    protected static $idTabla = 'alumno_id';
    
    public $alumno_id;
    public $alumno_nombre;
    public $alumno_apellido;
    public $alumno_fecha_nacimiento;
    public $alumno_direccion;
    public $alumno_telefono;
    public $alumno_email;
    public $alumno_situacion;

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
    }
}