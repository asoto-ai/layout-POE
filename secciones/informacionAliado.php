<?php
require_once __DIR__ . '/../auth/section_guard.php';
validate_section_access('informacionAliado', $pdo);

session_start();
$user = $_SESSION['user'] ?? null;
?>

<div class="content-header">
    <h1 class="page-title">Información de Instituciones Aliadas</h1>

    <?php if ($user): ?>
        <!-- Buscador -->
        <div class="mb-3">
            <input type="text" id="buscadorInstituciones" 
                   class="form-control" 
                   placeholder="🔍 Buscar institución, comuna, responsable...">
        </div>

        <div class="row mt-3">
            <!-- Columna izquierda -->
            <div class="col-md-6">
                <!-- Contador -->
                <div id="institucionCounter" class="mb-2 fw-bold text-muted"></div>

                <!-- Ficha -->
                <div id="institucionDetalle" class="mb-3"></div>

                <!-- Navegación -->
                <div id="navegacion" class="d-flex justify-content-between">
                    <button class="btn btn-outline-secondary" id="btnPrev">
                        <i class="fas fa-chevron-left"></i> Anterior
                    </button>
                    <button class="btn btn-outline-primary" id="btnNext">
                        Siguiente <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <!-- Columna derecha -->
            <div class="col-md-6">
                <!-- Mapa -->
                <div id="map" style="height:500px; border-radius:8px;"></div>
            </div>
        </div>

        <!-- JSON con datos -->
        <script type="application/json" id="institucionesData">
        <?php
        try {
            $stmt = $pdo->prepare("
                SELECT 
                    i.id_institucion,
                    i.rut_institucion,
                    i.nombre_institucion,
                    i.direccion,
                    c.comuna,
                    ti.descripcion AS tipo_institucion,
                    tc.descripcion AS tipo_convenio,
                    ec.descripcion AS estado_contacto,
                    ecn.descripcion AS estado_convenio,
                    i.fecha_firma,
                    i.nombre_contraparte,
                    i.mail_contraparte,
                    i.telefono_contraparte,
                    i.pagina_web,
                    i.redes_sociales,
                    i.estado_relacionamiento,
                    i.ultimo_seguimiento,
                    GROUP_CONCAT(DISTINCT t.ubicacion) AS ubicaciones
                FROM user_instituciones ui
                JOIN instituciones i ON i.id_institucion = ui.institucion_id
                LEFT JOIN comuna c ON c.cod_comuna = i.cod_comuna
                LEFT JOIN tipo_institucion ti ON ti.id_tipo_institucion = i.id_tipo_institucion
                LEFT JOIN tipo_convenios tc ON tc.id_convenio = i.id_convenio
                LEFT JOIN estado_contacto ec ON ec.id_estado_contacto = i.id_estado_contacto
                LEFT JOIN estado_convenio ecn ON ecn.id_estado_convenio = i.id_estado_convenio
                LEFT JOIN gs_talleresDeportivosAlianzas t 
                       ON t.nombre_institucion = i.nombre_institucion
                WHERE ui.user_id = ?
                GROUP BY i.id_institucion
                ORDER BY i.id_institucion
            ");
            $stmt->execute([$user['id']]);
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC), JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            echo "[]";
        }
        ?>
        </script>

    <?php else: ?>
        <div class="alert alert-warning mt-3">
            No hay usuario logueado en la sesión.
        </div>
    <?php endif; ?>
</div>
