<?php
session_start();

require_once __DIR__ . '/../datos/DAOpacientes.php';
require_once __DIR__ . '/../modelos/Paciente.php';
use Modelos\Paciente;
 
$dao     = new PacienteDAO();
$errores = [];
$exito   = '';
$editar  = false;
$paciente = null;

$valores = [
    'id'         => 0,
    'nombre'     => '',
    'correo'     => '',
    'genero'     => '',
    'contrasena' => '',
    'telefono'   => '',
    'direccion'  => '',
    'edad'       => ''
];

if (isset($_GET['id'])) {
    $paciente = $dao->obtenerPorId((int)$_GET['id']);
    if (!$paciente) {
        $_SESSION['msg'] = 'alert-danger--Paciente no encontrado';
        header('Location: ListaPacientes.php');
        exit;
    }
    $editar = true;
    $valores = [
        'id'         => $paciente->id,
        'nombre'     => $paciente->nombre,
        'correo'     => $paciente->correo,
        'genero'     => $paciente->genero,
        'contrasena' => '',
        'telefono'   => $paciente->telefono,
        'direccion'  => $paciente->direccion,
        'edad'       => $paciente->edad
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($valores as $campo => &$valor) {
        $valor = trim($_POST[$campo] ?? '');
    }
    unset($valor);

    // Validación
    if (strlen($valores['nombre']) < 2) {
        $errores[] = 'El nombre debe tener al menos 2 caracteres.';
    }
    if (!filter_var($valores['correo'], FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'Ingrese un correo válido.';
    }
    if (!in_array($valores['genero'], ['Femenino', 'Masculino', 'Otro'])) {
        $errores[] = 'Seleccione un género.';
    }
    if (!$editar && strlen($valores['contrasena']) < 6) {
        $errores[] = 'La contraseña debe tener al menos 6 caracteres.';
    }
    if (!preg_match('/^[0-9]{10}$/', $valores['telefono'])) {
        $errores[] = 'El teléfono debe tener 10 dígitos.';
    }
    if ($valores['direccion'] === '') {
        $errores[] = 'La dirección es obligatoria.';
    }
    if (!is_numeric($valores['edad']) || $valores['edad'] < 0 || $valores['edad'] > 120) {
        $errores[] = 'La edad debe estar entre 0 y 120.';
    }

    if (empty($errores)) {
        $paciente = new Paciente(
            (int)$valores['id'],
            $valores['nombre'],
            $valores['correo'],
            $valores['genero'],
            $valores['contrasena'],
            $valores['telefono'],
            $valores['direccion'],
            (int)$valores['edad']
        );

        if ($editar) {
            $dao->actualizar($paciente);
            $_SESSION['msg'] = 'alert-success--Paciente actualizado correctamente';
        } else {
            $dao->crear($paciente);
            $_SESSION['msg'] = 'alert-success--Paciente registrado correctamente';
        }

        header('Location: ListaPacientes.php');
        exit;
    }
}

include __DIR__ . '/headerlistas.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title><?= $editar ? 'Editar Paciente' : 'Registro de Paciente' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/estiloslogins.css" rel="stylesheet">
</head>
<body>
<main class="container py-5">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-6">
      <div class="card">
        <div class="card-header bg-primary text-white text-center">
          <h3><?= $editar ? 'Editar Paciente' : 'Registro de Paciente' ?></h3>
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

            <div class="mb-3">
              <label for="genero" class="form-label">Género</label>
              <select id="genero" name="genero" class="form-select" required>
                <option value="">Seleccione...</option>
                <option value="Femenino"  <?= $valores['genero'] === 'Femenino' ? 'selected' : '' ?>>Femenino</option>
                <option value="Masculino" <?= $valores['genero'] === 'Masculino' ? 'selected' : '' ?>>Masculino</option>
                <option value="Otro"      <?= $valores['genero'] === 'Otro' ? 'selected' : '' ?>>Otro</option>
              </select>
            </div>

            <?php if (!$editar): ?>
              <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" id="contrasena" name="contrasena" class="form-control" required>
              </div>
            <?php endif; ?>

            <div class="mb-3">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="tel" id="telefono" name="telefono" class="form-control" required
                     pattern="[0-9]{10}" value="<?= htmlspecialchars($valores['telefono']) ?>">
            </div>

            <div class="mb-3">
              <label for="direccion" class="form-label">Dirección</label>
              <textarea id="direccion" name="direccion" class="form-control" rows="2" required><?= htmlspecialchars($valores['direccion']) ?></textarea>
            </div>

            <div class="mb-3">
              <label for="edad" class="form-label">Edad</label>
              <input type="number" id="edad" name="edad" class="form-control" required
                     value="<?= htmlspecialchars($valores['edad']) ?>">
            </div>

            <div class="d-grid">
              <button type="submit" class="btn btn-success btn-lg"><?= $editar ? 'Actualizar' : 'Crear cuenta' ?></button>
    <a href="menuDoc.php" class="btn btn-secondary">Regresar</a>

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
