<!-- Pie de la página -->
<footer class="row text-center bgIceBackground mt-auto pt-3">
    <div class="col-md-6 col-lg-3">
        <h3>Instituto Costarricense de Electricidad</h3>
        <a href="#">Historia</a>
    </div>
    <div class="col-md-6 col-lg-3">
        <h3>Trámites</h3>
        <a href="#">Gestión en línea</a>
    </div>
    <div class="col-md-6 col-lg-3">
        <h3>Servicios</h3>
        <a href="#">Agencia Virtual</a>
    </div>
    <div class="col-md-6 col-lg-3">
        <h3>Contacto</h3>
        <a class="nav-link" href="#">
            <i class="fa-brands fa-facebook"></i>
        </a>
        <a class="nav-link" href="#">
            <i class="fa-brands fa-youtube"></i>
        </a>
    </div>
    <div class="row justify-content-center align-items-center">
        <img class="col-sm-1" width="100" src="img/icono.jpg" alt="logo del ICE">
        <p class="col-sm-3"> © 2025 <b>Instituto Costarricense de Electricidad.</b> </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/97cef9f55a.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

<?php
switch ($nombreArchivo) {
    case 'index':
        //script para index
        break;

    case 'contactenos':
        echo "<script src='https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js'></script>";
        break;

    case 'admin-permisos':
        echo "<script src='js/$nombreArchivo.js'></script>";
        break;
    case 'estadisticas_consumo':
        echo '<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>';
        echo "<script src='js/$nombreArchivo.js'></script>";
        break;
    case 'dashboard';
        echo  "<script src='js/$nombreArchivo.js'></script>";
        break;
    case 'contacto_cliente';
        echo  "<script src='js/$nombreArchivo.js'></script>";
        break;
    default:
        # code...
        break;
}
?>
</body>

</html>