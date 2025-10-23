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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Los 10 lugares clave para tu próximo viaje a Londres</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/cf1fb60fea.js" crossorigin="anonymous"></script>

     <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

    
     <style>
        /* Agrega estos estilos al final de tu archivo style.css */
html.has-scroll-smooth {
    overflow: hidden;
}

html.has-scroll-dragging {
    user-select: none;
}/* Estilos generales */


body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    line-height: 1.6;
    background-color: rgba(255, 255, 255, 0.5);
    /* Agrega la transición aquí para un cambio suave en el fondo y texto del body */
    transition: background-color 0.5s ease, color 0.5s ease; 
}

/* ... (resto de tus variables y estilos anteriores) ... */


/* Modo Claro (por defecto) */
body.light-mode {
    background-color: var(--bg-color-light);
    color: var(--text-color-light);
}

.light-mode .lugar {
    background-color: var(--card-bg-light);
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    /* Agrega la transición aquí para un cambio suave en el fondo y sombra de las tarjetas */
    transition: background-color 0.5s ease, box-shadow 0.5s ease; 
}

/* Modo Oscuro */
body.dark-mode {
    background-color: var(--bg-color-dark);
    color: var(--text-color-dark);
}

.dark-mode .lugar {
    background-color: var(--card-bg-dark);
    box-shadow: 0 6px 15px rgba(0,0,0,0.3);
    border: 1px solid var(--border-color-dark);
    /* Agrega la transición aquí también para el modo oscuro */
    transition: background-color 0.5s ease, box-shadow 0.5s ease, border-color 0.5s ease; 
}

/* ... (resto de tus estilos de header, controls, botones, carrusel, footer, etc.) ... */

/* Header llamativo con animación */
/* Variables para colores del modo claro y oscuro */
:root {
    --bg-color-light: #f0f2f5;
    --text-color-light: #333;
    --card-bg-light: #ffffff;
    --border-color-light: #e0e0e0;

    --bg-color-dark: #121212;
    --text-color-dark: #e0e0e0;
    --card-bg-dark: #1e1e1e;
    --border-color-dark: #333;

    /* Color base */
    --primary-color: #007bff;
}

/* Modo Claro (por defecto) */
body.light-mode {
    background-color: var(--bg-color-light);
    color: var(--text-color-light);
}

.light-mode .lugar {
    background-color: var(--card-bg-light);
    box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}

/* Modo Oscuro */
body.dark-mode {
    background-color: var(--bg-color-dark);
    color: var(--text-color-dark);
}

.dark-mode .lugar {
    background-color: var(--card-bg-dark);
    box-shadow: 0 6px 15px rgba(0,0,0,0.3);
    border: 1px solid var(--border-color-dark);
}

/* Header, botones y otros estilos */
.header {
    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('img/foto\ de\ header.gif');
    background-size: cover;
    background-position: center;
    color: white;
    text-align: center;
    padding: 100px 20px;
    animation: fadeIn 2s ease-in-out;
    position: relative;
}

.controls {
    position: absolute;
    top: 20px;
    right: 20px;
    display: flex;
    gap: 10px;
}

#theme-toggle, #lang-toggle {
    background-color: var(--primary-color);
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 20px;
    cursor: pointer;
    font-weight: bold;
    transition: transform 0.2s ease, background-color 0.2s ease;
}

#theme-toggle:hover, #lang-toggle:hover {
    transform: translateY(-2px);
    background-color: #0056b3;
}

/* ... (mantén los estilos de .lugar, .carrusel, .footer y animaciones anteriores) ... */

.header h1 {
    font-size: 3em;
    margin: 0;
}

.header p {
    font-size: 1.2em;
}

/* Animación para el header */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Estilos de las secciones de lugares */
.lugar {
    background-color: white;
    margin: 20px auto; /* Centra las tarjetas */
    max-width: 800px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    animation: slideIn 1s ease-out;
}

.lugar h2 {
    color: #007bff; /* Un color de acento */
}

/* Animación para las secciones de lugares */
@keyframes slideIn {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
}

/* Carrusel de imágenes */
.carrusel {
    margin: auto;
    position: relative;
    width: 70%;
    overflow: hidden;
    margin-top: 15px;
}

.imagenes-carrusel {
    display: flex;
    transition: transform 0.5s ease-in-out;
}

.imagenes-carrusel img {
    width: 100%;
    flex-shrink: 0;
    border-radius: 15px;
    display: block; /* Elimina el espacio extra debajo de las imágenes */
}

/* Estilos de los botones del carrusel */
.carrusel .prev-button,
.carrusel .next-button {
    cursor: pointer;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    padding: 16px;
    color: white;
    font-weight: bold;
    font-size: 24px;
    transition: 0.6s ease;
    border-radius: 0 3px 3px 0;
    user-select: none;
    background-color: rgba(0,0,0,0.5);
    border: none;
    z-index: 10;
}

