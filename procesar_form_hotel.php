<?php
    session_start(); // Inicia la sesión para guardar el mensaje de alerta


// --- CONFIGURACIÓN DE CONEXIÓN (Asegúrate de que sean correctos) ---
    $servidor = "localhost";
    $usuario_db = "root";
    $contrasena_db = "";
    $nombre_db = "registro_db"; 
    // -----------------------------------------------------------------

    $conexion = new mysqli($servidor, $usuario_db, $contrasena_db, $nombre_db);

    if ($conexion->connect_error) {
    // Error grave de conexión, termina la ejecución
    $_SESSION['alerta'] = "Error de conexión con la base de datos.";
    $_SESSION['tipo_alerta'] = 'error';
    header("Location: index.php?accion=registro"); // Redirige a la pestaña de registro
    exit();
    }

    // 1. RECIBIR Y SANITIZAR DATOS
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // 1. OBTENER DATOS DE USUARIO LOGUEADO
        // **Asegúrate de que el usuario esté logueado antes de continuar.**
        if (!isset($_SESSION['usuario_id'])) {
            // Manejo si el usuario no está logueado
            $_SESSION['alerta'] = "Debes iniciar sesión para hacer una reserva.";
            $_SESSION['tipo_alerta'] = 'error';
            header("Location: index.php?accion=login");
            exit();
    }
    
    // Asignamos la variable de sesión al ID para la consulta
    $usuario_id = $_SESSION['usuario_id']; 

    // Consultar nombre y email del usuario logueado
    $stmt_usuario = $conexion->prepare("SELECT nombre, email FROM usuarios WHERE id = ?");
    $stmt_usuario->bind_param("i", $usuario_id);
    $stmt_usuario->execute();
    $stmt_usuario->bind_result($nombre, $email);
    $stmt_usuario->fetch();
    $stmt_usuario->close();

    // Comprobar si se encontraron los datos
    if (!$nombre || !$email) {
        $_SESSION['alerta'] = "Error al obtener datos del usuario.";
        $_SESSION['tipo_alerta'] = 'error';
        header("Location: dashboard.php");
        exit();
    }

    $hotel = htmlspecialchars(trim($_POST['hotel']));
    $pais = htmlspecialchars(trim($_POST['pais']));
    $integrantes = htmlspecialchars(trim($_POST['integrantes']));
    $fecha_de_entrada = htmlspecialchars(trim($_POST['fecha_de_entrada']));
    $fecha_de_salida = htmlspecialchars(trim($_POST['fecha_de_salida']));
    
    // 3. INSERTAR DATOS (Usando Sentencias Preparadas)
    $stmt = $conexion->prepare("INSERT INTO reserva_hotel_db (nombre, email, hotel, pais, integrantes, fecha_de_entrada, fecha_de_salida) 
                                VALUES (?, ?, ?, ?, ?, ?, ?)");

    // 'sssssss' indica que los siete parámetros son strings
    
    $stmt->bind_param("sssssss", $nombre, $email, $hotel, $pais, $integrantes, $fecha_de_entrada, $fecha_de_salida);
    
    // 4. EJECUTAR Y MANEJAR EL RESULTADO
    if ($stmt->execute()) {
        
        // REGISTRO EXITOSO: Establecer la alerta de éxito
        $_SESSION['alerta'] = "¡Ya reservaste el hotel con exito, felicidades.";
        $_SESSION['tipo_alerta'] = 'reserva';
        
        // Redirigir a la pestaña de LOGIN (opuesta al registro)
        header("Location: dashboard.php"); 
        exit;
        
    } else {
        
        // ERROR: Manejar duplicados (por si el email ya existe)
        if ($conexion->errno == 1062) { // 1062 es el código de error para entrada duplicada en clave UNIQUE
            $_SESSION['alerta'] = "El correo electrónico ya está registrado. Intenta iniciar sesión.";
            $_SESSION['tipo_alerta'] = 'error';
            header("Location: index.php?accion=login"); // Redirige a la pestaña de LOGIN
            exit;
        } else {
            // Otros errores
            $_SESSION['alerta'] = "Error al registrar el usuario: " . $stmt->error;
            $_SESSION['tipo_alerta'] = 'error';
            header("Location: index.php?accion=registro");
            exit;
        }
    }

    $stmt->close();
}

$conexion->close();
?>