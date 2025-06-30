<?php
session_start();

// Excepción temporal
if ($_POST['correo'] === 'correo@prueba.com' && $_POST['pass'] === '12345') {
    $_SESSION['usuario'] = [
        'nombre' => 'Usuario de Prueba',
        'correo' => 'correo@prueba.com',
        'rol' => 'paciente'
    ];
    header("Location: index_paciente.php");
    exit;
}

require_once("conexion.php");

// Código original después de la excepción (si no se cumple, sigue con lo normal)
$correo = $_POST['correo'];
$pass = $_POST['pass'];

$sql = "SELECT * FROM usuarios WHERE correo = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $correo);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();
    if (password_verify($pass, $usuario['contraseña'])) {
        $_SESSION['usuario'] = $usuario;
        if ($usuario['rol'] === 'paciente') {
            header("Location: index_paciente.php");
        } else {
            header("Location: index.php");
        }
        exit;
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Correo no registrado";
}
?>
