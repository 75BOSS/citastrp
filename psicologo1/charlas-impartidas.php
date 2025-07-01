<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'psicologo') {
    header("Location: login.php");
    exit();
}

$id_psicologo = $_SESSION['usuario_id'];

// Consultamos las charlas creadas por este psicólogo
$query = "
  SELECT 
    c.id, c.titulo, c.fecha, c.hora_inicio, c.hora_fin, c.cupo_maximo,
    a.nombre AS auditorio
  FROM charlas c
  JOIN auditorios a ON c.id_auditorio = a.id
  WHERE c.id_psicologo = ?
  ORDER BY c.fecha DESC
";

$stmt = $conexion->prepare($query);
$stmt->bind_param("i", $id_psicologo);
$stmt->execute();
$resultado = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Charlas Impartidas</title>
  <link rel="stylesheet" href="charlas-com.css">
</head>
<body>

  <header class="panel-header">
    <h1 class="logo">Psico<span class="highlight" style="color:#f2b705">Vínculo</span></h1>
   <h2 class="titulo-centro">Charlas Impartidas</h2>
    <nav class="panel-nav">
                <a href="index-psicologo.php">Inicio</a>
      <a href="mi-cuenta.php">Mi Cuenta</a>
      <a href="logout.php" class="logout">Cerrar Sesión</a>
    </nav>
  </header>


<main>
  <table class="tabla-charlas">
    <thead>
      <tr>
        <th>Título</th>
        <th>Fecha</th>
        <th>Horario</th>
        <th>Auditorio</th>
        <th>Cupo Máximo</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($fila = $resultado->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($fila['titulo']) ?></td>
          <td><?= $fila['fecha'] ?></td>
          <td><?= substr($fila['hora_inicio'], 0, 5) ?> - <?= substr($fila['hora_fin'], 0, 5) ?></td>
          <td><?= $fila['auditorio'] ?></td>
          <td><?= $fila['cupo_maximo'] ?></td>
          <td>
            <a href="ver-reservas.php?id=<?= $fila['id'] ?>">👥 Ver asistentes</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</main>
</body>
</html>
