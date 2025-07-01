<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_id']) || $_SESSION['rol'] !== 'psicologo') {
    header("Location: login.php");
    exit();
}

$id_psicologo = $_SESSION['usuario_id'];

$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$id_auditorio = $_POST['id_auditorio'];
$fecha = $_POST['fecha'];
$hora_inicio = $_POST['hora_inicio'];
$hora_fin = $_POST['hora_fin'];
$cupo_maximo = $_POST['cupo_maximo'];
$tags = $_POST['tags'] ?? [];

$stmt = $conexion->prepare("INSERT INTO charlas (id_psicologo, titulo, descripcion, fecha, hora_inicio, hora_fin, id_auditorio, cupo_maximo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssssii", $id_psicologo, $titulo, $descripcion, $fecha, $hora_inicio, $hora_fin, $id_auditorio, $cupo_maximo);

if ($stmt->execute()) {
    $id_charla = $conexion->insert_id;

    // Insertar tags
    foreach ($tags as $tag_id) {
        $conexion->query("INSERT INTO charla_tags (id_charla, id_tag) VALUES ($id_charla, $tag_id)");
    }

    header("Location: index-psicologo.php?success=1");
} else {
    echo "Error al crear la charla: " . $stmt->error;
}
?>
