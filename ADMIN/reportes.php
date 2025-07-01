<?php
// Activar errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión
$host = "localhost";
$user = "root";
$pass = "";
$db   = "u240362798_citasTRP";
$conexion = new mysqli($host, $user, $pass, $db);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
$conexion->set_charset("utf8");

// Total de charlas
$resCharlas = $conexion->query("SELECT COUNT(*) AS total FROM charlas");
$totalCharlas = $resCharlas->fetch_assoc()['total'] ?? 0;

// Total de pacientes
$resPacientes = $conexion->query("SELECT COUNT(*) AS total FROM usuarios WHERE rol = 'paciente'");
$totalPacientes = $resPacientes->fetch_assoc()['total'] ?? 0;

// Psicólogo más activo
$resActivo = $conexion->query("
    SELECT u.nombre, COUNT(*) AS total 
    FROM charlas c
    INNER JOIN usuarios u ON u.id = c.id_psicologo
    GROUP BY c.id_psicologo
    ORDER BY total DESC
    LIMIT 1
");
$psicologoActivo = ($resActivo->num_rows > 0) ? $resActivo->fetch_assoc()['nombre'] : "Sin datos";

// Charla más popular (más reservas)
$resPopular = $conexion->query("
    SELECT c.titulo, COUNT(*) AS total
    FROM reservas r
    INNER JOIN charlas c ON c.id = r.id_charla
    GROUP BY c.id
    ORDER BY total DESC
    LIMIT 1
");
$charlaPopular = ($resPopular->num_rows > 0) ? $resPopular->fetch_assoc()['titulo'] : "Sin datos";

// Charla mejor calificada
$resMejor = $conexion->query("
    SELECT c.titulo, AVG(cal.calificacion) AS promedio
    FROM calificaciones cal
    INNER JOIN reservas r ON r.id = cal.id_reserva
    INNER JOIN charlas c ON c.id = r.id_charla
    GROUP BY c.id
    HAVING COUNT(cal.id) >= 1
    ORDER BY promedio DESC
    LIMIT 1
");
$charlaCalificada = ($resMejor->num_rows > 0) ? $resMejor->fetch_assoc()['titulo'] : "Sin datos";
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reportes Globales</title>
  <link rel="stylesheet" href="css/reportes.css?">
</head>
<body>
  <div class="container">
    <header>
  <a href="index.php">
    <img src="imagen/logo.png" alt="Logo Psicovínculo" class="logo">
  </a>
  <h1>Reportes Globales</h1>
</header>

    <section class="datos">
      <div class="dato"><strong>Total de Charlas</strong><p><?= $totalCharlas ?></p></div>
      <div class="dato"><strong>Total de Pacientes</strong><p><?= $totalPacientes ?></p></div>
      <div class="dato"><strong>Charla Más Popular</strong><p><?= $charlaPopular ?></p></div>
      <div class="dato"><strong>Psicólogo Más Activo</strong><p><?= $psicologoActivo ?></p></div>
      <div class="dato"><strong>Charla Mejor Calificada</strong><p><?= $charlaCalificada ?></p></div>
    </section>
  </div>
</body>
</html>