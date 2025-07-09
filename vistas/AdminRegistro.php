<?php
session_start();
require_once __DIR__ . '/../datos/DAOadministrador.php';
require_once __DIR__ . '/../modelos/Administrador.php';

use Modelos\Administrador;

$dao       = new AdministradorDAO();
$errores   = [];
$exito     = '';
$editar    = false;
$admin     = null;

$valores = [
    'id'         => 0,
    'nombre'     => '',
    'correo'     => '',
    'contrasena' => ''
];

if (isset($_GET['id'])) {
    // modo editar (opcional)
    $admin = $dao->obtenerPorId((int)$_GET['id']);
    if ($admin) {
        $editar = true;
        $valores = [
            'id'         => $admin->id,
            'nombre'     => $admin->nombre,
            'correo'     => $admin->correo,
            'contrasena' => ''
        ];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($valores as $campo => &$valor) {
        $valor = trim($_POST[$campo] ?? '');
    }
    unset($valor);

    // validaciones
    if (strlen($valores['nombre']) < 2) {
        $errores[] = 'El nombre debe tener al menos 2 caracteres.';
    }
    if (!filter_var($valores['correo'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'Ingrese un correo válido.';
    }
    if (!$editar && strlen($valores['contrasena']) < 6) {
        $errores[] = 'La contraseña debe tener al menos 6 caracteres.';
    }

    if (empty($errores)) {
        $admin = new Administrador(
            (int)$valores['id'],
            $valores['nombre'],
            $valores['correo'],
            $valores['contrasena']
        );

        // siempre crear (editar opcional)
        $dao->crear($admin);
        $_SESSION['msg'] = 'alert-success--Administrador registrado correctamente';
        header('Location: menuAdmin.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title><?= $editar ? 'Editar Administrador' : 'Registro de Administrador' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../Formularios/css/MenuPacientes.css" rel="stylesheet">
</head>
<body>
<main class="container py-5">
  <div class="row justify-content-center">
    <div class="col-12 col-md-6 col-lg-5">
      <div class="card">
        <div class="card-header bg-primary text-white text-center">
          <h3><?= $editar ? 'Editar Admin' : 'Registro de Admin' ?></h3>
        </div>
        <div class="card-body">
          <?php if (!empty($errores)): ?>
            <div class="alert alert-danger">
              <?php foreach ($errores as $err): ?>
                <div><?= htmlspecialchars($err) ?></div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>

          <form method="post" novalidate>
            <input type="hidden" name="id" value="<?= htmlspecialchars($valores['id']) ?>">

            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre completo</label>
              <input type="text" id="nombre" name="nombre" class="form-control" required
                     value="<?= htmlspecialchars($valores['nombre']) ?>">
            </div>

            <div class="mb-3">
              <label for="correo" class="form-label">Correo electrónico</label>
              <input type="email" id="correo" name="correo" class="form-control" required
                     value="<?= htmlspecialchars($valores['correo']) ?>">
            </div>

            <?php if (!$editar): ?>
              <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" class="form-control" required>
              </div>
            <?php endif; ?>

            <div class="d-grid">
              <button type="submit" class="btn btn-success btn-lg">
                <?= $editar ? 'Actualizar' : 'Crear Admin' ?>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include __DIR__ . '/pie.php'; ?>
<script src="js/PacienteRegistrado.js"></script>
</body>
</html>
