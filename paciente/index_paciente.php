<?php
session_start();
if (!isset($_SESSION["usuario"])) {
  header("Location: ../login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Psicovínculo - Paciente</title>
  <link rel="stylesheet" href="../css/index.css" />
  <link rel="stylesheet" href="../css/index_paciente.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
  <!-- HEADER -->
  <header class="header">
    <nav class="navbar">
      <div class="logo">
        <a href="index_paciente.php" class="logo-link">
          <img src="../imagen/logo.png" class="logo-psicovinculo" alt="Psicovínculo">
        </a>
        <span>Psicovínculo</span>
      </div>
      <ul class="menu">
        <li><a href="../index.php">Inicio</a></li>
        <li><a href="../test.php">Tests</a></li>
        <li><a href="../servicios.php">Servicios</a></li>
        <li><a href="../eventos.php">Eventos</a></li>
        <li><a href="../contacto.php">Contacto</a></li>
      </ul>
      <div class="auth-buttons">
        <a class="btn-outline btn" href="#">Mi Cuenta</a>
      </div>
    </nav>
  </header>

  <!-- CONTENIDO PRINCIPAL -->
  <section class="main-content">
    <div class="bienvenida">
      <h1>Bienvenido/a, Paciente</h1>
      <p>Nos alegra tenerte de vuelta. Revisa tus servicios, tests y charlas disponibles.</p>
      <a href="../servicios.php" class="btn-primary">Explorar Servicios</a>
      <a href="../test.php" class="btn-secondary">Tests Gratuitos</a>
    </div>
    <div class="imagen">
      <img src="../imagen/bienestar.jpg" alt="Bienestar emocional" />
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container">
      <div class="footer-info">
        <h4>INFORMACIÓN</h4>
        <p><i class="fas fa-map-marker-alt"></i>
          <a href="https://maps.app.goo.gl/CJ5V1qExnY63Y8Xn7" target="_blank">Av. Isabel La Católica N. 23-52 y Madrid.</a>
        </p>
        <p><i class="fas fa-phone"></i> 0960951729</p>
        <p><i class="fas fa-envelope"></i> fabian.carsola@ups.edu.ec</p>
      </div>

      <div class="footer-social">
        <h4>REDES SOCIALES</h4>
        <div class="social-media">
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-facebook-f"></i></a>
        </div>
      </div>

      <div class="footer-attention">
        <h4>ATENCIÓN</h4>
        <p>LUNES A VIERNES</p>
        <p>9:00 AM - 17:00 PM</p>
      </div>

      <div class="footer-newsletter">
        <h4>NUESTROS SERVICIOS</h4>
        <p class="hover-levanta">Tratamientos de Ansiedad</p>
        <p class="hover-levanta">Terapia para Depresión</p>
        <p class="hover-levanta">Manejo del Estrés</p>
        <p class="hover-levanta">Terapia para Crisis de Pánico</p>
      </div>
    </div>
  </footer>
</body>

</html>
