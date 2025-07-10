<?php
require_once  '/Conexion.php';
require_once  '../modelos/Cita.php';

use Modelos\Cita;

class CitaDAO
{
    private $con;

    public function __construct()
    {
        $this->con = Conexion::conectar();
    }

    public function crear(Cita $cita): ?int
    {
        $sql = "INSERT INTO citas (paciente_id, doctor_id, fecha, motivo)
                VALUES (:paciente_id, :doctor_id, :fecha, :motivo)";
        $stmt = $this->con->prepare($sql);
        if ($stmt->execute([
            ':paciente_id' => $cita->paciente_id,
            ':doctor_id'   => $cita->doctor_id,
            ':fecha'       => $cita->fecha,
            ':motivo'      => $cita->motivo
        ])) {
            return (int)$this->con->lastInsertId();
        }
        return null;
    }
    public function obtenerTodos(): array
    {
        $sql = "SELECT c.id, c.paciente_id, c.doctor_id, c.fecha, c.motivo, c.completada,
                   p.nombre AS paciente_nombre, d.nombre AS doctor_nombre
            FROM citas c
            JOIN pacientes p ON c.paciente_id = p.id
            JOIN doctores d ON c.doctor_id = d.id
            ORDER BY c.fecha DESC";
        $stmt = $this->con->query($sql);
        $lista = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cita = new Cita(
                (int)$fila['id'],
                (int)$fila['paciente_id'],
                (int)$fila['doctor_id'],
                $fila['fecha'],
                $fila['motivo'],
                $fila['completada'] 
            );
            $cita->paciente_nombre = $fila['paciente_nombre'];
            $cita->doctor_nombre = $fila['doctor_nombre'];
            $lista[] = $cita;
        }
        return $lista;
    }

    public function obtenerPorId(int $id): ?Cita
    {
        $sql = "SELECT id, paciente_id, doctor_id, fecha, motivo, completada
                FROM citas
                WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        $stmt->execute([':id' => $id]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$fila) return null;

        return new Cita(
            (int)$fila['id'],
            (int)$fila['paciente_id'],
            (int)$fila['doctor_id'],
            $fila['fecha'],
            $fila['motivo'],
            $fila['completada']
        );
    }
   public function marcarAsistencia(int $id, $completada): bool
{
    $sql = "UPDATE citas SET completada = :completada WHERE id = :id";
    $stmt = $this->con->prepare($sql);
    
    // Convierte explícitamente el valor a booleano
    $completada = filter_var($completada, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

    // Si no es booleano válido, aborta
    if (!is_bool($completada)) {
        throw new InvalidArgumentException("Valor de 'completada' inválido");
    }

    $stmt->bindValue(':completada', $completada, PDO::PARAM_BOOL);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
}



    public function actualizar(Cita $cita): bool
    {
        $sql = "UPDATE citas SET
                    paciente_id = :paciente_id,
                    doctor_id   = :doctor_id,
                    fecha       = :fecha,
                    motivo      = :motivo
                WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([
            ':paciente_id' => $cita->paciente_id,
            ':doctor_id'   => $cita->doctor_id,
            ':fecha'       => $cita->fecha,
            ':motivo'      => $cita->motivo,
            ':id'          => $cita->id
        ]);
    }

    public function eliminar(int $id): bool
    {
        $sql = "DELETE FROM citas WHERE id = :id";
        $stmt = $this->con->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
    public function obtenerPorUsuario(int $usuarioId, string $rol): array
    {
        if ($rol === 'paciente') {
            $sql = "SELECT c.id, c.paciente_id, c.doctor_id, c.fecha, c.motivo,
                       p.nombre AS paciente_nombre, d.nombre AS doctor_nombre
                FROM citas c
                JOIN pacientes p ON c.paciente_id = p.id
                JOIN doctores d ON c.doctor_id = d.id
                WHERE c.paciente_id = :id
                ORDER BY c.fecha DESC";
        } else if ($rol === 'doctor') {
            $sql = "SELECT c.id, c.paciente_id, c.doctor_id, c.fecha, c.motivo,
                       p.nombre AS paciente_nombre, d.nombre AS doctor_nombre
                FROM citas c
                JOIN pacientes p ON c.paciente_id = p.id
                JOIN doctores d ON c.doctor_id = d.id
                WHERE c.doctor_id = :id
                ORDER BY c.fecha DESC";
        } else {
            return [];
        }

        $stmt = $this->con->prepare($sql);
        $stmt->execute([':id' => $usuarioId]);
        $lista = [];

        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cita = new Cita(
                (int)$fila['id'],
                (int)$fila['paciente_id'],
                (int)$fila['doctor_id'],
                $fila['fecha'],
                $fila['motivo'],
                isset($fila['completada']) ? (bool)$fila['completada'] : false
            );
            $cita->paciente_nombre = $fila['paciente_nombre'];
            $cita->doctor_nombre = $fila['doctor_nombre'];
            $lista[] = $cita;
        }

        return $lista;
    }
}
