<?php

namespace Model;

class Cliente extends ActiveRecord
{
    protected static $tabla = 'asistencia';
    protected static $columnasBD = ['asistencia_alumno', 'asistencia_curso','asistencia_fecha','asistencia_estado','asistencia_situacion','asistencia_total'];
    protected static $idTabla = 'asistencia_id';

    public $asistencia_id;
    public $asistencia_alumno;
    public $asistencia_curso;
    public $asistencia_fecha;
    public $asistencia_estado;
    public $asistencia_situacion;
    public $asistencia_total;

    public function __construct($args = [])
    {
        $this->asistencia_id = $args['asistencia_id'] ?? '';
        $this->asistencia_alumno = $args['asistencia_alumno'] ?? '';
        $this->asistencia_curso = $args['asistencia_curso'] ?? '';
        $this->asistencia_fecha = $args['asistencia_fecha'] ?? '';
        $this->asistencia_estado = $args['asistencia_estado'] ?? '';
        $this->asistencia_situacion = $args['asistencia_situacion'] ?? '';
        $this->asistencia_total = $args['asistencia_total'] ?? '';
    }
}
