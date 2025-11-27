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
                    <div class="card-body">
                        <h5 class="card-title">Consulta NISE</h5>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="-- Ej: 0000000 --" aria-label="Buscar" />
                            <button class="btn btn-outline-success me-2" type="submit">Buscar</button>
                            <button class="btn btn-outline-success" type="submit"><i class="fa fa-pencil"></i></button>
                        </form>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                </div>
<!-- Formulario para consultar la facturacion de los clientes -->
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
<?php include "shared/footer.php"; ?>
<!-- Pasar el correo del usuario a JavaScript -->
<script>
    const usuarioCorreo = "<?= $_SESSION['correo'] ?>";
</script>
<script src="js/consulta_factura.js"></script>