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
          <img src="../imagen/logo.png" alt="Psicovínculo">
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

  <main class="cuenta-container">
    <section class="perfil">
      <img src="../imagen/usuario.png" alt="Foto de perfil">
      <h2>Bienvenido, Cristian</h2>
      <p><strong>Correo:</strong> correo@prueba.com</p>
      <p><strong>Rol:</strong> Paciente</p>
      <p><strong>Estado:</strong> Activa</p>
    </section>

    <section class="historial">
      <h3>Historial de Citas</h3>
      <div class="selector">
        <button onclick="mostrar('pasadas')">Citas Pasadas</button>
        <button onclick="mostrar('futuras')">Citas Futuras</button>
      </div>
      <div id="pasadas" class="citas">
        <h4>Citas Pasadas</h4>
        <ul>
          <li>
            <strong>Fecha:</strong> 12/05/2024<br>
            <strong>Hora:</strong> 10:00 AM<br>
            <strong>Psicólogo:</strong> Dra. Lucía Torres<br>
            <strong>Estado:</strong> Completada
          </li>
        </ul>
      </div>
      <div id="futuras" class="citas hidden">
        <h4>Citas Futuras</h4>
        <ul>
          <li>
            <strong>Fecha:</strong> 15/07/2025<br>
            <strong>Hora:</strong> 03:00 PM<br>
            <strong>Psicólogo:</strong> Lic. Marco Paredes<br>
            <strong>Estado:</strong> Confirmada
          </li>
        </ul>
      </div>
    </section>

    <section class="config">
      <h3>Configuración de Cuenta</h3>
      <ul>
        <li><a href="#">Editar información personal</a></li>
        <li><a href="#">Cambiar contraseña</a></li>
        <li><a href="#">Actualizar foto de perfil</a></li>
      </ul>
    </section>

    <section class="documentos">
      <h3>Documentos / Recetas</h3>
      <ul>
        <li><a href="#">Informe emocional - mayo 2024 (PDF)</a></li>
        <li><a href="#">Recomendaciones de terapia (PDF)</a></li>
      </ul>
    </section>

    <section class="mensajes">
      <h3>Notificaciones</h3>
      <p>Tienes una cita confirmada para el 15/07/2025 a las 3:00 PM.</p>
    </section>
  </main>

  <script>
    function mostrar(tipo) {
      document.getElementById('pasadas').classList.add('hidden');
      document.getElementById('futuras').classList.add('hidden');
      document.getElementById(tipo).classList.remove('hidden');
    }
  </script>
</body>

</html>
