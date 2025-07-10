<?php
// Archivo: datos/DAOUsuario.php

require_once '../Conexion.php';

class DAOUsuario {
    private \PDO $con;

    public function __construct() {
        $this->con = Conexion::conectar();
    }

    /**
     * Busca en usuarios por correo+rol y devuelve el objeto usuario (incluye contrasena-hash) o false.
     *
     * @param string $correo
     * @param string $rol
     * @return object|false
     */
    public function autenticar(string $correo, string $rol): object|false {
        $sql = "
            SELECT *
            FROM usuarios
            WHERE correo = :correo
              AND rol    = :rol
            LIMIT 1
        ";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([
            ':correo' => $correo,
            ':rol'    => $rol
        ]);
        $user = $stmt->fetch(\PDO::FETCH_OBJ);
        return $user ?: false;
    }
}
