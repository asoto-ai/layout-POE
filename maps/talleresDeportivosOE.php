<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Talleres Deportivos OE Chile</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />
  <style>
    * { box-sizing: border-box; }
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #ffffff;
      display: flex;
      flex-direction: row;
      height: 100vh;
    }

    .sidebar, .resumen {
      padding: 20px 24px;
      overflow-y: auto;
    }

    .sidebar {
      width: 340px;
      background: #ffffff;
      border-right: 1px solid #e5e5e5;
    }

    .resumen {
      width: 320px;
      background: #f9f9f9;
      border-left: 1px solid #e5e5e5;
      font-size: 13px;
    }

    #map {
      flex-grow: 1;
    }

    .leaflet-control-attribution {
      display: none !important;
    }

    .sidebar h3 {
      margin-top: 0;
      color: #000000;
      font-size: 24px;
      font-weight: 700;
    }

    .sidebar ul {
      list-style: none;
      padding-left: 0;
    }

    .region-header {
      margin: 12px 0;
      cursor: pointer;
      color: #111;
      font-size: 16px;
      font-weight: bold;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #f0f0f0;
      padding-bottom: 6px;
    }

    .region-header .arrow {
      font-size: 14px;
      color: #888;
      transition: transform 0.3s;
    }

    .region-header.collapsed .arrow {
      transform: rotate(-90deg);
    }

    .region-header.seleccionado {
      background-color: #f0f8ff;
      border-left: 4px solid #007BFF;
      padding-left: 8px;
    }

    .geo-list {
      display: none;
      margin: 5px 0 10px 15px;
      padding-left: 0;
      font-size: 13px;
      color: #444;
    }

    .geo-list li {
      margin-bottom: 4px;
      position: relative;
      padding-left: 18px;
    }

    .geo-list li::before {
      content: '•';
      position: absolute;
      left: 0;
      color: #999;
      font-size: 14px;
    }

    .geo-list li a {
      text-decoration: none;
      color: #000000;
      font-weight: normal;
      font-size: 13px;
    }

    .geo-list li a:hover {
      text-decoration: underline;
    }

    .geo-list li a.seleccionado::before {
      content: '📍';
      position: absolute;
      left: 0;
      color: #000000;
      font-size: 14px;
    }

    .geo-list li a.seleccionado {
      font-weight: bold;
      color: #222;
    }

    .resumen h4 {
      margin-top: 0;
      font-size: 16px;
    }

    .resumen ul {
      padding-left: 18px;
      margin: 0;
    }

    .resumen li {
      margin-bottom: 4px;
    }

    .resumen ul ul {
      list-style-type: none;
      padding-left: 12px;
    }

    .resumen ul ul li::before {
      content: '▪ ';
      color: #444;
    }

    @media (max-width: 768px) {
      body {
        flex-direction: column;
        height: auto;
      }

      .sidebar, .resumen {
        width: 100%;
        height: auto;
        border: none;
      }

      #map {
        width: 100%;
        height: 400px;
        order: 2;
      }

      .sidebar {
        order: 1;
      }

      .resumen {
        order: 3;
      }
    }
  </style>
  <link rel="icon" sizes="192x192" href="https://static.wixstatic.com/media/10aafd_df6a30cf16d941aaa72c5e91af502b95%7Emv2.png/v1/fill/w_192%2Ch_192%2Clg_1%2Cusm_0.66_1.00_0.01/10aafd_df6a30cf16d941aaa72c5e91af502b95%7Emv2.png" type="image/png">
</head>
<body>
  <div class="sidebar">
    <h3>Talleres Deportivos OE Chile</h3>
    <ul id="asociacionesList">
      <li class="region-header" onclick="goHome()">🏡 Inicio</li>
    </ul>
  </div>
  <div id="map"></div>
<div class="resumen">
  <h4>Resumen por Región</h4>

  <div style="text-align: justify;">
    <p>
      La convocatoria de los talleres se realizará con el apoyo del gestor territorial, considerando las siguientes instituciones como aliadas: Teletón, Coanil, Escuelas especiales, Programas locales y Clubes deportivos.
    </p>

    <p>Este modelo considera algunas restricciones clave:</p>
    <ul>
      <li><strong>Tope máximo nacional:</strong> La cantidad total de talleres a asignar es de 80.</li>
      <li><strong>Mínimo por región:</strong> Se establece un mínimo de 4 talleres por región. Esta condición busca asegurar que la oferta sea lo suficientemente atractiva para los proveedores en el proceso de licitación, ya que una asignación menor podría afectar negativamente la convocatoria.</li>
      <li><strong>Situación de la Región Metropolitana:</strong> En la RM ya contamos con 13 talleres implementados por el IND, por lo que esa base se considera al momento de hacer nuevas asignaciones.</li>
      <li><strong>Criterio de proporcionalidad:</strong> La distribución regional se realiza en base al número de escuelas especiales registradas por el MINEDUC, lo cual se utiliza como un referente aproximado de la población con discapacidad intelectual y del desarrollo en cada región (ya que no contamos con una cifra oficial actualizada de personas con discapacidad por región).</li>
      <li><strong>Cluster deportivos por zonas:</strong> a medida que el contexto lo permita, generar desarrollo zonal de disciplinas, considerando que esto podria potenciar competencias nacionales acotadas para zonas geograficas.</li>
    </ul>

    <p>
      Adicionalmente, se ha considerado el grado de conocimiento actual del equipo de los contextos regionales, lo que ha permitido proponer algunos ajustes en el margen que mejoran la pertinencia y aplicabilidad del modelo.
    </p>

    <p>
      Este enfoque busca equilibrar criterios de cobertura territorial, eficiencia operativa y factibilidad en la ejecución del programa.
    </p>
    <br>
  </div>

  <ul id="resumenList"></ul>
