<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'psicologo') {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['usuario_id'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$foto = $_POST['foto'];

$stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, telefono = ?, foto = ? WHERE id = ?");
$stmt->bind_param("sssi", $nombre, $telefono, $foto, $id);

if ($stmt->execute()) {
    header("Location: mi-cuenta.php?actualizado=1");
} else {
    echo "Error al actualizar perfil: " . $stmt->error;
}
?>
