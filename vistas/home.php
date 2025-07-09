<?php include 'header.php'; ?>

<header class="hero">
  <div class="container text-center">
    <h1 class="display-4 fw-bold">Bienvenido a Nuestra Clínica de Salud Mental</h1>
    <p class="lead">Caminamos contigo hacia el bienestar emocional y la tranquilidad</p>
    <a href="Formularios/LlameAhora.html" class="btn btn-light btn-lg mt-3">Contáctanos</a>
  </div>
</header>

<section id="nosotros" class="py-5">
  <div class="container">
    <h2 class="text-center mb-4">Sobre Nosotros</h2>
    <div class="row align-items-center">
      <div class="col-md-6">
        <img src="imgs/img1.png" class="img-fluid rounded shadow" alt="Equipo de profesionales">
      </div>
      <div class="col-md-6">
        <p>
          En <strong>Clínica de Salud Mental</strong>, somos una institución de beneficio social con cobertura nacional,
          especializada en tratamiento de rehabilitación ubicada en Guanajuato.
          Nuestro objetivo es prevenir, orientar, rehabilitar y educar a la población con servicios de atención
          y formación continua. Más de 10 años de experiencia, terapias adaptadas a tus necesidades,
          confidencialidad y respeto en cada sesión.
        </p>
      </div>
    </div>
  </div>
</section>

<section id="servicios" class="servicios-fondo py-5">
  <div class="container">
    <h2 class="text-center mb-4">Lo que Ofrecemos</h2>
    <div class="row text-center">
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow">
          <div class="card-body">
            <h4 class="card-title">Terapia Individual</h4>
            <p class="card-text">Sesiones personalizadas para trabajar en tus desafíos y metas.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow">
          <div class="card-body">
            <h4 class="card-title">Terapia Grupal</h4>
            <p class="card-text">Espacios de apoyo colectivo para compartir experiencias.</p>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card h-100 shadow">
          <div class="card-body">
            <h4 class="card-title">Mindfulness</h4>
            <p class="card-text">Programas para gestionar el estrés diario de manera efectiva.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section id="testimonios" class="py-5">
  <div class="container">
    <h2 class="text-center mb-4">Historias de Cambio</h2>
    <div id="testimonioCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <blockquote class="blockquote text-center">
            <p class="mb-0">"Gracias a la clínica, encontré un camino hacia la paz interior."</p>
          </blockquote>
        </div>
        <div class="carousel-item">
          <blockquote class="blockquote text-center">
            <p class="mb-0">"Cada sesión me ayudó a construir herramientas para mi bienestar."</p>
          </blockquote>
        </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#testimonioCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#testimonioCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
      </button>
    </div>
  </div>
</section>

<section id="contacto" class="contacto-seccion text-center py-5">
  <div class="container">
    <h2 class="contacto-titulo">Contáctanos</h2>
    <hr class="contacto-linea">
    <p class="contacto-info"><strong>Email:</strong> contacto@clinicadesaludmental.com</p>
    <p class="contacto-info"><strong>Teléfono:</strong> +34 912 345 678</p>
  </div>
</section>

<?php include 'pie.php'; ?>
