<?php
session_start();

// 1. Verificación de Administrador
if (!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] !== TRUE) {
    header("Location: index.php"); // Si no es admin, lo redirige
    exit;
}

// --- CONFIGURACIÓN DE CONEXIÓN ---
$servidor = "localhost";
$usuario_db = "root";
$contrasena_db = "";
$nombre_db = "registro_db"; 
// ---------------------------------

// --- ESTO FUE LO QUE NOS DIJO MOYA PARA USARLO EN EL ADMIN_PANEL.PHP ---
$conexion = new mysqli($servidor, $usuario_db, $contrasena_db, $nombre_db);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// 2. DE ACÁ OBTENEMOS LOS USUARIOS PARA MOSTRARLOS EN LA TABLA
$usuarios = [];
$consulta_usuarios = "SELECT id, nombre, email, fecha_registro FROM usuarios ORDER BY id DESC";
$resultado = $conexion->query($consulta_usuarios);

if ($resultado->num_rows > 0) {
    while($fila = $resultado->fetch_assoc()) {
        $usuarios[] = $fila;
    }
}

// ESTO ES PARA MOSTRAR MENSAJES DE ALERTA
$mensaje = '';
$tipo_alerta = '';
if (isset($_SESSION['alerta_admin'])) {
    $mensaje = $_SESSION['alerta_admin'];
    $tipo_alerta = $_SESSION['tipo_alerta_admin'] ?? 'exito';
    unset($_SESSION['alerta_admin']);
    unset($_SESSION['tipo_alerta_admin']);
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administrador</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style_admin.css">
        <script src="https://kit.fontawesome.com/cf1fb60fea.js" crossorigin="anonymous"></script>

</head>
<header class="main-header">
        <div class="logo">
            <img src="img/IUJO.png" alt="Logo" height="40">
            <h2>Samuel Cubano & Keiver Blanco</h2>
            <h4><i class="fa-solid fa-user-secret"></i> Admin</h4>
            <a href="logout.php" class="btn-logout">Cerrar Sesión</a>
        </div>
</header>
<body>
        <div class="contenedor">
            <h1>Panel de Administrador</h1>

            <?php if ($mensaje): ?>
                <div class="alerta-mensaje <?php echo $tipo_alerta; ?>">
                    <?php echo htmlspecialchars($mensaje); ?>
                </div>
            <?php endif; ?>

            <h2>Tabla de Usuarios Registrados</h2>
            
            <?php if (!empty($usuarios)): ?>
            
            <div class="tabla-scroll-contenedor">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo Electrónico</th>
                            <th>Fecha de Registro</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($usuario['id']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['email']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['fecha_registro']); ?></td>
                            <td>
                                <button class="btn-editar" 
                                        onclick="abrirModal(
                                            <?php echo $usuario['id']; ?>, 
                                            '<?php echo htmlspecialchars(addslashes($usuario['nombre'])); ?>', 
                                            '<?php echo htmlspecialchars(addslashes($usuario['email'])); ?>'
                                        )">
                                    Editar
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php else: ?>
                <p>No hay usuarios registrados.</p>
            <?php endif; ?>

        <div id="modal-edicion" class="modal">
            <div class="modal-contenido">
                <span class="cerrar" onclick="cerrarModal()">&times;</span>
                <h2>Editar Usuario</h2>
                <form action="procesar_edicion.php" method="POST">
                    <input type="hidden" id="edit-id" name="id">

                    <label for="edit-nombre">Nombre:</label>
                    <input type="text" id="edit-nombre" name="nombre" required>

                    <label for="edit-email">Correo Electrónico:</label>
                    <input type="email" id="edit-email" name="email" required>

                    <button type="submit" name="accion" value="editar">Guardar Cambios</button>
                </form>
            </div>
        </div></div>

    <footer class="main-footer">
        <p>© <?php echo date("Y"); ?> Samuel Cubano CI: 32935820 & Keiver Blanco CI: 31694238</p>
        <a href="https://github.com/SamuelCubano/Tarea-de-Login-y-Registro" target="_blank"><i class="fa-brands fa-github"></i></a>
    </footer>

    <script>
        // Funcionalidad del Modal
        const modal = document.getElementById('modal-edicion');
        const span = document.getElementsByClassName("cerrar")[0];

        function abrirModal(id, nombre, email) {
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-nombre').value = nombre;
            document.getElementById('edit-email').value = email;
            modal.style.display = "block";
        }

        function cerrarModal() {
            modal.style.display = "none";
        }

        span.onclick = cerrarModal;

        window.onclick = function(event) {
            if (event.target == modal) {
                cerrarModal();
            }
        }
    </script>
</body>
</html>