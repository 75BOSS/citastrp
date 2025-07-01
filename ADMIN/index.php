<?php
include '../conexion.php';

// Consultas
$totalUsuarios = $conexion->query("SELECT COUNT(*) AS total FROM usuarios WHERE activo = 1")->fetch_assoc()['total'] ?? 0;
$totalPacientes = $conexion->query("SELECT COUNT(*) AS total FROM usuarios WHERE rol = 'paciente' AND activo = 1")->fetch_assoc()['total'] ?? 0;
$totalPsicologos = $conexion->query("SELECT COUNT(*) AS total FROM usuarios WHERE rol = 'psicologo' AND activo = 1")->fetch_assoc()['total'] ?? 0;
$totalCharlas = $conexion->query("SELECT COUNT(*) AS total FROM charlas")->fetch_assoc()['total'] ?? 0;
$ultima = $conexion->query("SELECT MAX(fecha_registro) as fecha FROM usuarios")->fetch_assoc()['fecha'] ?? '--';
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="css/index.css">

</head>

<body>
    <header>
  <div class="top-bar">
    <img src="imagen/logo.png" alt="Logo Psicovínculo" class="logo">
    <div class="centrado">
      <h1 class="titulo">Panel de Administrador</h1>
      <nav>
        <ul class="nav-centrado">
          <li><a href="usuarios.php">Usuarios</a></li>
          <li><a href="auditorios.php">Auditorios</a></li>
          <li><a href="charlas.php">Charlas</a></li>
          <li><a href="reportes.php">Reportes</a></li>
        </ul>
      </nav>
    </div>
    <div class="perfil">
      <a href="micuenta.php" title="Mi Cuenta">
        <img src="imagen/perfil.png" alt="Perfil" class="icono-perfil">
      </a>
    </div>
  </div>
</header>
    <h2>Bienvenido Administrador</h2>
      <p>Resumen general del sistema y próximas charlas.</p>

    <div class="tarjetas">
        <div class="tarjeta">
            <h3>👥 Total de Usuarios</h3>
            <p><?= $totalUsuarios ?></p>
        </div>
        <div class="tarjeta">
            <h3>🧑‍🎓 Total de Pacientes</h3>
            <p><?= $totalPacientes ?></p>
        </div>
        <div class="tarjeta">
            <h3>🧑‍⚕️ Total de Psicólogos</h3>
            <p><?= $totalPsicologos ?></p>
        </div>
        <div class="tarjeta">
            <h3>🧠 Total de Charlas</h3>
            <p><?= $totalCharlas ?></p>
        </div>
        <div class="tarjeta">
            <h3>📅 Última Actualización</h3>
            <p><?= $ultima ?></p>
        </div>
    </div>
</body>

</html>