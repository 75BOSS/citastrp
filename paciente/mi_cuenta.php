<?php
session_start();
include '../conexion.php';

if (!isset($_SESSION["usuario"])) {
    header("Location: ../login.php");
    exit();
}

$correo = $_SESSION["usuario"];
$stmt = $conexion->prepare("SELECT nombre, correo, cedula, telefono, rol, codigo_estudiante FROM usuarios WHERE correo = ?");
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mi Cuenta - Psicovínculo</title>
  <link rel="stylesheet" href="../css/index.css">
</head>
<body>
<?php include 'header.php'; ?>

<section class="container" style="padding: 40px 20px;">
  <h2 style="text-align: center; margin-bottom: 30px;">Información de tu cuenta</h2>
  <div class="info-card" style="max-width: 500px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <p><strong>Nombre:</strong> <?= htmlspecialchars($usuario['nombre']) ?></p>
    <p><strong>Correo:</strong> <?= htmlspecialchars($usuario['correo']) ?></p>
    <p><strong>Cédula:</strong> <?= htmlspecialchars($usuario['cedula']) ?></p>
    <p><strong>Teléfono:</strong> <?= htmlspecialchars($usuario['telefono']) ?: 'No registrado' ?></p>
    <p><strong>Rol:</strong> <?= ucfirst($usuario['rol']) ?></p>
    <?php if ($usuario['rol'] === 'paciente'): ?>
      <p><strong>Código Estudiante:</strong> <?= htmlspecialchars($usuario['codigo_estudiante']) ?: 'No aplica' ?></p>
    <?php endif; ?>
  </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