.carrusel .next-button {
    right: 0;
    border-radius: 3px 0 0 3px;
}

.carrusel .prev-button:hover,
.carrusel .next-button:hover {
    background-color: rgba(0,0,0,0.8);
}

/* Footer */
.footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 20px;
    margin-top: 40px;
}

i {
    margin: 15px 10px;
    color: white;
    transition: color 0.3s ease;
    font-size: 30px;
}

i:hover {
    color: skyblue;
}

#map, #map1, #map2, #map3, #map4, #map5, #map6, #map7, #map8, #map9, #map10 { height: 200px; width: 75%;
    margin: auto;
    margin-top: 30px;
    display: block;
    border-radius: 5px;
}

iframe {
    border-radius: 10px;
    margin: 0 auto;
    display: block;
    border: none;
    width: 70%;
    height: 400px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    margin-top: 20px;
}

figcaption {
            font-size: small; /* Hace la letra más pequeña */
            color: #888; /* Un tono de gris */
            font-style: italic; /* Aplica cursiva */
            text-align: center;
            margin-top:5px ;
        }

/* Estilos para el formulario */
.formulario-container {
    padding: 50px 20px;
    transition: background-color 0.5s ease;
}

.formulario-card {
    max-width: 600px;
    margin: auto;
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.dark-mode .formulario-card {
    background-color: var(--card-bg-dark);
    box-shadow: 0 6px 15px rgba(0,0,0,0.3);
    border: 1px solid var(--border-color-dark);
}

.formulario-card h2, .formulario-card p {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

.form-group input, .form-group textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box; /* Para que el padding no afecte el ancho total */
    transition: border-color 0.3s ease;
}

.form-group input:focus, .form-group textarea:focus {
    border-color: var(--primary-color);
    outline: none;
}

.error-message {
    color: red;
    font-size: 0.9em;
    display: block;
    margin-top: 5px;
}

.submit-button {
    width: 100%;
    padding: 15px;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1.1em;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

.submit-button:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}

.success-message {
    color: green;
    text-align: center;
    margin-top: 20px;
}



/* Estilos para el contenedor del índice (si lo tienes) o para el párrafo */
.indice-navegacion {
    /* Agrega un poco de espacio alrededor para que no se pegue al texto de arriba */
    padding: 1.5em; /* Espacio interno para que no se pegue el texto a los bordes */
    text-align: left;
    margin: auto;
    margin-left: 120px;
    margin-right: 120px; /* Ancho máximo para que no se extienda demasiado */
}



/* Estilos para la lista de enlaces */
.indice-navegacion ol { /* Elimina las viñetas de la lista */
    padding: 0; /* Elimina el padding por defecto de la lista */
    margin-top: 1em; /* Espacio arriba de la lista */
    text-align: left;
    text-decoration: none;
}

/* Estilos para cada enlace de la lista */
.indice-navegacion li a {
    display: block; /* Hace que cada enlace ocupe toda la línea */
    text-decoration: none; /* Elimina el subrayado por defecto */
    color: #007bff; /* Un color de texto oscuro */
    padding: 0.5em 0; /* Espacio vertical para cada enlace */
    transition: color 0.3s; /* Transición suave para el color */
}

.indice-navegacion li a:hover {
    color: skyblue; /* Cambia el color al pasar el cursor */
}

html {
    scroll-behavior: smooth; /* Suaviza el desplazamiento al hacer clic en los enlaces */
}

/* Estilos para el botón de volver arriba */
.scroll-to-top {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background-color: #007bff;
    color: #fff;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    text-decoration: none;
    font-size: 2em;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    /* Estas líneas ya no son necesarias */
    /* opacity: 0; */
    /* visibility: hidden; */
    transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
    z-index: 1000;
}




@media screen and (max-width: 768px) {
    .indice-navegacion {
        margin:auto;
    }
    
    .indice-navegacion ol { /* Elimina las viñetas de la lista */
    margin-left: 10px;
    }

    .carrusel {
    width: 100%;
    }

    #map1, #map2, #map3, #map4, #map5, #map6, #map7, #map8, #map9, #map10 { height: 200px; width: 100%;
    margin: auto;
    margin-top: 30px;
    display: block;
    border-radius: 5px;
    }
    
}


.header-izquierda {
    /* Usa Flexbox para alinear el ícono y el nombre */
    display: flex;
    /* Alinea los elementos a la izquierda y verticalmente al centro */
    align-items: center; 
    /* Agrega un poco de espacio entre el ícono y el nombre */
    gap: 10px; /* Es una alternativa moderna a margin */
}

/* Estilo para el ícono de cerrar sesión */
.controls a {
    /* Ajusta el tamaño y color del ícono si es necesario */
    font-size: 25px;
    text-decoration: none; /* Quita el subrayado del enlace */
    background-color: #007bff;
    padding: 5px 10px;
    border-radius: 50%;
}

