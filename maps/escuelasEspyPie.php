<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Escuelas Especiales y PIEs</title>

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />

  <style>
    body { margin: 0; font-family: Arial, sans-serif; display: flex; height: 100vh; background: #ffffff; }
    .sidebar { width: 340px; background: #ffffff; padding: 20px 24px; overflow-y: auto; border-right: 1px solid #e5e5e5; }
    .sidebar h3 { margin-top: 0; color: #000000; font-size: 24px; font-weight: 700; }
    .sidebar ul { list-style: none; padding-left: 0; }
    .region-header { margin: 12px 0; cursor: pointer; color: #111; font-size: 16px; font-weight: bold; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #f0f0f0; padding-bottom: 6px; }
    .region-header .arrow { font-size: 14px; color: #888; transition: transform 0.3s; }
    .region-header.collapsed .arrow { transform: rotate(-90deg); }
    .geo-list { display: none; margin: 5px 0 10px 15px; padding-left: 0; font-size: 13px; color: #444; }
    .geo-list li { margin-bottom: 4px; position: relative; padding-left: 18px; }
    .geo-list li::before { content: '•'; position: absolute; left: 0; color: #999; font-size: 14px; }
    .selector-header { display: flex; align-items: center; margin-top: 10px; font-weight: bold; font-size: 14px; color: #555; margin-left: 0; padding-left: 0; gap: 6px; }
    .selector-header::before { content: "📂"; font-size: 18px; }
    .geo-list li a { text-decoration: none; color: #000000; font-weight: normal; font-size: 13px; }
    .geo-list li a:hover { text-decoration: underline; }
    .geo-list li a.seleccionado::before { content: '📍'; position: absolute; left: 0; color: #000000; font-size: 14px; }
    .geo-list li a.seleccionado { font-weight: bold; color: #222; }
    #map { flex-grow: 1; }
    .leaflet-control-attribution { display: none !important; }
    .custom-marker { width: 20px; height: 20px; border-radius: 50%; border: 2px solid #ffffff; box-shadow: 0 0 2px #666; background-color: gray; }
    .marker-pie { background-color: #4CAF50; }
    .marker-escuelas { background-color: #FFEB3B; }
    .marker-instituciones { background-color: #2196F3; }
    .marker-talleres { background-color: #FF9800; }
  </style>
</head>
<body>
<div class="sidebar">
  <h3>Escuelas Especiales y PIEs</h3>
  <ul id="asociacionesList">
    <li class="region-header" onclick="goHome()">🏡 Inicio</li>
  </ul>
</div>
<div id="map"></div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
<script>
let map;
let cluster;
let asociaciones = {};
const chileBounds = [
  [-17.5, -75],
  [-56, -66]
];

const regionOrden = {
  "Tarapacá": { numero: 1, romano: "I" },
  "Antofagasta": { numero: 2, romano: "II" },
  "Atacama": { numero: 3, romano: "III" },
  "Coquimbo": { numero: 4, romano: "IV" },
  "Valparaíso": { numero: 5, romano: "V" },
  "OHiggins": { numero: 6, romano: "VI" },
  "Maule": { numero: 7, romano: "VII" },
  "Biobío": { numero: 8, romano: "VIII" },
  "La Araucanía": { numero: 9, romano: "IX" },
  "Los Lagos": { numero: 10, romano: "X" },
  "Aysén del General Carlos Ibáñez del Campo": { numero: 11, romano: "XI" },
  "Magallanes y de la Antártica Chilena": { numero: 12, romano: "XII" },
  "Metropolitana de Santiago": { numero: 13, romano: "RM" },
  "Los Ríos": { numero: 14, romano: "XIV" },
  "Arica y Parinacota": { numero: 15, romano: "XV" },
  "Ñuble": { numero: 16, romano: "XVI" }
};

const regionCentros = {
  "Tarapacá": [-20.2133, -70.1524],
  "Antofagasta": [-23.65, -70.4],
  "Atacama": [-27.3668, -70.3322],
  "Coquimbo": [-29.9533, -71.3395],
  "Valparaíso": [-33.0472, -71.6127],
  "OHiggins": [-34.2932, -70.811],
  "Maule": [-35.4264, -71.6554],
  "Biobío": [-36.8201, -73.0444],
  "La Araucanía": [-38.7359, -72.5904],
  "Los Lagos": [-41.4717, -72.9369],
  "Aysén del General Carlos Ibáñez del Campo": [-45.5752, -72.0662],
  "Magallanes y de la Antártica Chilena": [-53.1638, -70.9171],
  "Metropolitana de Santiago": [-33.45, -70.6667],
  "Los Ríos": [-39.8142, -73.2459],
  "Arica y Parinacota": [-18.4783, -70.3126],
  "Ñuble": [-36.7226, -72.1254]
};

const regionEmojis = {
  "Antofagasta": "🏖️",
  "Tarapacá": "🏜️",
  "Atacama": "🌋",
  "OHiggins": "🏡",
  "La Araucanía": "🌳",
  "Aysén del General Carlos Ibáñez del Campo": "🧊",
  "Magallanes y de la Antártica Chilena": "❄️",
  "Arica y Parinacota": "🌵",
  "Biobío": "🌲",
  "Coquimbo": "🌅",
  "Los Lagos": "🌧️",
  "Los Ríos": "☔️",
  "Maule": "🏞️",
  "Metropolitana de Santiago": "🏙️",
  "Ñuble": "🌾",
  "Valparaíso": "⚓"
};

function goHome() {
  map.fitBounds(chileBounds);
}

async function initMap() {
  const response = await fetch('escuelasEspyPie_datos.php');
  const geos = await response.json();
  
  map = L.map('map', {
    minZoom: 4,
    maxBounds: chileBounds
  });
  map.fitBounds(chileBounds);

  // Capas base
  const calleLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
    attribution: '&copy; Esri &mdash; Source: Esri, NAVTEQ, DeLorme',
    maxZoom: 19
  });

  const sateliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles &copy; Esri'
  });

  // Capa activa por defecto
  calleLayer.addTo(map);
  //sateliteLayer.addTo(map);

  cluster = L.markerClusterGroup({ singleMarkerMode: true });
  geos.forEach(geo => {
    let markerClass = 'custom-marker';
    if (geo.selector === 'Establecimientos PIE') markerClass += ' marker-pie';
    else if (geo.selector === 'Escuelas Especiales') markerClass += ' marker-escuelas';
    else if (geo.selector === 'Instituciones') markerClass += ' marker-instituciones';
    else if (geo.selector === 'Talleres Deportivos') markerClass += ' marker-talleres';

    const icon = L.divIcon({ className: markerClass, iconSize: [20, 20], popupAnchor: [0, -10] });
    const marker = L.marker([parseFloat(geo.latitud), parseFloat(geo.longitud)], { icon })
      .bindPopup(`<div><strong>Tipo:</strong> ${geo.tipo}<br><strong><strong>Selección:</strong> ${geo.selector}<br><strong>Nombre:</strong> ${geo.nombre}<br>${geo.email ? `<strong>Email:</strong> <a href='mailto:${geo.email}'>${geo.email}</a><br>` : ""}<strong>Dirección:</strong> ${geo.direccion}<br>${geo.telefono ? `<strong>Teléfono:</strong> ${geo.telefono}<br>` : ""}${geo.web ? `<strong>Web:</strong> <a href='${geo.web}' target='_blank'>${geo.web}</a>` : ""}</div>`)
      .bindTooltip(`${geo.nombre} (${geo.tipo})`, { permanent: false, direction: "top", offset: [0, -15], opacity: 0.9 });

    cluster.addLayer(marker);

    if (!asociaciones[geo.region]) asociaciones[geo.region] = {};
    if (!asociaciones[geo.region][geo.selector]) asociaciones[geo.region][geo.selector] = [];
    asociaciones[geo.region][geo.selector].push({ marker, nombre: geo.nombre });
  });

  map.addLayer(cluster);
  renderSidebar();

  // Control de capas (calles y satelital)
  const baseMaps = {
    "🛰️ Mapa Satelital": sateliteLayer,
    "🗺️ Mapa Calles": calleLayer
  };
  L.control.layers(baseMaps).addTo(map);
}

function renderSidebar() {
  const ul = document.getElementById('asociacionesList');
  ul.innerHTML = '';
  const homeItem = document.createElement('li');
  homeItem.className = 'region-header';
  homeItem.onclick = goHome;
  homeItem.innerHTML = '🏡 Inicio';
  ul.appendChild(homeItem);

  Object.keys(regionOrden)
    .filter(region => asociaciones.hasOwnProperty(region))
    .sort((a, b) => regionOrden[a].numero - regionOrden[b].numero)
    .forEach(region => {
      const emoji = regionEmojis[region] || "📍";
      const selectors = asociaciones[region];
      const total = Object.values(selectors).reduce((sum, arr) => sum + arr.length, 0);

      const header = document.createElement('li');
      header.className = 'region-header';
      header.innerHTML = `<span>${emoji} ${regionOrden[region].romano} - ${region} (${total})</span><span class="arrow">&#x25BC;</span>`;
      header.onclick = () => {
        const centro = regionCentros[region];
        if (centro) {
          map.setView(centro, 8);
        }
        header.classList.toggle('collapsed');
        const regionList = header.nextSibling;
        if (regionList) {
          regionList.style.display = regionList.style.display === 'block' ? 'none' : 'block';
        }
      };

      const regionList = document.createElement('ul');
      regionList.className = 'geo-list';
      Object.keys(selectors).sort().forEach(selector => {
        const countSelector = selectors[selector].length;
        const selectorHeader = document.createElement('div');
        selectorHeader.className = 'selector-header';
        selectorHeader.textContent = `${selector} (${countSelector})`;
        regionList.appendChild(selectorHeader);

        selectors[selector].forEach(({ marker, nombre }) => {
          const li = document.createElement('li');
          const a = document.createElement('a');
          a.href = '#';
          a.textContent = nombre;
          a.onclick = (e) => {
            e.preventDefault();
            document.querySelectorAll('.geo-list li a').forEach(el => el.classList.remove('seleccionado'));
            a.classList.add('seleccionado');
            cluster.zoomToShowLayer(marker, () => {
              marker.openPopup();
            });
          };
          li.appendChild(a);
          regionList.appendChild(li);
        });
      });
      ul.appendChild(header);
      ul.appendChild(regionList);
    });
}

initMap();
</script>

</body>
</html>
