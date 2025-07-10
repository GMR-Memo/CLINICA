<?php
session_start();
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'admin') {
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Panel Administrador</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="../cssForms/MenuPacientes.css" />

</head>
<body>
  <div class="dashboard d-flex">
    <aside class="sidebar bg-success text-white p-3">
      <div class="brand text-center mb-4">
        <i class="fas fa-user-shield fa-2x"></i>
        <h4 class="mt-2">Admin Salud+</h4>
      </div>
      <nav class="nav flex-column">
        <div class="nav-section">Gestión</div>
        <a href="ListaDoctores.php" class="nav-item"><i class="fas fa-user-md me-2"></i>Doctores</a>
        <a href="ListapacientesAdmin.php" class="nav-item"><i class="fas fa-users me-2"></i>Pacientes</a>
        <a href="ListaCitasAdmin.php" class="nav-item"><i class="fas fa-calendar-check me-2"></i>Citas</a>
 <a href="DoctorRegistro.php" class="nav-item"><i class="fas fa-calendar-check me-2"></i>Doctor</a>
      
        <a href="cerrarsesion.php" class="nav-item mt-4"><i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión</a>
      </nav>
    </aside>

    <main class="content flex-fill p-4">
      <h1 class="mb-4">Bienvenido, <span class="text-success"><?php echo $_SESSION['usuario_nombre']; ?></span></h1>
      <p>Desde este panel puedes gestionar doctores, pacientes, citas, configuraciones del sistema.</p>
    </main>
  </div>
</body>
</html>
