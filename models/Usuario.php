<?php

namespace Model;

class Usuario extends ActiveRecord
{
    protected static $tabla = 'usuario';
    protected static $idTabla = 'usu_id';
    protected static $columnasDB = ['usu_nombre', 'usu_catalogo', 'usu_password', 'usu_situacion'];

    public $usu_id;
    public $usu_nombre;
    public $usu_catalogo;
    public $usu_password;
    public $usu_situacion;


    public function __construct($args = [])
    {
        $this->usu_id = $args['usu_id'] ?? null;
        $this->usu_nombre = $args['usu_nombre'] ?? '';
        $this->usu_catalogo = $args['usu_catalogo'] ?? '';
        $this->usu_password = $args['usu_password'] ?? '';
        $this->usu_situacion = $args['usu_situacion'] ?? 1;
    }

   public function validarUsuarioExistente(): bool
   {
    $sql = "SELECT * FROM usuario WHERE usu_catalogo = $this->usu_catalogo";
    $resultado = static::fetchArray($sql);
    return $resultado ? true : false;
    exit;
   }

   public function getUsuarioExistente(): array
   {
    $sql = "SELECT usu_id, usu_nombre, usu_password, usu_catalogo, rol_nombre_ct, rol_nombre 
            FROM permiso INNER JOIN usuario ON permiso_usuario = usu_id 
            INNER JOIN rol on rol_id = permiso_rol 
            INNER JOIN aplicacion on rol_app = app_id 
            where usu_catalogo = $this->usu_catalogo";

    $resultado = static::fetchFirst($sql);
    return $resultado;
    exit;
   }

}