/* Estilo para el nombre de usuario */
.header-izquierda h4 {
    /* Elimina el margen por defecto del h4 para un mejor alineamiento */
    margin: 0; /* Ajusta el tamaño de la fuente si es necesario */
}


/* Posicionamiento del contenedor de la IZQUIERDA */
.header-izquierda {
    /* Mismas propiedades que tu .controls, pero para la izquierda */
    position: absolute;
    top: 20px;
    /* Usar 'left' en lugar de 'right' */
    left: 20px; 

    /* Usar Flexbox para alinear el ícono y el nombre */
    display: flex;
    align-items: center; /* Centra verticalmente */
    gap: 10px; /* Espacio entre el ícono y el nombre */
}

/* Opcional: Estilos para que el nombre de usuario y el ícono se vean bien */
.header-izquierda h4 {
    margin: 0; /* Elimina el margen por defecto del h4 */
    white-space: nowrap;
}

/* El .controls sigue teniendo 'position: absolute; right: 20px;' 
pero el .header-izquierda ahora será posicionado de forma relativa a él.
*/

.header-izquierda {
    /* Necesitas que el elemento se posicione fuera de su flujo natural */
    position: absolute; 
    
    /* Mueve la caja completamente a la izquierda de su contenedor (.controls) */
    right: 100%; 
    
    /* Agrega un margen para separarlo de la esquina izquierda (20px) 
       y compensar el espacio que ocupan los elementos de control 
       (botones) a la derecha. Este valor puede requerir ajustes. */
    margin-right: calc(100% - 20px); 
    
    /* Asegura que los elementos internos sigan usando flexbox */
    display: flex;
    align-items: center;
    gap: 10px;
    
    /* Opcional: Si necesitas que quede *justo* al borde, es más complejo */
    /* top: 0; */
}
     </style>
</head>
<body class="light-mode">
    <a href="#top" id="scroll-to-top" class="scroll-to-top show">
  &#8679;
</a>


    <div id="top"></div>
    
    <header class="header">
        
    <script>
        alert("Has iniciado sesión correctamente. Bienvenido, <?php echo htmlspecialchars($_SESSION['user_nombre']); ?>.");
    </script>
    
    
    
        <div class="header-izquierda">
    <h4>👤 <?php echo htmlspecialchars($_SESSION['user_nombre']); ?></h4>
</div>

<div class="controls">
    <button id="theme-toggle">🌙</button>
    <button id="lang-toggle" data-lang="es" style="border-radius: 50px; padding: 15px">es</button>
    <a href="logout.php">🚪</a>
</div>
    </div>
        </div>
        <h1 data-es="Los 10 lugares clave para tu próximo viaje a Londres" data-en="Top 10 places to visit on your next trip to London">Los 10 lugares clave para tu próximo viaje a Londres</h1>
        <p data-es="Explora 10 destinos que te harán enamorarte de la ciudad." data-en="Explore 10 destinations that will make you fall in love with the city.">Explora 10 destinos que te harán enamorarte de la ciudad.</p><a href="https://www.instagram.com/samuelcubano/" target="_blank"><i class="fa-brands fa-instagram"></i></a><a href="https://github.com/SamuelCubano" target="_blank"><i class="fa-brands fa-github"></i></a>

    </header>
    <div class="indice-navegacion">
    <p data-es="Para que no pierdas ni un segundo, hemos organizado una guía rápida y práctica de las 10 joyas que hacen de Londres una ciudad inolvidable. Olvídate de la búsqueda interminable: te hemos preparado un atajo directo a cada uno de estos destinos imprescindibles. Usa el índice a continuación para saltar fácilmente a la información que más te interese, y empieza a planificar tu recorrido por los rincones más emblemáticos de la capital británica." data-en="So you don't waste a second, we've put together a quick and practical guide to the 10 gems that make London an unforgettable city. Forget the endless search: we've prepared a shortcut to each of these must-see destinations. Use the index below to easily jump to the information that interests you most, and start planning your tour of the British capital's most iconic corners.">Para que no pierdas ni un segundo, hemos organizado una guía rápida y práctica de las 10 joyas que hacen de Londres una ciudad inolvidable. Olvídate de la búsqueda interminable: te hemos preparado un atajo directo a cada uno de estos destinos imprescindibles. Usa el índice a continuación para saltar fácilmente a la información que más te interese, y empieza a planificar tu recorrido por los rincones más emblemáticos de la capital británica.</p>

    <ol>
      <li><a href="#1" data-es="La Torre de Londres" data-en="The Tower of London">La Torre de Londres</a></li>
      <li><a href="#2" data-es="El Palacio de Buckingham" data-en="Buckingham Palace">El Palacio de Buckingham</a></li>
      <li><a href="#3" data-es="El Big Ben" data-en="Big Ben">El Big Ben</a></li>
      <li><a href="#4" data-es="El London Eye" data-en="London Eye">El London Eye</a></li>
      <li><a href="#5" data-es="El Museo Británico" data-en="British Museum">El Museo Británico</a></li>
      <li><a href="#6" data-es="La Abadía de Westminster" data-en="Westminster Abbey">La Abadía de Westminster</a></li>
      <li><a href="#7" data-es="El Tower Bridge" data-en="Tower Bridge">El Tower Bridge</a></li>
      <li><a href="#8" data-es="El Mercado de Covent Garden" data-en="Covent Garden Market">El Mercado de Covent Garden</a></li>
      <li><a href="#9" data-es="El Barrio de Notting Hill" data-en="Notting Hill">El Barrio de Notting Hill</a></li>
      <li><a href="#10" data-es="La Galería Nacional" data-en="National Gallery">La Galería Nacional</a></li>
    </ol>
