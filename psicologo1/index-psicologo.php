<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'psicologo') {
    header("Location: login.php");
    exit();
}

$correo = $_SESSION['usuario'];
$perfil = [];
$id_psicologo = null;

// Obtener datos del psicólogo
$consulta = $conexion->query("SELECT id, nombre, telefono FROM usuarios WHERE correo = '$correo' LIMIT 1");
if ($consulta && $consulta->num_rows > 0) {
    $perfil = $consulta->fetch_assoc();
    $id_psicologo = $perfil['id'];
}

// Charlas programadas
$total = 0;
$prox_charla = null;
$charlas_por_mes = array_fill(1, 12, 0);
$proximas_charlas = [];

if ($id_psicologo) {
    $res_total = $conexion->query("SELECT COUNT(*) as total FROM charlas WHERE id_psicologo = $id_psicologo");
    $total = $res_total->fetch_assoc()['total'] ?? 0;

    $prox = $conexion->query("SELECT * FROM charlas WHERE id_psicologo = $id_psicologo AND fecha >= CURDATE() ORDER BY fecha ASC, hora_inicio ASC LIMIT 1");
    $prox_charla = $prox->fetch_assoc();

    $proximas_charlas = $conexion->query("SELECT * FROM charlas WHERE id_psicologo = $id_psicologo AND fecha >= CURDATE() ORDER BY fecha ASC LIMIT 5");

    $res_mes = $conexion->query("SELECT MONTH(fecha) as mes, COUNT(*) as cantidad FROM charlas WHERE id_psicologo = $id_psicologo AND YEAR(fecha) = YEAR(CURDATE()) GROUP BY MONTH(fecha)");
    while ($row = $res_mes->fetch_assoc()) {
        $charlas_por_mes[(int)$row['mes']] = (int)$row['cantidad'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Panel del Psicólogo</title>
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

  <main class="panel-main">
    <section class="bienvenida">
      <h2>Bienvenido, <?= htmlspecialchars($perfil['nombre'] ?? 'Psicólogo') ?></h2>
      <p class="intro">Resumen de tu actividad, próximas charlas y estado de tu perfil.</p>
      <div class="stats">
        <div class="stat-box">
          <h3>Charlas Programadas</h3>
          <p><?= $total ?></p>
        </div>
        <div class="stat-box">
          <h3>Próxima Charla</h3>
          <p><?= $prox_charla ? $prox_charla['fecha'] . ' - ' . substr($prox_charla['hora_inicio'], 0, 5) : 'Sin charlas' ?></p>
        </div>
        <div class="stat-box">
          <h3>Total de Charlas</h3>
          <p><?= $total ?></p>
        </div>
        <div class="stat-box">
          <h3>Última Actualización</h3>
          <p><?= date('d M Y') ?></p>
        </div>
      </div>
    </section>

    <section class="estadisticas-graficas">
      <h3>📊 Charlas por Mes (<?= date('Y') ?>)</h3>
      <canvas id="graficoCharlas" width="600" height="250"></canvas>
    </section>

    <div class="alerta">
      <i class="fas fa-bell"></i>
      <?= $prox_charla ? "Tienes una charla el " . $prox_charla['fecha'] . " a las " . substr($prox_charla['hora_inicio'], 0, 5) : "Sin charlas programadas" ?>
    </div>

    <section class="charlas">
      <h3>Charlas Próximas</h3>
      <?php if ($proximas_charlas instanceof mysqli_result): ?>
        <?php while ($charla = $proximas_charlas->fetch_assoc()): ?>
          <div class="charla-box">
            <h4><?= htmlspecialchars($charla['titulo']) ?></h4>
            <p><strong>Fecha:</strong> <?= $charla['fecha'] ?></p>
            <p><strong>Hora:</strong> <?= substr($charla['hora_inicio'], 0, 5) ?></p>
            <p><strong>Cupo Máximo:</strong> <?= htmlspecialchars($charla['cupo_maximo']) ?></p>
            <a class="ver-detalles" href="detalle-charla.php?id=<?= $charla['id'] ?>">Ver Detalles</a>
          </div>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No hay charlas próximas.</p>
      <?php endif; ?>
    </section>

    <section class="perfil">
      <h3>Datos del Perfil</h3>
      <p><strong>Nombre:</strong> <?= htmlspecialchars($perfil['nombre'] ?? '-') ?></p>
      <p><strong>Correo:</strong> <?= htmlspecialchars($correo) ?></p>
      <p><strong>Teléfono:</strong> <?= htmlspecialchars($perfil['telefono'] ?? '-') ?></p>
    </section>

    <section class="recordatorio">
      <h3><i class="fas fa-bullhorn"></i> Recordatorio</h3>
      <p>No olvides actualizar tu perfil si cambias de número o correo institucional.</p>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const datosCharlas = <?= json_encode(array_values($charlas_por_mes)) ?>;
    const etiquetas = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];

    const ctx = document.getElementById('graficoCharlas').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: etiquetas,
        datasets: [{
          label: 'Charlas impartidas',
          data: datosCharlas,
          backgroundColor: '#6b3fa0'
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: { display: false },
          title: { display: true, text: 'Charlas por mes' }
        },
        scales: {
          y: {
            beginAtZero: true,
            precision: 0,
            stepSize: 1
          }
        }
      }
    });
  </script>
</body>
</html>
