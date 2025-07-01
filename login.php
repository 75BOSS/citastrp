<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
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
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión - Psicovínculo</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
<header class="header">
    <nav class="navbar">
        <div class="logo">
            <a href="index.html" class="logo-link">
                <img src="imagen/logo.png" class="logo-psicovinculo" alt="Psicovínculo">
            </a>
            <span>Psicovínculo</span>
        </div>
        <ul class="menu">
            <li><a href="index.html">Inicio</a></li>
            <li><a href="test.html">Tests</a></li>
            <li><a href="servicios.html">Servicios</a></li>
            <li><a href="eventos.html">Eventos</a></li>
            <li><a href="contacto.html">Contacto</a></li>
        </ul>
        <div class="auth-buttons">
            <a class="btn-outline btn" href="login.php">Reservar Cita</a>
            <a class="btn-primary btn" href="login.php">Iniciar Sesión</a>
        </div>
    </nav>
</header>

<div id="tservicios" class="contenedor">
    <div class="contenedor__todo">
        <div class="caja__trasera">
            <div class="caja__trasera-login">
                <h3>¿Ya tienes una cuenta?</h3>
                <p>Inicia sesión para entrar en la página</p>
                <button id="btn__iniciar-sesion">Iniciar Sesión</button>
            </div>
            <div class="caja__trasera-register">
                <h3>¿Aún no tienes una cuenta?</h3>
                <p>Regístrate para que puedas iniciar sesión</p>
                <button id="btn__registrarse">Regístrarse</button>
            </div>
        </div>
        <div class="contenedor__login-register">
            <!--Formulario de Login-->
            <form action="login.php" method="POST" class="formulario__login">
                <h2>Iniciar Sesión</h2>
                <input type="text" placeholder="Correo Electrónico" name="correo" required>
                <input type="password" placeholder="Contraseña" name="contraseña" required>
                <button>Entrar</button>
            </form>
            <!--Formulario de Registro (NO FUNCIONAL EN ESTE ARCHIVO)-->
            <form action="registro.php" method="POST" class="formulario__register">
                <h2>Registrarse</h2>
                <input type="text" placeholder="Nombre completo" name="nombre" required>
                <input type="email" placeholder="Correo Electrónico" name="correo" required>
                <input type="password" placeholder="Contraseña" name="contraseña" required>
                <input type="text" placeholder="Cédula" name="cedula" required>
                <input type="text" placeholder="Teléfono (opcional)" name="telefono">
                <select name="rol" required>
                    <option value="">Selecciona un rol</option>
                    <option value="paciente">Paciente</option>
                    <option value="psicologo">Psicólogo</option>
                </select>
                <input type="text" placeholder="Código estudiante (si aplica)" name="codigo_estudiante">
                <button type="submit">Registrarse</button>
            </form>
        </div>
    </div>
</div>

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
