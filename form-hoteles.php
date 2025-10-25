<?php
session_start();

// Si el usuario no está logueado, lo envía de vuelta al login
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== TRUE) {
    header("Location: index.php");
    exit;
}

// Si es un administrador, lo redirige a su panel
if (isset($_SESSION['es_admin']) && $_SESSION['es_admin'] === TRUE) {
    header("Location: admin_panel.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style _hotel.css">
        <script src="https://kit.fontawesome.com/cf1fb60fea.js" crossorigin="anonymous"></script>

    <title>Reservaciones</title>
</head>
<header class="main-header">
    <div class="logo">
        <img src="img/IUJO.png" alt="Logo" height="40">
        <h2>Samuel Cubano & Keiver Blanco</h2>
        <a href="dashboard.php" class="regresar-link"><i class="fa-solid fa-house"></i></a>
        <h4><i class="fa-solid fa-circle-user"></i> <?php echo htmlspecialchars($_SESSION['user_nombre']); ?></h4>
    </div>
    
</header>
<body>
    <div class="contenedor-formulario">
        <form method="post" action="form-hoteles.php" class="form-reserva">
            <h1>Reserva de Hoteles</h1>

            <label for="hotel">Selecciona un Hotel:</label>
            <select id="hotel" name="hotel" required>
                <option value="">Hoteles Cercanos</option>
                <option value="Hotel A">CitizenM Tower of London hotel</option>
                <option value="Hotel B">Novotel London Tower Bridge</option>
                <option value="Hotel C">The Ritz London</option>
                <option value="Hotel D">Buckingham Gate Suites and Residences</option>
                <option value="Hotel E">The Savoy</option>
                <option value="Hotel F">The Resident Victoria</option>
                <option value="Hotel G">Buckingham Gate Suites and Residences</option>
                <option value="Hotel H">Raya hotel Victoria</option>
                <option value="Hotel I">Premier Inn London County Hall</option>
                <option value="Hotel J">Bedford Place</option>
                <option value="Hotel K">Astor Museum Hostel</option>
                <option value="Hotel L">Ruskin Hotel</option>
            </select>
            
            <label for="pais">Pais:</label>
            <select name="pais" id="pais">
                <option value="pais">Paises</option>
                <option value="pais1">Alemania</option>
                <option value="pais2">Argentina</option>
                <option value="pais3">Dinamarca</option>
                <option value="pais4">España</option>
                <option value="pais5">Francia</option>
                <option value="pais6">Italia</option>
                <option value="pais7">Mexico</option>
                <option value="pais8">Portugal</option>
                <option value="pais9">Reino Unido</option>
                <option value="pais10">Suiza</option>
                <option value="pais11">Venezuela</option>

            </select>
                <label for="integrantes">integrantes:</label>
                <input type="number" id="integrantes" name="integrantes" min="1" max="10" required title="Máximo 10 integrantes" oninput="if(this.value===''){return;} this.value = Math.max(1, Math.min(10, parseInt(this.value||0)));">
                <label for="checkin">Fecha de Entrada:</label>
                <input type="date" id="checkin" name="fecha_de_entrada" required>
                <label for="checkout">Fecha de salida:</label>
                <input type="date" id="checkout" name="fecha_de_salida" required>

            <form action="procesar_form_hotel.php" method="POST" class="reserva-form">
                <button type="submit">Reservar</button>
            </form>
        </form>
    </div>
    
<footer class="main-footer">
    <p>© <?php echo date("Y"); ?> Samuel Cubano CI: 32935820 & Keiver Blanco CI:31694238</p>
    <a href="https://github.com/SamuelCubano/Tarea-de-Login-y-Registro" target="_blank"><i class="fa-brands fa-github"></i></a>
</footer> 
<script src="validaciones.js"></script>
</body>
</html>