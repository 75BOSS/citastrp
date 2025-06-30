<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';
    $rol = $_POST['rol'] ?? 'paciente';
    $cedula = $_POST['cedula'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $codigo_estudiante = ($rol === 'psicologo') ? ($_POST['codigo_estudiante'] ?? '') : null;

    // Validar campos mínimos
    if (empty($nombre) || empty($correo) || empty($contraseña) || empty($cedula)) {
        die("Faltan datos obligatorios.");
    }

    // Verificar si el correo ya está registrado
    $stmt = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        die("El correo ya está registrado.");
    }
    $stmt->close();

    // Guardar imagen (si se subió)
    $foto_ruta = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $directorio = "uploads/";
        if (!file_exists($directorio)) {
            mkdir($directorio, 0755, true);
        }
        $nombre_archivo = uniqid() . "_" . basename($_FILES['foto']['name']);
        $ruta_completa = $directorio . $nombre_archivo;
        move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_completa);
        $foto_ruta = $ruta_completa;
    }

    // Hashear contraseña
    $hash = password_hash($contraseña, PASSWORD_DEFAULT);

    // Insertar en la base de datos
    $sql = "INSERT INTO usuarios (nombre, correo, contraseña, rol, cedula, telefono, codigo_estudiante, foto)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssss", $nombre, $correo, $hash, $rol, $cedula, $telefono, $codigo_estudiante, $foto_ruta);

    if ($stmt->execute()) {
        header("Location: login.php?registro=exitoso");
        exit();
    } else {
        echo "Error al registrar usuario: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
} else {
    echo "Acceso denegado.";
}
?>
