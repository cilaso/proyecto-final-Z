<?php

include ("../modelo/DB.php");

session_start();

$origen = $_REQUEST['origen'];

switch ($origen) {

    case "pedir_hilos":

        $hiloFav = pedirHilosFavoritos($mysqli);

        $hiloNow = pedirHilosRecientes($mysqli);

        $_SESSION['hiloFav'] = $hiloFav;
        $_SESSION['hiloNow'] = $hiloNow;
        $_SESSION['hilosPedidos'] = true;

        header("Location: ../vista/index.php");

        break;

    case "pedir_mis_fav":

        $username = $_SESSION['username'];

        $misFavs = pedirMisFav($mysqli, $username);

        $_SESSION['misFavs'] = $misFavs;
        $_SESSION['misFavPedidos'] = true;

        header("Location: ../vista/favoritos.php");

        break;

    case "pedir_mis_hilos":

        $username = $_SESSION['username'];

        $misHilos = pedirMisHilos($mysqli, $username);

        $_SESSION['misHilos'] = $misHilos;
        $_SESSION['misHilosPedidos'] = true;

        header("Location: ../vista/misHilos.php");

        break;

    case "pedirInfoUsuario":

        $info = pedirInfoUsuario($mysqli, $_SESSION['username']);
        
        $_SESSION['infoUsuario'] = $info;
        
        $_SESSION['infoPedida'] = true;
        
        header('Location: ../vista/miPerfil.php');

        break;

    case "actualizarUsuario":
        
        
        break;
    
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
            $_SESSION['usuarioIncorrecto'] = "404USER NO VALID";
            header("Location: ../../" . $_SESSION['url'] . "?mensaje='USUARIO INCORRECTO");
        }
        break;

    case "insertarMensaje":
        $mensaje = $_REQUEST['comentario'];
        $id_hilo = $_REQUEST['id_hilo'];
        insertarMensaje($mysqli, $_SESSION['username'], $id_hilo, $mensaje);
        header('Location: ../vista/hilo.php');
        break;

    case "cambiarPass":
        
        $pass = $_REQUEST['passActual'];
        $passNueva1 = $_REQUEST['passNueva1'];
        $passNueva2 = $_REQUEST['passNueva2'];
        
        $ok = confirmarUsuario($mysqli, $pass, $_SESSION['username']);
        
        if($ok){
            
            if($passNueva1 == $passNueva2){
                
                actualizarPass($mysqli, $passNueva1, $_SESSION['username']);
                
                $_SESSION['cambiarPass'] = "Cambio realizado con exito";
                
            }else{
                
                $_SESSION['cambiarPass'] = "No coinciden los dos valores";
                
            }
            
        }else{
            
            $_SESSION['cambiarPass'] = "Contraseña incorrecta";
            
        }
        
        header('Location: ../vista/miPerfil.php');
        
        break;
    
    case "marcarFav":
        $id_hilo = $_REQUEST['id_hilo'];
        $username = $_SESSION['username'];
        marcarHiloFavorito($mysqli, $username, $id_hilo);
        header('Location: ../vista/hilo.php');
        break;

    case "desmarcarFav":

        $id_hilo = $_REQUEST['id_hilo'];
        desmarcarHiloFavorito($mysqli, $_SESSION['username'], $id_hilo);
        header('Location: ../vista/favoritos.php');
        break;

    case "desconect":
        session_destroy();
        header('Location: ../vista/index.php');
        break;

    case "crearHilo":
        header('Location: ../vista/crearHiloForm.php');
        break;

    case "consultarImagen":
        $ruta = usuarioConImagen($mysqli, $_SESSION['username']);
        $_SESSION['rutaImagen'] = $ruta;
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

            echo "Ha ocurrido un error al cargar la imagen";

            $resultado = crearHilo($mysqli, $asunto, $categoria, $descripcion, $admin);

            if ($resultado) {
                $_SESSION['usuarioRegistrado'] = "Se ha publicado el hilo éxito";
                header('Location: ../vista/index.php');
            } else {
                $_SESSION['usuarioRegistrado'] = 'Se ha producido un error al publicar el hilo';
                header('Location: ../vista/index.php');
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
                    }
                } else {
                    $_SESSION['usuarioRegistrado'] = "Posible ataque del archivo subido: nombre del archivo '" . $_FILES['imagen']['tmp_name'] . "'. ";
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
                $_SESSION['usuarioRegistrado'] = "Archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
            }
        }

        break;

    default:
        $_SESSION['usuarioRegistrado'] = 'ERROR EN LA VARIABLE ORIGEN';
}