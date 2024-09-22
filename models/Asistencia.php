<?php

namespace Model;

class Asistencia extends ActiveRecord
{
    protected static $tabla = 'asistencia';
    protected static $columnasDB = [
        'asistencia_alumno', 
        'asistencia_curso', 
        'asistencia_fecha', 
        'asistencia_estado', 
        'asistencia_situacion'
    ];
    protected static $idTabla = 'asistencia_id';

    public $asistencia_id;
    public $asistencia_alumno;
    public $asistencia_curso;
    public $asistencia_fecha;
    public $asistencia_estado;
    public $asistencia_situacion;

    public function __construct($args = [])
    {
        $this->asistencia_id = $args['asistencia_id'] ?? null;
        $this->asistencia_alumno = $args['asistencia_alumno'] ?? null;
        $this->asistencia_curso = $args['asistencia_curso'] ?? null;
        $this->asistencia_fecha = $args['asistencia_fecha'] ?? '';
        $this->asistencia_estado = $args['asistencia_estado'] ?? null;
        $this->asistencia_situacion = $args['asistencia_situacion'] ?? 1;
    }

    public static function obtenerAsistencias()
    {
        $sql = "SELECT * FROM asistencia WHERE asistencia_situacion = 1";
        return self::fetchArray($sql);
    }
}
