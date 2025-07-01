<?php
include '../conexion.php';

$accion = $_GET['accion'] ?? '';

if ($accion === 'listar') {
    $sql = "SELECT id, nombre, correo, rol, cedula, codigo_estudiante, activo FROM usuarios";
    $res = $conexion->query($sql);
    $usuarios = [];
    while ($row = $res->fetch_assoc()) {
        $usuarios[] = $row;
    }
    echo json_encode($usuarios);
    exit;
}

if ($accion === 'cambiar_estado') {
    $id = $_POST['id'];
    $activo = $_POST['activo'];
    $stmt = $conexion->prepare("UPDATE usuarios SET activo = ? WHERE id = ?");
    $stmt->bind_param("ii", $activo, $id);
    echo $stmt->execute() ? 'ok' : 'error';
    exit;
}

if ($accion === 'cambiar_rol') {
    $id = $_POST['id'];
    $rol = $_POST['rol'];
    $stmt = $conexion->prepare("UPDATE usuarios SET rol = ? WHERE id = ?");
    $stmt->bind_param("si", $rol, $id);
    echo $stmt->execute() ? 'ok' : 'error';
    exit;
}

if ($accion === 'eliminar') {
    $id = $_POST['id'];
    $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);
    echo $stmt->execute() ? 'ok' : 'error';
    exit;
}

if ($accion === 'registrar') {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $rol = $_POST['rol'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';
    $cedula = $_POST['cedula'] ?? null;
    $codigo = $_POST['codigo_estudiante'] ?? null;

    if (!$nombre || !$correo || !$rol || !$contraseña) {
        echo 'error: campos vacíos';
        exit;
    }

    $hash = password_hash($contraseña, PASSWORD_DEFAULT);

    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, contraseña, rol, cedula, codigo_estudiante, activo) VALUES (?, ?, ?, ?, ?, ?, 1)");
    $stmt->bind_param("ssssss", $nombre, $correo, $hash, $rol, $cedula, $codigo);
    echo $stmt->execute() ? 'ok' : 'error';
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Usuarios</title>
  <link rel="stylesheet" href="css/usuarios.css">
</head>
<body>
  <header class="encabezado">
    <a href="index.php">
      <img src="imagen/logo.png" alt="Logo" class="logo">
    </a>
    <h1>Gestión de Usuarios</h1>
  </header>

  <form id="formRegistro">
    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <input type="email" name="correo" placeholder="Correo" required>
    <input type="password" name="contraseña" placeholder="Contraseña" required>
    <select name="rol" id="rolSelect" required>
      <option value="">Selecciona Rol</option>
      <option value="paciente">Paciente</option>
      <option value="psicologo">Psicólogo</option>
    </select>
    <input type="text" name="cedula" id="inputCedula" placeholder="Cédula" style="display:none">
    <input type="text" name="codigo_estudiante" id="inputCodigo" placeholder="Código Estudiante" style="display:none">
    <button type="submit">Registrar Usuario</button>
  </form>

  <input type="text" id="busqueda" placeholder="🔍 Buscar por nombre...">

  <table id="tablaUsuarios">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Rol</th>
        <th>Cédula / Código</th>
        <th>Estado</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody></tbody>
  </table>

<script>
document.addEventListener('DOMContentLoaded', () => {
  cargarUsuarios();

  document.getElementById('rolSelect').addEventListener('change', e => {
    const rol = e.target.value;
    document.getElementById('inputCedula').style.display = rol === 'paciente' ? 'inline-block' : 'none';
    document.getElementById('inputCodigo').style.display = rol === 'psicologo' ? 'inline-block' : 'none';
  });

  document.getElementById('formRegistro').addEventListener('submit', e => {
    e.preventDefault();
    const datos = new FormData(e.target);

    fetch('usuarios.php?accion=registrar', {
      method: 'POST',
      body: datos
    })
    .then(res => res.text())
    .then(r => {
      if (r.trim() === 'ok') {
        alert('Registrado con éxito');
        e.target.reset();
        cargarUsuarios();
      } else {
        alert('Error al registrar: ' + r);
      }
    });
  });

  document.getElementById('busqueda').addEventListener('input', () => {
    const texto = document.getElementById('busqueda').value.toLowerCase();
    document.querySelectorAll('#tablaUsuarios tbody tr').forEach(fila => {
      const nombre = fila.children[1].textContent.toLowerCase();
      fila.style.display = nombre.includes(texto) ? '' : 'none';
    });
  });
});

function cargarUsuarios() {
  fetch('usuarios.php?accion=listar')
    .then(res => res.json())
    .then(data => {
      const tbody = document.querySelector('#tablaUsuarios tbody');
      tbody.innerHTML = '';
      data.forEach(u => {
        const fila = document.createElement('tr');
        fila.innerHTML = `
          <td>${u.id}</td>
          <td>${u.nombre}</td>
          <td>${u.correo}</td>
          <td>
            <select onchange="cambiarRol(${u.id}, this.value)">
              <option value="paciente" ${u.rol === 'paciente' ? 'selected' : ''}>Paciente</option>
              <option value="psicologo" ${u.rol === 'psicologo' ? 'selected' : ''}>Psicólogo</option>
              <option value="admin" ${u.rol === 'admin' ? 'selected' : ''}>Admin</option>
            </select>
          </td>
          <td>${u.rol === 'paciente' ? (u.cedula ?? '-') : (u.codigo_estudiante ?? '-')}</td>
          <td>${u.activo == 1 ? 'Activo' : 'Inactivo'}</td>
          <td>
            <button onclick="toggleActivo(${u.id}, ${u.activo == 1 ? 0 : 1})">
              ${u.activo == 1 ? 'Desactivar' : 'Activar'}
            </button>
            <button onclick="eliminarUsuario(${u.id})" style="background-color: crimson; color: white;">
              Eliminar
            </button>
          </td>
        `;
        tbody.appendChild(fila);
      });
    });
}

function toggleActivo(id, estadoNuevo) {
  const datos = new FormData();
  datos.append('id', id);
  datos.append('activo', estadoNuevo);

  fetch('usuarios.php?accion=cambiar_estado', {
    method: 'POST',
    body: datos
  }).then(res => res.text())
    .then(r => {
      if (r === 'ok') cargarUsuarios();
      else alert('Error al cambiar estado');
    });
}

function cambiarRol(id, nuevoRol) {
  const datos = new FormData();
  datos.append('id', id);
  datos.append('rol', nuevoRol);

  fetch('usuarios.php?accion=cambiar_rol', {
    method: 'POST',
    body: datos
  }).then(res => res.text())
    .then(r => {
      if (r !== 'ok') alert('Error al cambiar rol');
    });
}

function eliminarUsuario(id) {
  if (!confirm("¿Estás seguro de eliminar este usuario?")) return;

  const datos = new FormData();
  datos.append('id', id);

  fetch('usuarios.php?accion=eliminar', {
    method: 'POST',
    body: datos
  }).then(res => res.text())
    .then(r => {
      if (r === 'ok') cargarUsuarios();
      else alert('Error al eliminar usuario');
    });
}
</script>
</body>
</html>