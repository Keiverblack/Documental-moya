// MAPA 1
var map = L.map('map1').setView([51.508238, -0.076169], 15);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

// ----------------------------------------------------
// 1. La Torre de Londres
var lugarIcon = L.divIcon({
    className: 'lugar-dot-marker',
    html: '<i class="fa-solid fa-location-dot"></i>',
    iconSize: [30, 30],
    iconAnchor: [15, 15]
});


// 2. Hoteles
var hotelesIcon = L.divIcon({
    className: 'hoteles-dot-marker',
    html: '<i class="fa-solid fa-bed"></i>',
    iconSize: [30, 30],
    iconAnchor: [15, 15]
});

// 3. Restaurantes
var restaurantesIcon = L.divIcon({
    className: 'restaurantes-dot-marker',
    html: '<i class="fa-solid fa-utensils"></i>',
    iconSize: [30, 30],
    iconAnchor: [15, 15]
});

// MARCADORES del mapa 1
var marker = L.marker([51.508238, -0.076169], {icon: lugarIcon}).addTo(map);
var marker = L.marker([51.510595, -0.077494], {icon: hotelesIcon}).addTo(map);
var marker = L.marker([51.510227, -0.076432], {icon: hotelesIcon}).addTo(map);
var marker = L.marker([51.510407, -0.075255], {icon: hotelesIcon}).addTo(map);
var marker = L.marker([51.510330, -0.075129], {icon: restaurantesIcon}).addTo(map);
var marker = L.marker([51.508871, -0.078927], {icon: restaurantesIcon}).addTo(map);
var marker = L.marker([51.509717, -0.078742], {icon: restaurantesIcon}).addTo(map);
// ----------------------------------------------------



// MAPA 2
var map = L.map('map2').setView([51.500749, -0.142994], 15);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

// ----------------------------------------------------
// 1. La Torre de Londres
var lugarIcon = L.divIcon({
    className: 'lugar-dot-marker',
    html: '<i class="fa-solid fa-location-dot"></i>',
    iconSize: [30, 30],
    iconAnchor: [15, 15]
});


// 2. Hoteles
var hotelesIcon = L.divIcon({
    className: 'hoteles-dot-marker',
    html: '<i class="fa-solid fa-bed"></i>',
    iconSize: [30, 30],
    iconAnchor: [15, 15]
});

// 3. Restaurantes
var restaurantesIcon = L.divIcon({
    className: 'restaurantes-dot-marker',
    html: '<i class="fa-solid fa-utensils"></i>',
    iconSize: [30, 30],
    iconAnchor: [15, 15]
});

// MARCADORES del mapa 2
var marker = L.marker([51.500749, -0.142994], {icon: lugarIcon}).addTo(map);
var marker = L.marker([51.498466, -0.137938], {icon: hotelesIcon}).addTo(map);
var marker = L.marker([51.498834, -0.142747], {icon: hotelesIcon}).addTo(map);
var marker = L.marker([51.504731, -0.147226], {icon: restaurantesIcon}).addTo(map);
var marker = L.marker([51.499002, -0.137565], {icon: restaurantesIcon}).addTo(map);
var marker = L.marker([51.499092, -0.136766], {icon: restaurantesIcon}).addTo(map);
// ----------------------------------------------------
