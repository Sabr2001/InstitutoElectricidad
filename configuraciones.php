<?php
include "shared/auth.php";
include "shared/header.php";
loginRequerido();
?>

<main class="flex-grow-1">
    <div class="row">
        <?php if ($_SESSION["correo"] == 'admin@ice.go.cr'): ?>
            <?php include "shared/aside.php"; ?>
        <?php endif; ?>

        <section class="col">
            <div class="container mt-2">
                <h1 class="text-center mt-4 mb-4">
                    Configuraciones Globales
                    <i class="fas fa-globe-americas"></i>
                </h1>

                <div class="container-fluid">
                    <div class="d-flex justify-content-end mb-3">
                        <button id="btnNuevo" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalConfig">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                    </div>

                    <!-- Tabla configs -->
                    <table class="table table-striped table-hover align-middle" id="tabla-configs">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre Variable (var_name)</th>
                                <th>Valor Numérico (valor_num)</th>
                                <th>Unidad</th>
                                <th>Estado</th> 
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="indexConfigs">
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</main>

<!-- Modal CRUD Config -->
<div class="modal fade" id="modalConfig" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crudModalLabel">Nueva Configuración</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="crudConfig">
                    <!-- id se usa para editar -->
                    <input type="hidden" id="id" name="id" value="">

                    <div class="mb-3">
                        <label for="var_name" class="form-label">Nombre de la variable (var_name)</label>
                        <input name="var_name" type="text" class="form-control" id="var_name" placeholder="EJ: VAR_GENERICA" required
                        >
                    </div>

                    <div class="mb-3">
                        <label for="valor_num" class="form-label">Valor numérico (valor_num)</label>
                        <input name="valor_num" type="number" step="0.01" class="form-control" 
                            id="valor_num" placeholder="Ej: 1, 10.50, 0.75" required>
                    </div>

                    <div class="mb-3">
                        <label for="unidad" class="form-label">Unidad</label>
                        <input name="unidad" type="text" class="form-control" id="unidad" placeholder="Ej: kWh, días, %, colones"
                        >
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnGuardar" type="button" class="btn btn-primary">Guardar</button>
                <button id="cancelar" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>

<div id="loaderOverlay">
    <div class="spinner-border text-light" role="status">
        <span class="visually-hidden">Cargando...</span>
    </div>
</div>

<?php include "shared/footer.php"; ?>
