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
                    <h3 class="fw-bold">Administración de Clientes</h3>
                    <button class="btn btn-primary" id="btnNuevo">
                        <i class="fa fa-user-plus"></i> Agregar Cliente
                    </button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-sm" id="tablaClientes">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>NISE</th>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Provincia</th>
                                <th>Tarifa</th>
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
<div class="modal fade" id="modalCliente" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-semibold">Gestión de Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form id="formCliente">
                    <input type="hidden" id="editNise">

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Cédula*</label>
                            <input type="text" id="cedula" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nombre*</label>
                            <input type="text" id="nombre" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Primer Apellido*</label>
                            <input type="text" id="apellido1" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Segundo Apellido*</label>
                            <input type="text" id="apellido2" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Teléfono</label>
                            <input type="text" id="telefono" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" id="email" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Provincia*</label>
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

                        <div class="col-md-6">
                            <label class="form-label">Tipo Tarifa*</label>
                            <select id="tipo_tarifa" class="form-control">
                                <option value="HOGAR">HOGAR</option>
                                <option value="INDUSTRIAL">INDUSTRIAL</option>
                            </select>
                        </div>

                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button class="btn btn-success" id="guardarCliente">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>

        </div>
    </div>
</div>

<?php include "shared/footer.php"; ?>

<script src="js/admin-clientes.js"></script>
