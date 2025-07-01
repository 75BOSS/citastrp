<?php
session_start();
require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST["correo"] ?? '';
    $clave = $_POST["contraseña"] ?? '';

    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ? AND activo = 1");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($usuario = $resultado->fetch_assoc()) {
        if ($usuario["contraseña"] === $clave) {
            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["rol"] = $usuario["rol"];
            $_SESSION["correo"] = $usuario["correo"];

            if ($usuario["rol"] === "psicologo") {
                header("Location: index-psicologo.php");
            } elseif ($usuario["rol"] === "paciente") {
                header("Location: mi-cuenta.php");
            } else {
                echo "<script>alert('Rol desconocido'); window.location.href='login.php';</script>";
            }
            exit;
        } else {
            echo "<script>alert('Contraseña incorrecta'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado'); window.location.href='login.php';</script>";
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Acceso no permitido.";
}
?>
