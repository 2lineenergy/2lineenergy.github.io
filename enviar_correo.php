<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombre = $_POST['nombre'];
  $correo = $_POST['correo'];
  $asunto = $_POST['asunto'];
  $mensaje = $_POST['mensaje'];

  // Configura los detalles del servidor de correo
  $servidor_correo = 'https://webmail.2lineenergy.com';
  $puerto = 587;
  $usuario = 'info@2lineenergy.com';
  $contrasena = 'Generan2+';

  // Construye el mensaje de correo
  $cabeceras = "From: $nombre <$correo>\r\n";
  $cabeceras .= "Reply-To: $correo\r\n";
  $mensaje_correo = "Nombre: $nombre\n";
  $mensaje_correo .= "Correo electrónico: $correo\n";
  $mensaje_correo .= "Asunto: $asunto\n";
  $mensaje_correo .= "Mensaje: $mensaje\n";

  // Envía el correo
  if (mail('info@2lineenergy.com', $asunto, $mensaje_correo, $cabeceras)) {
    echo "El correo ha sido enviado correctamente.";
  } else {
    echo "Hubo un error al enviar el correo.";
  }
}
?>
