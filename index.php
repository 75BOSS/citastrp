<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Psicovínculo - Servicios Psicológicos</title>
  <link href="css/index.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
</head>

<body>
  <header class="header">
    <nav class="navbar">
      <div class="logo">
        <img src="imagen/logo.png" alt="Psicovínculo" class="logo-psicovinculo" />
        <span>Psicovínculo</span>
      </div>
      <ul class="menu">
        <li><a class="active" href="#inicio">Inicio</a></li>
        <li><a href="test.html">Tests</a></li>
        <li> <a href="servicios.html">Servicios</a></li>
        <li><a href="eventos.html">Eventos</a></li>
        <li><a href="contacto.html">Contacto</a></li>
      </ul>
      <div class="auth-buttons">
        <a class="btn-outline btn" href="login.php">Reservar Cita</a>
        <a class="btn-primary btn" href="login.php">Iniciar Sesión</a>
      </div>
    </nav>
  </header>


  <section class="gallery-slider">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide"><img src="imagen/estudiantes.jpg" alt="Galería 1"></div>
        <div class="swiper-slide"><img src="imagen/estudiantes2.jpg" alt="Galería 2"></div>
        <div class="swiper-slide"><img src="imagen/estudiantes3.jpg" alt="Galería 3"></div>
      </div>
    </div>
    <div class="slider-overlay">
      <div class="overlay-content">
        <h2>¿Quiénes somos?</h2>
        <p>
        <h3>Somos un grupo de estudiantes del noveno semestre de la carrera de Psicología Clínica de la Universidad
          Politécnica Salesiana. Nos dedicamos a la organización y ejecución de charlas psicoeducativas dirigidas a la
          comunidad estudiantil y al público general.</h3>
        </p>
      </div>
    </div>
  </section>

  <section class="services-section">
    <div class="container">
      <h2 class="section-title" style="text-align: center;">Objetivos del Proyecto</h2>
      <div class="card-grid">
        <div class="info-card objetivo-card objetivo-1">
          <p>
          <h4>Concienciar sobre salud mental, sexualidad, autoestima y más.</h4>
          </p>
          <img src="imagen/estilo-de-vida-saludable.png" alt="Saludable" class="icon-img">
        </div>
        <div class="info-card objetivo-card objetivo-2">
          <p>
          <h4>Promover espacios de diálogo y aprendizaje.</h4>
          </p>
          <img src="imagen/dialogo.png" alt="Diálogo" class="icon-img">
        </div>
        <div class="info-card objetivo-card objetivo-3">
          <p>
          <h4>Fomentar el bienestar psicológico desde un enfoque preventivo.</h4>
          </p>
          <img src="imagen/secundario.png" alt="Bienestar" class="icon-img">
        </div>
      </div>
    </div>
  </section>


  <section class="respaldo-section">
    <div class="respaldo-container">
      <div class="respaldo-texto">
        <h2>Respaldo Institucional</h2>
        <p>Contamos con el respaldo de la Universidad Politécnica Salesiana, asegurando la calidad académica y el
          compromiso ético de nuestras actividades.</p>
      </div>
      <div class="respaldo-imagen">
        <img src="imagen/salesiana2.png" alt="Universidad Politécnica Salesiana">
      </div>
    </div>
  </section>



  <section class="porque-asistir-section">
    <div class="container">
      <h2 class="section-title">¿Por qué asistir?</h2>
      <div class="asistir-grid">
        <div class="asistir-card">
          <img src="imagen/terapia.png" alt="Terapia educativa">
          <p>
          <h4>Charlas gratuitas con enfoque educativo y terapéutico.</h4>
          </p>
        </div>
        <div class="asistir-card">
          <img src="imagen/profesional.png" alt="Profesionales">
          <p>
          <h4>Temas relevantes impartidos por futuros profesionales.</h4>
          </p>
        </div>
        <div class="asistir-card">
          <img src="imagen/espacio_seguro.png" alt="Espacio seguro">
          <p>
          <h4>Espacios seguros para resolver inquietudes personales.</h4>
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="hero" id="inicio">
    <div class="hero-container">
      <div class="hero-text">
        <h1>Tu bienestar emocional es<br><span>nuestra prioridad</span></h1>
        <p>Descubre herramientas, recursos y servicios profesionales para mejorar tu salud mental y alcanzar un
          equilibrio emocional duradero.</p>
        <div class="hero-buttons">
          <a class="btn btn-primary" href="#servicios.html">Explorar Servicios</a>
          <a class="btn btn-secondary" href="#tests.html">Tests Gratuitos</a>
        </div>
      </div>
      <div class="hero-image">
        <img src="imagen/bienestar_emocional.png" alt="Bienestar emocional">
      </div>
    </div>
  </section>

  <a class="whatsapp-btn" href="https://wa.me/593978123456">
    <i class="fab fa-whatsapp"></i>
  </a>

  <footer class="footer">
    <div class="footer-container">
        <div class="footer-section">
            <h3>INFORMACIÓN</h3>
            <p><i class="fas fa-map-marker-alt"></i> Av. Isabel La Católica N. 23-52 y Madrid.</p>
            <p><i class="fas fa-phone"></i> <a href="tel:0960951729">0960951729</a></p>
            <p><i class="fas fa-envelope"></i> <a href="mailto:fabian.carsoia@ups.edu.co">fabian.carsoia@ups.edu.co</a></p>
        </div>
        
        <div class="footer-section">
            <h3>ATENCIÓN</h3>
            <p><i class="far fa-clock"></i> LUNES A VIERNES</p>
            <p>9:00 AM - 17:00 PM</p>
        </div>
        
        <div class="footer-section">
            <h3>NUESTROS SERVICIOS</h3>
            <ul class="services-list">
                <li>Tratamientos de Ansiedad</li>
                <li>Terapia para Depresión</li>
                <li>Manejo del Estrés</li>
                <li>Terapia para Crisis de Pánico</li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h3>REDES SOCIALES</h3>
            <div class="social-icons">
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
            </div>
            <div class="footer-link">
                <a href="servicios.html" target="_blank">
                    Más información sobre nuestros servicios
                </a>
            </div>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; 2025 Psicovínculo. Todos los derechos reservados.</p>
    </div>

    <!-- Botón flotante de WhatsApp -->
    <a href="https://wa.me/593960951729" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp whatsapp-icon"></i>
    </a>
</footer>
</body>
</html>