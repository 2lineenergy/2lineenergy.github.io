<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    $to = 'info@2lineenergy.com'; // Cambia esto por la dirección de correo del destinatario
    $subject = 'Nuevo mensaje de contacto';
    $message = "Nombre: $nombre\n";
    $message .= "Email: $email\n";
    $message .= "Mensaje: $mensaje\n";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    if (mail($to, $subject, $message, $headers)) {
        echo 'Correo electrónico enviado correctamente.';
    } else {
        echo 'Error al enviar el correo electrónico.';
    }
}
?>
