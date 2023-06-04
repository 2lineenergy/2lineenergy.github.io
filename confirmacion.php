<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Confirmacion de envio formulario</title>
    <link rel="stylesheet" href="libs/bootstrap.css">
</head>

<body>
    <div class="container">
        <?php

        function form_mail($sPara, $sAsunto, $sTexto, $sDe)
        {
            $bHayFicheros = 0;
            $sCabeceraTexto = "";
            $sAdjuntos = "";

            if ($sDe) $sCabeceras = "From:" . $sDe . "\n";
            else $sCabeceras = "";
            $sCabeceras .= "MIME-version: 1.0\n";
            foreach ($_POST as $sNombre => $sValor)
                $sTexto = $sTexto . "\n" . $sNombre . " = " . $sValor;

            foreach ($_FILES as $vAdjunto) {
                if ($bHayFicheros == 0) {
                    $bHayFicheros = 1;
                    $sCabeceras .= "Content-type: multipart/mixed;";
                    $sCabeceras .= "boundary=\"--_Separador-de-mensajes_--\"\n";

                    $sCabeceraTexto = "----_Separador-de-mensajes_--\n";
                    $sCabeceraTexto .= "Content-type: text/plain;charset=iso-8859-1\n";
                    $sCabeceraTexto .= "Content-transfer-encoding: 7BIT\n";

                    $sTexto = $sCabeceraTexto . $sTexto;
                }
                if ($vAdjunto["size"] > 0) {
                    $sAdjuntos .= "\n\n----_Separador-de-mensajes_--\n";
                    $sAdjuntos .= "Content-type: " . $vAdjunto["type"] . ";name=\"" . $vAdjunto["name"] . "\"\n";;
                    $sAdjuntos .= "Content-Transfer-Encoding: BASE64\n";
                    $sAdjuntos .= "Content-disposition: attachment;filename=\"" . $vAdjunto["name"] . "\"\n\n";

                    $oFichero = fopen($vAdjunto["tmp_name"], 'r');
                    $sContenido = fread($oFichero, filesize($vAdjunto["tmp_name"]));
                    $sAdjuntos .= chunk_split(base64_encode($sContenido));
                    fclose($oFichero);
                }
            }

            if ($bHayFicheros)
                $sTexto .= $sAdjuntos . "\n\n----_Separador-de-mensajes_----\n";
            return (mail($sPara, $sAsunto, $sTexto, $sCabeceras));
        }

        //Cambiar aqui el email.
        if (form_mail("info@2lineenergy.com", $_POST['asunto'], "Los datos introducidos en el formulario son:\n\n", $_POST['email']))
            echo "
        <div class='py-5 text-center'>
            <div class='card'>
                <h2>Confirmacion envio correo.</h2>

                <div class='alert alert-success'>
                    <strong>Confirmacion Envío</strong> Su mensaje fue enviado.
                </div>
            </div>
        </div>

";
        ?>

    </div>

</body>
<script src="libs/formJs.js" ?id=<? print(date('H:i:s')); ?>></script>

</html>
