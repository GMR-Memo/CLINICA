<?php
require_once '../Conexion.php';
require_once '../modelos/Administrador.php';

use Modelos\Administrador;

class AdministradorDAO {
    private $con;

    public function __construct() {
        $this->con = Conexion::conectar();
    }

    public function crear(Administrador $admin): Administrador {
        // 1) Insert en tabla usuarios
        $sql1 = "
            INSERT INTO usuarios (correo, contrasena, rol)
            VALUES (:correo, :contrasena, 'administrador')
        ";
        $stmt1 = $this->con->prepare($sql1);
        $hash = password_hash($admin->contrasena, PASSWORD_DEFAULT);
        $stmt1->execute([
            ':correo'     => $admin->correo,
            ':contrasena' => $hash
        ]);
        $admin->id = (int)$this->con->lastInsertId();

        // 2) Insert en tabla administradores
        $sql2 = "
            INSERT INTO administradores (id, nombre)
            VALUES (:id, :nombre)
        ";
        $stmt2 = $this->con->prepare($sql2);
        $stmt2->execute([
            ':id'     => $admin->id,
            ':nombre' => $admin->nombre
        ]);

        return $admin;
    }

    /**
     * Busca al administrador por correo y devuelve el objeto completo
     * (incluye nombre y hash para password_verify).
     */
    public function obtenerPorCorreo(string $correo): ?Administrador {
        $sql = "
            SELECT 
              u.id,
              u.correo,
              u.contrasena,
              a.nombre
            FROM usuarios u
            JOIN administradores a 
              ON u.id = a.id
            WHERE u.correo = :correo
              AND u.rol = 'administrador'
            LIMIT 1
        ";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([':correo' => $correo]);
        $fila = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$fila) {
            return null;
        }

        // Construimos el objeto con nombre y hash
        return new Administrador(
            (int)$fila['id'],
            $fila['nombre'],
            $fila['correo'],
            $fila['contrasena']
        );
    }

    /**
     * (Opcional) Si en algún punto necesitas buscar por ID,
     * puedes agregar este método idéntico al anterior pero filtrando por u.id = :id
     */
    public function obtenerPorId(int $id): ?Administrador {
        $sql = "
            SELECT 
              u.id,
              u.correo,
              u.contrasena,
              a.nombre
            FROM usuarios u
            JOIN administradores a 
              ON u.id = a.id
            WHERE u.id = :id
              AND u.rol = 'administrador'
            LIMIT 1
        ";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([':id' => $id]);
        $fila = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$fila) {
            return null;
        }
        return new Administrador(
            (int)$fila['id'],
            $fila['nombre'],
            $fila['correo'],
            $fila['contrasena']
        );
    }
}
