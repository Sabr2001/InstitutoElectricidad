<?php
    require_once "shared/auth.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $correo = trim($_POST["correo"]);
    $password = trim($_POST["password"]);

    // Preparar body
    $body = http_build_query([
        "correo" => $correo,
        "password" => $password
    ]);

    // Preparar request a la API
    $context = stream_context_create([
        "http" => [
            "method"  => "POST",
            "header"  => "Content-Type: application/x-www-form-urlencoded",
            "content" => $body,
            "ignore_errors" => true
        ]
    ]);

    // Ejecutar solicitud
    $response = @file_get_contents("http://localhost:8080/login", false, $context);

    if ($response === FALSE) {
        $error = "No se pudo conectar con el servidor.";
    } else {

        $data = json_decode($response, true);

        // Si la API devuelve error 500 con mensaje → atraparlo
        if (!is_array($data)) {
            $error = "Respuesta inválida del servidor.";
        }
        else if (isset($data["error"])) {
            // Slim manda errores en "error"
            $error = $data["error"]["description"] ?? "Error desconocido";
        }
        // CORRECCIÓN: Cambiar de "status" a "success"
        else if (isset($data["success"]) && $data["success"] === true) {

            // GUARDAR SESIÓN
            $_SESSION["correo"] = $data["usuario"]["correo"];
            $_SESSION["nombre"] = $data["usuario"]["nombreUsuario"];
            $_SESSION["id_usuario"] = $data["usuario"]["id"];

            header("Location: dashboard.php");
            exit;
        } 
        else {
            // Mostrar el mensaje de la API si existe
            $error = $data["message"] ?? "Credenciales incorrectas.";
        }
    }
}
?>

<?php include "shared/header.php"; ?>

<main class="row justify-content-evenly m-5 pb-5">
    <h1 class="col-sm-12 text-center mb-4">Acceso a la Agencia Virtual</h1>

    <div class="col-sm-6 col-md-4">

        <?php if ($error != ""): ?>
            <div class="alert alert-danger text-center">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="border p-4 rounded shadow">

            <div class="mb-3">
                <label class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" name="correo" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Ingresar</button>

        </form>
    </div>
</main>

<?php include "shared/footer.php"; ?>