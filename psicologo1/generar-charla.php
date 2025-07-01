<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'psicologo') {
    header("Location: login.php");
    exit();
}

$id_psicologo = $_SESSION['usuario_id'];

// Cargar auditorios
$aud_result = $conexion->query("SELECT id, nombre FROM auditorios");
$hay_auditorios = $aud_result && $aud_result->num_rows > 0;

// Cargar tags
$tags_result = $conexion->query("SELECT id, nombre FROM tags");
$hay_tags = $tags_result && $tags_result->num_rows > 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Generar Charla</title>
  <link rel="stylesheet" href="estilos/panel1.css">
</head>
<body>


  <header class="panel-header">
    <h1 class="logo">Psico<span class="highlight" style="color:#f2b705">Vínculo</span></h1>
      <h2 class="titulo-centro">🗓️ Programar una Nueva Charla</h2>
    <nav class="panel-nav">
          <a href="index-psicologo.php">Inicio</a>
      <a href="charlas-impartidas.php">Mis Charlas</a>
      <a href="mi-cuenta.php">Mi Cuenta</a>
      <a href="logout.php" class="logout">Cerrar Sesión</a>
    </nav>
  </header>

<main>
  <form action="procesar-charla.php" method="POST">
    <label>Título:</label>
    <input type="text" name="titulo" required>

    <label>Descripción:</label>
    <textarea name="descripcion" required></textarea>

    <label>Auditorio:</label>
    <select name="id_auditorio" required>
      <option value="">Seleccione un auditorio</option>
      <?php if ($hay_auditorios): ?>
        <?php while ($a = $aud_result->fetch_assoc()): ?>
          <option value="<?= $a['id'] ?>"><?= htmlspecialchars($a['nombre']) ?></option>
        <?php endwhile; ?>
      <?php else: ?>
        <!-- si no hay auditorios -->
        <option disabled>No hay auditorios disponibles</option>
      <?php endif; ?>
    </select>

    <label>Fecha:</label>
    <input type="date" name="fecha" required min="<?= date('Y-m-d') ?>">

    <label>Hora de inicio:</label>
    <input type="time" name="hora_inicio" required>

    <label>Hora de fin:</label>
    <input type="time" name="hora_fin" required>

    <label>Tags relacionados:</label>
    <div class="tags-container">
      <?php if ($hay_tags): ?>
        <?php while ($tag = $tags_result->fetch_assoc()): ?>
          <label>
            <input type="checkbox" name="tags[]" value="<?= $tag['id'] ?>">
            <?= htmlspecialchars($tag['nombre']) ?>
          </label>
        <?php endwhile; ?>
      <?php else: ?>
        <p style="color: red; font-weight: bold;">⚠️ No hay tags disponibles en el sistema.</p>
      <?php endif; ?>
    </div>

    <label>Cupo máximo:</label>
    <input type="number" name="cupo_maximo" min="1" required>

    <button type="submit">Crear Charla</button>
  </form>
</main>
</body>
</html>
