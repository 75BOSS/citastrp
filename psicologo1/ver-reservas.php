<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'psicologo') {
    header("Location: login.php");
    exit();
}

$id_psicologo = $_SESSION['usuario_id'];

if (!isset($_GET['id'])) {
    echo "Charla no especificada.";
    exit();
}

$id_charla = intval($_GET['id']);

// Verificar que la charla pertenece al psicólogo
$stmt_verif = $conexion->prepare("SELECT titulo FROM charlas WHERE id = ? AND id_psicologo = ?");
$stmt_verif->bind_param("ii", $id_charla, $id_psicologo);
$stmt_verif->execute();
$res_verif = $stmt_verif->get_result();

if ($res_verif->num_rows === 0) {
    echo "No tienes permiso para ver esta charla.";
    exit();
}

$titulo_charla = $res_verif->fetch_assoc()['titulo'];

// Obtener asistentes (reservas de pacientes)
$stmt = $conexion->prepare("
    SELECT u.nombre, u.correo, r.fecha_reserva, r.estado
    FROM reservas r
    JOIN usuarios u ON r.id_paciente = u.id
    WHERE r.id_charla = ?
");
$stmt->bind_param("i", $id_charla);
$stmt->execute();
$reservas = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Asistentes a la Charla</title>
  <link rel="stylesheet" href="charlas-com.css">
</head>
<body>
<header>
  <div class="logo-container">
    <img src="imagen/logo.png" alt="Logo PsicoVínculo" class="logo-img">
    <span class="logo-text">Psico<span class="highlight">Vínculo</span></span>
  </div>
  <h2 class="titulo-centro">Asistentes a: <?= htmlspecialchars($titulo_charla) ?></h2>
  <nav>
    <a href="charlas-impartidas.php">🔙 Volver</a>
  </nav>
</header>

<main>
<?php if ($reservas->num_rows > 0): ?>
  <table class="tabla-charlas">
    <thead>
      <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Fecha de Reserva</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($fila = $reservas->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($fila['nombre']) ?></td>
          <td><?= htmlspecialchars($fila['correo']) ?></td>
          <td><?= $fila['fecha_reserva'] ?></td>
          <td>
            <span class="estado <?= strtolower($fila['estado']) ?>">
              <?= htmlspecialchars(ucfirst($fila['estado'])) ?>
            </span>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
<?php else: ?>
  <p style="text-align:center;">Esta charla aún no tiene asistentes registrados.</p>
<?php endif; ?>
</main>
</body>
</html>
