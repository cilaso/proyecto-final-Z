<?php

include ("../modelo/DB.php");
session_start();

$username = $_REQUEST['username'];
$password = $_REQUEST['password'];
$contrasenia2 = $_REQUEST['password2'];
$nombre = $_REQUEST['nombre'];
$apellidos = $_REQUEST['apellidos'];
$correo = $_REQUEST['correo'];
$fecha_nacimiento = $_REQUEST['cumpleanios'];

// Validamos que las 2 contraseñas sean iguales
if ($password == $contrasenia2) {
    
// Comprobamos si ha ocurrido un error, o si no ha adjuntado imagen
// Sea cual sea el resultado, procedemos a registrar el usuario igualmente sin iamgen
// Ya que se podrá adjuntar la imagen en el menú de usuario
    if (!isset($_FILES["imagen"]) || $_FILES["imagen"]["error"] > 0) {

        $resultado = registrarUsuario($mysqli, $username, $password, $nombre, $apellidos, $correo, $fecha_nacimiento);

        if ($resultado) {
            $_SESSION['usuarioRegistrado'] = "Se ha registrado con éxito";
            header('Location: ../vista/index.php?mensaje="Se ha registrado con éxito"');
        } else {
            $_SESSION['usuarioRegistrado'] = 'Se ha producido un error al registrarse';
            header('Location: ../vista/index.php?mensaje="Se ha registrado con éxito"');
        }
    } else {

        // Ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido 
        // y que el tamano del archivo no exceda los 16MB
        $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
        $limite_kb = 16384;

        if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024) {

            $dir_destino = '/opt/lampp/htdocs/proyectoZ/uploads/';
            $nombre_imagen = date("d") . date("m") . date("Y") . date("H") . date("i") . date("s") . basename($_FILES['imagen']['name']);
            $imagen_subida = $dir_destino . $nombre_imagen;
            
            if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
                if (move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_subida)) {
                    $resultado = registrarUsuarioConImagen($mysqli, $username, $password, $nombre, $apellidos, $correo, $fecha_nacimiento, $nombre_imagen);
                } else {
                    $_SESSION['usuarioRegistrado'] = "Posible ataque del archivo subido: nombre del archivo '" . $_FILES['imagen']['tmp_name'];
                }
            } else {
                $_SESSION['usuarioRegistrado'] = "Posible ataque del archivo subido: ";
            }

            if ($resultado) {
                $_SESSION['usuarioRegistrado'] = "Se ha registrado con éxito";
                header('Location: ../vista/index.php?mensaje="Se ha registrado con éxito"');
            } else {
                $_SESSION['usuarioRegistrado'] = $_SESSION['usuarioRegistrado'] . ". Se ha producido un error al registrarse";
                header('Location: ../vista/index.php?mensaje="Se ha registrado con éxito"');
            }
        } else {
            $_SESSION['usuarioRegistrado'] = "Archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
            header('Location: ../vista/index.php');
        }
    }
} else {
    $_SESSION['usuarioRegistrado'] = "No coinciden las contraseñas";
    header('Location: ../vista/index.php');
}




    
