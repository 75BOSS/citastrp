<?php
session_start();
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'paciente') {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Psicovínculo - Paciente</title>
  <link rel="stylesheet" href="../css/index.css">
</head>
<body>
  <header class="header">
    <nav class="navbar">
      <div class="logo">
        <a href="index_paciente.php" class="logo-link">
          <img src="../imagen/logo.png" class="logo-psicovinculo" alt="Psicovínculo">
        </a>
        <span>Psicovínculo</span>
      </div>
      <ul class="menu">
        <li><a href="index_paciente.php">Inicio</a></li>
        <li><a href="../test.php">Tests</a></li>
        <li><a href="../servicios.php">Servicios</a></li>
        <li><a href="../eventos.php">Eventos</a></li>
        <li><a href="../contacto.php">Contacto</a></li>
      </ul>
      <div class="auth-buttons">
        <a class="btn-outline btn" href="mi_cuenta.php">Mi Cuenta</a>
      </div>
    </nav>
  </header>

  <main class="main-content">
    <section class="bienvenida">
      <h1>Bienvenido/a, Paciente</h1>
      <p>Nos alegra tenerte de vuelta. Revisa tus servicios, tests y charlas disponibles.</p>
      <a href="../servicios.php" class="btn-primary">Explorar Servicios</a>
      <a href="../test.php" class="btn-secondary">Tests Gratuitos</a>
    </section>

    <section class="imagen">
      <img src="../imagen/bienestar.png" alt="Bienestar emocional">
    </section>
  </main>

  <footer class="footer">
    <div class="container">
      <div class="footer-info">
        <h4>INFORMACIÓN</h4>
        <p><i class="fas fa-map-marker-alt"></i> Av. Isabel La Católica N. 23-52 y Madrid.</p>
        <p><i class="fas fa-phone"></i> 0960951729</p>
        <p><i class="fas fa-envelope"></i> fabian.carsola@ups.edu.ec</p>
      </div>

      <div class="footer-social">
        <h4>REDES SOCIALES</h4>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-facebook-f"></i></a>
      </div>

      <div class="footer-attention">
        <h4>ATENCIÓN</h4>
        <p>LUNES A VIERNES</p>
        <p>9:00 AM - 17:00 PM</p>
      </div>

      <div class="footer-services">
        <h4>NUESTROS SERVICIOS</h4>
        <ul>
          <li>Tratamientos de Ansiedad</li>
          <li>Terapia para Depresión</li>
          <li>Manejo del Estrés</li>
          <li>Terapia para Crisis de Pánico</li>
        </ul>
      </div>
    </div>
  </footer>
</body>
</html>
