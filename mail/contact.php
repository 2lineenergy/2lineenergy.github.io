<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        http_response_code(400); // Error de solicitud incorrecta
        echo json_encode(['status' => 'error', 'message' => 'Por favor completa todos los campos correctamente.']);
        exit();
    }

    // Recoger datos del formulario
    $name = strip_tags(htmlspecialchars($_POST['name']));
    $email = strip_tags(htmlspecialchars($_POST['email']));
    $subject = strip_tags(htmlspecialchars($_POST['subject']));
    $message = strip_tags(htmlspecialchars($_POST['message']));

    // Configuración del endpoint de RatuFaMailer
    $ratufa_url = 'https://n1.ratufa.io/forms/y8e28zmw'; // Cambia "y8e28zmw" si tu identificador es diferente
    $form_data = [
        'name' => $name,
        'email' => $email,
        'subject' => $subject,
        'message' => $message,
    ];

    // Enviar los datos al endpoint usando cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $ratufa_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $form_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Manejo de la respuesta
    if ($http_status === 200) {
        echo json_encode(['status' => 'success', 'message' => 'Correo enviado correctamente.']);
    } else {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Error al enviar el correo. Intenta nuevamente.']);
    }
    exit();
} else {
    http_response_code(405); // Método no permitido
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
    exit();
}
?>
