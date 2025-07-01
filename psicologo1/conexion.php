<?php
$host = "localhost";
$usuario = "root";
$contraseña = ""; // en XAMPP por defecto está vacío
$base_datos = "u240362798_citasTRP";

$conexion = new mysqli($host, $usuario, $contraseña, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");
?>
