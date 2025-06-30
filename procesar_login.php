<?php
session_start();

// Verificación directa sin base de datos
$correo = $_POST['correo'] ?? '';
$pass = $_POST['pass'] ?? '';

if ($correo === 'correo@prueba.com' && $pass === '12345') {
    $_SESSION['usuario'] = [
        'nombre' => 'Usuario de Prueba',
        'correo' => $correo,
        'rol' => 'paciente'
    ];
    header("Location: index_paciente.php");
    exit;
} else {
    echo "<script>
        alert('Credenciales incorrectas');
        window.location.href = 'login.php';
    </script>";
    exit;
}
?>
