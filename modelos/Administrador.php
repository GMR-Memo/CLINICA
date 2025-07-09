<?php
namespace Modelos;

class Administrador {
    public int $id = 0;
    public string $nombre = "";
    public string $correo = "";
    public string $contrasena = "";

    public function __construct(
        int $id   = 0,
        string $nombre = "",
        string $correo = "",
        string $contrasena = ""
    ) {
        $this->id          = $id;
        $this->nombre      = $nombre;
        $this->correo      = $correo;
        $this->contrasena  = $contrasena;
    }
}
