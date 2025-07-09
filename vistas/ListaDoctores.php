<?php
session_start();
require_once __DIR__ . '/../datos/DAOdoctores.php';
use Modelos\Doctor;

$dao = new DoctorDAO();
$doctores = $dao->obtenerTodos();

include __DIR__ . '/headerlistas.php';
if (isset($_SESSION['msg'])) {
    [$tipo, $texto] = explode('--', $_SESSION['msg'], 2);
    echo "<div class='alert $tipo'>$texto</div>";
    unset($_SESSION['msg']);
}
?>
<main class="container py-4">
  <h2>Lista de Doctores</h2>
  <a href="DoctorRegistro.php" class="btn btn-success mb-3">Registrar Nuevo</a>
  <br>
    <a href="menuAdmin.php" class="btn btn-secondary">Regresar</a>

  <table class="table table-bordered table-hover">
    <thead class="table-light">
      <tr>
        <th>Nombre</th><th>Correo</th><th>Especialidad</th><th>Teléfono</th><th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($doctores as $doc): ?>
        <tr>
          <td><?= htmlspecialchars($doc->nombre) ?></td>
          <td><?= htmlspecialchars($doc->correo) ?></td>
          <td><?= htmlspecialchars($doc->especialidad) ?></td>
          <td><?= htmlspecialchars($doc->telefono) ?></td>
          <td>
            <a href="DoctorRegistro.php?id=<?= $doc->id ?>" class="btn btn-warning btn-sm">Editar</a>
            <form method="post" action="eliminarDoctor.php" class="d-inline">
              <input type="hidden" name="id" value="<?= $doc->id ?>">
              <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar doctor?')">Eliminar</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</main>
<?php include __DIR__ . '/pie.php'; ?>
