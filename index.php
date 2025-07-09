<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Clínica de Salud Mental</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="Servidor/css/estilosbara.css">
</head>
<body>
  <?php include 'vistas/header.php'; ?>

  <!-- Partículas -->
  <div id="particles-js"></div>

  <header class="hero">
    <div class="container text-center">
      <h1 id="titulo-animado">Bienvenido a Nuestra Clínica de Salud Mental</h1>
      <p class="lead">Caminamos contigo hacia el bienestar emocional y la tranquilidad</p>
    </div>
  </header>

  <section id="nosotros" class="py-5 bg-white fade-in">
    <div class="container">
      <h2 class="text-center mb-4">Sobre Nosotros</h2>
      <div class="row align-items-center">
        <div class="col-md-6 mb-4 mb-md-0">
          <img src="imgs/img1.png" class="img-fluid rounded shadow" alt="Equipo de profesionales">
        </div>
        <div class="col-md-6">
          <p>
            En <strong>Clínica de Salud Mental</strong>, somos una institución de beneficio social con cobertura nacional,
            especializada en tratamiento de rehabilitación ubicada en Guanajuato. Más de 10 años de experiencia,
            terapias adaptadas a tus necesidades, confidencialidad y respeto en cada sesión.
          </p>
        </div>
      </div>
    </div>
  </section>

  <section id="servicios" class="bg-light py-5 fade-in">
    <div class="container">
      <h2 class="text-center mb-4">Lo que Ofrecemos</h2>
      <div class="row text-center">
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow service-card">
            <div class="card-body">
              <h4 class="card-title">Terapia Individual</h4>
              <p class="card-text">Sesiones personalizadas para trabajar en tus desafíos y metas.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow service-card">
            <div class="card-body">
              <h4 class="card-title">Terapia Grupal</h4>
              <p class="card-text">Espacios de apoyo colectivo para compartir experiencias.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow service-card">
            <div class="card-body">
              <h4 class="card-title">Mindfulness</h4>
              <p class="card-text">Programas para gestionar el estrés diario de manera efectiva.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="testimonios" class="py-5 bg-white fade-in">
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
          <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#testimonioCarousel" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
        </button>
      </div>
    </div>
  </section>

  <section id="contacto" class="text-center py-5 bg-light fade-in">
    <div class="container">
      <h2 class="mb-4">Contáctanos</h2>
      <p><strong>Email:</strong> contacto@clinicadesaludmental.com</p>
      <p><strong>Teléfono:</strong> +34 912 345 678</p>
    </div>
  </section>

  <?php include 'vistas/pie.php'; ?>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
  <script>
    // Particles.js
    particlesJS("particles-js", {
      particles: {
        number: { value: 60 },
        color: { value: ["#00e676","#1de9b6","#00b0ff","#18ffff"] },
        shape: { type: "circle" },
        opacity: { value: 0.5 },
        size: { value: 3 },
        move: { enable: true, speed: 2, out_mode: "bounce" }
      },
      interactivity: {
        events: { onhover: { enable: true, mode: "grab" } },
        modes: { grab: { distance: 120, line_linked: { opacity: 0.5 } } }
      },
      retina_detect: true
    });

    // Tipo de letra con efecto escritura
    const titulo = document.getElementById('titulo-animado');
    const texto = titulo.textContent;
    titulo.textContent = '';
    let i = 0;
    function escribir() {
      if (i < texto.length) {
        titulo.innerHTML += texto.charAt(i) === ' ' ? '&nbsp;' : texto.charAt(i);
        i++;
        setTimeout(escribir, 60);
      }
    }
    window.addEventListener('DOMContentLoaded', escribir);

    // Animación de aparición al hacer scroll
    const faders = document.querySelectorAll('.fade-in');
    const appearOptions = { threshold: 0.2, rootMargin: "0px 0px -50px 0px" };
    const appearOnScroll = new IntersectionObserver((entries, appearOnScroll) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('appear');
        appearOnScroll.unobserve(entry.target);
      });
    }, appearOptions);
    faders.forEach(fader => appearOnScroll.observe(fader));
  </script>
</body>
</html>
