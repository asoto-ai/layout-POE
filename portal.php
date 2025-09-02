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
                <li class="nav-item">
                    <a class="nav-link active" href="#" data-section="inicio">
                        <i class="fas fa-home"></i>
                        <span>Página de inicio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="talleres">
                        <i class="fas fa-tools"></i>
                        <span>Talleres</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="eventos">
                        <i class="fas fa-calendar-alt"></i>
                        <span>Eventos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="capacitaciones">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Capacitaciones</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="actividades">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Registro de actividades</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-section="descargas">
                        <i class="fas fa-download"></i>
                        <span>Material descargable</span>
                    </a>
                </li>
                <li class="nav-item mt-auto">
                    <a class="nav-link" href="#" data-section="settings">
                        <i class="fas fa-cog"></i>
                        <span>Configuración</span>
                    </a>
                </li>
            </ul>
        </div>

        <!--<div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="user-details">
                    <div class="user-name">Usuario</div>
                    <div class="user-email">Email</div>
                    <div class="user-role">Role</div>
                </div>
            </div>
        </div>-->
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navigation -->
        <header class="top-navbar">
            <div class="navbar-content">
                <button class="sidebar-toggle d-lg-none" id="mobileToggle">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="navbar-search">
                    <div class="search-box">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Buscar...">
                    </div>
                </div>

                <div class="navbar-actions d-flex align-items-center">
                    <!-- Bloque de usuario (IZQUIERDA del botón de notificación) -->
                    <div class="topbar-user d-flex align-items-center me-3">
                        <div class="topbar-avatar me-2">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <div class="user-details text-end">
                            <div class="user-name" id="topUserName">Usuario</div>
                            <div class="user-email" id="topUserEmail">Email</div>
                            <div class="user-role" id="topUserRole">Role</div>
                        </div>
                    </div>

                    <!-- Botones (DERECHA) -->
                    <button class="btn btn-outline-primary btn-sm me-2" aria-label="Notificaciones">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger">3</span>
                    </button>
                    <button class="btn btn-outline-primary btn-sm" aria-label="Mensajes">
                        <i class="fas fa-envelope"></i>
                    </button>
                    <!-- Botón de logout -->
<button id="logoutBtn" class="btn btn-outline-danger btn-sm" aria-label="Cerrar sesión">
    <i class="fas fa-sign-out-alt"></i>
</button>

                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="content-area">
            <div id="content"></div>
        </main>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JavaScript -->
    <script src="static/js/main.js"></script>

    <!-- App JS -->
    <script>
  // Cargar secciones
  function loadSection(section) {
    fetch(`secciones/${section}.php`)
      .then(response => {
        if (!response.ok) throw new Error("Error al cargar " + section);
        return response.text();
      })
      .then(html => {
        document.getElementById("content").innerHTML = html;

        // Marcar activa la sección en el menú
        document.querySelectorAll(".sidebar-menu .nav-link").forEach(link => {
          link.classList.remove("active");
          if (link.dataset.section === section) {
            link.classList.add("active");
          }
        });
      })
      .catch(error => {
        document.getElementById("content").innerHTML =
          `<div class="alert alert-danger">No se pudo cargar la sección ${section}</div>`;
        console.error(error);
      });
  }

  document.addEventListener("DOMContentLoaded", () => {
    // Página inicial
    loadSection("inicio");

    // Clicks en el sidebar
    document.querySelectorAll(".sidebar-menu .nav-link").forEach(link => {
      link.addEventListener("click", e => {
        e.preventDefault();
        loadSection(link.dataset.section);
      });
    });

    // Mostrar/Ocultar sidebar en móvil
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

    // ===== Cargar info de usuario (TOPBAR SOLAMENTE) =====
    fetch("auth/getUser.php")
      .then(res => res.json())
      .then(data => {
        const roleLabel = (r) =>
          r === "admin" ? "Administrador" :
          r === "ally"  ? "Aliado" :
                          "Público";

        const topName  = document.getElementById("topUserName");
        const topEmail = document.getElementById("topUserEmail");
        const topRole  = document.getElementById("topUserRole");

        if (data.ok) {
          if (topName)  topName.textContent  = data.user?.name  ?? "Usuario";
          if (topEmail) topEmail.textContent = data.user?.email ?? "Email";
          //if (topRole)  topRole.textContent  = roleLabel(data.user?.role);
          if (topRole)  topRole.textContent  = data.user?.role_name ?? "Público";
        } else {
          if (topName)  topName.textContent  = "Invitado";
          if (topEmail) topEmail.textContent = "";
          if (topRole)  topRole.textContent  = "Público";
        }
      })
      .catch(err => console.error("Error cargando usuario:", err));
  });

      // ===== Logout =====
    const logoutBtn = document.getElementById("logoutBtn");
    if (logoutBtn) {
      logoutBtn.addEventListener("click", () => {
        fetch("auth/logout.php", { method: "POST" })
          .then(() => {
            window.location.href = "login.htm"; // redirige al login
          })
          .catch(err => console.error("Error cerrando sesión:", err));
      });
    }

</script>

</body>
</html>
