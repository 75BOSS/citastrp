<?php
session_start();
if (!isset($_SESSION["usuario"]) || $_SESSION["rol"] !== "paciente") {
  header("Location: ../login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi Cuenta - Psicovínculo</title>
  <link rel="stylesheet" href="../css/mi_cuenta.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
  <header class="header">
    <nav class="navbar">
      <div class="logo">
        <a href="index_paciente.php" class="logo-link">
          <img src="../imagen/logo.png" alt="Psicovínculo" width="40">
        </a>
        <span>Psicovínculo</span>
      </div>
      <ul class="menu">
        <li><a href="index_paciente.php">Inicio</a></li>
        <li><a href="../test.php">Tests</a></li>
        <li><a href="../servicios.php">Servicios</a></li>
        <li><a href="../eventos.php">Eventos</a></li>
        <li><a href="../contacto.php">Contacto</a></li>
      </ul>
      <div class="auth-buttons">
        <a class="btn-outline btn" href="../logout.php">Cerrar Sesión</a>
      </div>
    </nav>
  </header>

  <main class="panel-container">
    <!-- Panel Lateral -->
    <aside class="panel-menu">
      <h2>Mi Cuenta</h2>
      <ul>
        <li><a href="#" class="active" onclick="mostrarPanel('perfil')">Perfil</a></li>
        <li><a href="#" onclick="mostrarPanel('citas')">Historial de Citas</a></li>
        <li><a href="#" onclick="mostrarPanel('configuracion')">Configuración</a></li>
        <li><a href="#" onclick="mostrarPanel('documentos')">Documentos</a></li>
        <li><a href="#" onclick="mostrarPanel('notificaciones')">Notificaciones</a></li>
      </ul>
    </aside>

    <!-- Contenido Principal -->
    <section class="panel-content">
      <!-- Perfil -->
      <div id="perfil" class="panel-section active">
        <h3>Datos del Usuario</h3>
        <div class="datos-usuario">
          <p><span>Nombre:</span> Cristian</p>
          <p><span>Correo:</span> correo@prueba.com</p>
          <p><span>Rol:</span> Paciente</p>
          <p><span>Estado:</span> Activa</p>
        </div>
      </div>

      <!-- Historial de Citas -->
      <div id="citas" class="panel-section">
        <h3>Historial de Citas</h3>
        <div class="citas-tabs">
          <button onclick="mostrarCitas('pasadas')" class="active">Citas Pasadas</button>
          <button onclick="mostrarCitas('futuras')">Citas Futuras</button>
        </div>
        <div id="pasadas" class="tabla-citas">
          <table>
            <thead>
              <tr><th>Fecha</th><th>Hora</th><th>Psicólogo</th><th>Estado</th></tr>
            </thead>
            <tbody>
              <tr><td>12/05/2024</td><td>10:00 AM</td><td>Dra. Lucía Torres</td><td class="estado">Completada</td></tr>
            </tbody>
          </table>
        </div>
        <div id="futuras" class="tabla-citas" style="display:none">
          <table>
            <thead>
              <tr><th>Fecha</th><th>Hora</th><th>Psicólogo</th><th>Estado</th></tr>
            </thead>
            <tbody>
              <tr><td>15/07/2025</td><td>03:00 PM</td><td>Lic. Marco Paredes</td><td class="estado">Confirmada</td></tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Configuración -->
      <div id="configuracion" class="panel-section">
        <h3>Configuración de Cuenta</h3>
        <div class="configuracion">
          <label>Correo:</label>
          <input type="email" value="correo@prueba.com" disabled>
          <label>Contraseña:</label>
          <input type="password" value="12345" disabled>
        </div>
      </div>

      <!-- Documentos -->
      <div id="documentos" class="panel-section">
        <h3>Documentos / Recetas</h3>
        <ul>
          <li><a href="#">Informe emocional - mayo 2024 (PDF)</a></li>
          <li><a href="#">Recomendaciones de terapia (PDF)</a></li>
        </ul>
      </div>

      <!-- Notificaciones -->
      <div id="notificaciones" class="panel-section notificaciones">
        <h3>Notificaciones</h3>
        <p>Tienes una cita confirmada para el 15/07/2025 a las 3:00 PM.</p>
      </div>
    </section>
  </main>

  <script>
    function mostrarPanel(id) {
      const secciones = document.querySelectorAll('.panel-section');
      secciones.forEach(sec => sec.classList.remove('active'));
      document.getElementById(id).classList.add('active');

      const links = document.querySelectorAll('.panel-menu a');
      links.forEach(link => link.classList.remove('active'));
      event.target.classList.add('active');
    }

    function mostrarCitas(tipo) {
      document.getElementById('pasadas').style.display = tipo === 'pasadas' ? 'table' : 'none';
      document.getElementById('futuras').style.display = tipo === 'futuras' ? 'table' : 'none';

      const botones = document.querySelectorAll('.citas-tabs button');
      botones.forEach(btn => btn.classList.remove('active'));
      event.target.classList.add('active');
    }
  </script>
</body>

</html>
