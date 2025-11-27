<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// cargar PHPMailer desde Composer
require __DIR__ . '/ApiINSTITUTOELECTRICIDAD/vendor/autoload.php';

// ============================
// VALIDAR CLIENTE EN LA BD
// ============================

$cedula = $_POST['cedula'] ?? '';

if (!$cedula) {
    echo "Debe ingresar una cédula.";
    exit;
}

// Conexión a la BD
$conexion = new mysqli("localhost", "root", "", "institutoelectricidad");

if ($conexion->connect_error) {
    die("Error conectando a la base de datos: " . $conexion->connect_error);
}

// Consulta con diagnóstico
$sql = "SELECT * FROM clientes WHERE cedula = ?";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    die("Error en prepare(): " . $conexion->error . "<br>SQL: $sql");
}

$stmt->bind_param("s", $cedula);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    echo "La cédula ingresada no está registrada como cliente.";
    exit;
}

$cliente = $resultado->fetch_assoc();
$correoCliente = $cliente['email'] ?? "No registrado";

// ============================
// ENVIAR CORREO
// ============================

try {

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;

    $mail->Username = "luis.zamora012@gmail.com";
    $mail->Password = "muin nrdw wbpn hswd";

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom("luis.zamora012@gmail.com", "Sistema Administrativo");
    $mail->addAddress("luis.zamora012@gmail.com");

    $mail->isHTML(true);
    $mail->Subject = "Solicitud de registro de usuario";
    $mail->Body = "
        Un cliente ha solicitado la creación de usuario.<br><br>
        <b>Cédula:</b> $cedula <br>
        <b>Correo registrado en BD:</b> $correoCliente
    ";

    $mail->send();

    echo "Solicitud enviada correctamente.";

} catch (Exception $e) {
    echo "Error enviando correo: " . $mail->ErrorInfo;
}
?>
