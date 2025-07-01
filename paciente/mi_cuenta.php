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
  <link rel="stylesheet" href="../css/mi_cuenta.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>
  <?php include("header.php"); ?>

  <main class="panel-container">
    <h1 class="titulo">Mi Cuenta</h1>
    <div class="grid-panel">

      <div class="card">
        <i class="fas fa-user-circle icon"></i>
        <h3>Perfil</h3>
        <p><strong>Nombre:</strong> <?= $usuario['nombre']; ?></p>
        <p><strong>Correo:</strong> <?= $usuario['correo']; ?></p>
        <a href="#" class="btn">Ver perfil</a>
      </div>

      <div class="card">
        <i class="fas fa-calendar-check icon"></i>
        <h3>Mis Reservas</h3>
        <p>Consulta tus charlas pasadas y futuras.</p>
        <a href="#" class="btn">Ver reservas</a>
      </div>

      <div class="card">
        <i class="fas fa-star icon"></i>
        <h3>Calificaciones</h3>
        <p>Revisa tus valoraciones dadas.</p>
        <a href="#" class="btn">Ver calificaciones</a>
      </div>

      <div class="card">
        <i class="fas fa-bell icon"></i>
        <h3>Notificaciones</h3>
        <p>Tienes 2 notificaciones nuevas.</p>
        <a href="#" class="btn">Ver mensajes</a>
      </div>

      <div class="card">
        <i class="fas fa-cog icon"></i>
        <h3>Configuración</h3>
        <p>Modifica tu contraseña o datos.</p>
        <a href="#" class="btn">Editar cuenta</a>
      </div>

      <div class="card">
        <i class="fas fa-sign-out-alt icon"></i>
        <h3>Salir</h3>
        <p>Cierra tu sesión con seguridad.</p>
        <a href="../logout.php" class="btn">Cerrar sesión</a>
      </div>

    </div>
  </main>

  <?php include("footer.php"); ?>
</body>
</html>
