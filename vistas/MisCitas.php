<?php
session_start();
require_once __DIR__ . '/../datos/DAOcitas.php';
use Modelos\Cita;

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

$usuarioId = $_SESSION['usuario_id'];
$rol = $_SESSION['usuario_rol'];

$dao = new CitaDAO();
$citas = $dao->obtenerPorUsuario((int)$usuarioId, $rol);

include __DIR__ . '../headerlistas.php';
?>

<main class="container py-4">
  <h2>Mis Citas</h2>
  <?php if (empty($citas)): ?>
    <p>No tienes citas registradas.</p>
  <?php else: ?>
    <table class="table table-bordered table-hover">
      <thead class="table-light">
        <tr>
          <th>Fecha</th>
          <th>Motivo</th>
          <th><?= $rol === 'doctor' ? 'Paciente' : 'Doctor' ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($citas as $cita): ?>
          <tr>
            <td><?= date('d/m/Y H:i', strtotime($cita->fecha)) ?></td>
            <td><?= htmlspecialchars($cita->motivo) ?></td>
            <td><?= $rol === 'doctor' ? $cita->paciente_nombre : $cita->doctor_nombre ?></td>
          </tr>
        <?php endforeach; ?>
         
      </tbody>
    </table>
     <div class="text-center mt-3">
  <a href="menuPacientes.php" class="btn btn-secondary">← Regresar</a>
</div>
  <?php endif; ?>
</main>

<?php include __DIR__ . '/pie.php'; ?>
