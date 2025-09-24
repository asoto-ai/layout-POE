<?php require_once __DIR__ . '/auth/check_access.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plataforma Olimpiadas Especiales Chile</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Custom CSS -->
  <link rel="stylesheet" href="static/css/style.css">

  <!-- Icono -->
  <link rel="icon" type="image/png" href="static/img/favicon.png">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

</head>
<body>
  <!-- Sidebar Overlay for Mobile -->
  <div id="sidebarOverlay" class="sidebar-overlay"></div>

  <!-- Sidebar -->
  <nav id="sidebar" class="sidebar">
    <div class="sidebar-header">
      <div class="sidebar-brand">
        <img src="https://poe.olimpiadasespecialeschile.net/static/img/logoPoe2.png" style="height: 150px; vertical-align: middle;">
      </div>
      <button class="sidebar-toggle d-lg-none" id="sidebarToggle">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <div class="sidebar-menu">
      <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link active" href="#" data-section="inicio"><i class="fas fa-home"></i> <span>Página de inicio</span></a></li>
        <li class="nav-item"><a class="nav-link" href="#" data-section="informacionAliado"><i class="fas fa-info-circle"></i> <span>Información Aliado</span></a></li>
        <li class="nav-item"><a class="nav-link" href="#" data-section="talleres"><i class="fas fa-tools"></i> <span>Talleres</span></a></li>
        <li class="nav-item"><a class="nav-link" href="#" data-section="eventos"><i class="fas fa-calendar-alt"></i> <span>Eventos</span></a></li>
        <li class="nav-item"><a class="nav-link" href="#" data-section="capacitaciones"><i class="fas fa-graduation-cap"></i> <span>Capacitaciones</span></a></li>
        <li class="nav-item"><a class="nav-link" href="#" data-section="actividades"><i class="fas fa-clipboard-list"></i> <span>Registro de actividades</span></a></li>
        <li class="nav-item"><a class="nav-link" href="#" data-section="descargas"><i class="fas fa-download"></i> <span>Material descargable</span></a></li>
        <li class="nav-item mt-auto"><a class="nav-link" href="#" data-section="settings"><i class="fas fa-cog"></i> <span>Configuración</span></a></li>
      </ul>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="main-content">
    <!-- Top Navigation -->
    <header class="top-navbar">
      <div class="navbar-content">
        <button class="sidebar-toggle d-lg-none" id="mobileToggle"><i class="fas fa-bars"></i></button>

        <div class="navbar-search">
          <div class="search-box">
            <i class="fas fa-search"></i>
            <input type="text" placeholder="Buscar...">
          </div>
        </div>

        <div class="navbar-actions d-flex align-items-center">
          <!-- Bloque de usuario -->
          <div class="topbar-user d-flex align-items-center me-3">
            <div class="topbar-avatar me-2"><i class="fas fa-user-circle"></i></div>
            <div class="user-details text-end">
              <div class="user-name" id="topUserName">Usuario</div>
              <div class="user-email" id="topUserEmail">Email</div>
              <div class="user-role" id="topUserRole">Role</div>
            </div>
          </div>

          <!-- Botones -->
          <button class="btn btn-outline-primary btn-sm me-2"><i class="fas fa-bell"></i><span class="badge bg-danger">3</span></button>
          <button class="btn btn-outline-primary btn-sm"><i class="fas fa-envelope"></i></button>
          <button id="logoutBtn" class="btn btn-outline-danger btn-sm"><i class="fas fa-sign-out-alt"></i></button>
        </div>
      </div>
    </header>

    <!-- Content Area -->
    <main class="content-area">
      <div id="content"></div>
    </main>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <!-- Custom JS -->
  <script src="static/js/main.js"></script>