</div>

    <main>
        <section class="lugar" id="1">
            <h2 data-es="1. La Torre de Londres" data-en="1. The Tower of London">1. La Torre de Londres</h2>
            <p class="descripcion" data-es="La Torre de Londres es una fortaleza histórica, un ícono de la ciudad. Fundada en el año 1066 como parte de la conquista normanda de Inglaterra, no es solo una torre, sino un complejo de varios edificios y fortificaciones. A lo largo de los siglos, la Torre ha tenido muchos propósitos. Fue un palacio real, una formidable fortaleza, un arsenal y la prisión más temida de Inglaterra. Actualmente, es el hogar de las Joyas de la Corona, una invaluable colección de ceremonias y joyas reales, y sigue siendo una de las atracciones más populares de Londres. Los guardianes de la Torre, conocidos como 'Beefeaters', son sus custodios y guías, famosos por sus uniformes y por contar las historias del lugar. Una curiosa leyenda cuenta que si los cuervos que viven en la Torre la abandonan, la monarquía y el reino caerán. Por ello, siempre hay al menos seis cuervos en sus terrenos. Debes visitar la Torre de Londres porque es una inmersión completa en la historia de Inglaterra. Es una oportunidad única para ver de cerca las impresionantes joyas y conocer las fascinantes leyendas y los relatos de quienes estuvieron allí, como Ana Bolena. La Torre te transporta en el tiempo y te conecta de inmediato con el pasado de la ciudad de una forma única y cautivadora." data-en="The Tower of London is a historic fortress, an icon of the city. Founded in 1066 as part of the Norman conquest of England, it is not just a tower, but a complex of several buildings and fortifications. Over the centuries, the Tower has served many purposes. It was a royal palace, a formidable fortress, an arsenal, and England's most feared prison. Today, it is home to the Crown Jewels, a priceless collection of ceremonial and royal jewels, and remains one of London's most popular attractions. The Tower's guardians, known as 'Beefeaters,' are its custodians and guides, famous for their uniforms and for telling the stories of the place. A curious legend tells that if the ravens who live in the Tower leave, the monarchy and the kingdom will fall. Therefore, there are always at least six ravens on its grounds. You must visit the Tower of London because it's a complete immersion in England's history. It's a unique opportunity to see the impressive jewels up close and learn the fascinating legends and stories of those who once stood there, like Anne Boleyn. The Tower transports you back in time and immediately connects you with the city's past in a unique and captivating way.">La Torre de Londres es una fortaleza histórica, un ícono de la ciudad. Fundada en el año 1066 como parte de la conquista normanda de Inglaterra, no es solo una torre, sino un complejo de varios edificios y fortificaciones. A lo largo de los siglos, la Torre ha tenido muchos propósitos. Fue un palacio real, una formidable fortaleza, un arsenal y la prisión más temida de Inglaterra. Actualmente, es el hogar de las Joyas de la Corona, una invaluable colección de ceremonias y joyas reales, y sigue siendo una de las atracciones más populares de Londres. Los guardianes de la Torre, conocidos como 'Beefeaters', son sus custodios y guías, famosos por sus uniformes y por contar las historias del lugar. Una curiosa leyenda cuenta que si los cuervos que viven en la Torre la abandonan, la monarquía y el reino caerán. Por ello, siempre hay al menos seis cuervos en sus terrenos. Debes visitar la Torre de Londres porque es una inmersión completa en la historia de Inglaterra. Es una oportunidad única para ver de cerca las impresionantes joyas y conocer las fascinantes leyendas y los relatos de quienes estuvieron allí, como Ana Bolena. La Torre te transporta en el tiempo y te conecta de inmediato con el pasado de la ciudad de una forma única y cautivadora.</p> <br>
            <div class="carrusel">
                <div class="imagenes-carrusel">
                    <img src="img/Torre1.jpg" alt="Imagen 1">
                    <img src="img/Torre2.jpg" alt="Imagen 2">
                    <img src="img/Torre3.jpg" alt="Imagen 3">
                    <img src="img/Torre4.jpg" alt="Imagen 4">
                </div>
                <button class="prev-button">&#10094;</button>
                <button class="next-button">&#10095;</button>
            </div>
            <figcaption><cite data-es="Imagenes de La Torre de Londres (2015). [Author: Hilarmont]. Wikipedia.
            Recuperado el 10 de septiembre de 2025, de https://es.wikipedia.org/wiki/Londres" data-en="Images from The Tower of London (2015). [Author: Hilarmont]. Wikipedia.
