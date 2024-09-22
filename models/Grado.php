<?php

namespace Model;

class Grado extends ActiveRecord
{
    protected static $tabla = 'grado';
    protected static $idTabla = 'grado_id';
    protected static $columnasDB = ['grado_nombre', 'grado_situacion'];

    public $grado_id;
    public $grado_nombre;
    public $grado_situacion;


    public function __construct($args = [])
    {
        $this->grado_id = $args['grado_id'] ?? null;
        $this->grado_nombre = $args['grado_nombre'] ?? '';
        $this->grado_situacion = $args['grado_situacion'] ?? 1;
    }

    public static function obtenerGradoconQuery()
    {
        $sql = "SELECT * FROM grado where grado_situacion = 1";
        return self::fetchArray($sql);
    }

}
