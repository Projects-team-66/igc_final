<?php
namespace Model;

class Seccion extends ActiveRecord
{
    protected static $tabla = 'seccion';
    protected static $columnasDB = [
        'seccion_nombre', 
        'seccion_grado', 
        'seccion_situacion', 

    ];
    protected static $idTabla = 'seccion_id';

    public $seccion_id;
    public $seccion_nombre;
    public $seccion_grado;
    public $seccion_situacion;

    // Nuevas propiedades para los grados
    public $grado_nombre; // Nombre del grado

    public function __construct($args = [])
    {
        $this->seccion_id = $args['seccion_id'] ?? null;
        $this->seccion_nombre = $args['seccion_nombre'] ?? null;
        $this->seccion_grado = $args['seccion_grado'] ?? null;
        $this->seccion_situacion = $args['asistencia_situacion'] ?? 1;

        // Asignar los nombres si están presentes
        $this->grado_nombre = $args['grado_nombre'] ?? '';
    }

    public static function obtenerSeccionconQuery()
    {
        $sql = "SELECT * FROM seccion where seccion_situacion = 1";
        return self::fetchArray($sql);
    }

    public static function obtenerSecciones()
    {
        $sql = "
            SELECT 
                s.seccion_id, 
                s.seccion_nombre, 
                g.grado_nombre 
            FROM seccion s
            JOIN grado g ON s.seccion_grado = g.grado_id
            WHERE s.seccion_situacion = 1";
        return self::fetchArray($sql);
    }
    
}