</div>


  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js"></script>
  <script>
    let map;
    let cluster;
    let asociaciones = {};
    let todosLosMarkers = [];
    let resumen = {};

    function goHome() {
      map.setView([-33.45, -70.6667], 4);
      cluster.clearLayers();
      todosLosMarkers.forEach(m => cluster.addLayer(m));
      map.addLayer(cluster);
      document.querySelectorAll('.region-header').forEach(el => el.classList.remove('seleccionado'));
      document.querySelectorAll('.geo-list').forEach(el => el.style.display = 'none');
    }

async function initMap() {
  const response = await fetch('talleresDeportivosOE_datos.php');
  const geos = await response.json();

  map = L.map('map').setView([-33.45, -70.6667], 4);

  // Base normal (Calles)
  const calleLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Street_Map/MapServer/tile/{z}/{y}/{x}', {
    attribution: '&copy; Esri &mdash; Source: Esri, NAVTEQ, DeLorme',
    maxZoom: 19
  }).addTo(map);

  // Base satelital
  const sateliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: 'Tiles &copy; Esri'
  });

  // Agrupador de markers
  cluster = L.markerClusterGroup({});

  geos.forEach(geo => {
    const marker = L.circleMarker([parseFloat(geo.latitud), parseFloat(geo.longitud)], {
      radius: 8,
      color: '#ff7800',
      fillColor: '#ff7800',
      fillOpacity: 0.8
    })
    .bindPopup(`<div>
      <strong>Selección:</strong> ${geo.selector}<br>
      <strong>Nombre:</strong> ${geo.nombre}<br>
      <strong>Deporte:</strong> ${geo.deporte}<br>
      <strong>Lugar:</strong> ${geo.lugar || 'Por definir'}<br>
      ${geo.email ? `<strong>Email:</strong> <a href='mailto:${geo.email}'>${geo.email}</a><br>` : ""}
      <strong>Dirección:</strong> ${geo.direccion || '1'}<br>
      ${geo.telefono ? `<strong>Teléfono:</strong> ${geo.telefono}<br>` : ""}
      ${geo.web ? `<strong>Web:</strong> <a href='${geo.web}' target='_blank'>${geo.web}</a>` : ""}
    </div>`)
    .bindTooltip(`${geo.nombre} (${geo.tipo})`, { permanent: false, direction: "top", offset: [0, -15], opacity: 0.9 });

    if (!asociaciones[geo.deporte]) asociaciones[geo.deporte] = [];
    asociaciones[geo.deporte].push({ marker, nombre: geo.nombre });
    todosLosMarkers.push(marker);

    if (!resumen[geo.region]) {
      resumen[geo.region] = {
        total: 0,
        lugares: new Set(),
        deportes: new Set(),
        deportesContados: {}
      };
    }
    resumen[geo.region].total++;
    resumen[geo.region].deportes.add(geo.deporte);
    resumen[geo.region].lugares.add(geo.nombre);
    if (!resumen[geo.region].deportesContados[geo.deporte]) {
      resumen[geo.region].deportesContados[geo.deporte] = 0;
    }
    resumen[geo.region].deportesContados[geo.deporte]++;
  });

  todosLosMarkers.forEach(m => cluster.addLayer(m));
  map.addLayer(cluster);

  // 🌍 Control de capas para cambiar entre calle y satelital
  const baseMaps = {
    "🗺️ Mapa Calle": calleLayer,
    "🛰️ Mapa Satelital": sateliteLayer
  };

  L.control.layers(baseMaps).addTo(map);

  renderSidebar();
  renderResumen();
}


    function renderSidebar() {
      const ul = document.getElementById('asociacionesList');
      ul.innerHTML = '';

      const homeItem = document.createElement('li');
      homeItem.className = 'region-header';
      homeItem.onclick = goHome;
      homeItem.innerHTML = '🏡 Inicio';
      ul.appendChild(homeItem);

      Object.keys(asociaciones).sort().forEach(deporte => {
        const grupo = asociaciones[deporte];
        const header = document.createElement('li');
        header.className = 'region-header';
        header.innerHTML = `<span>🏅 ${deporte} (${grupo.length})</span><span class="arrow">&#x25BC;</span>`;

        const regionList = document.createElement('ul');
        regionList.className = 'geo-list';

        grupo.forEach(({ marker, nombre }) => {
          const li = document.createElement('li');
          const a = document.createElement('a');
          a.href = '#';
          a.textContent = nombre;
          a.onclick = (e) => {
            e.preventDefault();
            document.querySelectorAll('.geo-list li a').forEach(el => el.classList.remove('seleccionado'));
            a.classList.add('seleccionado');
            map.setView(marker.getLatLng(), 15);
            marker.openPopup();
          };
          li.appendChild(a);
          regionList.appendChild(li);
        });

        header.onclick = () => {
          document.querySelectorAll('.region-header').forEach(el => el.classList.remove('seleccionado'));
          document.querySelectorAll('.geo-list').forEach(el => el.style.display = 'none');
          header.classList.add('seleccionado');
          regionList.style.display = 'block';
          cluster.clearLayers();
          grupo.forEach(({ marker }) => cluster.addLayer(marker));
          map.addLayer(cluster);
        };

        ul.appendChild(header);
        ul.appendChild(regionList);
      });
    }

    function renderResumen() {
      const ul = document.getElementById('resumenList');
      ul.innerHTML = '';

const regionOrden = {
  "Arica y Parinacota": 15,
  "Tarapacá": 1,
  "Antofagasta": 2,
  "Atacama": 3,
  "Coquimbo": 4,
  "Valparaíso": 5,
  "Libertador General Bernardo O'Higgins": 6,
  "Maule": 7,
  "Biobío": 8,
  "La Araucanía": 9,
  "Los Lagos": 10,
  "Aysén del General Carlos Ibáñez del Campo": 11,
  "Magallanes y de la Antártica Chilena": 12,
  "Metropolitana de Santiago": 13,
  "Los Ríos": 14,
  "Ñuble": 16
};

const regionRomano = {
  1: "I",
  2: "II",
  3: "III",
  4: "IV",
  5: "V",
  6: "VI",
  7: "VII",
  8: "VIII",
  9: "IX",
  10: "X",
  11: "XI",
  12: "XII",
  13: "RM",
  14: "XIV",
  15: "XV",
  16: "XVI"
};


      let totalTalleres = 0;
      let totalDeportes = new Set();

      Object.keys(resumen)
        .sort((a, b) => (regionOrden[a] || 999) - (regionOrden[b] || 999))
        .forEach(region => {
          const data = resumen[region];
          const cantidadTalleres = data.total || 0;
          const deportesContados = data.deportesContados || {};

          totalTalleres += cantidadTalleres;
          Object.keys(deportesContados).forEach(dep => totalDeportes.add(dep));

          const numeroRegion = regionOrden[region];
          const numeroRomano = numeroRegion ? regionRomano[numeroRegion] : "";

          const regionHeader = document.createElement('div');
          regionHeader.className = 'region-header';
          regionHeader.style.cursor = 'pointer';
          regionHeader.innerHTML = `<span>📍 ${numeroRomano ? numeroRomano + ' - ' : ''}${region} (${cantidadTalleres} talleres, ${Object.keys(deportesContados).length} deportes)</span><span class="arrow">&#x25BC;</span>`;

          const regionList = document.createElement('ul');
          regionList.style.display = 'none';
          regionList.className = 'geo-list';

          const liTalleres = document.createElement('li');
          liTalleres.textContent = `Talleres: ${cantidadTalleres}`;
          regionList.appendChild(liTalleres);

          const liDeportes = document.createElement('li');
          liDeportes.textContent = `Deportes distintos: ${Object.keys(deportesContados).length}`;
          regionList.appendChild(liDeportes);

          const liListaDeportes = document.createElement('li');
          liListaDeportes.innerHTML = `📝 <strong>Deportes:</strong>`;
          const ulDeportes = document.createElement('ul');
          ulDeportes.style.paddingLeft = '16px';

          Object.entries(deportesContados)
            .sort((a, b) => a[0].localeCompare(b[0]))
            .forEach(([dep, cantidad]) => {
              const li = document.createElement('li');
              li.textContent = `${dep} (${cantidad})`;
              ulDeportes.appendChild(li);
            });

          liListaDeportes.appendChild(ulDeportes);
          regionList.appendChild(liListaDeportes);

          regionHeader.onclick = () => {
            regionHeader.classList.toggle('collapsed');
            regionList.style.display = regionList.style.display === 'block' ? 'none' : 'block';
          };

          ul.appendChild(regionHeader);
          ul.appendChild(regionList);
        });

      const totalLi = document.createElement('li');
      totalLi.innerHTML = `📊 <strong>Total:</strong> ${totalTalleres} talleres, ${totalDeportes.size} deportes`;
      ul.appendChild(totalLi);
    }

    initMap();
  </script>

  <div style="display: none;">
  <span id="contador-visitas"></span>
</div>

<script>
  fetch('contador.php')
    .then(response => response.text())
    .then(data => {
      document.getElementById('contador-visitas').textContent = data;
    })
    .catch(error => {
      console.error('Error al obtener el contador:', error);
    });
</script>

</body>
</html>
