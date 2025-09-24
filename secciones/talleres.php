<?php
require_once __DIR__ . '/../auth/section_guard.php';
validate_section_access('talleres', $pdo);

session_start();
$user = $_SESSION['user'] ?? null;
?>

<div class="content-header">
    <h1 class="page-title">Talleres Deportivos Asociados</h1>

    <?php if ($user): ?>

        <?php
        // === KPIs resumen ===
        $kpiStmt = $pdo->prepare("
            SELECT 
                COUNT(*) AS total_talleres,
                SUM(CASE WHEN estado_intervencion = 'Activo' THEN 1 ELSE 0 END) AS activos,
                SUM(CASE WHEN estado_intervencion = 'Pendiente' THEN 1 ELSE 0 END) AS pendientes,
                SUM(num_deportistas) AS total_deportistas,
                SUM(num_monitores) AS total_monitores
            FROM gs_talleresDeportivosAlianzas t
            INNER JOIN user_instituciones ui 
                ON ui.institucion_id = (
                    SELECT id_institucion 
                    FROM instituciones 
                    WHERE nombre_institucion = t.nombre_institucion 
                    LIMIT 1
                )
            WHERE ui.user_id = ?
        ");
        $kpiStmt->execute([$user['id']]);
        $kpis = $kpiStmt->fetch(PDO::FETCH_ASSOC);
        ?>

<!-- KPIs -->
<div class="row row-cols-5 g-3 mt-3 text-center">
    <div class="col d-flex">
        <div class="card shadow-sm border-0 w-100 h-100">
            <div class="card-body d-flex flex-column justify-content-center">
                <i class="fas fa-dumbbell text-primary fa-2x mb-2"></i>
                <h4 class="mb-0 text-primary"><?= $kpis['total_talleres'] ?? 0 ?></h4>
                <small class="text-muted">Total Talleres</small>
            </div>
        </div>
    </div>

    <div class="col d-flex">
        <div class="card shadow-sm border-0 w-100 h-100">
            <div class="card-body d-flex flex-column justify-content-center">
                <i class="fas fa-play-circle text-success fa-2x mb-2"></i>
                <h4 class="mb-0 text-success"><?= $kpis['activos'] ?? 0 ?></h4>
                <small class="text-muted">Activos</small>
            </div>
        </div>
    </div>

    <div class="col d-flex">
        <div class="card shadow-sm border-0 w-100 h-100">
            <div class="card-body d-flex flex-column justify-content-center">
                <i class="fas fa-clock text-warning fa-2x mb-2"></i>
                <h4 class="mb-0 text-warning"><?= $kpis['pendientes'] ?? 0 ?></h4>
                <small class="text-muted">Pendientes</small>
            </div>
        </div>
    </div>

    <div class="col d-flex">
        <div class="card shadow-sm border-0 w-100 h-100">
            <div class="card-body d-flex flex-column justify-content-center">
                <i class="fas fa-users text-info fa-2x mb-2"></i>
                <h4 class="mb-0 text-info"><?= $kpis['total_deportistas'] ?? 0 ?></h4>
                <small class="text-muted">Deportistas</small>
            </div>
        </div>
    </div>

    <div class="col d-flex">
        <div class="card shadow-sm border-0 w-100 h-100">
            <div class="card-body d-flex flex-column justify-content-center">
                <i class="fas fa-chalkboard-teacher text-dark fa-2x mb-2"></i>
                <h4 class="mb-0 text-dark"><?= $kpis['total_monitores'] ?? 0 ?></h4>
                <small class="text-muted">Monitores</small>
            </div>
        </div>
    </div>
</div>


        <!-- Grilla de talleres -->
        <div class="card mt-3">
            <div class="card-body table-responsive">
                <table id="talleresTable" 
                       class="table table-striped table-bordered datatable align-middle" 
                       style="width:100%;">
                    <thead class="table-light">
                        <tr>
                            <th>Institución</th>
                            <th>Deporte</th>
                            <th>Lugar</th>
                            <th>Días</th>
                            <th>Hora</th>
                            <th>Estado Intervención</th>
                            <th>Monitores</th>
                            <th>Deportistas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        try {
                            $stmt = $pdo->prepare("
                                SELECT 
                                    t.nombre_institucion,
                                    t.deporte,
                                    t.lugar,
                                    t.dias_taller,
                                    t.hora,
                                    t.estado_intervencion,
                                    t.num_monitores,
                                    t.num_deportistas
                                FROM gs_talleresDeportivosAlianzas t
                                INNER JOIN user_instituciones ui 
                                    ON ui.institucion_id = (
                                        SELECT id_institucion 
                                        FROM instituciones 
                                        WHERE nombre_institucion = t.nombre_institucion 
                                        LIMIT 1
                                    )
                                WHERE ui.user_id = ?
                                ORDER BY t.nombre_institucion, t.codigo_taller
                            ");
                            $stmt->execute([$user['id']]);
                            $talleres = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($talleres as $row) {
                                $estado = $row['estado_intervencion'] ?? '';
                                $estadoColors = [
                                    'Activo' => 'success',
                                    'Pendiente' => 'warning',
                                    'Finalizado' => 'secondary'
                                ];
                                $estadoBadge = $estado ? "<span class='badge bg-".($estadoColors[$estado] ?? 'secondary')."'>$estado</span>" : '';

                                echo "<tr>
                                    <td class='text-truncate' style='max-width:180px;' title='".htmlspecialchars($row['nombre_institucion'])."'>".htmlspecialchars($row['nombre_institucion'])."</td>
                                    <td>".htmlspecialchars($row['deporte'] ?? '')."</td>
                                    <td class='text-truncate' style='max-width:150px;' title='".htmlspecialchars($row['lugar'])."'>".htmlspecialchars($row['lugar'] ?? '')."</td>
                                    <td>".htmlspecialchars($row['dias_taller'] ?? '')."</td>
                                    <td>".htmlspecialchars($row['hora'] ?? '')."</td>
                                    <td>$estadoBadge</td>
                                    <td class='text-center'><span class='badge bg-info'>".($row['num_monitores'] ?? 0)."</span></td>
                                    <td class='text-center'><span class='badge bg-primary'>".($row['num_deportistas'] ?? 0)."</span></td>
                                </tr>";
                            }
                        } catch (Exception $e) {
                            echo "<tr><td colspan='8' class='text-danger text-center'>Error: ".htmlspecialchars($e->getMessage())."</td></tr>";
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
