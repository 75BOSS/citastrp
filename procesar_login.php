<?php
session_start();

// Simulación de login temporal sin conexión a base de datos
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST['correo'] ?? '';
    $pass = $_POST['pass'] ?? '';

    // Verificación hardcodeada
    if ($correo === "correo@prueba.com" && $pass === "12345") {
        $_SESSION['correo'] = $correo;
        $_SESSION['rol'] = 'paciente'; // Asumimos rol paciente
        header("Location: index_paciente.php");
        exit;
    } else {
        echo "<script>alert('Credenciales incorrectas'); window.location.href='login.php';</script>";
        exit;
    }
} else {
    echo "Acceso no permitido";
}
?>
