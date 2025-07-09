<?php
require_once __DIR__ . '/Conexion.php';
require_once __DIR__ . '/../modelos/Doctor.php';
use Modelos\Doctor;

class DoctorDAO {
    private $con;

    public function __construct() {
        $this->con = Conexion::conectar();
    }

    public function crear(Doctor $doctor): Doctor {
        $sql = "INSERT INTO usuarios (correo, contrasena, rol)
                VALUES (:correo, :contrasena, 'doctor')";
        $stmt = $this->con->prepare($sql);
        $hash = password_hash($doctor->contrasena, PASSWORD_DEFAULT);
        $stmt->execute([
            ':correo' => $doctor->correo,
            ':contrasena' => $hash
        ]);
        $doctor->id = (int)$this->con->lastInsertId();

        $sql2 = "INSERT INTO doctores (id, nombre, cedula, especialidad, telefono, direccion)
                 VALUES (:id, :nombre, :cedula, :especialidad, :telefono, :direccion)";
        $stmt2 = $this->con->prepare($sql2);
        $stmt2->execute([
            ':id' => $doctor->id,
            ':nombre' => $doctor->nombre,
            ':cedula' => $doctor->cedula,
            ':especialidad' => $doctor->especialidad,
            ':telefono' => $doctor->telefono,
            ':direccion' => $doctor->direccion
        ]);

        return $doctor;
    }

    public function obtenerTodos(): array {
        $sql = "SELECT u.id, u.correo, d.nombre, d.cedula, d.especialidad, d.telefono, d.direccion
                FROM usuarios u
                JOIN doctores d ON u.id = d.id
                WHERE u.rol = 'doctor'";
        $stmt = $this->con->query($sql);
        $lista = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $lista[] = new Doctor(
                (int)$fila['id'],
                $fila['nombre'],
                $fila['correo'],
                '',
                $fila['cedula'],
                $fila['especialidad'],
                $fila['telefono'],
                $fila['direccion']
            );
        }
        return $lista;
    }

    public function obtenerPorId(int $id): ?Doctor {
        $sql = "SELECT u.id, u.correo, d.nombre, d.cedula, d.especialidad, d.telefono, d.direccion
                FROM usuarios u
                JOIN doctores d ON u.id = d.id
                WHERE u.id = :id AND u.rol = 'doctor'";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([':id' => $id]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$fila) return null;

        return new Doctor(
            (int)$fila['id'],
            $fila['nombre'],
            $fila['correo'],
            '',
            $fila['cedula'],
            $fila['especialidad'],
            $fila['telefono'],
            $fila['direccion']
        );
    }

    public function actualizar(Doctor $doctor): bool {
        $sql1 = "UPDATE usuarios SET correo = :correo WHERE id = :id AND rol = 'doctor'";
        $stmt1 = $this->con->prepare($sql1);
        $stmt1->execute([
            ':correo' => $doctor->correo,
            ':id' => $doctor->id
        ]);

        $sql2 = "UPDATE doctores SET
                    nombre = :nombre,
                    cedula = :cedula,
                    especialidad = :especialidad,
                    telefono = :telefono,
                    direccion = :direccion
                 WHERE id = :id";
        $stmt2 = $this->con->prepare($sql2);
        return $stmt2->execute([
            ':nombre' => $doctor->nombre,
            ':cedula' => $doctor->cedula,
            ':especialidad' => $doctor->especialidad,
            ':telefono' => $doctor->telefono,
            ':direccion' => $doctor->direccion,
            ':id' => $doctor->id
        ]);
    }

    public function eliminar(int $id): bool {
        $sql = "DELETE FROM usuarios WHERE id = :id AND rol = 'doctor'";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
