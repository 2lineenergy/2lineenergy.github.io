<?php
// Configuración inicial
header('Content-Type: application/json');

// Validar si los campos requeridos están presentes
if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Por favor, complete todos los campos correctamente.']);
    exit();
}

// Sanear los datos recibidos
$name = strip_tags(htmlspecialchars($_POST['name']));
$email = strip_tags(htmlspecialchars($_POST['email']));
$m_subject = strip_tags(htmlspecialchars($_POST['subject']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Crear el cuerpo del mensaje
$to = "info@2lineenergy.com"; // Cambia esto por tu dirección de correo
$subject = "$m_subject: $name";
$body = "Has recibido un nuevo mensaje desde el formulario de contacto de tu página web.\n\n";
$body .= "Detalles:\n\n";
$body .= "Nombre: $name\n";
$body .= "Email: $email\n";
$body .= "Asunto: $m_subject\n";
$body .= "Mensaje:\n$message\n";
$headers = "From: no-reply@2lineenergy.com\r\n"; // Cambia el dominio si es necesario
$headers .= "Reply-To: $email\r\n";

// Intentar enviar el correo
if (!mail($to, $subject, $body, $headers)) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al enviar el correo. Inténtelo más tarde.']);
    exit();
}

// Respuesta de éxito
http_response_code(200);
echo json_encode(['success' => 'El mensaje se envió correctamente.']);
?>
