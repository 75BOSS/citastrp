<?php
session_start();

$usuario = [
  'nombre' => 'Cristian',
  'correo' => 'correo@prueba.com',
  'codigo_estudiante' => '0601061234',
  'telefono' => '0999999999',
  'rol' => 'Paciente',
  'estado' => 'Activo'
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mi Cuenta - Psicovínculo</title>
  <link rel="stylesheet" href="../css/index.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
</head>
<body>
  <?php include("header.php"); ?>

  <main class="main-content">
    <h1 class="titulo">Mi Cuenta</h1>

    <div class="grid-panel">
      <div class="card">
        <i class="fas fa-user-circle"></i>
        <h3>Perfil</h3>
        <p><strong><?php echo $usuario['nombre']; ?></strong></p>
        <p><?php echo $usuario['correo']; ?></p>
        <a href="#" class="btn">Ver perfil</a>
      </div>

      <div class="card">
        <i class="fas fa-calendar-check"></i>
        <h3>Mis Reservas</h3>
        <p>Consulta tus charlas pasadas y futuras.</p>
        <a href="#" class="btn">Ver reservas</a>
      </div>

      <div class="card">
        <i class="fas fa-star"></i>
        <h3>Calificaciones</h3>
        <p>Revisa tus valoraciones dadas.</p>
        <a href="#" class="btn">Ver calificaciones</a>
      </div>

      <div class="card">
        <i class="fas fa-bell"></i>
        <h3>Notificaciones</h3>
        <p>Tienes 2 notificaciones nuevas.</p>
        <a href="#" class="btn">Ver mensajes</a>
      </div>

      <div class="card">
        <i class="fas fa-user-cog"></i>
        <h3>Configuración</h3>
        <p>Cambia tus datos o contraseña.</p>
        <a href="#" class="btn">Configurar</a>
      </div>

      <div class="card">
        <i class="fas fa-sign-out-alt"></i>
        <h3>Salir</h3>
        <p>Cierra tu sesión con seguridad.</p>
        <a href="../logout.php" class="btn">Cerrar sesión</a>
      </div>
    </div>
  </main>

  <?php include("footer.php"); ?>
</body>
</html>
