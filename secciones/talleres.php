
<?php
require_once __DIR__ . '/../auth/section_guard.php';
validate_section_access('talleres', $pdo);
?>

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
