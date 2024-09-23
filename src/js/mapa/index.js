import { Dropdown } from "bootstrap";
import L from 'leaflet';


const map = L.map('map', {
    center: [15.525158, -90.32959],
    zoom: 7,
    layers: []
});

// Añadir una capa de mapa base de OpenStreetMap
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);


const markerLayer = L.layerGroup();

const icon = L.icon({
    iconUrl: './images/cit.png',
    iconSize: [35, 35]
});

L.marker([15.525158, -90.32959], {
    icon: icon
}).addTo(markerLayer);

markerLayer.addTo(map);