<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Psicovínculo - Paciente</title>
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
        <li><a href="servicios.html">Servicios</a></li>
        <li><a href="eventos.html">Eventos</a></li>
        <li><a href="contacto.html">Contacto</a></li>
      </ul>
      <div class="auth-buttons">
        <a class="btn-outline btn" href="perfil_paciente.php">Mi Cuenta</a>
      </div>
    </nav>
  </header>

  <section class="hero" id="inicio">
    <div class="hero-container">
      <div class="hero-text">
        <h1>Bienvenido/a, Paciente</h1>
        <p>Nos alegra tenerte de vuelta. Revisa tus servicios, tests y charlas disponibles.</p>
        <div class="hero-buttons">
          <a class="btn btn-primary" href="servicios.html">Explorar Servicios</a>
          <a class="btn btn-secondary" href="test.html">Tests Gratuitos</a>
        </div>
      </div>
      <div class="hero-image">
        <img src="imagen/bienestar_emocional.png" alt="Bienestar emocional">
      </div>
    </div>
  </section>

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
    <a href="https://wa.me/593960951729" class="whatsapp-float" target="_blank">
      <i class="fab fa-whatsapp whatsapp-icon"></i>
    </a>
  </footer>
</body>

</html>
