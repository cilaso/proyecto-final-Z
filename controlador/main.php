<?php

include ("../modelo/DB.php");

session_start();

$origen = $_REQUEST['origen'];

switch ($origen){
    
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
    
        case "login":
            
            $username = $_REQUEST['username'];
            $password = $_REQUEST['password'];
            

            $resultado = comprobarUsuario($mysqli, $username, $password);

            if ($resultado->num_rows > 0) { //usuario y password correcto
                $filaR = mysqli_fetch_array($resultado);
                $_SESSION['username'] = $filaR[0];
                unset($_SESSION['usuarioIncorrecto']);
                header("Location: ../../".$_SESSION['url']."");
            } else { //usuario incorrecto
                $_SESSION['usuarioIncorrecto'] = 1;
                header("Location: ../../".$_SESSION['url']."");
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
        
        case "marcarFav":
            
            $id_hilo = $_REQUEST['id_hilo'];
            $username = $_SESSION['username'];
            
            marcarHiloFavorito($mysqli, $username, $id_hilo);
            
            header('Location: ../vista/hilo.php');
            
            break;
        
        case "consultarImagen":
          
            $ruta = usuarioConImagen($mysqli, $_SESSION['username']);
            $_SESSION['ruta'] = $ruta;
            header("Location: ../../".$_SESSION['url']."");
            break;
        
        case "confirmarHilo":
 
        case "borrarMensaje":
            $id_mensaje = $_REQUEST['id_mensaje'];
            borrarMensaje($mysqli, $id_mensaje);
            header('Location: ../vista/hilo.php');
            break;
        
        case "comprobarHilo":
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

                    //este es el archivo temporal
                    $imagen_temporal = $_FILES['imagen']['tmp_name'];
                    //este es el tipo de archivo
                    $tipo = $_FILES['imagen']['type'];
                    //leer el archivo temporal en binario
                    $fp = fopen($imagen_temporal, 'r+b');
                    $data = fread($fp, filesize($imagen_temporal));
                    fclose($fp);

                    $resultado = crearHiloConImagen($mysqli, $asunto, $categoria, $descripcion, $admin, $data, $tipo);

                    if ($resultado) {
                        $mensaje = 'Se ha publicado el hilo éxito';
                        var_dump($mensaje);
                        echo '$mensaje';
                        header('Location: ../vista/index.php?mensaje=$mensaje');
                    } else {
                        $mensaje = 'Se ha producido un error al publicar el hilo';
                        header('Location: ../vista/index.php?mensaje=$mensaje');
                    }
                } else {
                    echo "Archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
                }
            }
    
            break;
            
        default :
            
            echo 'ERROR EN LA VARIABLE ORIGEN';
            
            
    }
