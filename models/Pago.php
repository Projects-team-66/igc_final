<?php

namespace Model;

class Pago extends ActiveRecord
{
    protected static $tabla = 'pago';
    protected static $idTabla = 'pago_id';
    protected static $columnasDB = ['pago_alumno', 'pago_mes', 'pago_fecha', 'pago_estado', 'pago_situacion'];

    public $pago_id;
    public $pago_alumno;
    public $pago_mes;
    public $pago_fecha;
    public $pago_estado;
    public $pago_situacion;


    public function __construct($args = [])
    {
        $this->pago_id = $args['pago_id'] ?? null;
        $this->pago_alumno = $args['pago_alumno'] ?? '';
        $this->pago_mes = $args['pago_mes'] ?? '';
        $this->pago_fecha = $args['pago_fecha'] ?? '';
        $this->pago_estado = $args['pago_estado'] ?? '';
        $this->pago_situacion = $args['pago_situacion'] ?? 1;
    }

    public static function obtenerPagoconQuery()
    {
        $sql = "SELECT * FROM pago where pago_situacion = 1";
        return self::fetchArray($sql);
    }

    public static function obtenerPago()
    {
        $sql = "SELECT 
            p.pago_id,
            a.alumno_nombre,
            s.seccion_nombre,
            g.grado_nombre,
            g.grado_monto,
            p.pago_fecha,
            p.pago_estado,
            p.pago_mes
        FROM 
            pago p
        JOIN 
            alumnos a ON p.pago_alumno = a.alumno_id
        JOIN 
            asignacion_alumnos aa ON a.alumno_id = aa.asignacion_alumno
        JOIN 
            seccion s ON aa.asignacion_seccion = s.seccion_id
        JOIN 
            grado g ON s.seccion_grado = g.grado_id
        WHERE 
            p.pago_situacion = 1;";

                return self::fetchArray($sql);
    }

    // public static function find($id = [])
    // {
    //     // Asegúrate de que se proporciona un ID en el array
    //     if (isset($id[static::$idTabla])) {
    //         $idValor = filter_var($id[static::$idTabla], FILTER_SANITIZE_NUMBER_INT);
    //         $query = "SELECT * FROM " . static::$tabla . " WHERE " . static::$idTabla . " = " . self::$db->quote($idValor) . " LIMIT 1";
    //         $resultado = self::consultarSQL($query);
    //         return !empty($resultado) ? new self($resultado[0]) : null; // Devuelve una instancia de Alumno o null si no se encuentra
    //     }
    //     return null; // Retorna null si no se proporcionó un ID
    // }
}
