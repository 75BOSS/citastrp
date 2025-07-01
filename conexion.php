<?php
$host = "localhost";
$usuario = "u240362798_reservas1";
$contrasena = "Lap2incasablanca";
$base_datos = "u240362798_reservas";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
