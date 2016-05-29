<?php

if ($_POST["nombre"] && $_POST["email"] != "") {
    $de = $_POST["nombre"];
    $destino = "sgi1989@hotmail.com"; 
    $asunto = "FORMULARIO DE EJEMPLO";
    $mensaje = "FORMULARIO.\n\nNOMBRE: " . utf8_decode($_POST["nombre"]) . "\n\nEMAIL: " . utf8_decode($_POST["email"]) . "\n";
    $mensaje .= "FORMULARIO." . "\n";
    $mensaje .= "\n";
    $mensaje .= "NOMBRE: " . utf8_decode($_POST["nombre"]) . "\n";
    $mensaje .= "\n";
    $mensaje .= "EMAIL: " . utf8_decode($_POST["email"]) . "\n";
    $emailheader = "From: formulario <tuemail>\r\n"; 
    mail($destino, $asunto, $mensaje, $emailheader) or die("Lo sentimos, tu solicitud no ha sido enviada.<br/>Intentelo de nuevo.");
    echo utf8_decode(utf8_encode('Tu consulta ha sido enviada correctamente.'));
} else {
    if ($_POST["nombre"] == "") {
        echo utf8_encode('Por favor, indica tu nombre.');
        exit;
    }
    if ($_POST["email"] == "") {
        echo utf8_encode('Por favor, indica un email de contacto.');
        exit;
    }
}
?>