Retrieved September 10, 2025, from https://es.wikipedia.org/wiki/Londres">Imagenes de El La Torre de Londres (2015). [Author: Hilarmont]. Wikipedia.
            Recuperado el 10 de septiembre de 2025, de https://es.wikipedia.org/wiki/Londres</cite></figcaption>
            <div id="map1"></div>
        </section>

        <section class="lugar" id="2">
            <h2 data-es="2. El Palacio de Buckingham" data-en="2. Buckingham Palace">2. El Palacio de Buckingham</h2>
            <p class="descripcion" data-es="El Palacio de Buckingham es la residencia y oficina principal de la monarquía británica en Londres. Es uno de los edificios más icónicos de la ciudad y un símbolo de la realeza. El palacio no es solo una residencia, sino el centro de eventos de estado y ceremonias reales. Ha sido la residencia oficial de los monarcas británicos desde el reinado de la Reina Victoria, y hoy en día, es el hogar del Rey Carlos III. El palacio tiene 775 habitaciones y un jardín que se dice que es el más grande de Londres. Uno de los eventos más famosos que puedes presenciar es el cambio de guardia, una ceremonia formal en la que los guardias de la Reina, con sus icónicas túnicas rojas y sombreros de piel de oso, cambian sus turnos. Es una oportunidad única para acercarte a la realeza británica. Aunque el interior solo está abierto al público durante ciertas épocas del año, presenciar el cambio de guardia es una experiencia imperdible y muy popular. El palacio es un lugar impresionante para tomar fotos y sentir la historia de la monarquía." data-en="Buckingham Palace is the London residence and principal office of the British monarchy. It is one of the city's most iconic buildings and a symbol of royalty. The palace is not just a residence, but the center of state events and royal ceremonies. It has been the official residence of British monarchs since the reign of Queen Victoria, and today, it is the home of King Charles III. The palace has 775 rooms and a garden that is said to be the largest in London. One of the most famous events you can witness is the Changing of the Guard, a formal ceremony in which the Queen's Guard, wearing their iconic red robes and bearskin hats, change their shifts. It is a unique opportunity to get up close and personal with British royalty. Although the interior is only open to the public during certain times of the year, witnessing the Changing of the Guard is a must-see and very popular experience. The palace is a stunning place to take photos and experience the history of the monarchy.">El Palacio de Buckingham es la residencia y oficina principal de la monarquía británica en Londres. Es uno de los edificios más icónicos de la ciudad y un símbolo de la realeza. El palacio no es solo una residencia, sino el centro de eventos de estado y ceremonias reales. Ha sido la residencia oficial de los monarcas británicos desde el reinado de la Reina Victoria, y hoy en día, es el hogar del Rey Carlos III. El palacio tiene 775 habitaciones y un jardín que se dice que es el más grande de Londres. Uno de los eventos más famosos que puedes presenciar es el cambio de guardia, una ceremonia formal en la que los guardias de la Reina, con sus icónicas túnicas rojas y sombreros de piel de oso, cambian sus turnos. Es una oportunidad única para acercarte a la realeza británica. Aunque el interior solo está abierto al público durante ciertas épocas del año, presenciar el cambio de guardia es una experiencia imperdible y muy popular. El palacio es un lugar impresionante para tomar fotos y sentir la historia de la monarquía.</p>
            <div class="carrusel">
                <div class="imagenes-carrusel">
                    <img src="img/Palacio 1.jpg" alt="Imagen 1">
                    <img src="img/Palacio 2.png" alt="Imagen 2">
                    <img src="img/Palacio 3.jpg" alt="Imagen 3">
                    <img src="img/Palacio 4.jpg" alt="Imagen 4">
                </div>
                <button class="prev-button">&#10094;</button>
                <button class="next-button">&#10095;</button>
            </div>
              <figcaption><cite data-es="Imagenes de El Palacio de Buckingham (2015). [Author: Hilarmont]. Wikipedia.
            Recuperado el 10 de septiembre de 2025, de https://es.wikipedia.org/wiki/Londres" data-en="Images from Buckingham Palace (2015). [Author: Hilarmont]. Wikipedia.
