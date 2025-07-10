<?php
// public/panelDoctor.php
session_start(); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Panel Doctor</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <link rel="stylesheet" href="/cssForms/menuDoctores.css" />

</head>
<body>
  <div class="dashboard d-flex">
    <aside class="sidebar bg-primary text-white p-3">
      <div class="brand text-center mb-4">
        <i class="fas fa-stethoscope fa-2x"></i>
        <h4 class="mt-2">Clínica Salud+</h4>
      </div>
      <nav class="nav flex-column">
        <div class="nav-section">Citas</div>
        <a href="crearCita.php" class="nav-item"><i class="fas fa-calendar-plus me-2"></i>Crear Cita</a>
        <a href="listacitasAdmin.php" class="nav-item"><i class="fas fa-calendar-alt me-2"></i>Ver/Editar Citas</a>

        <div class="nav-section">Pacientes</div>
        <a href="PacienteRegistroD.php" class="nav-item"><i class="fas fa-user-plus me-2"></i>Agregar Paciente</a>
        <a href="ListaPacienteDoc.php" class="nav-item"><i class="fas fa-users me-2"></i>Ver/Editar Pacientes</a>
        <div class="nav-section">Doctores</div>
       
        <a href="cerrarsesion.php" class="nav-item"><i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión</a>
      </nav>
    </aside>
    <main class="content flex-fill p-4">
      <h1 class="mb-4">Bienvenido, <span class="text-success"><?php echo $_SESSION['usuario_nombre'] ?? 'Doctor'; ?></span></h1>
      <p>Seleccione una opción del menú para comenzar.</p>
    </main>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
