<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Psicovínculo</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <!-- Barra de navegación -->
    <header class="header">
        <nav class="navbar">
            <div class="logo">
                <a href="index.html" class="logo-link">
                    <img src="imagen/logo.png" class="logo-img" alt="Psicovínculo">
                </a>
                <span>Psicovínculo</span>
            </div>
            <ul class="menu">
                <a href="index.html">Inicio</a>
                <li><a href="#">Tests</a></li>
                <li><a href="#">Servicios</a></li>
                <li><a href="#">Eventos</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
            <div class="auth-buttons">
                <a href="login.php" class="btn-outline btn">Iniciar Sesión</a>
                <a href="registro.php" class="btn-primary btn">Registrarse</a>
            </div>
        </nav>
    </header>

    <!-- Contenedor de registro -->
    <div class="login-container">
        <div class="login-logo">
            <img src="imagen/logo.png" alt="Psicovínculo">
            <h1>Registro</h1>
            <p class="switch-text">¿Ya tienes cuenta? <a href="login.php">Inicia Sesión</a></p>
        </div>

        <!-- Selector de tipo de usuario -->
        <div class="user-type-selector">
            <div class="user-type active" data-type="paciente">Paciente</div>
            <div class="user-type" data-type="psicologo">Psicólogo</div>
        </div>

        <form id="registroForm" action="procesar_registro.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="rol" id="userType" value="paciente">

            <div class="form-group">
                <input type="text" name="nombre" placeholder="Nombre completo" required>
            </div>

            <div class="form-group">
                <input type="email" name="correo" placeholder="Correo electrónico" required>
            </div>

            <div class="form-group">
                <input type="text" name="cedula" placeholder="Número de cédula" required>
            </div>

            <div class="form-group">
                <input type="text" name="telefono" placeholder="Teléfono">
            </div>

            <div class="form-group" id="codigoEstudianteGroup" style="display: none;">
                <input type="text" name="codigo_estudiante" placeholder="Código de estudiante (solo psicólogos)">
            </div>

            <div class="form-group">
                <input type="password" name="contraseña" placeholder="Contraseña" required>
            </div>

            <div class="form-group">
                <label for="foto">Foto de perfil:</label>
                <input type="file" name="foto" accept="image/*">
            </div>

            <button type="submit" class="btn btn-login">Crear cuenta</button>
        </form>
    </div>

    <footer class="footer">
        <p>© 2023 Psicovínculo. Todos los derechos reservados. <a href="#">Términos y condiciones</a> | <a href="#">Política de privacidad</a></p>
    </footer>

    <script>
        // Manejar selección de tipo de usuario
        document.querySelectorAll('.user-type').forEach(type => {
            type.addEventListener('click', function () {
                document.querySelectorAll('.user-type').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                const tipo = this.dataset.type;
                document.getElementById('userType').value = tipo;

                // Mostrar/ocultar campo de código estudiante
                const codigoEstudianteGroup = document.getElementById('codigoEstudianteGroup');
                if (tipo === 'psicologo') {
                    codigoEstudianteGroup.style.display = 'block';
                } else {
                    codigoEstudianteGroup.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>