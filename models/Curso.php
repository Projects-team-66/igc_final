<?php

namespace Model;

class Curso extends ActiveRecord
{
    protected static $tabla = 'curso';
    protected static $columnasDB = ['curso_nombre', 'curso_descripcion', 'curso_creditos', 'curso_situacion'];
    protected static $idTabla = 'curso_id';

    public $curso_id;
    public $curso_nombre;
    public $curso_descripcion;
    public $curso_creditos;
    public $curso_situacion;

    public function __construct($args = [])
    {
        $this->curso_id = $args['curso_id'] ?? null;
        $this->curso_nombre = $args['curso_nombre'] ?? '';
        $this->curso_descripcion = $args['curso_descripcion'] ?? '';
        $this->curso_creditos = $args['curso_creditos'] ?? 0;
        $this->curso_situacion = $args['curso_situacion'] ?? 1;
    }

    public static function obtenerCursos()
    {
        $sql = "SELECT * FROM curso WHERE curso_situacion = 1";
        return self::fetchArray($sql);
    }
}
