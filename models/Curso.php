<?php
namespace Model;

class Curso extends ActiveRecord
{
    protected static $tabla = 'curso';
    protected static $columnasDB = ['curso_id', 'curso_nombre', 'curso_descripcion', 'curso_creditos', 'curso_situacion'];
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

    public static function find($id = [])
    {
    //Funcion para que busque los nombres de los cursos por medio del ID, el id se iguala como array ya que de no ser asi daba conflicto con la function find($id) del Modelo ActiveRecord
    if (isset($id[static::$idTabla])) {
            $idValor = filter_var($id[static::$idTabla], FILTER_SANITIZE_NUMBER_INT);
            $query = "SELECT * FROM " . static::$tabla . " WHERE " . static::$idTabla . " = " . self::$db->quote($idValor) . " LIMIT 1";
            $resultado = self::consultarSQL($query);
            return !empty($resultado) ? new self($resultado[0]) : null; // Devuelve una instancia de Curso o null si no se encuentra
        }
        return null; // Retorna null si no se le da un ID
    }
}
