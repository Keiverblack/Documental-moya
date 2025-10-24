<?php
session_start();

$conexion = new mysqli("localhost", "root", "", "registro_db");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_usuario'])) {
    $id = intval($_POST['id_usuario']);

    // 1️⃣ OBTENER NOMBRE DEL USUARIO ANTES DE ELIMINAR
    $query_nombre = "SELECT nombre FROM usuarios WHERE id = $id";
    $resultado_nombre = $conexion->query($query_nombre);

    if ($resultado_nombre && $resultado_nombre->num_rows > 0) {
        $usuario = $resultado_nombre->fetch_assoc();
        $nombre_usuario = $usuario['nombre'];
    } else {
        $nombre_usuario = "desconocido";
    }

    // 2️⃣ ELIMINAR USUARIO
    $sql = "DELETE FROM usuarios WHERE id = $id";
    $resultado = $conexion->query($sql);

    // 3️⃣ MENSAJE PERSONALIZADO
    if ($resultado) {
        $_SESSION['alerta_admin'] = "Usuario de ID '" . htmlspecialchars($id) . "' eliminado correctamente.";
        $_SESSION['tipo_alerta_admin'] = "exito";
    } else {
        $_SESSION['alerta_admin'] = "Error al eliminar al usuario <strong>" . htmlspecialchars($nombre_usuario) . "</strong>.";
        $_SESSION['tipo_alerta_admin'] = "error";
    }

    header("Location: admin_panel.php");
    exit;
}
?>
