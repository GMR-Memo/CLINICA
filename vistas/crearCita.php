<?php
session_start();

// 1. Conexión (con el guard evita redeclarar la clase)
require_once __DIR__ . '/../datos/Conexion.php';

// 2. DAO y modelos
require_once __DIR__ . '/../datos/DAOcitas.php';
require_once __DIR__ . '/../modelos/Cita.php';
require_once __DIR__ . '/../modelos/Doctor.php';

use Modelos\Cita;

// Verificar sesión
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$error = '';
$exito = '';
$dao   = new CitaDAO();

// Cargar pacientes (para el <select>)
$con        = Conexion::conectar();
$pacientes  = $con
    ->query("SELECT p.id, p.nombre 
             FROM pacientes p 
             JOIN usuarios u ON p.id = u.id 
             ORDER BY p.nombre")
    ->fetchAll(PDO::FETCH_ASSOC);

// Si vienen por GET para editar
$cita = null;
if (isset($_GET['id'])) {
    $cita = $dao->obtenerPorId((int)$_GET['id']);
    if (!$cita) {
        $_SESSION['msg'] = "danger--Cita no encontrada.";
        header('Location: ListaCitas.php');
        exit;
    }
}

// Procesar formulario POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id         = (int)($_POST['id'] ?? 0);
    $pacienteId = (int)($_POST['paciente'] ?? 0);
    $fecha      = $_POST['fecha'] ?? '';
    $hora       = $_POST['hora'] ?? '';
    $motivo     = trim($_POST['motivo'] ?? '');

    if (!$pacienteId || !$fecha || !$hora || $motivo === '') {
        $error = 'Todos los campos son obligatorios.';
    } else {
        $doctorId = $_SESSION['usuario_id'];
        $fechaCompleta = "$fecha $hora";
        $cita = new Cita($id, $pacienteId, $doctorId, $fechaCompleta, $motivo);

        if ($id > 0) {
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
  <title><?= $cita ? 'Editar Cita' : 'Agendar Nueva Cita' ?></title>
  <link rel="stylesheet" href="../cssForms/crearcita.css" />
</head>
<body>

  <?php include __DIR__ . '/../vistas/headerlistas.php'; ?>

  <main class="form-wrapper">
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
          <option value="<?= $p['id'] ?>"
            <?= ($cita && $cita->paciente_id === $p['id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($p['nombre']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <?php
        $fechaVal = $cita ? date('Y-m-d', strtotime($cita->fecha)) : '';
        $horaVal  = $cita ? date('H:i', strtotime($cita->fecha)) : '';
      ?>
      <label for="fecha">Fecha</label>
      <input type="date" id="fecha" name="fecha" value="<?= $fechaVal ?>" required>

      <label for="hora">Hora</label>
      <input type="time" id="hora" name="hora" value="<?= $horaVal ?>" required>

      <label for="motivo">Motivo de Consulta</label>
      <textarea id="motivo" name="motivo" rows="3" required><?= htmlspecialchars($cita->motivo ?? '') ?></textarea>

      <button type="submit"><?= $cita ? 'Actualizar Cita' : 'Guardar Cita' ?></button>
    </form>

    <p><a href="ListaCitas.php">← Volver a la lista</a></p>
    <p><a href="menuDoc.php">← Regresar al menú</a></p>
  </main>

  <?php include __DIR__ . '/../vistas/pie.php'; ?>

</body>
</html>