Retrieved September 10, 2025, from https://es.wikipedia.org/wiki/Londres">Imagenes de El Palacio de Buckingham (2015). [Author: Hilarmont]. Wikipedia.
            Recuperado el 10 de septiembre de 2025, de https://es.wikipedia.org/wiki/Londres</cite></figcaption>

            <div id="map2"></div>
        </section>

        <section class="lugar" id="3">
            <h2 data-es="3. El Big Ben" data-en="3. The Big Ben">3. El Big Ben</h2>
            <p class="descripcion" data-es="El Big Ben es el nombre que se le da a la enorme campana dentro de la torre del reloj en el extremo norte del Palacio de Westminster, las Casas del Parlamento. Es uno de los símbolos más famosos de Londres y del Reino Unido. La torre del reloj, oficialmente conocida como la Elizabeth Tower, tiene más de 96 metros de altura. Su reloj es el más preciso y confiable del mundo, a pesar de su tamaño y antigüedad. El Big Ben ha marcado la hora con una precisión asombrosa desde 1859. El Big Ben es conocido por ser un símbolo de la resiliencia británica, ya que su campana siguió sonando durante los bombardeos de la Segunda Guerra Mundial, incluso cuando el parlamento fue gravemente dañado. Debes visitar el Big Ben para ver de cerca un icono global. Es un lugar perfecto para tomar fotos, sentir la historia de la ciudad y escuchar las campanas que han marcado el tiempo para los londinenses por más de 160 años." data-en="Big Ben is the name given to the enormous bell inside the clock tower at the north end of the Palace of Westminster, the Houses of Parliament. It is one of the most famous symbols of London and the United Kingdom. The clock tower, officially known as the Elizabeth Tower, is over 96 meters tall. Its clock is the most accurate and reliable in the world, despite its size and age. Big Ben has kept time with astonishing accuracy since 1859. Big Ben is known as a symbol of British resilience, as its bell continued to ring during the bombing raids of World War II, even when Parliament was severely damaged. You must visit Big Ben to see this global icon up close. It's a perfect place to take photos, experience the city's history, and hear the bells that have kept time for Londoners for over 160 years.">El Big Ben es el nombre que se le da a la enorme campana dentro de la torre del reloj en el extremo norte del Palacio de Westminster, las Casas del Parlamento. Es uno de los símbolos más famosos de Londres y del Reino Unido. La torre del reloj, oficialmente conocida como la Elizabeth Tower, tiene más de 96 metros de altura. Su reloj es el más preciso y confiable del mundo, a pesar de su tamaño y antigüedad. El Big Ben ha marcado la hora con una precisión asombrosa desde 1859. El Big Ben es conocido por ser un símbolo de la resiliencia británica, ya que su campana siguió sonando durante los bombardeos de la Segunda Guerra Mundial, incluso cuando el parlamento fue gravemente dañado. Debes visitar el Big Ben para ver de cerca un icono global. Es un lugar perfecto para tomar fotos, sentir la historia de la ciudad y escuchar las campanas que han marcado el tiempo para los londinenses por más de 160 años.</p>
            <div class="carrusel">
                <div class="imagenes-carrusel">
                    <img src="img/Bigben 1.jpg" alt="Imagen 1">
                    <img src="img/Bigben 2.jpg" alt="Imagen 2">
                    <img src="img/Bigben 3.jpg" alt="Imagen 3">
                    <img src="img/Bigben 4.jpg" alt="Imagen 4">
                </div>
                <button class="prev-button">&#10094;</button>
                <button class="next-button">&#10095;</button>
            </div>
            <figcaption><cite data-es="Imagenes de El Big Ben (2015). [Author: Hilarmont]. Wikipedia.
            Recuperado el 10 de septiembre de 2025, de https://es.wikipedia.org/wiki/Londres" data-en="Images from Big Ben (2015). [Author: Hilarmont]. Wikipedia.
