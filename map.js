var map = L.map('map1').setView([51.508238, -0.076169], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

// ----------------------------------------------------
// 1. La Torre de Londres
var lugarIcon = L.divIcon({
    className: 'lugar-dot-marker', // Esta clase la definiremos en CSS
    html: '<i class="fa-solid fa-location-dot"></i>', // Opcional: puedes poner un icono de Font Awesome si lo tienes en tu HTML
    iconSize: [30, 30], // Tamaño del elemento
    iconAnchor: [15, 15] // Punto de anclaje (mitad del tamaño)
});


// 2. Hoteles
var hotelesIcon = L.divIcon({
    className: 'hoteles-dot-marker', // Esta clase la definiremos en CSS
    html: '<i class="fa-solid fa-bed"></i>', // Opcional: puedes poner un icono de Font Awesome si lo tienes en tu HTML
    iconSize: [30, 30], // Tamaño del elemento
    iconAnchor: [15, 15] // Punto de anclaje (mitad del tamaño)
});

// 3. Restaurantes
var restaurantesIcon = L.divIcon({
    className: 'restaurantes-dot-marker', // Esta clase la definiremos en CSS
    html: '<i class="fa-solid fa-utensils"></i>', // Opcional: puedes poner un icono de Font Awesome si lo tienes en tu HTML
    iconSize: [30, 30], // Tamaño del elemento
    iconAnchor: [15, 15] // Punto de anclaje (mitad del tamaño)
});

// 2. Crear el marcador usando L.divIcon
var marker = L.marker([51.508238, -0.076169], {icon: lugarIcon}).addTo(map);
var marker = L.marker([51.510595, -0.077494], {icon: hotelesIcon}).addTo(map);
var marker = L.marker([51.510227, -0.076432], {icon: hotelesIcon}).addTo(map);
var marker = L.marker([51.510407, -0.075255], {icon: hotelesIcon}).addTo(map);
var marker = L.marker([51.519499, -0.084610], {icon: restaurantesIcon}).addTo(map);



// ----------------------------------------------------
