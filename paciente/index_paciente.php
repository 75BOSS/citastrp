<?php
session_start();
include '../conexion.php';

$nombreCompleto = "Usuario";
if (isset($_SESSION["usuario"])) {
    $correo = $_SESSION["usuario"];
    $stmt = $conexion->prepare("SELECT nombre FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado->num_rows === 1) {
        $row = $resultado->fetch_assoc();
        $nombreCompleto = $row['nombre'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Psicovínculo - Servicios Psicológicos</title>
  <link href="../css/index.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
</head>

<body>
  <?php include 'header.php'; ?>

  <section class="gallery-slider">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide"><img src="../imagen/estudiantes.jpg" alt="Galería 1"></div>
        <div class="swiper-slide"><img src="../imagen/estudiantes2.jpg" alt="Galería 2"></div>
        <div class="swiper-slide"><img src="../imagen/estudiantes3.jpg" alt="Galería 3"></div>
      </div>
    </div>
    <div class="slider-overlay">
      <div class="overlay-content">
        <h2>¡Bienvenido, <?= htmlspecialchars($nombreCompleto) ?>!</h2>
        <p>Es un gusto tenerte en Psicovínculo. Aquí podrás encontrar recursos gratuitos, servicios y charlas
        psicoeducativas pensadas para ti. Explora, aprende y cuida de tu bienestar emocional junto a nosotros.</p>
        <a href="../eventos.php" class="btn btn-primary" style="margin-top: 20px;">Buscar charlas</a>
      </div>
    </div>
  </section>

  <?php include 'footer.php'; ?>
</body>
</html>
