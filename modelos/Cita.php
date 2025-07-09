<?php

namespace Modelos;

class Cita
{
    public int $id;
    public int $paciente_id;
    public int $doctor_id;
    public string $fecha;
    public string $motivo;
    public string $paciente_nombre = '';
    public string $doctor_nombre = '';
    public bool $completada = false;



    public function __construct($id, $paciente_id, $doctor_id, $fecha, $motivo,$completada = false)
    {
        $this->id = $id;
        $this->paciente_id = $paciente_id;
        $this->doctor_id = $doctor_id;
        $this->fecha = $fecha;
        $this->motivo = $motivo;
        $this->completada = $completada;
    }
}
