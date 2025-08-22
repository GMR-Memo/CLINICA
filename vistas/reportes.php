<?php
session_start();
require_once __DIR__ . '/../datos/DAOdoctores.php';
require_once __DIR__ . '/../datos/DAOpacientes.php';
require_once __DIR__ . '/../datos/DAOcitas.php';

$daoDoc = new DoctorDAO();
$daoPac = new PacienteDAO();
$daoCita = new CitaDAO();

$totalDoctores = count($daoDoc->obtenerTodos());
$totalPacientes = count($daoPac->obtenerTodos());
$totalCitas = count($daoCita->obtenerTodos());
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reportes - Admin</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="p-4">
  <h2>Reportes del Sistema</h2>
  
  <div class="row mt-4">
    <div class="col-md-4">
      <div class="card p-3 shadow">
        <h5>Total Doctores</h5>
        <p class="fs-3 text-success"><?= $totalDoctores ?></p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 shadow">
        <h5>Total Pacientes</h5>
        <p class="fs-3 text-success"><?= $totalPacientes ?></p>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card p-3 shadow">
        <h5>Total Citas</h5>
        <p class="fs-3 text-success"><?= $totalCitas ?></p>
      </div>
    </div>
  </div>

  <canvas id="graficoCitas" class="mt-5"></canvas>

  <script>
    const ctx = document.getElementById('graficoCitas');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Doctores', 'Pacientes', 'Citas'],
        datasets: [{
          label: 'Totales',
          data: [<?= $totalDoctores ?>, <?= $totalPacientes ?>, <?= $totalCitas ?>],
          backgroundColor: ['#28a745','#17a2b8','#ffc107']
        }]
      }
    });
  </script>
</body>
</html>
