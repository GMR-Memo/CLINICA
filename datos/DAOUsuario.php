<?php
// Archivo: datos/DAOUsuario.php

require_once '../Conexion.php';


class DAOUsuario {
    private \PDO $con;

    public function __construct() {
        $this->con = Conexion::conectar();
    }

    /**
     * Autentica al usuario por correo, contraseña y rol.
     * @param string $correo
     * @param string $contrasena
     * @param string $rol         // "paciente", "doctor" o "administrador"
     * @return object|null        // { id, correo, rol, contrasena(hash) } o null
     */
    public function autenticar(string $correo, string $contrasena, string $rol): ?object {
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
            ':rol'    => $rol,
        ]);
        $usr = $stmt->fetch(\PDO::FETCH_OBJ);
        if ($usr && password_verify($contrasena, $usr->contrasena)) {
            return $usr;
        }
        return null;
    }
}
