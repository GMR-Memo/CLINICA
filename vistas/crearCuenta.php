<?php
// vistas/CrearCuenta.php
session_start();


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Crear Cuenta - Clínica de Salud</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/estiloslogins.css">
</head>
<body>

  <?php include __DIR__ . '/headerlistas.php'; ?>

  <div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card formulario-cuenta">
      <div class="card-header text-white text-center py-3">
        <h3>Crear Cuenta</h3>
      </div>
      <div class="card-body px-4">
        <form method="get" class="d-grid gap-3">
          <button type="submit"
                  formaction="PacienteRegistro.php"
                  class="btn btn-outline-primary btn-lg">
            Paciente
          </button>
         
        </form>
        <p class="text-center mt-4 text-muted">
          ¿Ya tienes una cuenta?
          <a href="login.php">Inicia sesión</a>
        </p>
          <div class="text-center mt-3">
        <a href="../index.php" class="btn btn-secondary">← Regresar</a>


</div>
      </div>
    </div>
  </div>

  <?php include __DIR__ . '/pie.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
