<?php
$host = "localhost"; // Cambiar a "mysql.hostinger.com" si no funciona
$user = "u240362798_reservas1";
$pass = "Lap2incasablanca";
$db = "u240362798_reservas";

$conexion = new mysqli($host, $user, $pass, $db);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
