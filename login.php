<?php
session_start();
include 'conexion.php';

// LOGIN
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["correo"]) && isset($_POST["contraseña"]) && isset($_POST["accion"]) && $_POST["accion"] === "login") {
    $correo = $_POST["correo"] ?? '';
    $contraseña = $_POST["contraseña"] ?? '';

    if ($correo && $contraseña) {
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ? AND activo = 1");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();
            if (password_verify($contraseña, $usuario['contraseña'])) {
                $_SESSION["usuario"] = $usuario["correo"];
                $_SESSION["rol"] = $usuario["rol"];

                if ($usuario["rol"] === "paciente") {
                    header("Location: paciente/index_paciente.php");
                } elseif ($usuario["rol"] === "psicologo") {
                    header("Location: psicologo1/index_psicolog.html");
                } elseif ($usuario["rol"] === "admin") {
                    header("Location: ADMIN/index.php");
                } else {
                    echo "<script>alert('Rol no válido'); window.location.href='login.php';</script>";
                }
                exit();
            }
        }
        echo "<script>alert('Credenciales incorrectas'); window.location.href='login.php';</script>";
        exit();
    }
}

// REGISTRO
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["accion"]) && $_POST["accion"] === "registro") {
    $nombre = $_POST['nombre'] ?? '';
    $correo = $_POST['correo'] ?? '';
    $contraseña = $_POST['contraseña'] ?? '';
    $rol = $_POST['rol'] ?? '';
    $cedula = $_POST['cedula'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $codigo = $_POST['codigo_estudiante'] ?? null;

    if ($nombre && $correo && $contraseña && $rol && $cedula) {
        $hash = password_hash($contraseña, PASSWORD_DEFAULT);
        $stmt = $conexion->prepare("INSERT INTO usuarios (nombre, correo, contraseña, rol, cedula, telefono, codigo_estudiante, activo) VALUES (?, ?, ?, ?, ?, ?, ?, 1)");
        $stmt->bind_param("sssssss", $nombre, $correo, $hash, $rol, $cedula, $telefono, $codigo);
        if ($stmt->execute()) {
            echo "<script>alert('Registro exitoso, ahora puedes iniciar sesión'); window.location.href='login.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error al registrar: " . $stmt->error . "');</script>";
        }
    } else {
        echo "<script>alert('Faltan campos obligatorios');</script>";
    }
}

<footer class="footer">
    <div class="container">
        <div class="footer-info">
            <h4>INFORMACIÓN</h4>
            <p><i class="fas fa-map-marker-alt"></i><a href="https://maps.app.goo.gl/CJ5V1qExnY63Y8Xn7" target="_blank">Av. Isabel La Católica N. 23-52 y Madrid.</a></p>
            <p><i class="fas fa-phone"></i> 0960951729</p>
            <p><i class="fas fa-envelope"></i> fabian.carsola@ups.edu.ec</p>
        </div>

        <div class="footer-social">
            <h4>NUESTRAS REDES SOCIALES</h4>
            <div class="social-media">
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>

        <div class="footer-attention">
            <h4>ATENCIÓN</h4>
            <p>LUNES A VIERNES</p>
            <p>9:00 AM - 17:00 PM</p>
        </div>

        <div class="footer-newsletter">
            <h4>NUESTROS SERVICIOS</h4>
            <p class="hover-levanta">Tratamientos de Depresión</p>
            <p class="hover-levanta">Terapia para Ansiedad</p>
            <p class="hover-levanta">Mejora de Autoestima</p>
            <p class="hover-levanta">Terapia para Parejas</p>
        </div>
    </div>
</footer>
<script src="js/iniciar.js"></script>
</body>
</html>
