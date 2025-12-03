<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include "shared/header.php";

// cargar PHPMailer
require __DIR__ . '/ApiINSTITUTOELECTRICIDAD/vendor/autoload.php';

// ============================
// VALIDAR CLIENTE EN LA BD
// ============================

$mensaje = "";   // mensaje a mostrar
$tipo = "";      // success | danger

$cedula = $_POST['cedula'] ?? '';

if (!$cedula) {
    $mensaje = "Debe ingresar una cédula.";
    $tipo = "danger";
    include "shared/footer.php";
    mostrarVista($mensaje, $tipo);
    exit;
}

// Conexión a la BD
$conexion = new mysqli("localhost", "root", "", "institutoelectricidad2");

if ($conexion->connect_error) {
    $mensaje = "Error conectando a la base de datos.";
    $tipo = "danger";
    mostrarVista($mensaje, $tipo);
    exit;
}

$sql = "SELECT * FROM clientes WHERE cedula = ?";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    $mensaje = "Error interno del servidor.";
    $tipo = "danger";
    mostrarVista($mensaje, $tipo);
    exit;
}

$stmt->bind_param("s", $cedula);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows == 0) {
    $mensaje = "La cédula ingresada no está registrada como cliente, si sigue teniendo problemas dejenos saberlo en soporte al cliente.";
    $tipo = "danger";
    mostrarVista($mensaje, $tipo);
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
        Un cliente ha solicitado la creación de usuario, por favor crearle el usuario y contrasena de su agencia virtual.<br><br>
        <b>Cédula:</b> $cedula <br>
        <b>Correo registrado en BD:</b> $correoCliente
    ";

    $mail->send();

    $mensaje = "Solicitud enviada correctamente, una vez creadas sus credenciales se le hara llegar via correo electronico.";
    $tipo = "success";

} catch (Exception $e) {
    $mensaje = "Error enviando correo: " . $mail->ErrorInfo;
    $tipo = "danger";
}

// Mostrar vista final
mostrarVista($mensaje, $tipo);


// ============================
// FUNCIÓN PARA MOSTRAR VISTA
// ============================

function mostrarVista($mensaje, $tipo)
{
    echo "
    <main class='row justify-content-center mt-5'>
        <div class='col-sm-10 col-md-6 col-lg-4'>
            <div class='alert alert-$tipo text-center shadow-sm p-3'>
                <strong>" . ($tipo == "danger" ? "Error:" : "Éxito:") . "</strong> 
                $mensaje
            </div>

            <a href='contacto.php' class='btn btn-primary w-100 mt-3'>Volver</a>
        </div>
    </main>
    ";

    include "shared/footer.php";
}
?>
