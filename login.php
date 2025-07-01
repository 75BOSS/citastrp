<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $correo = $_POST["correo"] ?? '';
  $contraseña = $_POST["contraseña"] ?? '';

  if ($correo === "correo@prueba.com" && $contraseña === "12345") {
    $_SESSION["usuario"] = $correo;
    $_SESSION["rol"] = "paciente";
    header("Location: paciente/index_paciente.php");
    exit();
  } else {
    echo "<script>alert('Credenciales incorrectas'); window.location.href='login.php';</script>";
    exit();
  }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Iniciar sesión - Psicovínculo</title>
  <link rel="stylesheet" href="css/login.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body>
  <!-- Header -->
  <header class="header">
    <nav class="navbar">
      <div class="logo">
        <a href="index.php"><img src="imagen/logo.png" alt="Psicovínculo" class="logo-psicovinculo"></a>
        <span>Psicovínculo</span>
      </div>
      <ul class="menu">
        <li><a href="index.php">Inicio</a></li>
        <li><a href="test.php">Tests</a></li>
        <li><a href="servicios.php">Servicios</a></li>
        <li><a href="eventos.php">Eventos</a></li>
        <li><a href="contacto.php">Contacto</a></li>
      </ul>
      <div class="auth-buttons">
        <a class="btn-outline btn" href="registro.php">Reservar Cita</a>
        <a class="btn-primary btn" href="login.php">Iniciar Sesión</a>
      </div>
    </nav>
  </header>

  <!-- Login Container -->
  <div class="contenedor">
    <div class="formulario__login">
      <h2>Iniciar Sesión</h2>
      <form method="POST">
        <input type="email" name="correo" placeholder="Correo Electrónico" required />
        <input type="password" name="contraseña" placeholder="Contraseña" required />
        <button type="submit">Entrar</button>
      </form>

      <p class="no-cuenta-text">¿Aún no tienes una cuenta?</p>
      <a href="registro.php" class="btn__registrarse">Registrarse</a>
    </div>
  </div>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-info">
        <h4>INFORMACIÓN</h4>
        <p><i class="fas fa-map-marker-alt"></i> Av. Isabel La Católica N. 23-52 y Madrid.</p>
        <p><i class="fas fa-phone"></i> 0960951729</p>
        <p><i class="fas fa-envelope"></i> fabian.carsola@ups.edu.ec</p>
      </div>

      <div class="footer-social">
        <h4>NUESTRAS REDES SOCIALES</h4>
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
        <p class="hover-levanta">Tratamientos de Depresión</p>
        <p class="hover-levanta">Terapia para Ansiedad</p>
        <p class="hover-levanta">Mejora de Autoestima</p>
        <p class="hover-levanta">Terapia para Parejas</p>
      </div>
    </div>
  </footer>
</body>
</html>
