<?php
$host = "localhost"; // Hostinger usa 'localhost' para conexiones internas
$usuario = "u240362798_citasTRP";
$contrasena = "glcp.,._2A.";
$base_datos = "u240362798_citasTRP";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Opcional: establecer charset
$conexion->set_charset("utf8");
?>
