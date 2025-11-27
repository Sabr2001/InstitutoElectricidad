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
                            <input class="form-control me-2" type="search" placeholder="-- Ej: 0000000 --" aria-label="Buscar"/>
                            <button class="btn btn-outline-success me-2" type="submit">Buscar</button>
                            <button class="btn btn-outline-success" type="submit"><i class="fa fa-pencil"></i></button>
                        </form>
                        <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                    </div>
                    </div>
                </div>
            </section>
    </div>
</main>
<?php include "shared/footer.php"; ?>
