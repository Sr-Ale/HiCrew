

var map = L.map('map').setView([45.0, 0.0], 4);

L.tileLayer('https://cartodb-basemaps-{s}.global.ssl.fastly.net/dark_all/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.carto.com/">carto.com</a> contributors'
}).addTo(map);

