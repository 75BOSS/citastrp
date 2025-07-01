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
        <div class="swiper-slide"><img src="../imagen/estudiantes3.jpg" alt="Galería 3"></div>
      </div>
    </div>
    <div class="slider-overlay">
      <div class="overlay-content">
        <h2>¡Bienvenido, <?= htmlspecialchars($nombreCompleto) ?>!</h2>
        <p>Es un gusto tenerte en Psicovínculo. Aquí podrás encontrar recursos gratuitos, servicios y charlas
        psicoeducativas pensadas para ti. Explora, aprende y cuida de tu bienestar emocional junto a nosotros.</p>
        <a href="../buscar_charlas.php" class="btn btn-primary" style="margin-top: 20px;">Buscar charlas</a>
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
  <?php include 'footer.php'; ?>
</body>
</html>
