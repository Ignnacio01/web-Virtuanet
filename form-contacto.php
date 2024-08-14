<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $asunto = $_POST["asunto"];
    $mensaje = $_POST["mensaje"];

    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'oscargonvargas15@gmail.com';
    $mail->Password = 'fhjx fjor gxxt bhnl';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom($email, $nombre); // Establecer el remitente como la dirección del formulario
    $mail->addAddress('oscargonvargas15@gmail.com');  // Tu dirección de correo sigue siendo el destinatario
    $mail->isHTML(true);

    // Recoge y valida datos del formulario
    $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $asunto = filter_input(INPUT_POST, 'asunto', FILTER_SANITIZE_STRING);
    $mensaje = filter_input(INPUT_POST, 'mensaje', FILTER_SANITIZE_STRING);

    if (!$nombre || !$email || !$mensaje) {
        throw new Exception('Los datos del formulario no son válidos.');
    }

    // Contenido del correo
    $mail->isHTML(true);
    $mail->Subject = $asunto;
    $mail->Body = "Nombre: $nombre<br>Email: $email<br>Mensaje: $mensaje";

    if ($mail->send()) {
        $response = array('success' => true);
    } else {
        $response = array('success' => false, 'error' => $mail->ErrorInfo);
    }
    
    header('Content-type: application/json');
    echo json_encode($response);
}

?>