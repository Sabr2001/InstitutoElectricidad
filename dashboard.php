<?php
include "shared/auth.php";
include "shared/header.php";

loginRequerido()

?>
<main class="flex-grow-1">
    <div class="row">
        <?php include "shared/aside.php"; ?>
        <section class="col">
            <div class="container">
                <div class="m-4">
                    <h1>Bienvenidos a Agencia Virtual</h1>
                </div>
                <div class="card text-center">
                    <div class="card-header">
                        Buscador
                    </div>
                    <!-- INICIO SECCION CONSULTA NISE -->
                    <div class="card-body">
                        <h5 class="card-title">Consulta NISE</h5>
                        <form id="buscarNise" class="d-flex" role="search">
                            <input class="form-control me-2" name="nise" id="nise" type="search" placeholder="-- Ej: 0000000 --" aria-label="Buscar" />
                            <button class="btn btn-outline-success me-2" type="submit">Buscar</button>
                            <!-- <button class="btn btn-outline-success"><i class="fa fa-pencil"></i></button> -->
                        </form>
                    </div>
                    <!-- FIN SECCION CONSULTA NISE -->
                </div>
                <div class="container mt-4">
                    <h3 class="mb-3 text-center">Consulta de Facturación</h3>
                    <!-- Selector de periodo -->
                    <div class="card p-3 mb-4">
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

<!-- Modal para consulta -->

<div class="modal modal-xl fade w-100" id="modalIndexLectura" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crudModalLabel">Consulta de Lecturas <i class="fa-solid fa-bolt"></i></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <table class="m-4 table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Periodo</th>
                            <th>Nise</th>
                            <th>Consumo</th>
                            <th>F. Lectura  </th>
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

<div class="modal fade" id="modalEditLectura" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="crudModalLabel">Nuevo Permiso</h5> -->
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body">
                <form id="crudLectura">
                    <input type="hidden" id="id" name="id" value="">
                    <div class="mb-3">
                        <label for="nombrePermiso" class="form-label">Nombre Permiso</label>
                        <input name="nombrePermiso" type="text" class="form-control" id="nombrePermiso" placeholder="Ingrese Nombre del Permiso">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input name="descripcion" type="text" class="form-control" id="descripcion" placeholder="Ingrese descripción">
                    </div>
                    <div class="mb-3">
                        <label for="habilitado" class="form-label">Habilitado</label>
                        <select name="habilitado" id="habilitado" class="form-select">
                            <option value="1">Si</option>
                            <option value="2">No</option>
                        </select>
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
<?php include "shared/footer.php"; ?>
<!-- Pasar el correo del usuario a JavaScript -->
<script>
    const usuarioCorreo = "<?= $_SESSION['correo'] ?>";
</script>
<script src="js/consulta_factura.js"></script>