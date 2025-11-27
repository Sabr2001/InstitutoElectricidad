<?php 
    include "shared/auth.php";
    include "shared/header.php";
?>
<main class="flex-grow-1">
    <div class="row">
        <?php include "shared/aside.php"; ?>
            <section class="col">
                <div class="m-4">
                    <h1>Bienvenidos a Agencia Virtual</h1>
                </div>


                <div class="card text-center">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
    <h5 class="card-title">Special title treatment</h5>
    <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                            <button class="btn btn-outline-success" type="submit">Buscar</button>
                        </form>
    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
  </div>
  <div class="card-footer text-body-secondary">
    2 days ago
  </div>
</div>
                <nav class="navbar bg-body-tertiary">
                    <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <a class="navbar-brand" href="#">Navbar</a>
                        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                       
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                            <button class="btn btn-outline-success" type="submit">Buscar</button>
                        </form>
                        </div>
                    </div>
                </nav>
            </section>
    </div>
</main>
<?php include "shared/footer.php"; ?>
