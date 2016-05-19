<?php

include ("../modelo/DB.php");

session_start();

$origen = $_REQUEST['origen'];

switch ($origen) {

    case "login":

        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];


        $resultado = comprobarUsuario($mysqli, $username, $password);

        if ($resultado->num_rows > 0) { //usuario y password correcto
            $filaR = mysqli_fetch_array($resultado);
            $_SESSION['username'] = $filaR[0];
            unset($_SESSION['usuarioIncorrecto']);
            header("Location: ../../" . $_SESSION['url'] . "");
        } else { //usuario incorrecto
            $_SESSION['usuarioIncorrecto'] = 1;
            header("Location: ../../" . $_SESSION['url'] . "");
        }
        break;

    case "desconect":
        session_destroy();
        header('Location: ../vista/index.php');
        break;

    case "crearHilo":
        header('Location: ../vista/crearHiloForm.php');
        break;

    case "insertarMensaje":
        $mensaje = $_REQUEST['comentario'];
        $id_hilo = $_REQUEST['id_hilo'];
        insertarMensaje($mysqli, $_SESSION['username'], $id_hilo, $mensaje);
        header('Location: ../vista/hilo.php');
        break;

    case "borrarMensaje":
        $id_mensaje = $_REQUEST['id_mensaje'];
        borrarMensaje($mysqli, $id_mensaje);
        header('Location: ../vista/hilo.php');
        break;

    case "consultarImagen":

        $ruta = usuarioConImagen($mysqli, $_SESSION['username']);
        $_SESSION['ruta'] = $ruta;
        header("Location: ../../" . $_SESSION['url'] . "");
        break;

    case "borrarMensaje":
        $id_mensaje = $_REQUEST['id_mensaje'];
        borrarMensaje($mysqli, $id_mensaje);
        header('Location: ../vista/hilo.php');
        break;

    case "confirmarHilo":
        $asunto = $_REQUEST['asunto'];
        $categoria = $_REQUEST['categoria'];
        $descripcion = $_REQUEST['descripcion'];
        $admin = $_SESSION['username'];

        // Comprobamos si ha ocurrido un error.
        if (!isset($_FILES["imagen"]) || $_FILES["imagen"]["error"] > 0) {

            echo "Ha ocurrido un error al cargar la imagen ____________________________***********************";

            $resultado = crearHilo($mysqli, $asunto, $categoria, $descripcion, $admin);

            if ($resultado) {
                $mensaje = "Se ha publicado el hilo éxito";
                header('Location: ../vista/index.php?mensaje=$mensaje');
            } else {
                $mensaje = 'Se ha producido un error al publicar el hilo';
                header('Location: ../vista/index.php?mensaje=$mensaje');
            }
        } else {

            // Ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido 
            // y que el tamano del archivo no exceda los 16MB
            $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
            $limite_kb = 16384;

            if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024) {

                $dir_destino = '/opt/lampp/htdocs/proyectoZ/uploads/';
                $nombre_imagen = date("d") . date("m") . date("Y") . date("H") . date("i") . basename($_FILES['imagen']['name']);
                $imagen_subida = $dir_destino . $nombre_imagen;

                if (is_uploaded_file($_FILES['imagen']['tmp_name'])) {
                    if (move_uploaded_file($_FILES['imagen']['tmp_name'], $imagen_subida)) {

                        $resultado = crearHiloConImagen($mysqli, $asunto, $categoria, $descripcion, $admin, $nombre_imagen);
                        //echo "<img src='http://localhost/foro/uploads/". basename($imagen_subida) ."' />";
                    }
                } else {
                    echo "Posible ataque del archivo subido: ";
                    echo "nombre del archivo '" . $_FILES['imagen']['tmp_name'] . "'.";
                }

                if ($resultado) {
                    $_SESSION['usuarioRegistrado'] = "Se ha registrado con éxito";
                    header('Location: ../vista/index.php');
                } else {
                    $_SESSION['usuarioRegistrado'] = "Se ha producido un error al registrarse";
                    $_SESSION['usuarioRegistrado'] = $_FILES['imagen']['size'];
                    $_SESSION['usuarioRegistrado2'] = $tipo;
                    header('Location: ../vista/index.php');
                }
            } else {
                echo "Archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
            }
        }

        break;

    default :

        echo 'ERROR EN LA VARIABLE ORIGEN';
}
