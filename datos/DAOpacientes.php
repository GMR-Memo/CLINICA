<?php 
require_once  '../Conexion.php';
require_once  '../modelos/Paciente.php';

use Modelos\Paciente;

class PacienteDAO {
    private $con;

    public function __construct() {
        $this->con = Conexion::conectar();
    }

    public function crear(Paciente $paciente): Paciente {
        $sql1 = "INSERT INTO usuarios (correo, contrasena, rol)
                 VALUES (:correo, :contrasena, 'paciente')";
        $stmt1 = $this->con->prepare($sql1);
        $hash = password_hash($paciente->contrasena, PASSWORD_DEFAULT);
        $stmt1->execute([
            ':correo' => $paciente->correo,
            ':contrasena' => $hash
        ]);
        $paciente->id = (int)$this->con->lastInsertId();

        $sql2 = "INSERT INTO pacientes (id, nombre, genero, telefono, direccion, edad)
                 VALUES (:id, :nombre, :genero, :telefono, :direccion, :edad)";
        $stmt2 = $this->con->prepare($sql2);
        $stmt2->execute([
            ':id' => $paciente->id,
            ':nombre' => $paciente->nombre,
            ':genero' => $paciente->genero,
            ':telefono' => $paciente->telefono,
            ':direccion' => $paciente->direccion,
            ':edad' => $paciente->edad
        ]);

        return $paciente;
    }

    public function obtenerTodos(): array {
        $sql = "SELECT u.id, u.correo, p.nombre, p.genero, p.telefono, p.direccion, p.edad
                FROM usuarios u
                JOIN pacientes p ON u.id = p.id
                WHERE u.rol = 'paciente'";
        $stmt = $this->con->query($sql);
        $lista = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $lista[] = new Paciente(
                (int)$fila['id'],
                $fila['nombre'],
                $fila['correo'],
                $fila['genero'],
                $fila['genero'],
                $fila['telefono'],
                $fila['direccion'],
                (int)$fila['edad']
            );
        }
        return $lista;
    }

    public function obtenerPorId(int $id): ?Paciente {
        $sql = "SELECT u.id, u.correo, p.nombre, p.genero, p.telefono, p.direccion, p.edad
                FROM usuarios u
                JOIN pacientes p ON u.id = p.id
                WHERE u.id = :id AND u.rol = 'paciente'";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([':id' => $id]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$fila) return null;

        return new Paciente(
            (int)$fila['id'],
            $fila['nombre'],
            $fila['correo'],
            '',
            $fila['genero'],
            $fila['telefono'],
            $fila['direccion'],
            (int)$fila['edad']
        );
    }

    public function actualizar(Paciente $paciente): bool {
        $sql1 = "UPDATE usuarios SET correo = :correo WHERE id = :id AND rol = 'paciente'";
        $stmt1 = $this->con->prepare($sql1);
        $stmt1->execute([
            ':correo' => $paciente->correo,
            ':id' => $paciente->id
        ]);

        $sql2 = "UPDATE pacientes SET
                    nombre = :nombre,
                    genero = :genero,
                    telefono = :telefono,
                    direccion = :direccion,
                    edad = :edad
                 WHERE id = :id";
        $stmt2 = $this->con->prepare($sql2);
        return $stmt2->execute([
            ':nombre' => $paciente->nombre,
            ':genero' => $paciente->genero,
            ':telefono' => $paciente->telefono,
            ':direccion' => $paciente->direccion,
            ':edad' => $paciente->edad,
            ':id' => $paciente->id
        ]);
    }

    public function eliminar(int $id): bool {
        $sql = "DELETE FROM usuarios WHERE id = :id AND rol = 'paciente'";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
    
}
