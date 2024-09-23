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
