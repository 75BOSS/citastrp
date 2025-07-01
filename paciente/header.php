<?php
session_start();
$nombre = "Usuario";

if (isset($_SESSION["usuario"])) {
    include '../conexion.php';

    $correo = $_SESSION["usuario"];
    $stmt = $conexion->prepare("SELECT nombre FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $row = $resultado->fetch_assoc();
        $partes = explode(" ", trim($row['nombre']));
        $nombre = ucfirst($partes[0]); // Solo el primer nombre
    }
}
?>

<header class="header">
  <nav class="navbar">
    <div class="logo">
      <img src="../imagen/logo.png" alt="Psicovínculo" class="logo-psicovinculo" />
      <span>Psicovínculo</span>
    </div>
    <ul class="menu">
      <li><a class="active" href="index_paciente.php">Inicio</a></li>
      <li><a href="../test.php">Tests</a></li>
      <li><a href="../servicios.php">Servicios</a></li>
      <li><a href="../eventos.php">Eventos</a></li>
      <li><a href="../contacto.php">Contacto</a></li>
    </ul>
    <div class="auth-buttons">
      <span class="bienvenido" style="margin-right: 15px; font-weight: bold;">¡Bienvenido, <?= htmlspecialchars($nombre) ?>!</span>
      <a class="btn-outline btn" href="../logout.php">Cerrar Sesión</a>
      <a class="btn-primary btn" href="mi_cuenta.php">Mi Cuenta</a>
    </div>
  </nav>
</header>