Retrieved September 10, 2025, from https://es.wikipedia.org/wiki/Londres">Imagenes de El Big Ben (2015). [Author: Hilarmont]. Wikipedia.
            Recuperado el 10 de septiembre de 2025, de https://es.wikipedia.org/wiki/Londres</cite></figcaption>
            <div id="map3"></div>
            
        </section>

        <section class="lugar" id="4">
            <h2 data-es="4. El London Eye" data-en="4.The London Eye">4. El London Eye</h2>
            <p class="descripcion" data-es="El London Eye es la rueda de observación en voladizo más alta de Europa y una de las atracciones turísticas más populares de la ciudad. Se encuentra en la orilla sur del río Támesis, justo enfrente de las Casas del Parlamento. Con 135 metros de altura, la rueda ofrece unas vistas de 360 grados de Londres. En un día despejado, puedes ver hasta 40 kilómetros de distancia. La vuelta completa dura unos 30 minutos, lo que te da tiempo de sobra para admirar el horizonte de la ciudad. El London Eye fue inaugurado en el año 2000 para conmemorar el nuevo milenio. Desde entonces, se ha convertido en un símbolo moderno de Londres y un lugar clave para disfrutar de las vistas más famosas, como el Big Ben, el Palacio de Buckingham y la Torre de Londres. Si quieres tener la mejor vista panorámica de Londres, el London Eye es una parada obligatoria. Es la forma perfecta de orientarte en la ciudad y ver todos los lugares famosos desde una perspectiva completamente nueva. La experiencia en sus cápsulas de cristal es suave y relajante, ideal para cualquier tipo de viajero." data-en="The London Eye is Europe's tallest cantilevered observation wheel and one of the city's most popular tourist attractions. It's located on the South Bank of the River Thames, directly opposite the Houses of Parliament. At 135 meters high, the wheel offers 360-degree views of London. On a clear day, you can see up to 40 kilometers in distance. A full tour takes about 30 minutes, giving you plenty of time to admire the city skyline. The London Eye opened in 2000 to commemorate the new millennium. Since then, it has become a modern symbol of London and a key spot for famous sights, including Big Ben, Buckingham Palace, and the Tower of London. If you want the best panoramic view of London, the London Eye is a must-see. It's the perfect way to get your bearings in the city and see all the famous landmarks from a whole new perspective. The experience in its glass capsules is smooth and relaxing, ideal for any type of traveler.">El London Eye es la rueda de observación en voladizo más alta de Europa y una de las atracciones turísticas más populares de la ciudad. Se encuentra en la orilla sur del río Támesis, justo enfrente de las Casas del Parlamento. Con 135 metros de altura, la rueda ofrece unas vistas de 360 grados de Londres. En un día despejado, puedes ver hasta 40 kilómetros de distancia. La vuelta completa dura unos 30 minutos, lo que te da tiempo de sobra para admirar el horizonte de la ciudad. El London Eye fue inaugurado en el año 2000 para conmemorar el nuevo milenio. Desde entonces, se ha convertido en un símbolo moderno de Londres y un lugar clave para disfrutar de las vistas más famosas, como el Big Ben, el Palacio de Buckingham y la Torre de Londres. Si quieres tener la mejor vista panorámica de Londres, el London Eye es una parada obligatoria. Es la forma perfecta de orientarte en la ciudad y ver todos los lugares famosos desde una perspectiva completamente nueva. La experiencia en sus cápsulas de cristal es suave y relajante, ideal para cualquier tipo de viajero.</p>
            <div class="carrusel">
                <div class="imagenes-carrusel">
                    <img src="img/Eye 1.jpg" alt="Imagen 1">
                    <img src="img/Eye 2.jpg" alt="Imagen 2">
                    <img src="img/Eye 3.jpg" alt="Imagen 3">
                    <img src="img/Eye 4.jpg" alt="Imagen 4">
                </div>
                <button class="prev-button">&#10094;</button>
                <button class="next-button">&#10095;</button>
            </div>
            <figcaption><cite data-es="Imagenes de El London Eye (2015). [Author: Hilarmont]. Wikipedia.
            Recuperado el 10 de septiembre de 2025, de https://es.wikipedia.org/wiki/Londres" data-en="Images from The London Eye (2015). [Author: Hilarmont]. Wikipedia.
Retrieved September 10, 2025, from https://es.wikipedia.org/wiki/Londres">Imagenes de El London Eye (2015). [Author: Hilarmont]. Wikipedia.
            Recuperado el 10 de septiembre de 2025, de https://es.wikipedia.org/wiki/Londres</cite></figcaption>
            <div id="map4"></div>
        </section>

        <section class="lugar" id="5">
            <h2 data-es="5. El Museo Británico" data-en="5. The British Museum">5. El Museo Británico</h2>
            <p class="descripcion" data-es="El Museo Británico es uno de los museos más grandes y prestigiosos del mundo. Ubicado en el corazón de Londres, su colección de más de ocho millones de objetos abarca la historia humana desde los primeros tiempos hasta el presente. Sus galerías albergan tesoros de civilizaciones enteras. Aquí podrás ver la famosa Piedra de Rosetta, que fue clave para descifrar los jeroglíficos egipcios, y las icónicas Momias Egipcias. También encontrarás los mármoles del Partenón de Atenas y objetos de la Roma Antigua. El museo está diseñado para todos. Sus exhibiciones son visualmente impresionantes y bien organizadas, haciendo que sea fácil encontrar lo que más te interesa, ya sea la historia de los samuráis, los vikingos o los primeros seres humanos. La entrada al Museo Británico es gratuita, lo que lo convierte en una visita obligada si buscas cultura y conocimiento sin coste. Es una oportunidad de ver algunos de los artefactos más importantes de la historia en un solo lugar. Es una parada perfecta para cualquier amante de la historia, el arte o la arqueología." data-en="The British Museum is one of the largest and most prestigious museums in the world. Located in the heart of London, its collection of more than eight million objects spans human history from the earliest times to the present. Its galleries house treasures from entire civilizations. Here you can see the famous Rosetta Stone, which was key to deciphering Egyptian hieroglyphics, and the iconic Egyptian mummies. You'll also find the Parthenon Marbles in Athens and artifacts from Ancient Rome. The museum is designed for everyone. Its exhibits are visually stunning and well-organized, making it easy to find what interests you most, whether it's the history of the samurai, the Vikings, or early humans. Entry to the British Museum is free, making it a must-visit if you're looking for culture and knowledge without the cost. It's a chance to see some of history's most important artifacts in one place. It's a perfect stop for any history, art, or archaeology lover.">
