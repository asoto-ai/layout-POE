<?php
require_once __DIR__ . '/../auth/section_guard.php';
validate_section_access('eventos', $pdo);
?>

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
