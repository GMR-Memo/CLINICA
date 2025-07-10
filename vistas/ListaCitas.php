<?php
session_start();
require_once  '../datos/DAOcitas.php';

use Modelos\Cita;

$dao = new CitaDAO();
$citas = $dao->obtenerTodos();

include __DIR__ . '../headerlistas.php';

if (isset($_SESSION['msg'])) {
  [$tipo, $texto] = explode('--', $_SESSION['msg'], 2);
  echo "<div class='alert $tipo'>$texto</div>";
  unset($_SESSION['msg']);
}
?>
<main class="container py-4">
  <h2>Lista de Citas</h2>
  <a href="crearCita.php" class="btn btn-success mb-3">Registrar Nueva Cita</a>
  <table class="table table-bordered table-hover">
    <thead class="table-light">
      <tr>
        <th>Paciente</th>
        <th>Doctor</th>
        <th>Fecha</th>
        <th>Motivo</th>
        <th>Completada</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($citas as $cita): ?>
        <tr>
          <td><?= htmlspecialchars($cita->paciente_nombre ?? 'Desconocido') ?></td>
          <td><?= htmlspecialchars($cita->doctor_nombre ?? 'Desconocido') ?></td>
          <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($cita->fecha))) ?></td>
          <td><?= htmlspecialchars($cita->motivo) ?></td>
          <td>
            <form method="post" action="marcarAsistencia.php" class="d-inline">
              <input type="hidden" name="id" value="<?= $cita->id ?>">
              <input type="hidden" name="completada" value="<?= $cita->completada ? '0' : '1' ?>">
              <button type="submit" class="btn btn-sm <?= $cita->completada ? 'btn-success' : 'btn-outline-secondary' ?>">
                <?= $cita->completada ? 'Sí' : 'Marcar' ?>
              </button>
            </form>
          </td>

          <td>
            <a href="crearCita.php?id=<?= $cita->id ?>" class="btn btn-warning btn-sm">Editar</a>
            <form method="post" action="eliminarCita.php" class="d-inline">
              <input type="hidden" name="id" value="<?= $cita->id ?>">
              <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar cita?')">Eliminar</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
    <p class="back-link"><a href="menuDoc.php">← Regresar</a></p>

  </table>
</main>
<?php include __DIR__ . '/pie.php'; ?>