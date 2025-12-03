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

            <div class="container mt-4">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="fw-bold">Administración de Lecturas</h3>
                    <button class="btn btn-primary" id="btnNuevoLectura">
                        <i class="fa fa-plus"></i> Agregar Lectura
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-sm" id="tablaLecturas">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>ID</th>
                                <th>Periodo</th>
                                <th>NISE</th>
                                <th>Consumo kWh</th>
                                <th>Fecha Lectura</th>
                                <th>Fecha Corte</th>
                                <th>Tarifa</th>
                                <th>Provincia</th>
                                <th>Observaciones</th>
                                <th class="text-nowrap">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-center"></tbody>
                    </table>
                </div>

            </div>

        </section>
    </div>
</main>

<!-- MODAL -->
<div class="modal fade" id="modalLectura" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-semibold">Gestión de Lectura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formLectura">
                    <input type="hidden" id="editId">

                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Periodo*</label>
                            <input type="date" id="periodo" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">NISE*</label>
                            <input type="number" id="nise" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Consumo kWh*</label>
                            <input type="number" step="0.01" id="consumo_kWh" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Fecha de lectura*</label>
                            <input type="datetime-local" id="fecha_lectura" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Fecha de corte</label>
                            <input type="date" id="fecha_corte" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tarifa*</label>
                            <select id="tarifa_id" class="form-control" required>
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="1">HOGAR</option>
                                <option value="2">INDUSTRIAL</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Provincia</label>
                            <select id="provincia_id" class="form-control">
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="1">San José</option>
                                <option value="2">Alajuela</option>
                                <option value="3">Cartago</option>
                                <option value="4">Heredia</option>
                                <option value="5">Guanacaste</option>
                                <option value="6">Puntarenas</option>
                                <option value="7">Limón</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Observaciones</label>
                            <input type="text" id="observaciones" class="form-control" maxlength="200">
                        </div>

                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success" id="guardarLectura">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>

        </div>
    </div>
</div>

<?php include "shared/footer.php"; ?>

<script src="js/admin-lecturas.js"></script>
