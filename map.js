var map = L.map('map1').setView([51.508238, -0.076169], 15);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

// ----------------------------------------------------
// 1. Definir la clase CSS para el icono
var greenIcon = L.divIcon({
    className: 'green-dot-marker', // Esta clase la definiremos en CSS
    html: '<i class="fa-solid fa-location-dot"></i>', // Opcional: puedes poner un icono de Font Awesome si lo tienes en tu HTML
    iconSize: [30, 30], // Tamaño del elemento
    iconAnchor: [15, 15] // Punto de anclaje (mitad del tamaño)
});

// 2. Crear el marcador usando L.divIcon
var marker = L.marker([51.508238, -0.076169], {icon: greenIcon}).addTo(map);
// ----------------------------------------------------
