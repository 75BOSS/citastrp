<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'psicologo') {
    header("Location: login.php");
    exit();
}

function nivelExperiencia($charlas) {
    if ($charlas >= 10) return "⭐ Experto";
    if ($charlas >= 5) return "🔰 Intermedio";
    return "🌱 Principiante";
}

$id_psicologo = $_SESSION['usuario_id'];

$stmt = $conexion->prepare("SELECT nombre, correo, foto, telefono, codigo_estudiante FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id_psicologo);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();

$foto = trim($usuario['foto']);
$ruta_foto = (!empty($foto)) ? $foto : 'imagen/descarga.jpeg';

$stmt2 = $conexion->prepare("SELECT COUNT(*) as total FROM charlas WHERE id_psicologo = ?");
$stmt2->bind_param("i", $id_psicologo);
$stmt2->execute();
$total_charlas = $stmt2->get_result()->fetch_assoc()['total'];

$experiencia = nivelExperiencia($total_charlas);

$stmt3 = $conexion->prepare("SELECT titulo, fecha FROM charlas WHERE id_psicologo = ? ORDER BY fecha DESC LIMIT 1");
$stmt3->bind_param("i", $id_psicologo);
$stmt3->execute();
$ultima_charla = $stmt3->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mi Cuenta</title>
  <link rel="stylesheet" href="estilos/panel1.css">
  <link rel="stylesheet" href="estilos/cuenta.css">

</head>
<body>
   <header class="panel-header">
    <h1 class="logo">Psico<span class="highlight" style="color:#f2b705">Vínculo</span></h1>
  <h2 class="titulo-centro">👤 Mi Perfil</h2>    <nav class="panel-nav">
    <a href="index-psicologo.php">Inicio</a>
      <a href="generar-charla.php">Programar Charla</a>
      <a href="charlas-impartidas.php">Mis Charlas</a>
      <a href="logout.php" class="logout">Cerrar Sesión</a>
    </nav>
  </header>

<main>
  <section class="tarjeta">
    <h3>Tarjeta de presentación</h3>
    <img src="<?= htmlspecialchars($ruta_foto) ?>" alt="Foto de perfil" class="foto-perfil-grande">
    <p><strong>Nombre:</strong> <?= htmlspecialchars($usuario['nombre']) ?></p>
    <p><strong>Correo:</strong> <?= htmlspecialchars($usuario['correo']) ?></p>
    <p><strong>Teléfono:</strong> <?= htmlspecialchars($usuario['telefono']) ?></p>
    <p><strong>Código Estudiante:</strong> <?= htmlspecialchars($usuario['codigo_estudiante']) ?></p>
    <p><strong>Charlas impartidas:</strong> <?= $total_charlas ?> (<?= $experiencia ?>)</p>
    <p><strong>Última charla:</strong> <?= $ultima_charla ? htmlspecialchars($ultima_charla['titulo']) . ' (' . $ultima_charla['fecha'] . ')' : 'Aún no hay charlas' ?></p>
    <a href="editar-perfil.php" class="boton-editar">✏️ Editar Perfil</a>
    <a href="charlas-impartidas.php" class="boton-charlas">📋 Ver Charlas Impartidas</a>
  </section>
</main>
</body>
</html>