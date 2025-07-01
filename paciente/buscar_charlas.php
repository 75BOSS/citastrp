<?php
session_start();
include '../conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Buscar Charlas - Psicovínculo</title>
  <link rel="stylesheet" href="../css/index.css">
  <style>
    .auditorio-section {
      background-color: #5c2d91;
      padding: 40px 20px;
      min-height: 400px;
    }

    .auditorio-section select {
      padding: 10px 15px;
      font-size: 1rem;
      border-radius: 6px;
      border: 2px solid #333;
      background-color: white;
      color: #333;
      font-family: 'Segoe UI', sans-serif;
      margin-bottom: 30px;
    }

    .horario-container {
      background-color: white;
      margin: 0 auto;
      padding: 30px;
      max-width: 80%;
      min-height: 300px;
      border: 2px solid #333;
      border-radius: 8px;
    }
  </style>
</head>
<body>
<?php include 'header.php'; ?>

<section class="auditorio-section">
  <form method="GET" style="text-align: center;">
    <select name="auditorio" onchange="this.form.submit()" required>
      <option value="">Seleccione el auditorio</option>
      <option value="auditorio_1">Auditorio 1</option>
      <option value="auditorio_2">Auditorio 2</option>
      <option value="auditorio_3">Auditorio 3</option>
    </select>
  </form>

  <div class="horario-container">
    <?php
    if (isset($_GET["auditorio"])) {
      $auditorio = $_GET["auditorio"];
      echo "<h3>Horario del {$auditorio}</h3>";
      echo "<p>— Aquí se mostrará la información del horario de forma dinámica.</p>";
      // Aquí podrías usar una consulta a la base de datos para mostrar datos reales
    } else {
      echo "<p style='text-align: center;'>Seleccione un auditorio para ver su horario disponible.</p>";
    }
    ?>
  </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>
