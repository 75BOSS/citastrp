<?php
$host = "localhost"; // Confirmado, Hostinger usa localhost
$usuario = "u240362798_citasTRP";
$contrasena = "glcp.,._2A.";
$base_de_datos = "u240362798_citasTRP";

$conn = new mysqli($host, $usuario, $contrasena, $base_de_datos);

// Verifica la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
