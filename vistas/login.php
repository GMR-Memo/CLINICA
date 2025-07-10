<?php
// Archivo: vistas/login.php

session_start();

require_once __DIR__ . '/../datos/DAOUsuario.php';
require_once __DIR__ . '/../datos/DAOdoctores.php';
require_once __DIR__ . '/../datos/DAOpacientes.php';
require_once __DIR__ . '/../datos/DAOadministrador.php';
require_once __DIR__ . '/../modelos/Doctor.php';
require_once __DIR__ . '/../modelos/Paciente.php';
require_once __DIR__ . '/../modelos/Administrador.php';


$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rol        = $_POST['tipoUsuario'] ?? '';
    $correo     = trim($_POST['correo'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';

    // 1. Validaciones básicas
    if (! in_array($rol, ['paciente','doctor','administrador'])) {
        $error = 'Seleccione un tipo de usuario válido.';
    } elseif (! filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $error = 'Ingrese un correo válido.';
    } elseif (strlen($contrasena) < 6) {
        $error = 'La contraseña debe tener al menos 6 caracteres.';
    } else {
        // 2. Intentamos autenticar
        $daoUser     = new DAOUsuario();
        $usuarioAuth = $daoUser->autenticar($correo, $contrasena, $rol);

        if ($usuarioAuth !== null) {
            // 3. Cargar perfil y redirigir según rol
            switch ($rol) {
                case 'paciente':
                    $dao     = new PacienteDAO();
                    $perfil  = $dao->obtenerPorId($usuarioAuth->id);
                    $destino = 'menuPacientes.php';
                    break;
                case 'doctor':
                    $dao     = new DoctorDAO();
                    $perfil  = $dao->obtenerPorId($usuarioAuth->id);
                    $destino = 'menuDoc.php';
                    break;
                case 'administrador':
                    $dao     = new AdministradorDAO();
                    $perfil  = $dao->obtenerPorId($usuarioAuth->id);
                    $destino = 'menuAdmin.php';
                    break;
            }

            if ($perfil) {
                $_SESSION['usuario_id']     = $perfil->id;
                $_SESSION['usuario_rol']    = $rol;
                $_SESSION['usuario_nombre'] = $perfil->nombre;
                header("Location: ../vistas/$destino");
                exit;
            } else {
                $error = "No se encontró el perfil de $rol.";
            }
        } else {
            $error = 'Correo o contraseña incorrectos.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar Sesión - Clínica Salud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card w-100" style="max-width:500px;">
      <div class="card-header bg-primary text-white text-center">
        <h3>Iniciar Sesión</h3>
      </div>
      <div class="card-body p-4">
        <?php if($error): ?>
          <div class="alert alert-danger text-center"><?=htmlspecialchars($error)?></div>
        <?php endif; ?>

        <form method="post" class="d-grid gap-3">
          <div class="text-center">
            <label class="form-label fw-semibold">Tipo de usuario:</label>
            <div class="btn-group" role="group">
              <input type="radio" name="tipoUsuario" id="paciente" value="paciente"
                     <?=(!isset($_POST['tipoUsuario']) || $_POST['tipoUsuario']==='paciente')?'checked':''?>>
              <label class="btn btn-outline-primary" for="paciente">Paciente</label>

              <input type="radio" name="tipoUsuario" id="doctor" value="doctor"
                     <?=(isset($_POST['tipoUsuario']) && $_POST['tipoUsuario']==='doctor')?'checked':''?>>
              <label class="btn btn-outline-success" for="doctor">Doctor</label>

              <input type="radio" name="tipoUsuario" id="administrador" value="administrador"
                     <?=(isset($_POST['tipoUsuario']) && $_POST['tipoUsuario']==='administrador')?'checked':''?>>
              <label class="btn btn-outline-warning" for="administrador">Admin</label>
            </div>
          </div>

          <div class="form-group">
            <label for="correo">Correo electrónico</label>
            <input type="email" id="correo" name="correo" class="form-control" required
                   placeholder="ejemplo@correo.com" value="<?=htmlspecialchars($_POST['correo']??'')?>">
          </div>

          <div class="form-group">
            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" class="form-control" required
                   placeholder="Ingresa tu contraseña">
          </div>

          <button type="submit" class="btn btn-primary btn-lg mt-3">Iniciar Sesión</button>
        </form>

        <p class="text-center mt-4 text-muted">
          ¿No tienes una cuenta? <a href="crearCuenta.php">Crear una cuenta</a>
        </p>
        <div class="text-center mt-2">
          <a href="../index.php" class="btn btn-secondary">← Regresar</a>
        </div>
      </div>
    </div>
  </div>

  <script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