El Museo Británico es uno de los museos más grandes y prestigiosos del mundo. Ubicado en el corazón de Londres, su colección de más de ocho millones de objetos abarca la historia humana desde los primeros tiempos hasta el presente. Sus galerías albergan tesoros de civilizaciones enteras. Aquí podrás ver la famosa Piedra de Rosetta, que fue clave para descifrar los jeroglíficos egipcios, y las icónicas Momias Egipcias. También encontrarás los mármoles del Partenón de Atenas y objetos de la Roma Antigua. El museo está diseñado para todos. Sus exhibiciones son visualmente impresionantes y bien organizadas, haciendo que sea fácil encontrar lo que más te interesa, ya sea la historia de los samuráis, los vikingos o los primeros seres humanos. La entrada al Museo Británico es gratuita, lo que lo convierte en una visita obligada si buscas cultura y conocimiento sin coste. Es una oportunidad de ver algunos de los artefactos más importantes de la historia en un solo lugar. Es una parada perfecta para cualquier amante de la historia, el arte o la arqueología.</p>
            <div class="carrusel">
                <div class="imagenes-carrusel">
                    <img src="img/Museo 1.jpg" alt="Imagen 1">
                    <img src="img/Museo 2.jpg" alt="Imagen 2">
                    <img src="img/Museo 3.jpg" alt="Imagen 3">
                    <img src="img/Museo 4.jpg" alt="Imagen 4">
                </div>
                <button class="prev-button">&#10094;</button>
                <button class="next-button">&#10095;</button>
            </div>
            <figcaption><cite data-es="Imagenes de El La Torre de Londres (2015). [Author: Hilarmont]. Wikipedia.
            Recuperado el 10 de septiembre de 2025, de https://es.wikipedia.org/wiki/Londres" data-en="Images from The Tower of London (2015). [Author: Hilarmont]. Wikipedia.
Retrieved September 10, 2025, from https://es.wikipedia.org/wiki/Londres">Imagenes de El Museo Británico (2015). [Author: Hilarmont]. Wikipedia.
            Recuperado el 10 de septiembre de 2025, de https://es.wikipedia.org/wiki/Londres</cite></figcaption>
            <div id="map5"></div>
        </section>
        </section>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/19MMYWZNiwU?si=EQbBE6mJ_50Q1h8_" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </main>
    <section class="formulario-container">
    <div class="formulario-card">
        <h2>¿Te gustaría estar al tanto de nuestros próximos destinos?</h2>
        <p>Suscríbete y recibe las mejores guías de viaje directamente en tu correo.</p>
        <form id="contact-form" action="https://formsubmit.co/samule10cubano@gmail.com" method="POST">
            <div class="form-group">
                <label for="nombre">Tu Nombre:</label>
                <input type="text" id="nombre" name="name" placeholder="Ingresa tu nombre" required>
                <span class="error-message" id="nombre-error"></span>
            </div>
            <div class="form-group">
                <label for="email">Tu Correo Electrónico:</label>
                <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>
                <span class="error-message" id="email-error"></span>
            </div>
            <div class="form-group">
                <label for="mensaje">Tu Mensaje (opcional):</label>
                <textarea id="mensaje" name="message" rows="4" placeholder="¿Tienes alguna pregunta o sugerencia?"></textarea>
            </div>
            <button type="submit" class="submit-button">Suscribirme</button>
            <p class="success-message" id="form-success"></p>
        </form>
    </div>
</section>
    <footer class="footer">
        <p data-es="&copy; Samii - 2025. Todos los derechos reservados." data-en="&copy; Samii - 2025. All rights reserved.">&copy; Samii - 2025. Todos los derechos reservados.</p><a href="https://www.instagram.com/samuelcubano/" target="_blank"><i class="fa-brands fa-instagram"></i></a><a href="https://github.com/SamuelCubano" target="_blank"><i class="fa-brands fa-github"></i></a><br>
        <a href="https://webiujocatia.wordpress.com/" target="_blank"><img src="/img/IUJO.png" alt="" width="300px"></a>
    </footer>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

    <script src="script.js"></script>
    <script src="map.js"></script>
</body>
</html>