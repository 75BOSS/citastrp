<?php
require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST["nombre"] ?? '';
    $correo = $_POST["correo"] ?? '';
    $contraseña = $_POST["contraseña"] ?? '';
    $cedula = $_POST["cedula"] ?? '';
    $telefono = $_POST["telefono"] ?? '';
    $codigo_estudiante = $_POST["codigo_estudiante"] ?? '';
    $rol = $_POST["rol"] ?? 'paciente'; // por defecto

    $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, contraseña, rol, cedula, telefono, codigo_estudiante) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nombre, $correo, $contraseña, $rol, $cedula, $telefono, $codigo_estudiante);

    if ($stmt->execute()) {
        echo "<script>alert('Registro exitoso. Ahora puedes iniciar sesión.'); window.location.href='login.php';</script>";
    } else {
        echo "<script>alert('Error al registrar.'); window.history.back();</script>";
    }

    $stmt->close();
    $conexion->close();
}
?>
