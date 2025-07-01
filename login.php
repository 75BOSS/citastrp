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
  <header class="header">
    <nav class="navbar">
      <div class="logo">
        <a href="index.php" class="logo-link">
          <img src="imagen/logo.png" class="logo-psicovinculo" alt="Psicovínculo" />
        </a>
        <span>Psicovínculo</span>
      </div>
    </nav>
  </header>

  <div class="contenedor">
    <form method="POST" class="formulario__login">
      <h2>Iniciar Sesión</h2>
      <input type="email" name="correo" placeholder="Correo Electrónico" required />
      <input type="password" name="contraseña" placeholder="Contraseña" required />
      <button type="submit">Entrar</button>
      <p class="no-cuenta-text">¿No tienes una cuenta?</p>
      <a href="registro.php" class="btn__registrarse">Registrarse</a>
    </form>
  </div>
</body>
  <footer class="footer">
    <div class="footer-container">
      <div class="footer-section">
        <h4>INFORMACIÓN</h4>
        <p><i class="fas fa-map-marker-alt"></i> Av. Isabel La Católica N. 23-52 y Madrid.</p>
        <p><i class="fas fa-phone"></i> 0960951729</p>
        <p><i class="fas fa-envelope"></i> fabian.carsola@ups.edu.ec</p>
      </div>

      <div class="footer-section">
        <h4>REDES SOCIALES</h4>
        <div class="social-icons">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
      </div>

      <div class="footer-section">
        <h4>ATENCIÓN</h4>
        <p>LUNES A VIERNES</p>
        <p>9:00 AM - 17:00 PM</p>
      </div>

      <div class="footer-section">
        <h4>NUESTROS SERVICIOS</h4>
        <ul>
          <li>Tratamientos de Ansiedad</li>
          <li>Terapia para Depresión</li>
          <li>Mejora de Autoestima</li>
          <li>Terapia para Parejas</li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2025 Psicovínculo. Todos los derechos reservados.</p>
    </div>
  </footer>

</html>
