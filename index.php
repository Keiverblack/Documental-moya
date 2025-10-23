<?php
session_start(); // Siempre al inicio para usar sesiones

// Determina qué formulario mostrar por defecto
$mostrar_registro = isset($_POST['accion']) && $_POST['accion'] === 'registro';

// Recupera y limpia el mensaje de alerta de la sesión
$mensaje = '';
$tipo_alerta = '';
if (isset($_SESSION['alerta'])) {
    $mensaje = $_SESSION['alerta'];
    $tipo_alerta = $_SESSION['tipo_alerta'] ?? 'exito';
    // Limpia las variables para que el mensaje no se muestre al recargar
    unset($_SESSION['alerta']);
    unset($_SESSION['tipo_alerta']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso y Registros</title>
    <link rel="stylesheet" href="css/style_index.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/cf1fb60fea.js" crossorigin="anonymous"></script>
</head>
<body>
    <header class="main-header">
        <div class="logo">
            <img src="img/IUJO.png" alt="Logo" height="40">
            <h2>Samuel Cubano & Keiver Blanco</h2>
        </div>
    </header>

    <div class="contenedor-formulario">
        
        <div class="opciones-formulario">
            <button onclick="mostrarFormulario('login')" id="btn-login">Iniciar Sesión</button>
            <button onclick="mostrarFormulario('registro')" id="btn-registro">Registrarse</button>
        </div>

        <?php if ($mensaje): ?>
            <div class="alerta-mensaje <?php echo $tipo_alerta; ?>">
                <?php echo htmlspecialchars($mensaje); ?>
            </div>
        <?php endif; ?>

        <form action="procesar_login.php" method="POST" id="form-login" style="display: <?php echo $mostrar_registro ? 'none' : 'block'; ?>">
            <h1>Iniciar Sesión</h1>
            <label for="email_login">Correo Electrónico:</label>
            <input type="email" id="email_login" name="email" required>
            <br>
            <label for="contrasena_login">Contraseña:</label>
            <input type="password" id="contrasena_login" name="contrasena" required>
            <br>
            <button type="submit">Entrar</button>
        </form>

        <form action="procesar_registro.php" method="POST" id="form-registro" style="display: <?php echo $mostrar_registro ? 'block' : 'none'; ?>">
            <h1>Registrarse</h1>
            <label for="nombre_registro">Nombre Completo:</label>
            <input type="text" id="nombre_registro" name="nombre" required>

            <label for="email_registro">Correo Electrónico:</label>
            <input type="email" id="email_registro" name="email" required>

            <label for="contrasena_registro">Contraseña:</label>
            <input type="password" id="contrasena_registro" name="contrasena" required>

            <button type="submit">Crear Cuenta</button>
        </form>
    </div>

    <footer class="main-footer">
        <p>© <?php echo date("Y"); ?> Samuel Cubano CI: 32935820 & Keiver Blanco CI:</p>
        <a href="https://github.com/SamuelCubano/Tarea-de-Login-y-Registro" target="_blank"><i class="fa-brands fa-github"></i></a>
    </footer>

    <script>
        function mostrarFormulario(tipo) {
            const isLogin = tipo === 'login';
            document.getElementById('form-login').style.display = isLogin ? 'block' : 'none';
            document.getElementById('btn-login').classList.toggle('activo', isLogin);
            
            document.getElementById('form-registro').style.display = isLogin ? 'none' : 'block';
            document.getElementById('btn-registro').classList.toggle('activo', !isLogin);
        }
        // Inicializa el estado activo del botón al cargar
        document.addEventListener('DOMContentLoaded', function() {
            mostrarFormulario('<?php echo $mostrar_registro ? 'registro' : 'login'; ?>');
        });
    </script>
</body>
</html>