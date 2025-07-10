<?php
session_start();
require_once  '../modelos/Doctor.php';
require_once  '../modelos/Cita.php';
require_once  '../datos/DAOcitas.php';
require_once  '../datos/Conexion.php';

use Modelos\Cita;

$error = '';
$exito = '';
$dao = new CitaDAO();
$cita = null;

$con = Conexion::conectar();
$pacientes = $con->query("SELECT p.id, p.nombre FROM pacientes p JOIN usuarios u ON p.id = u.id ORDER BY p.nombre")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_GET['id'])) {
    $cita = $dao->obtenerPorId((int)$_GET['id']);
    if (!$cita) {
        $_SESSION['msg'] = "danger--Cita no encontrada.";
        header('Location: CitasLista.php');
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id         = $_POST['id'] ?? 0;
    $pacienteId = $_POST['paciente'] ?? '';
    $fecha      = $_POST['fecha'] ?? '';
    $hora       = $_POST['hora'] ?? '';
    $motivo     = trim($_POST['motivo'] ?? '');

    if (!$pacienteId || !$fecha || !$hora || !$motivo) {
        $error = 'Todos los campos son obligatorios.';
    } else {
        $doctorId = $_SESSION['usuario_id'] ?? null;
        if (!$doctorId) {
            die('Error: No hay sesión activa para el doctor.');
        }

        $fechaCompleta = "$fecha $hora";
        $cita = new Cita((int)$id, (int)$pacienteId, (int)$doctorId, $fechaCompleta, $motivo);

        if ((int)$id > 0) {
            $dao->actualizar($cita);
            $exito = 'Cita actualizada correctamente.';
        } else {
            $dao->crear($cita);
            $exito = 'Cita creada correctamente.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title><?= $cita ? 'Editar Cita' : 'Crear Cita' ?> - Clínica</title>
  <link rel="stylesheet" href="../cssForms/crearcita.css" />
</head>
<body>
  <div class="form-wrapper">
    <h2><?= $cita ? 'Editar Cita' : 'Agendar Nueva Cita' ?></h2>

    <?php if ($error): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php elseif ($exito): ?>
      <div class="alert alert-success"><?= htmlspecialchars($exito) ?></div>
    <?php endif; ?>

    <form method="post" novalidate>
      <input type="hidden" name="id" value="<?= $cita->id ?? 0 ?>">

      <label for="paciente">Paciente</label>
      <select id="paciente" name="paciente" required>
        <option value="">Selecciona paciente</option>
        <?php foreach ($pacientes as $p): ?>
          <option value="<?= $p['id'] ?>" <?= ($cita && $cita->paciente_id == $p['id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($p['nombre']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <?php
        $fecha = $cita ? date('Y-m-d', strtotime($cita->fecha)) : '';
        $hora  = $cita ? date('H:i', strtotime($cita->fecha)) : '';
      ?>

      <label for="fecha">Fecha</label>
      <input type="date" id="fecha" name="fecha" value="<?= $fecha ?>" required />

      <label for="hora">Hora</label>
      <input type="time" id="hora" name="hora" value="<?= $hora ?>" required />

      <label for="motivo">Motivo de Consulta</label>
      <textarea id="motivo" name="motivo" rows="3" required><?= $cita->motivo ?? '' ?></textarea>

      <input type="submit" value="<?= $cita ? 'Actualizar Cita' : 'Guardar Cita' ?>" />
    </form>

    <p class="back-link"><a href="ListaCitas.php">← Volver a la lista</a></p>
    <p class="back-link"><a href="menuDoc.php">← Regresar</a></p>
    
  </div>

</body>
</html>
