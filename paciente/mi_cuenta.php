<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mi Cuenta - Psicovínculo</title>
  <link rel="stylesheet" href="../css/index.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body>
  <?php include("header.php"); ?>

  <main class="main-content">
    <section class="bienvenida">
      <h1>Mi Cuenta</h1>
      <p>Bienvenido/a, <?php echo isset($_SESSION["usuario"]) ? $_SESSION["usuario"] : 'Invitado'; ?>.</p>
    </section>
  </main>

  <?php include("footer.php"); ?>
</body>
</html>