<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

  <script>
  // === Inicializador DataTables ===
  function initDataTables() {
    document.querySelectorAll('.datatable').forEach(tbl => {
      if (!$.fn.DataTable.isDataTable(tbl)) {
        $(tbl).DataTable({
          paging: true,
          searching: true,
          ordering: true,
          info: true,
          autoWidth: false,
          responsive: true,
          pageLength: 10,
          lengthMenu: [5, 10, 25, 50, 100],
          language: { url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json' }
        });
      }
    });
  }

  // === Navegador de aliados ===
function initAliadosNavigator() {
  const dataEl = document.getElementById("institucionesData");
  if (!dataEl) return;

  const instituciones = JSON.parse(dataEl.textContent || "[]");
  let currentIndex = 0;
  let filtered = [...instituciones]; // copia inicial

  const searchInput = document.getElementById("buscadorInstituciones");

  function renderInstitucion(index) {
    const detalle = document.getElementById("institucionDetalle");
    const counter = document.getElementById("institucionCounter");
    const nav = document.getElementById("navegacion");

    if (!filtered.length) {
      detalle.innerHTML = "<div class='alert alert-warning'>No hay instituciones</div>";
      counter.textContent = "";
      nav.style.display = "none";
      return;
    }

    const inst = filtered[index];
    counter.textContent = `Institución ${index + 1} de ${filtered.length}`;

    detalle.innerHTML = `
      <div class="card shadow-sm">
        <div class="card-header bg-light">
          <h5>${inst.nombre_institucion ?? ''}</h5>
          <small class="text-muted">ID: ${inst.id_institucion} | RUT: ${inst.rut_institucion ?? ''}</small>
        </div>
        <div class="card-body">
          <p><strong>Dirección:</strong> ${inst.direccion ?? ''}</p>
          <p><strong>Comuna:</strong> ${inst.comuna ?? ''}</p>
          <p><strong>Tipo institución:</strong> ${inst.tipo_institucion ?? ''}</p>
          <p><strong>Convenio:</strong> ${inst.tipo_convenio ?? ''}</p>
          <p><strong>Estado contacto:</strong> ${inst.estado_contacto ?? ''}</p>
          <p><strong>Estado convenio:</strong> ${inst.estado_convenio ?? ''}</p>
          <p><strong>Responsable:</strong> ${inst.nombre_contraparte ?? ''}</p>
          <p><strong>Email:</strong> ${inst.mail_contraparte ?? ''}</p>
        </div>
      </div>`;

    // Navegación
    document.getElementById("btnPrev").onclick = () => {
      if (currentIndex > 0) renderInstitucion(--currentIndex);
    };
    document.getElementById("btnNext").onclick = () => {
      if (currentIndex < filtered.length - 1) renderInstitucion(++currentIndex);
    };

    // === Actualizar mapa ===
    if (!map) initMap();

    // limpiar marcadores anteriores
    if (markerGroup) {
      map.removeLayer(markerGroup);
    }
    markerGroup = L.layerGroup().addTo(map);

    if (inst.ubicaciones) {
      const puntos = inst.ubicaciones.split("|"); // suponiendo que el GROUP_CONCAT use "|"
      let firstCoords = null;

      puntos.forEach(ub => {
        const coords = ub.split(",").map(Number);
        if (coords.length === 2 && !isNaN(coords[0]) && !isNaN(coords[1])) {
          const mk = L.marker(coords).bindPopup(inst.nombre_institucion ?? "Institución");
          markerGroup.addLayer(mk);
          if (!firstCoords) firstCoords = coords;
        }
      });

      if (firstCoords) {
        map.setView(firstCoords, 12);
      }
    }
  }

  // === Buscador dinámico ===
  if (searchInput) {
    searchInput.addEventListener("input", () => {
      const term = searchInput.value.toLowerCase();
      filtered = instituciones.filter(inst =>
        (inst.nombre_institucion ?? "").toLowerCase().includes(term) ||
        (inst.comuna ?? "").toLowerCase().includes(term) ||
        (inst.nombre_contraparte ?? "").toLowerCase().includes(term) ||
        (inst.mail_contraparte ?? "").toLowerCase().includes(term)
      );
      currentIndex = 0;
      renderInstitucion(currentIndex);
    });
  }

  renderInstitucion(currentIndex);
}



  // === Cargar secciones ===
  function loadSection(section) {
    fetch(`secciones/${section}.php`)
      .then(r => {
        if (!r.ok) throw new Error("Error al cargar " + section);
        return r.text();
      })
      .then(html => {
        document.getElementById("content").innerHTML = html;

        // DataTables
        initDataTables();

        // Navegador de aliados
        if (section === "informacionAliado") {
          initAliadosNavigator();
        }

        // Marcar activa
        document.querySelectorAll(".sidebar-menu .nav-link").forEach(link => {
          link.classList.remove("active");
          if (link.dataset.section === section) link.classList.add("active");
        });
      })
      .catch(err => {
        document.getElementById("content").innerHTML =
          `<div class="alert alert-danger">Usted no tiene acceso a esta sección</div>`;
        console.error(err);
      });
  }

  document.addEventListener("DOMContentLoaded", () => {
    loadSection("inicio");

    document.querySelectorAll(".sidebar-menu .nav-link").forEach(link => {
      link.addEventListener("click", e => {
        e.preventDefault();
        loadSection(link.dataset.section);
      });
    });

    // Sidebar toggle
    const sidebar = document.getElementById("sidebar");
    const sidebarOverlay = document.getElementById("sidebarOverlay");
    const mobileToggle = document.getElementById("mobileToggle");
    const closeToggle = document.getElementById("sidebarToggle");

    const toggleSidebar = (show) => {
      if (show) {
        sidebar.classList.add("show");
        sidebarOverlay.classList.add("show");
      } else {
        sidebar.classList.remove("show");
        sidebarOverlay.classList.remove("show");
      }
    };

    if (mobileToggle) mobileToggle.addEventListener("click", () => toggleSidebar(true));
    if (closeToggle)  closeToggle.addEventListener("click", () => toggleSidebar(false));
    if (sidebarOverlay) sidebarOverlay.addEventListener("click", () => toggleSidebar(false));

    // Usuario topbar
    fetch("auth/getUser.php")
      .then(res => res.json())
      .then(data => {
        const topName  = document.getElementById("topUserName");
        const topEmail = document.getElementById("topUserEmail");
        const topRole  = document.getElementById("topUserRole");

        if (data.ok) {
          if (topName)  topName.textContent  = data.user?.name  ?? "Usuario";
          if (topEmail) topEmail.textContent = data.user?.email ?? "Email";
          if (topRole)  topRole.textContent  = data.user?.role_name ?? "Público";
        } else {
          if (topName)  topName.textContent  = "Invitado";
          if (topEmail) topEmail.textContent = "";
          if (topRole)  topRole.textContent  = "Público";
        }
      })
      .catch(err => console.error("Error cargando usuario:", err));

    // Logout
    const logoutBtn = document.getElementById("logoutBtn");
    if (logoutBtn) {
      logoutBtn.addEventListener("click", () => {
        fetch("auth/logout.php", { method: "POST" })
          .then(() => window.location.href = "login.htm")
          .catch(err => console.error("Error cerrando sesión:", err));
      });
    }
  });

// Inicializar mapa una sola vez
let map, markerGroup;

function initMap() {
  map = L.map('map').setView([-33.45, -70.66], 10); // vista inicial Santiago
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap'
  }).addTo(map);
}

if (inst.ubicaciones) {
  inst.ubicaciones.split(',').forEach(ub => {
    const coords = ub.split(' ').join('').split(',').map(Number);
    if (coords.length === 2 && !isNaN(coords[0]) && !isNaN(coords[1])) {
      L.marker(coords).addTo(map)
        .bindPopup(inst.nombre_institucion ?? "Institución");
    }
  });
}


  </script>



</body>
</html>
