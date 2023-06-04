<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    // Configurar el correo electrónico
    $destinatario = 'info@2lineenergy.com'; // Cambia esto con tu dirección de correo electrónico
    $asunto = 'Nuevo mensaje de contacto';
    $contenido = "Nombre: $nombre\n\n";
    $contenido .= "Email: $email\n\n";
    $contenido .= "Mensaje:\n$mensaje\n";

    // Enviar el correo electrónico
    $headers = "From: $nombre <$email>\r\n";
    if (mail($destinatario, $asunto, $contenido, $headers)) {
        echo "El mensaje ha sido enviado. ¡Gracias por tu contacto!";
    } else {
        echo "Lo sentimos, ha ocurrido un error al enviar el mensaje.";
    }
}
?>
