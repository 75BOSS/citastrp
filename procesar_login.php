<?php
session_start();
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';

    if (empty($correo) || empty($contraseña)) {
        die("Debes ingresar tu correo y contraseña.");
    }

    // Buscar el usuario por correo
    $stmt = $conexion->prepare("SELECT id, nombre, contraseña, rol, foto FROM usuarios WHERE correo = ? AND activo = 1");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($contraseña, $usuario['contraseña'])) {
            // Guardar datos en sesión
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'rol' => $usuario['rol'],
                'foto' => $usuario['foto']
            ];

            // Redirigir según el rol
            switch ($usuario['rol']) {
                case 'paciente':
                    header("Location: paciente/index_paciente.php");
                    break;
                case 'psicologo':
                    header("Location: psicologo/index_psicologo.php");
                    break;
                case 'admin':
                    header("Location: admin/index_admin.php");
                    break;
            }
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado o cuenta inactiva.";
    }

    $stmt->close();
    $conex
