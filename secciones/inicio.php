<?php
require_once __DIR__ . '/../auth/section_guard.php';
validate_section_access('inicio', $pdo);

session_start();
$user = $_SESSION['user'] ?? null;
?>

<div class="content-header">
    <h1 class="page-title">Tus Alianzas Institucionales</h1>

    <?php if ($user): ?>

        <?php
        // === KPIs resumen ===
        $kpiStmt = $pdo->prepare("
            SELECT ecn.descripcion AS estado_convenio, COUNT(*) AS total
            FROM user_instituciones ui
            JOIN instituciones i ON i.id_institucion = ui.institucion_id
            LEFT JOIN estado_convenio ecn ON ecn.id_estado_convenio = i.id_estado_convenio
            WHERE ui.user_id = ?
            GROUP BY ecn.descripcion
        ");
        $kpiStmt->execute([$user['id']]);
        $kpis = $kpiStmt->fetchAll(PDO::FETCH_KEY_PAIR);

        $map = [
            'Activo' => ['color' => 'success', 'icon' => 'fa-check-circle'],
            'En proceso de firma' => ['color' => 'warning', 'icon' => 'fa-file-signature'],
            'Sin respuesta' => ['color' => 'secondary', 'icon' => 'fa-envelope-open-text'],
            'Pausado' => ['color' => 'dark', 'icon' => 'fa-pause-circle'],
            'Sin avances' => ['color' => 'secondary', 'icon' => 'fa-hourglass-half'],
            'Vencido' => ['color' => 'danger', 'icon' => 'fa-times-circle']
        ];
        ?>

<!-- KPIs -->
<div class="row row-cols-<?= count($kpis) ?> g-3 mt-3 text-center">
    <?php foreach ($kpis as $estado => $total): 
        $conf = $map[$estado] ?? ['color' => 'secondary', 'icon' => 'fa-circle'];
    ?>
        <div class="col d-flex">
            <div class="card shadow-sm border-0 w-100 h-100">
                <div class="card-body d-flex flex-column justify-content-center">
                    <i class="fas <?= $conf['icon'] ?> text-<?= $conf['color'] ?> fa-2x mb-2"></i>
                    <h4 class="mb-0 text-<?= $conf['color'] ?>"><?= $total ?></h4>
                    <small class="text-muted"><?= htmlspecialchars($estado) ?></small>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>



        <!-- Grilla de instituciones -->
        <div class="card mt-3">
            <div class="card-body">
                <table id="institucionesTable" class="table table-striped table-bordered datatable" style="width:100%;">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Institución</th>
                            <th>Tipo</th>
                            <th>Convenio</th>
                            <th>Estado Contacto</th>
                            <th>Estado Convenio</th>
                            <th>Comuna</th>
                            <th>Fecha Asociación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        try {
                            $stmt = $pdo->prepare("
                                SELECT 
                                    i.id_institucion,
                                    i.nombre_institucion,
                                    ti.descripcion AS tipo_institucion,
                                    tc.descripcion AS convenio,
                                    ec.descripcion AS estado_contacto,
                                    ecn.descripcion AS estado_convenio,
                                    c.comuna,
                                    ui.fecha_asociacion
                                FROM user_instituciones ui
                                JOIN instituciones i ON i.id_institucion = ui.institucion_id
                                LEFT JOIN tipo_institucion ti ON ti.id_tipo_institucion = i.id_tipo_institucion
                                LEFT JOIN tipo_convenios tc ON tc.id_convenio = i.id_convenio
                                LEFT JOIN estado_contacto ec ON ec.id_estado_contacto = i.id_estado_contacto
                                LEFT JOIN estado_convenio ecn ON ecn.id_estado_convenio = i.id_estado_convenio
                                LEFT JOIN comuna c ON c.cod_comuna = i.cod_comuna
                                WHERE ui.user_id = ?
                                ORDER BY i.id_institucion
                            ");
                            $stmt->execute([$user['id']]);
                            $instituciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            function renderBadge($texto) {
                                $map = [
                                    'Activo' => 'success',
                                    'En proceso de firma' => 'warning',
                                    'Sin respuesta' => 'secondary',
                                    'Pausado' => 'dark',
                                    'Sin avances' => 'secondary',
                                    'Vencido' => 'danger',
                                    'Hecho' => 'success',
                                    'Pendiente' => 'warning'
                                ];
                                $color = $map[$texto] ?? 'secondary';
                                return $texto ? "<span class='badge bg-{$color}'>".htmlspecialchars($texto)."</span>" : '';
                            }

                            if ($instituciones) {
                                foreach ($instituciones as $inst) {
                                    echo "<tr>
                                            <td>".htmlspecialchars($inst['id_institucion'])."</td>
                                            <td>".htmlspecialchars($inst['nombre_institucion'])."</td>
                                            <td>".htmlspecialchars($inst['tipo_institucion'] ?? '')."</td>
                                            <td>".htmlspecialchars($inst['convenio'] ?? '')."</td>
                                            <td>".renderBadge($inst['estado_contacto'] ?? '')."</td>
                                            <td>".renderBadge($inst['estado_convenio'] ?? '')."</td>
                                            <td>".htmlspecialchars($inst['comuna'] ?? '')."</td>
                                            <td>".htmlspecialchars($inst['fecha_asociacion'] ?? '')."</td>
                                          </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8' class='text-center'>No hay instituciones asociadas</td></tr>";
                            }
                        } catch (Exception $e) {
                            echo "<tr><td colspan='8' class='text-danger text-center'>Error al cargar: ".htmlspecialchars($e->getMessage())."</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    <?php else: ?>
        <div class="alert alert-warning mt-3">
            No hay usuario logueado en la sesión.
        </div>
    <?php endif; ?>
</div>
