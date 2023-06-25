#!/usr/bin/perl

use strict;
use warnings;

# Configuración del correo electrónico
my $to = 'info@2lineenergy.com';  # Reemplazar con la dirección de correo del destinatario
my $from = 'info@2lineenergy.com';  # Reemplazar con tu dirección de correo
my $subject = 'Nuevo mensaje de contacto';

# Lectura de los datos enviados desde el formulario
my $name = param('name');
my $email = param('email');
my $message = param('message');

# Construcción del cuerpo del correo electrónico
my $body = "Nombre: $name\n";
$body .= "Email: $email\n";
$body .= "Mensaje: $message\n";

# Configuración de las cabeceras del correo electrónico
my $headers = "From: $from\n";
$headers .= "Reply-To: $email\n";

# Envío del correo electrónico
if (send_mail($to, $subject, $body, $headers)) {
    print "Content-type: text/html\n\n";
    print "El correo electrónico se envió correctamente.";
} else {
    print "Content-type: text/html\n\n";
    print "Error al enviar el correo electrónico.";
}

# Función para enviar el correo electrónico
sub send_mail {
    my ($to, $subject, $body, $headers) = @_;

    open (SENDMAIL, "|/usr/sbin/sendmail -t");
    print SENDMAIL "To: $to\n";
    print SENDMAIL "Subject: $subject\n";
    print SENDMAIL $headers;
    print SENDMAIL "\n";
    print SENDMAIL $body;
    close (SENDMAIL);

    return 1;  # Retorna 1 si el envío del correo fue exitoso
}
