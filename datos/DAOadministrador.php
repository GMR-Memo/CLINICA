<?php
require_once __DIR__ . '/Conexion.php';
require_once __DIR__ . '/../modelos/Administrador.php';

use Modelos\Administrador;

class AdministradorDAO {
    private $con;

    public function __construct() {
        $this->con = Conexion::conectar();
    }

    public function crear(Administrador $admin): Administrador {
        // 1) Insert en tabla usuarios
        $sql1 = "INSERT INTO usuarios (correo, contrasena, rol)
                 VALUES (:correo, :contrasena, 'administrador')";
        $stmt1 = $this->con->prepare($sql1);
        $hash = password_hash($admin->contrasena, PASSWORD_DEFAULT);
        $stmt1->execute([
            ':correo'     => $admin->correo,
            ':contrasena' => $hash
        ]);
        $admin->id = (int)$this->con->lastInsertId();

        // 2) Insert en tabla administradores
        $sql2 = "INSERT INTO administradores (id, nombre)
                 VALUES (:id, :nombre)";
        $stmt2 = $this->con->prepare($sql2);
        $stmt2->execute([
            ':id'     => $admin->id,
            ':nombre' => $admin->nombre
        ]);

        return $admin;
    }

    public function obtenerPorId(int $id): ?Administrador {
        $sql = "SELECT u.id, a.nombre, u.correo
                FROM usuarios u
                JOIN administradores a ON u.id = a.id
                WHERE u.id = :id AND u.rol = 'administrador'";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([':id' => $id]);
        $fila = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$fila) return null;

        return new Administrador(
            (int)$fila['id'],
            $fila['nombre'],
            $fila['correo'],
            '' // no devolvemos la contraseña
        );
    }

    // (Opcional) actualizar y eliminar...
}
