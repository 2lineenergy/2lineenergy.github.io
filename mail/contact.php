<?php
header('Content-Type: application/json');

// Verifica si los datos están presentes
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método no permitido.']);
    exit;
}

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

if (!$name || !$email || !$subject || !$message) {
    echo json_encode(['success' => false, 'message' => 'Todos los campos son obligatorios.']);
    exit;
}

// Configura la URL y clave del API de RatuFaMailer
$api_url = "https://n1.ratufa.io/api/v1/send"; // URL correcta del endpoint
$api_key = "y8e28zmw"; // Reemplaza con tu clave API
$to_email = "info@2lineenergy.com"; // Correo de destino

// Prepara los datos para enviar el correo
$post_data = [
    "to" => $to_email,
    "from" => $email,
    "subject" => "Nuevo mensaje de contacto: $subject",
    "message" => "Nombre: $name\nCorreo: $email\nAsunto: $subject\n\nMensaje:\n$message",
];

// Configura la solicitud cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $api_key
]);

// Ejecuta la solicitud
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Manejo de la respuesta
if ($http_code === 200) {
    echo json_encode(['success' => true, 'message' => 'Tu mensaje ha sido enviado exitosamente.']);
} else {
    error_log('Error al enviar correo: ' . $response);
    echo json_encode(['success' => false, 'message' => 'No se pudo enviar el correo. Inténtalo de nuevo.']);
}
?>
