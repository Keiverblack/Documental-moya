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
var map = L.map('map2').setView([51.500749, -0.142994], 14);

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




// MAPA 3
var map = L.map('map3').setView([51.500714, -0.124575], 15);

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

// MARCADORES del mapa 3
var marker = L.marker([51.500714, -0.124575], {icon: lugarIcon}).addTo(map);
var marker = L.marker([51.498466, -0.137938], {icon: hotelesIcon}).addTo(map);
var marker = L.marker([51.498834, -0.142747], {icon: hotelesIcon}).addTo(map);
var marker = L.marker([51.501131, -0.125600], {icon: restaurantesIcon}).addTo(map);
var marker = L.marker([51.501218, -0.125195], {icon: restaurantesIcon}).addTo(map);
var marker = L.marker([51.501094, -0.124602], {icon: restaurantesIcon}).addTo(map);
// ----------------------------------------------------




// MAPA 4
var map = L.map('map4').setView([51.503347, -0.119661], 16);

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

// MARCADORES del mapa 4
var marker = L.marker([51.503347, -0.119661], {icon: lugarIcon}).addTo(map);
var marker = L.marker([51.502816, -0.118143], {icon: hotelesIcon}).addTo(map);
var marker = L.marker([51.502425, -0.118267], {icon: hotelesIcon}).addTo(map);
var marker = L.marker([51.503348, -0.119208], {icon: restaurantesIcon}).addTo(map);
var marker = L.marker([51.502223, -0.117725], {icon: restaurantesIcon}).addTo(map);
var marker = L.marker([51.501948, -0.119181], {icon: restaurantesIcon}).addTo(map);
// ----------------------------------------------------





// MAPA 5
var map = L.map('map5').setView([51.519419, -0.126922], 16);

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

// MARCADORES del mapa 5
var marker = L.marker([51.519419, -0.126922], {icon: lugarIcon}).addTo(map);
var marker = L.marker([51.520587, -0.125093], {icon: hotelesIcon}).addTo(map);
var marker = L.marker([51.519514, -0.124846], {icon: hotelesIcon}).addTo(map);
var marker = L.marker([51.519679, -0.125053], {icon: hotelesIcon}).addTo(map);
var marker = L.marker([51.518532, -0.124943], {icon: restaurantesIcon}).addTo(map);
var marker = L.marker([51.518743, -0.123934], {icon: restaurantesIcon}).addTo(map);
var marker = L.marker([51.520070, -0.125552], {icon: restaurantesIcon}).addTo(map);
// ----------------------------------------------------
