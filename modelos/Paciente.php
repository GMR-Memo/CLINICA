<?php
namespace Modelos;
 
class Paciente {
    public int $id = 0;
    public string $nombre = "";
    public string $correo = "";
    public string $genero = "";
    public string $contrasena = "";
    public string $telefono = "";
    public string $direccion = "";
    public int $edad = 0;

    public function __construct(
        int $id,
        string $nombre,
        string $correo,
        string $genero,
        string $contrasena,
        string $telefono,
        string $direccion,
        int $edad
    ) {
        $this->id         = $id;
        $this->nombre     = $nombre;
        $this->correo     = $correo;
        $this->genero     = $genero;
        $this->contrasena = $contrasena;
        $this->telefono   = $telefono;
        $this->direccion  = $direccion;
        $this->edad       = $edad;
    }
}
