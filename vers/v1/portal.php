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
        
        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="user-details">
                    <div class="user-name">Usuario Admin</div>
                    <div class="user-role">Administrador</div>
                </div>
            </div>
        </div>
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
                
                <div class="navbar-actions">
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger">3</span>
                    </button>
                    <button class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-envelope"></i>
                    </button>
                </div>
            </div>
        </header>
        
        <!-- Content Area -->
        <main class="content-area">
            <!-- Inicio Section -->
            <div id="inicio" class="content-section active">
                <div class="content-header">
                    <h1 class="page-title">Inicio</h1>
                    <p class="page-subtitle">Transformamos vidas a través del deporte</p>
                </div>
                
                <div class="row mb-4">
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-icon bg-primary">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-content">
                                <h3>248</h3>
                                <p>Atletas Participando</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-icon bg-success">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                            <div class="stat-content">
                                <h3>42</h3>
                                <p>Programas Inclusivos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-icon bg-warning">
                                <i class="fas fa-tasks"></i>
                            </div>
                            <div class="stat-content">
                                <h3>156</h3>
                                <p>Entrenamientos</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 mb-3">
                        <div class="stat-card">
                            <div class="stat-icon bg-info">
                                <i class="fas fa-file-alt"></i>
                            </div>
                            <div class="stat-content">
                                <h3>1,240</h3>
                                <p>Recursos Educativos</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-8 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Actividad Reciente</h5>
                            </div>
                            <div class="card-body">
                                <div class="activity-item">
                                    <div class="activity-icon bg-primary">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <div class="activity-content">
                                        <p><strong>Nuevo proyecto creado:</strong> Sistema de Gestión</p>
                                        <small class="text-muted">Hace 2 horas</small>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon bg-success">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="activity-content">
                                        <p><strong>Tarea completada:</strong> Revisión de código</p>
                                        <small class="text-muted">Hace 4 horas</small>
                                    </div>
                                </div>
                                <div class="activity-item">
                                    <div class="activity-icon bg-info">
                                        <i class="fas fa-upload"></i>
                                    </div>
                                    <div class="activity-content">
                                        <p><strong>Documento subido:</strong> Manual de usuario</p>
                                        <small class="text-muted">Hace 6 horas</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Próximas Reuniones</h5>
                            </div>
                            <div class="card-body">
                                <div class="meeting-item">
                                    <div class="meeting-time">
                                        <span class="time">10:00</span>
                                        <span class="date">Hoy</span>
                                    </div>
                                    <div class="meeting-details">
                                        <h6>Reunión de Equipo</h6>
                                        <p class="text-muted">Sala de conferencias A</p>
                                    </div>
                                </div>
                                <div class="meeting-item">
                                    <div class="meeting-time">
                                        <span class="time">14:30</span>
                                        <span class="date">Hoy</span>
                                    </div>
                                    <div class="meeting-details">
                                        <h6>Revisión de Proyecto</h6>
                                        <p class="text-muted">Virtual</p>
                                    </div>
                                </div>
                                <div class="meeting-item">
                                    <div class="meeting-time">
                                        <span class="time">09:00</span>
                                        <span class="date">Mañana</span>
                                    </div>
                                    <div class="meeting-details">
                                        <h6>Presentación Cliente</h6>
                                        <p class="text-muted">Sala de conferencias B</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Talleres Section -->
            <div id="talleres" class="content-section">
                <div class="content-header">
                    <h1 class="page-title">Proyectos</h1>
                    <p class="page-subtitle">Gestión de proyectos y tareas</p>
                </div>
                
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="project-card">
                            <div class="project-header">
                                <h5>Sistema de Gestión</h5>
                                <span class="badge bg-success">Activo</span>
                            </div>
                            <p class="project-description">Desarrollo de sistema integral de gestión empresarial</p>
                            <div class="project-progress">
                                <div class="progress-label">
                                    <span>Progreso</span>
                                    <span>75%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-success" style="width: 75%"></div>
                                </div>
                            </div>
                            <div class="project-footer">
                                <div class="project-team">
                                    <i class="fas fa-users"></i>
                                    <span>5 miembros</span>
                                </div>
                                <div class="project-deadline">
                                    <i class="fas fa-calendar"></i>
                                    <span>15 días</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="project-card">
                            <div class="project-header">
                                <h5>App Móvil</h5>
                                <span class="badge bg-warning">En desarrollo</span>
                            </div>
                            <p class="project-description">Aplicación móvil para clientes externos</p>
                            <div class="project-progress">
                                <div class="progress-label">
                                    <span>Progreso</span>
                                    <span>45%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-warning" style="width: 45%"></div>
                                </div>
                            </div>
                            <div class="project-footer">
                                <div class="project-team">
                                    <i class="fas fa-users"></i>
                                    <span>3 miembros</span>
                                </div>
                                <div class="project-deadline">
                                    <i class="fas fa-calendar"></i>
                                    <span>30 días</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="project-card">
                            <div class="project-header">
                                <h5>Portal Web</h5>
                                <span class="badge bg-info">Planificación</span>
                            </div>
                            <p class="project-description">Renovación completa del portal corporativo</p>
                            <div class="project-progress">
                                <div class="progress-label">
                                    <span>Progreso</span>
                                    <span>20%</span>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-info" style="width: 20%"></div>
                                </div>
                            </div>
                            <div class="project-footer">
                                <div class="project-team">
                                    <i class="fas fa-users"></i>
                                    <span>8 miembros</span>
                                </div>
                                <div class="project-deadline">
                                    <i class="fas fa-calendar"></i>
                                    <span>60 días</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Eventos Section -->
            <div id="eventos" class="content-section">
                <div class="content-header">
                    <h1 class="page-title">Equipo</h1>
                    <p class="page-subtitle">Miembros del equipo y organización</p>
                </div>
                
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="team-card">
                            <div class="team-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="team-info">
                                <h5>Ana García</h5>
                                <p class="team-role">Directora de Proyecto</p>
                                <p class="team-department">Desarrollo</p>
                            </div>
                            <div class="team-actions">
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-envelope"></i>
                                </button>
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-phone"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="team-card">
                            <div class="team-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="team-info">
                                <h5>Carlos Ruiz</h5>
                                <p class="team-role">Desarrollador Senior</p>
                                <p class="team-department">Desarrollo</p>
                            </div>
                            <div class="team-actions">
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-envelope"></i>
                                </button>
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-phone"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="team-card">
                            <div class="team-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <div class="team-info">
                                <h5>María López</h5>
                                <p class="team-role">Diseñadora UX/UI</p>
                                <p class="team-department">Diseño</p>
                            </div>
                            <div class="team-actions">
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-envelope"></i>
                                </button>
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-phone"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Capacitaciones Section -->
            <div id="capacitaciones" class="content-section">
                <div class="content-header">
                    <h1 class="page-title">Reportes</h1>
                    <p class="page-subtitle">Análisis y métricas del sistema</p>
                </div>
                
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Rendimiento Mensual</h5>
                            </div>
                            <div class="card-body">
                                <div class="metric">
                                    <h3>92%</h3>
                                    <p>Eficiencia del equipo</p>
                                </div>
                                <div class="metric">
                                    <h3>156</h3>
                                    <p>Tareas completadas</p>
                                </div>
                                <div class="metric">
                                    <h3>24</h3>
                                    <p>Horas promedio por tarea</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Estado de Proyectos</h5>
                            </div>
                            <div class="card-body">
                                <div class="metric">
                                    <h3>12</h3>
                                    <p>Proyectos activos</p>
                                </div>
                                <div class="metric">
                                    <h3>8</h3>
                                    <p>Proyectos completados</p>
                                </div>
                                <div class="metric">
                                    <h3>3</h3>
                                    <p>Proyectos en pausa</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Registro de actividades Section -->
            <div id="actividades" class="content-section">
                <div class="content-header">
                    <h1 class="page-title">Documentos</h1>
                    <p class="page-subtitle">Gestión de archivos y documentos</p>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <div class="document-item">
                            <div class="document-icon text-danger">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="document-info">
                                <h6>Manual de Usuario v2.0</h6>
                                <p class="text-muted">Actualizado hace 2 días • 2.4 MB</p>
                            </div>
                            <div class="document-actions">
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-share"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="document-item">
                            <div class="document-icon text-success">
                                <i class="fas fa-file-excel"></i>
                            </div>
                            <div class="document-info">
                                <h6>Reporte Financiero Q3</h6>
                                <p class="text-muted">Actualizado hace 1 semana • 856 KB</p>
                            </div>
                            <div class="document-actions">
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-share"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="document-item">
                            <div class="document-icon text-primary">
                                <i class="fas fa-file-word"></i>
                            </div>
                            <div class="document-info">
                                <h6>Propuesta de Proyecto</h6>
                                <p class="text-muted">Actualizado hace 3 días • 1.2 MB</p>
                            </div>
                            <div class="document-actions">
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-download"></i>
                                </button>
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-share"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Material descargable Section -->
            <div id="descargas" class="content-section">
                <div class="content-header">
                    <h1 class="page-title">Calendario</h1>
                    <p class="page-subtitle">Eventos y reuniones programadas</p>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <div class="event-item">
                            <div class="event-date">
                                <span class="day">28</span>
                                <span class="month">JUL</span>
                            </div>
                            <div class="event-details">
                                <h6>Reunión de Planificación</h6>
                                <p class="text-muted">10:00 AM - Sala de conferencias A</p>
                            </div>
                        </div>
                        
                        <div class="event-item">
                            <div class="event-date">
                                <span class="day">29</span>
                                <span class="month">JUL</span>
                            </div>
                            <div class="event-details">
                                <h6>Presentación de Resultados</h6>
                                <p class="text-muted">2:00 PM - Virtual</p>
                            </div>
                        </div>
                        
                        <div class="event-item">
                            <div class="event-date">
                                <span class="day">30</span>
                                <span class="month">JUL</span>
                            </div>
                            <div class="event-details">
                                <h6>Capacitación del Equipo</h6>
                                <p class="text-muted">9:00 AM - Sala de capacitación</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Settings Section -->
            <div id="settings" class="content-section">
                <div class="content-header">
                    <h1 class="page-title">Configuración</h1>
                    <p class="page-subtitle">Ajustes del sistema y preferencias</p>
                </div>
                
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Perfil de Usuario</h5>
                            </div>
                            <div class="card-body">
                                <form>
                                    <div class="mb-3">
                                        <label class="form-label">Nombre completo</label>
                                        <input type="text" class="form-control" value="Usuario Admin">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" value="admin@empresa.com">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Departamento</label>
                                        <select class="form-control">
                                            <option>Administración</option>
                                            <option>Desarrollo</option>
                                            <option>Diseño</option>
                                            <option>Marketing</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Preferencias</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Idioma</label>
                                    <select class="form-control">
                                        <option selected>Español</option>
                                        <option>English</option>
                                        <option>Français</option>
                                    </select>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="notifications">
                                    <label class="form-check-label" for="notifications">
                                        Recibir notificaciones por email
                                    </label>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="darkMode">
                                    <label class="form-check-label" for="darkMode">
                                        Modo oscuro
                                    </label>
                                </div>
                                <button type="submit" class="btn btn-primary">Aplicar configuración</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script src="static/js/main.js"></script>
</body>
</html>