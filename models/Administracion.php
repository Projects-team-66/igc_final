<?php

namespace Model;

class Administracion extends ActiveRecord
{
    protected static $tabla = 'administracion';
    protected static $idTabla = 'app_id';
    protected static $columnasDB = ['app_id', 'app_nombre', 'app_situacion'];

    public $app_id;
    public $app_nombre;
    public $app_situacion;


    public function __construct($args = [])
    {
        $this->app_id = $args['app_id'] ?? null;
        $this->app_nombre = $args['app_nombre'] ?? '';
        $this->app_situacion = $args['app_situacion'] ?? 1;
    }

    public static function obteneradministracionconQuery()
    {
        $sql = "SELECT * FROM administracion where app_situacion = 1";
        return self::fetchArray($sql);
    }

}
