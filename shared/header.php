<?php
$archivo = basename($_SERVER['PHP_SELF']);
$nombreArchivo = explode(".", $archivo)[0];
// var_dump($nombreArchivo);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenidos al Instituto Costarricense de Electricidad</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c3c613e268.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/<?php echo $nombreArchivo ?>.css"> 
</head>

<body class="container-fluid p-0">
    <!-- Cabecera de la página -->
    <header>
        <!-- Menu principal -->
        <nav id="menu-principal" class="navbar navbar-expand-lg bgIceBackground">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="img/icono.jpg" alt="Logo ICE" width="120" height="auto">
                </a>

               <button class="navbar-toggler bgColorSecundario" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?php if ($nombreArchivo == "acerca") echo 'active' ?>" aria-current="page" href="acerca.php">Acerca del ICE</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($nombreArchivo == "galeria") echo 'active' ?>" href="galeria.php">Galería</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($nombreArchivo == "Formulario") echo 'active' ?>" href="contacto.php">Formulario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($nombreArchivo == "FAQ") echo 'active' ?>" href="FAQ.php">Preguntas Frecuentes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php if ($nombreArchivo == "contactenos") echo 'active' ?>" href="servicios.php">Servicios</a>
                        </li>
                        <l class="nav-item">
                            <a class="nav-link <?php if ($nombreArchivo == "login") echo 'active' ?>" href="login.php">
                                Agencia Virtual
                            </a>
                        </li>
                    </ul>
                </div>
                <a href="logout.php" class="btn btn-danger btn-l">Cerrar sesión</a>

            </div>

        </nav>
    </header>