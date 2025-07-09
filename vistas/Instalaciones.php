<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Clínica - Instalaciones</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>

<!-- Barra de navegación -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
  <div class="container">
    <a class="navbar-brand" href="#">Clínica</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
            aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="../index.html">Inicio</a></li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="menuTratamiento" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tratamiento
          </a>
          <ul class="dropdown-menu" aria-labelledby="menuTratamiento">
            <li><a class="dropdown-item" href="../Formularios/Autodiagnostico.html">Autodiagnóstico</a></li>
            <li><a class="dropdown-item" href="#">Adicciones a sustancias</a></li>
            <li><a class="dropdown-item" href="#">Tratamiento de ludopatía</a></li>
            <li><a class="dropdown-item" href="#">Tratamiento para ansiedad</a></li>
            <li><a class="dropdown-item" href="#">Tratamiento para depresión</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="menuContacto" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Contacto
          </a>
          <ul class="dropdown-menu" aria-labelledby="menuContacto">
            <li><a class="dropdown-item" href="#">Llame ahora</a></li>
            <li><a class="dropdown-item" href="../Formularios/contactanos.html">Contáctanos</a></li>
          </ul>
        </li>

        <li class="nav-item"><a class="nav-link" href="#">Servicios</a></li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="menuNosotros" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Sobre Nosotros
          </a>
          <ul class="dropdown-menu" aria-labelledby="menuNosotros">
            <li><a class="dropdown-item" href="QuienesSomos.php">Quiénes Somos</a></li>
            <li><a class="dropdown-item active" href="Instalaciones.php">Instalaciones</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Contenido principal -->
<main class="container py-5">
  <header class="text-center mb-5">
    <h2 class="fw-bold">Nuestras Instalaciones</h2>
    <p class="lead">Espacios diseñados para tu tranquilidad, privacidad y bienestar.</p>
  </header>

  <!-- Galería de instalaciones -->
  <section class="mb-5">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card shadow">
          <img src="https://officeclass.com/wp-content/uploads/2023/11/sofa-joy-1.webp" class="card-img-top" alt="Sala de espera">
          <div class="card-body">
            <h5 class="card-title">Sala de Espera</h5>
            <p class="card-text">Ambiente cómodo y sereno, ideal para que nuestros pacientes se sientan tranquilos desde el primer momento.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow">
          <img src="https://consultoriosvidya.com/fotos/ConsultoriosDisponibles/Alquiler_Consultorios_por_hora_DF/alquilerdeconsultoriospsicologicosporhoraDF.jpg" class="card-img-top" alt="Consultorio moderno">
          <div class="card-body">
            <h5 class="card-title">Consultorios Modernos</h5>
            <p class="card-text">Espacios privados equipados con tecnología actual para brindar atención de calidad.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card shadow">
          <img src="https://img.freepik.com/fotos-premium/salon-moderno-sala-relajacion-gimnasio_217593-15724.jpg" class="card-img-top" alt="Área de meditación">
          <div class="card-body">
            <h5 class="card-title">Zona de Relajación</h5>
            <p class="card-text">Espacios especiales para meditación y terapias de relajación, rodeados de calma y naturaleza.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Características adicionales -->
  <section class="mb-5">
    <h4 class="text-primary">Más sobre nuestras instalaciones</h4>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">Ambientes climatizados y silenciosos para un tratamiento más cómodo.</li>
      <li class="list-group-item">Accesibilidad para personas con movilidad reducida.</li>
      <li class="list-group-item">Salas de terapia familiar y grupal.</li>
      <li class="list-group-item">Seguridad y privacidad garantizadas para todos nuestros pacientes.</li>
    </ul>
  </section>
</main>

<!-- Pie de página -->
<footer class="bg-dark text-white text-center py-4 mt-5">
  <div class="container">
    <p class="mb-1">&copy; 2025 Clínica de Salud Mental. Todos los derechos reservados.</p>
    <p class="mb-0">Síguenos en redes sociales: Facebook | Instagram | Twitter</p>
  </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
