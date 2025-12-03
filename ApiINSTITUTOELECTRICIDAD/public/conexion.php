<?php
    include __DIR__ . "/../vendor/adodb/adodb-php/adodb.inc.php";

    function conexion() {
        $conector = NewADOConnection('mysqli');

        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $db   = 'institutoelectricidad2';

        // Conexión
        $conector->Connect($host, $user, $pass, $db);

        // Para que los resultados siempre vengan como arreglo asociativo
        $conector->SetFetchMode(ADODB_FETCH_ASSOC);

        return $conector;
    }
?>
