<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'psicologo') {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "Charla no especificada.";
    exit();
}

$id_charla = intval($_GET['id']);
$id_psicologo = $_SESSION['usuario_id'];

// Verifica que la charla le pertenezca al psicólogo
$stmt = $conexion->prepare("SELECT * FROM charlas WHERE id = ? AND id_psicologo = ?");
$stmt->bind_param("ii", $id_charla, $id_psicologo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "No tienes acceso a esta charla.";
    exit();
}

$charla = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Detalle de la Charla</title>
  <link rel="stylesheet" href="detalle-charla.css">
  <link rel="stylesheet" href="estilos/panel1.css">
</head>
<body>
    <header class="panel-header">
    <h1 class="logo">Psico<span class="highlight" style="color:#f2b705">Vínculo</span></h1>
        <h2>📋 Detalles de la Charla</h2>
    <nav class="panel-nav">
          <a href="index-psicologo.php">Inicio</a>
      <a href="generar-charla.php">Programar Charla</a>
      <a href="charlas-impartidas.php">Mis Charlas</a>
      <a href="mi-cuenta.php">Mi Cuenta</a>
      <a href="logout.php" class="logout">Cerrar Sesión</a>
    </nav>
  </header>

  <main>
    <section class="detalle-charla">
      <h3><?= htmlspecialchars($charla['titulo']) ?></h3>
      <p><strong>Fecha:</strong> <?= $charla['fecha'] ?></p>
      <p><strong>Hora:</strong> <?= substr($charla['hora_inicio'], 0, 5) . ' - ' . substr($charla['hora_fin'], 0, 5) ?></p>
      <p><strong>Cupo Máximo:</strong> <?= $charla['cupo_maximo'] ?></p>
      <p><strong>Descripción:</strong> <?= nl2br(htmlspecialchars($charla['descripcion'] ?? 'No especificada')) ?></p>

      <div class="botones-acciones">
        <a href="editar-charla.php?id=<?= $charla['id'] ?>" class="boton-editar">✏️ Editar</a>
        <a href="cancelar-charla.php?id=<?= $charla['id'] ?>" class="boton-cancelar" onclick="return confirm('¿Estás seguro de cancelar esta charla?')">❌ Cancelar</a>
      </div>
    </section>
  </main>
</body>
</html>
