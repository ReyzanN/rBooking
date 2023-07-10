import L from 'leaflet';
let coords = JSON.parse(document.getElementById('mapCoords').value);
let map = L.map('map').setView([coords.lat, coords.long], 13);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);
let AppointmentMarker = L.marker([coords.lat, coords.long]).addTo(map);
AppointmentMarker.bindPopup("<b>Lieu du rendez-vous</b><br>").openPopup();
