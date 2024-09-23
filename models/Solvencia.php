<?php

namespace Model;

class Solvencia extends ActiveRecord
{
    protected static $tabla = 'matricula';
    protected static $idTabla = 'matricula_id';
    protected static $columnasDB = ['matricula_alumno', 'matricula_curso', 'matricula_fecha', 'matricula_estado', 'matricula_situacion'];

    public $matricula_id;
    public $matricula_alumno;
    public $matricula_curso;
    public $matricula_fecha;
    public $matricula_estado;
    public $matricula_situacion;


    public function __construct($args = [])
    {
        $this->matricula_id = $args['matricula_id'] ?? null;
        $this->matricula_alumno = $args['matricula_alumno'] ?? '';
        $this->matricula_curso = $args['matricula_curso'] ?? '';
        $this->matricula_fecha = $args['matricula_fecha'] ?? '';
        $this->matricula_estado = $args['matricula_estado'] ?? '';
        $this->matricula_situacion = $args['matricula_situacion'] ?? 1;
    }

    public static function obtenerSolvenciaconQuery()
    {
        $sql = "SELECT * FROM matricula where matricula_situacion = 1";
        return self::fetchArray($sql);
    }


    public static function obtenerSolvencia()
    {
        $sql = "
             SELECT 
            m.matricula_id,
            a.alumno_nombre,
            a.alumno_apellido,
            c.curso_nombre,
            m.matricula_fecha,
            m.matricula_estado
        FROM 
            matricula m
        JOIN 
            alumnos a ON m.matricula_alumno = a.alumno_id
        JOIN 
            curso c ON m.matricula_curso = c.curso_id
        WHERE 
            m.matricula_situacion = 1";
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
