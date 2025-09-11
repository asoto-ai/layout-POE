<?php
require_once __DIR__ . '/../auth/section_guard.php';
validate_section_access('descargas', $pdo);
?>

<div class="content-header">
    <h1 class="page-title">Material Descargable</h1>
    <p class="page-subtitle">Recursos, manuales y documentos para entrenadores y familias</p>
</div>

<!-- Categorías de archivos -->
<div class="row mb-4">
    <div class="col-12">
        <ul class="nav nav-pills" id="material-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#manuales">
                    <i class="fas fa-book me-2"></i>Manuales
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#formularios">
                    <i class="fas fa-file-alt me-2"></i>Formularios
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#multimedia">
                    <i class="fas fa-video me-2"></i>Multimedia
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#recursos">
                    <i class="fas fa-tools me-2"></i>Recursos
                </button>
            </li>
        </ul>
    </div>
</div>

<!-- Tab Content -->
<div class="tab-content" id="material-content">
    <!-- Manuales -->
    <div class="tab-pane fade show active" id="manuales">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card download-card">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="file-icon text-danger me-3">
                                <i class="fas fa-file-pdf fa-3x"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="card-title">Manual del Entrenador</h6>
                                <p class="card-text small text-muted">Guía completa para entrenadores de deportes adaptados</p>
                                <div class="file-info">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>Actualizado: 15 Jul 2024<br>
                                        <i class="fas fa-weight me-1"></i>2.4 MB<br>
                                        <i class="fas fa-download me-1"></i>1,240 descargas
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary btn-sm me-2">
                                <i class="fas fa-download me-1"></i>Descargar
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-eye me-1"></i>Vista previa
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card download-card">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="file-icon text-danger me-3">
                                <i class="fas fa-file-pdf fa-3x"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="card-title">Guía para Familias</h6>
                                <p class="card-text small text-muted">Apoyo y orientación para familias de atletas</p>
                                <div class="file-info">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>Actualizado: 10 Jul 2024<br>
                                        <i class="fas fa-weight me-1"></i>1.8 MB<br>
                                        <i class="fas fa-download me-1"></i>856 descargas
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary btn-sm me-2">
                                <i class="fas fa-download me-1"></i>Descargar
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-eye me-1"></i>Vista previa
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card download-card">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="file-icon text-danger me-3">
                                <i class="fas fa-file-pdf fa-3x"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="card-title">Reglamentos Deportivos</h6>
                                <p class="card-text small text-muted">Normativas oficiales para competencias</p>
                                <div class="file-info">
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>Actualizado: 5 Jul 2024<br>
                                        <i class="fas fa-weight me-1"></i>3.2 MB<br>
                                        <i class="fas fa-download me-1"></i>452 descargas
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary btn-sm me-2">
                                <i class="fas fa-download me-1"></i>Descargar
                            </button>
                            <button class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-eye me-1"></i>Vista previa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Formularios -->
    <div class="tab-pane fade" id="formularios">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card download-card">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="file-icon text-success me-3">
                                <i class="fas fa-file-excel fa-3x"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="card-title">Inscripción de Atletas</h6>
                                <p class="card-text small text-muted">Formulario de registro para nuevos atletas</p>
                                <div class="file-info">
                                    <small class="text-muted">
                                        <i class="fas fa-weight me-1"></i>156 KB<br>
                                        <i class="fas fa-download me-1"></i>324 descargas
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-success btn-sm me-2">
                                <i class="fas fa-download me-1"></i>Descargar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card download-card">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="file-icon text-primary me-3">
                                <i class="fas fa-file-word fa-3x"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="card-title">Autorización Médica</h6>
                                <p class="card-text small text-muted">Documento de autorización para participar</p>
                                <div class="file-info">
                                    <small class="text-muted">
                                        <i class="fas fa-weight me-1"></i>89 KB<br>
                                        <i class="fas fa-download me-1"></i>267 descargas
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary btn-sm me-2">
                                <i class="fas fa-download me-1"></i>Descargar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Multimedia -->
    <div class="tab-pane fade" id="multimedia">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card download-card">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="file-icon text-info me-3">
                                <i class="fas fa-video fa-3x"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="card-title">Técnicas de Natación</h6>
                                <p class="card-text small text-muted">Video instructivo para entrenadores</p>
                                <div class="file-info">
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>45 minutos<br>
                                        <i class="fas fa-weight me-1"></i>156 MB<br>
                                        <i class="fas fa-download me-1"></i>89 descargas
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-info btn-sm me-2">
                                <i class="fas fa-play me-1"></i>Reproducir
                            </button>
                            <button class="btn btn-outline-info btn-sm">
                                <i class="fas fa-download me-1"></i>Descargar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recursos -->
    <div class="tab-pane fade" id="recursos">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card download-card">
                    <div class="card-body">
                        <div class="d-flex align-items-start">
                            <div class="file-icon text-warning me-3">
                                <i class="fas fa-images fa-3x"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="card-title">Kit de Logos Oficiales</h6>
                                <p class="card-text small text-muted">Logotipos para uso institucional</p>
                                <div class="file-info">
                                    <small class="text-muted">
                                        <i class="fas fa-weight me-1"></i>12.3 MB<br>
                                        <i class="fas fa-download me-1"></i>156 descargas
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-warning btn-sm me-2">
                                <i class="fas fa-download me-1"></i>Descargar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
