<?php
session_start();

if (!isset($_SESSION["correo"])) {
    header("Location: login.php");
    exit;
}

include "shared/header.php";
?>

<main>
    <h1>Bienvenidos a Agencia Virtual</h1>

    <!-- BOTÓN DE LOGOUT -->
    <a href="logout.php" class="btn btn-danger">Cerrar sesión</a>

</main>

<?php include "shared/footer.php"; ?>
