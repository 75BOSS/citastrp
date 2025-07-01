<?php
include '../conexion.php';

$accion = $_GET['accion'] ?? '';

if ($accion === 'listar' || $accion === 'filtrar') {
    header('Content-Type: application/json');
    $datos = [];

    if ($accion === 'listar') {
        $sql = "SELECT 
                    c.titulo,
                    c.descripcion,
                    c.fecha,
                    c.hora_inicio,
                    c.hora_fin,
                    c.cupo_maximo,
                    u.nombre AS psicologo,
                    a.nombre AS auditorio
                FROM charlas c
                INNER JOIN usuarios u ON c.id_psicologo = u.id
                INNER JOIN auditorios a ON c.id_auditorio = a.id
                ORDER BY c.fecha DESC";

        $res = $conexion->query($sql);
        while ($row = $res->fetch_assoc()) {
            $datos[] = $row;
        }
    }

    if ($accion === 'filtrar') {
        $desde = $_GET['desde'] ?? '';
        $hasta = $_GET['hasta'] ?? '';
        if (!$desde || !$hasta) {
            echo json_encode([]);
            exit;
        }

        $sql = "SELECT 
                    c.titulo,
                    c.descripcion,
                    c.fecha,
                    c.hora_inicio,
                    c.hora_fin,
                    c.cupo_maximo,
                    u.nombre AS psicologo,
                    a.nombre AS auditorio
                FROM charlas c
                INNER JOIN usuarios u ON c.id_psicologo = u.id
                INNER JOIN auditorios a ON c.id_auditorio = a.id
                WHERE c.fecha BETWEEN ? AND ?
                ORDER BY c.fecha DESC";

        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ss", $desde, $hasta);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $datos[] = $row;
        }
    }

    echo json_encode($datos);
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Charlas Disponibles</title>
  <link rel="stylesheet" href="css/charlas.css">
</head>
<body>
  <header class="encabezado">
    <a href="index.php">
      <img src="imagen/logo.png" alt="Logo Psicovínculo" class="logo">
    </a>
    <h1>Charlas Disponibles</h1>
  </header>

  <section class="filtros">
    <label>Desde: <input type="date" id="fechaInicio"></label>
    <label>Hasta: <input type="date" id="fechaFin"></label>
    <button onclick="filtrarPorFechas()">Filtrar</button>
    <button onclick="cargarCharlas()">Mostrar Todo</button>
  </section>

  <table>
    <thead>
      <tr>
        <th>Título</th>
        <th>Psicólogo</th>
        <th>Descripción</th>
        <th>Fecha</th>
        <th>Hora Inicio</th>
        <th>Hora Fin</th>
        <th>Auditorio</th>
        <th>Cupo Máximo</th>
      </tr>
    </thead>
    <tbody id="tablaCharlas"></tbody>
  </table>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      cargarCharlas();
    });

    function cargarCharlas() {
      fetch('charlas.php?accion=listar')
        .then(res => res.json())
        .then(renderizarCharlas);
    }

    function filtrarPorFechas() {
      const inicio = document.getElementById('fechaInicio').value;
      const fin = document.getElementById('fechaFin').value;

      fetch(`charlas.php?accion=filtrar&desde=${inicio}&hasta=${fin}`)
        .then(res => res.json())
        .then(renderizarCharlas);
    }

    function renderizarCharlas(data) {
      const tbody = document.getElementById('tablaCharlas');
      tbody.innerHTML = '';
      data.forEach(c => {
        const fila = document.createElement('tr');
        fila.innerHTML = `
          <td>${c.titulo}</td>
          <td>${c.psicologo}</td>
          <td>${c.descripcion}</td>
          <td>${c.fecha}</td>
          <td>${c.hora_inicio}</td>
          <td>${c.hora_fin}</td>
          <td>${c.auditorio}</td>
          <td>${c.cupo_maximo}</td>
        `;
        tbody.appendChild(fila);
      });
    }
  </script>
</body>
</html>