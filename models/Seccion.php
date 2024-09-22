<?php

namespace Model;

class Seccion extends ActiveRecord
{
    protected static $tabla = 'seccion';
    protected static $idTabla = 'seccion_id';
    protected static $columnasDB = ['seccion_nombre', seccion_grado];

    public $seccion_id;
    public $seccion_nombre;
    public $seccion_grado;


    public function __construct($args = [])
    {
        $this->seccion_id = $args['seccion_id'] ?? null;
        $this->seccion_nombre = $args['seccion_nombre'] ?? '';
        $this->seccion_grado = $args['seccion_grado'] ?? '';
    }

    public static function obtenerGradoconQuery()
    {
        $sql = "SELECT * FROM seccion;
        return self::fetchArray($sql);
    }

}
