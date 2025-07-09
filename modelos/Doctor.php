<?php
namespace Modelos;

/**
 * Representa un doctor de la clínica
 */
class Doctor {
    public int $id = 0;
    public string $nombre = "";
    public string $correo = "";
    public string $contrasena = "";
    public string $cedula = "";
    public string $especialidad = "";
    public string $telefono = "";
    public string $direccion = "";

    public function __construct(
        int $id,
        string $nombre,
        string $correo,
        string $contrasena,
        string $cedula,
        string $especialidad,
        string $telefono,
        string $direccion
    ) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->contrasena = $contrasena;
        $this->cedula = $cedula;
        $this->especialidad = $especialidad;
        $this->telefono = $telefono;
        $this->direccion = $direccion;
    }
}
