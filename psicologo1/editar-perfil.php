<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'psicologo') {
    header("Location: login.php");
    exit();
}

$id_psicologo = $_SESSION['usuario_id'];

// Obtener los datos actuales del usuario
$stmt = $conexion->prepare("SELECT nombre, correo, foto, telefono FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id_psicologo);
$stmt->execute();
$usuario = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Perfil</title>
  <link rel="stylesheet" href="estilos/editar-perfil.css">
</head>
<body>
<header>
  <div class="logo-container">
    <img src="imagen/logo.png" alt="Logo PsicoVínculo" class="logo-img">
    <span class="logo-text">Psico<span class="highlight">Vínculo</span></span>
  </div>
  <h2 class="titulo-centro">✏️ Editar Información</h2>
  <nav>
    <a href="index-psicologo.php">🏠 Panel</a>
    <a href="logout.php">🔓 Cerrar Sesión</a>
  </nav>
</header>

<main>
  <section class="formulario-edicion">
    <form action="actualizar-perfil.php" method="POST">
      <label>Nombre:</label>
      <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>

      <label>Teléfono:</label>
      <input type="text" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>">

      <label>Foto de perfil (URL):</label>
      <input type="text" name="foto" value="<?= htmlspecialchars($usuario['foto']) ?>">

      <button type="submit">Guardar Cambios</button>
    </form>
  </section>
</main>
</body>
</html>
