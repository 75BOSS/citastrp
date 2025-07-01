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
  <link rel="stylesheet" href="css/index.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
  <?php include("header.php"); ?>

  <main class="login-main">
    <div class="login-container">
      <div class="login-box">
        <form method="POST" class="login-form">
          <h2>Iniciar Sesión</h2>
          <input type="email" name="correo" placeholder="Correo Electrónico" required />
          <input type="password" name="contraseña" placeholder="Contraseña" required />
          <button type="submit">Entrar</button>
          <p class="register-text">¿Aún no tienes una cuenta?</p>
          <a href="registro.php" class="btn-register">Registrarse</a>
        </form>
      </div>
      <div class="login-side-text">
        <h3>Bienvenido a Psicovínculo</h3>
        <p>Accede para reservar citas y participar en nuestras charlas.</p>
      </div>
    </div>
  </main>

  <?php include("footer.php"); ?>
</body>
</html>
