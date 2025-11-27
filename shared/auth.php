<?php
session_start();

function autenticado(){
     return isset($_SESSION["correo"]); 
}

function loginRequerido(){
    if (!isset($_SESSION["correo"])) {
        header("Location: login.php");
        exit;
    }
}

?>