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

// Verifica que la charla pertenezca al psicólogo
$stmt = $conexion->prepare("SELECT * FROM charlas WHERE id = ? AND id_psicologo = ?");
$stmt->bind_param("ii", $id_charla, $id_psicologo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No tienes permiso para editar esta charla.";
    exit();
}

$charla = $result->fetch_assoc();

// Obtener auditorios disponibles
$aud_result = $conexion->query("SELECT id, nombre FROM auditorios");
$auditorios = $aud_result->fetch_all(MYSQLI_ASSOC);

// Procesar actualización
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titulo = $_POST['titulo'];
    $fecha = $_POST['fecha'];
    $hora_inicio = $_POST['hora_inicio'];
    $hora_fin = $_POST['hora_fin'];
    $cupo_maximo = $_POST['cupo_maximo'];
    $descripcion = $_POST['descripcion'];
    $id_auditorio = $_POST['id_auditorio'];

    $stmt_upd = $conexion->prepare("
        UPDATE charlas SET 
        titulo = ?, fecha = ?, hora_inicio = ?, hora_fin = ?, 
        cupo_maximo = ?, descripcion = ?, id_auditorio = ?
        WHERE id = ? AND id_psicologo = ?
    ");
    $stmt_upd->bind_param("ssssissii", 
        $titulo, $fecha, $hora_inicio, $hora_fin, 
        $cupo_maximo, $descripcion, $id_auditorio, 
        $id_charla, $id_psicologo
    );
    $stmt_upd->execute();

    header("Location: detalle-charla.php?id=$id_charla");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Charla</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="index.css">

</head>
<body>
  <header class="panel-header">
    <h1 class="logo">Psico<span class="highlight" style="color:#f2b705">Vínculo</span></h1>
    <nav class="panel-nav">
          <a href="index-psicologo.php">Inicio</a>
      <a href="generar-charla.php">Programar Charla</a>
      <a href="charlas-impartidas.php">Mis Charlas</a>
      <a href="mi-cuenta.php">Mi Cuenta</a>
      <a href="logout.php" class="logout">Cerrar Sesión</a>
    </nav>
  </header>
<main>
  <form method="post">
    <label>Título:</label>
    <input type="text" name="titulo" required value="<?= htmlspecialchars($charla['titulo']) ?>">

    <label>Fecha:</label>
    <input type="date" name="fecha" required value="<?= $charla['fecha'] ?>">

    <label>Hora de Inicio:</label>
    <input type="time" name="hora_inicio" required value="<?= substr($charla['hora_inicio'], 0, 5) ?>">

    <label>Hora de Fin:</label>
    <input type="time" name="hora_fin" required value="<?= substr($charla['hora_fin'], 0, 5) ?>">

    <label>Cupo Máximo:</label>
    <input type="number" name="cupo_maximo" required min="1" value="<?= $charla['cupo_maximo'] ?>">

    <label>Auditorio:</label>
    <select name="id_auditorio" required>
      <?php foreach ($auditorios as $aud): ?>
        <option value="<?= $aud['id'] ?>" <?= $aud['id'] == $charla['id_auditorio'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($aud['nombre']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <label>Descripción:</label>
    <textarea name="descripcion" rows="5"><?= htmlspecialchars($charla['descripcion']) ?></textarea>

    <button type="submit">💾 Guardar Cambios</button>
  </form>

  <a href="detalle-charla.php?id=<?= $id_charla ?>" class="volver">← Volver</a>
</main>
</body>
</html>
