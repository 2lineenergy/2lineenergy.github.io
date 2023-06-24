<?php

if(empty($_POST['submit']))
{
	echo "El formulario no se ha enviado!";
	exit;
}
if(empty($_POST["fullname"]) ||
	empty($_POST["email"]) ||
	empty($_POST["phone"]) ||
	empty($_POST["subject"]) ||)
	{
		echo "Por favor rellene el formulario";
		exit;
	}
	
$name = $_POST["fullname"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$subject = $_POST["subject"];

mail( 'info@2lineenergy.com' , 'New form submission' , 
"Nuevo coantacto desde la web: Name: $name, Email:$email, Phone:$phone, Subject:$subject" );

header('Location: thank-you.html');


?>