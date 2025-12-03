<?php
include "shared/auth.php";
include "shared/header.php";


loginRequerido()

?>
<main class="flex-grow-1">
    <div class="row">
        <?php if ($_SESSION["correo"] == 'admin@ice.go.cr'): ?>
            <?php include "shared/aside.php"; ?>
        <?php endif; ?>
        <section class="col">
            <div class="container">
                <div class="m-4">
                    <h1>Bienvenidos a Agencia Virtual</h1>
                </div>
                <!-- INICIO SECCION CONSULTA NISE -->
                <div class="card text-center">
                    <div class="card-header">
                        <h3>Consulta Lecturas</h3>
                    </div>
                    <div class="card-body ">
                        <h5 class="card-title">Ingresar NISE</h5>
                        
                        <form id="buscarNise" role="search">  
                            <div class="row g-2">
                                <div class="col-12 col-md-8">
                                    <input class="form-control me-2" name="nise" id="nise" type="search" placeholder="-- Ej: 0000000 --" aria-label="Buscar" />
                                </div>
                                <div class="col-12 col-md-1 d-grid">
                                    <button class="btn btn-outline-success me-2" type="submit" data-tipo="read">Buscar</button>
                                </div>
                                <?php if ($_SESSION["correo"] == 'admin@ice.go.cr'): ?>
                                    <div class="col-12 col-md-1 d-grid">
                                        <button class="btn btn-outline-success" type="submit" id="btn-add-nise" data-tipo="add">Generar<i class="fa-solid fa-bolt"></i></button>
                                    </div>  
                                <?php endif; ?>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- FIN SECCION CONSULTA NISE -->
                <!-- Inicio Formulario para consultar la facturacion de los clientes -->
                <div class="container mt-4">
                    <h3 class="mb-3 text-center">Consulta de Facturación</h3>
                    
                    <!-- Selector de periodo -->
                    <div class="card p-3 mb-4">
                        <!-- si es admin deja escribir el nise a revisar la facturacion -->
                    <?php if (isset($_SESSION["correo"]) && $_SESSION["correo"] === 'admin@ice.go.cr'): ?>
                        <div class="mb-3">
                            <label><strong>Consultar facturación por NISE:</strong></label>
                            <input type="number" id="adminNise" class="form-control w-25" placeholder="Ingrese NISE del cliente">
                        </div>
                    <?php endif; ?>
                    <label><strong>Seleccione el periodo a consultar:</strong></label>
                        <input type="month" id="periodo" class="form-control w-25">
                        <button id="btnBuscar" class="btn btn-primary mt-3 w-25">Buscar</button>
                    </div>
                    <!-- Contenedor del resultado -->
                    <div id="resultado" class="card p-4" style="display:none;">
                        <h4>Información del Cliente</h4>
                        <p id="infoCliente"></p>
                        <hr>
                        <h4>Detalle de Facturación</h4>
                        <ul id="detalleFactura"></ul>
                        <hr>
                        <h4>Total a pagar:</h4>
                        <p id="total" class="fs-3 fw-bold text-success"></p>
                        <p id="estadoFactura" class="badge fs-5"></p>
                    </div>
                </div>
                <!-- Fin del Formulario para consultar la facturacion de los clientes -->
            </div>

        </section>
    </div>
</main>

<!-- Modal GET LECTURA-->
<div class="modal modal-xl fade w-100" id="modalIndexLectura" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crudModalLabel">Consulta de Lecturas <i class="fa-solid fa-bolt"></i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Periodo</th>
                            <th>Nise</th>
                            <th>Consumo</th>
                            <th>F. Lectura </th>
                            <th>F. Corte</th>
                            <th>Observaciones</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="indexLectura">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal ADD LECTURA -->
<div class="modal fade" id="modalAddLectura" tabindex="-1" aria-labelledby="modalAddLecturaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddLecturaLabel">
                    Nueva Lectura <i class="fa-solid fa-bolt"></i>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <form id="crudLectura">
                    <input type="hidden" id="id" name="id" value="">

                    <div class="mb-3">
                        <label for="niseAddLectura" class="form-label">NISE</label>
                        <input type="text" class="form-control" id="niseAddLectura" name="niseAddLectura" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="periodo" class="form-label">Periodo</label>
                        <input type="date" class="form-control" id="periodo" name="periodo" required>
                    </div>
                    <div class="mb-3">
                        <label for="consumo_kWh" class="form-label">Consumo (kWh)</label>
                        <input type="number" class="form-control" id="consumo_kWh" name="consumo_kWh" step="0.01" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_lectura" class="form-label">Fecha de lectura</label>
                        <input type="date" class="form-control" id="fecha_lectura" name="fecha_lectura" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_corte" class="form-label">Fecha de corte</label>
                        <input type="date" class="form-control" id="fecha_corte" name="fecha_corte">
                    </div>
                    <div class="mb-3">
                        <label for="tarifa_id" class="form-label">Tarifa</label>
                        <select class="form-select" id="tarifa_id" name="tarifa_id" required>
                            <option value="">Seleccione una tarifa</option>
                            <option value="1">Tarifa 1 - Residencial</option>
                            <option value="2">Tarifa 2 - Comercial</option>
                        </select>
                    </div>

                    <!-- Observaciones -->
                    <div class="mb-3">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="2" maxlength="100"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button id="btnGuardarAddLectura" type="button" class="btn btn-primary">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal EDIT LECTURA -->
<div class="modal fade" id="modalEditLectura" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLecturaLabel">
                    Editar Lectura <i class="fa-solid fa-bolt"></i>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <form id="crudEditLectura">
                    <input type="hidden" id="edit-id" name="id" value="">

                    <div class="mb-3">
                        <label for="nise" class="form-label">NISE</label>
                        <input type="text" class="form-control" id="edit-nise" name="nise" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="periodo" class="form-label">Periodo</label>
                        <input type="date" class="form-control" id="edit-periodo" name="periodo" required>
                    </div>
                    <div class="mb-3">
                        <label for="consumo_kWh" class="form-label">Consumo (kWh)</label>
                        <input type="number" class="form-control" id="edit-consumo_kWh" name="consumo_kWh" step="0.01" min="0" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_lectura" class="form-label">Fecha de lectura</label>
                        <input type="date" class="form-control" id="edit-fecha_lectura" name="fecha_lectura" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_corte" class="form-label">Fecha de corte</label>
                        <input type="date" class="form-control" id="edit-fecha_corte" name="fecha_corte">
                    </div>
                    <div class="mb-3">
                        <label for="tarifa_id" class="form-label">Tarifa</label>
                        <select class="form-select" id="edit-tarifa_id" name="tarifa_id" required>
                            <option value="">Seleccione una tarifa</option>
                            <option value="1">Tarifa 1 - Residencial</option>
                            <option value="2">Tarifa 2 - Comercial</option>
                        </select>
                    </div>

                    <!-- Observaciones -->
                    <div class="mb-3">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea class="form-control" id="edit-observaciones" name="observaciones" rows="2" maxlength="100"></textarea>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Cancelar
                </button>
                <button id="btnGuardarEditLectura" type="button" class="btn btn-primary">
                    Guardar
                </button>
            </div>
        </div>
    </div>
</div>
<?php include "shared/footer.php"; ?>
<!-- Pasar el correo del usuario a JavaScript -->
<script>
    const usuarioCorreo = "<?= $_SESSION['correo'] ?>";
    const esAdmin = (usuarioCorreo === "admin@ice.go.cr");
</script>
<script src="js/consulta_factura.js"></script>