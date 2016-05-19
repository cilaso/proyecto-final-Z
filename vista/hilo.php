<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>

    <?php
    include ("../modelo/DB.php");


    session_start();


    if (isset($_SESSION['id_hilo'])) {
        $id_hilo = $_SESSION['id_hilo'];
    } else {
        $id_hilo = $_REQUEST['id_hilo'];
        $_SESSION['id_hilo'] = $id_hilo;
    }

    $resultadoHilo = pedirHiloPorId($mysqli, $id_hilo);

    $resultadoHilo = pedirHiloPorId($mysqli, $id_hilo); //informacion del hilo actual

    $hilo = mysqli_fetch_array($resultadoHilo);

    $resultadoMensajes = pedirMensajes($mysqli, $id_hilo); //comentarios del hilo actual

    $mensajes = array();

    while ($fila = mysqli_fetch_array($resultadoMensajes, MYSQLI_BOTH)) {

        $mensajes[] = $fila;
    }
    ?>

    <div id="cabecera"> <!--LOGO Y COSAS CHULAS-->
        <ul id="mainMenu"> <!--MENU DE ARRIBA TIPICO DE TODAS LAS WEBS-->
            <li>Inicio</li>
            <li>Favoritos</li>
            <li>Mis hilos</li>
            <li>Buscar hilos</li>
        </ul>

        <!--PARTE DE ARRIBA A LA DERECHA TIPICA DE TODAS LAS WEBS CON LAS OPCIONES-->
        <?php
        include ("zonaLogin.php");
        ?>


    </div>

    <div id='hilo' style="border:2px solid black;">
        Nombre: <?php echo $hilo[1]; ?> <br>
        Categoria: <?php echo $hilo[3]; ?> <br>
        Descripcion: <?php echo $hilo[4]; ?> <br>
        Likes: <?php echo $hilo[7]; ?> <br>
        Creador: <?php echo $hilo[2]; ?> <br>
        Fecha de creacion: <?php echo $hilo[6]; ?> <br>
        <?php
        if (isset($_SESSION['username'])) {
            echo ('<form action="../controlador/main.php?origen=marcarFav" method="POST">');
            echo ("<input type='hidden' name='id_hilo' value=" . $hilo[0] . ">");
            echo ("<input type='submit' value='marcar como favorito'>");
            echo("</form>");
        }
        ?>
    </div>

    <?php
    if (isset($_SESSION['username'])) {

        echo ("<div id='cometar'>");
        echo ('<form action="../controlador/main.php?origen=insertarMensaje" method="POST">');
        echo ("<input type=\"text\" name='comentario'>");
        echo ("<input type='hidden' name='id_hilo' value=" . $hilo[0] . ">");
        echo ("<input type='submit' value='enviar comentario'>");
        echo("</form>");
        echo("</div>");
    }
    ?>


    <div class='comentario'>
        <?php
        foreach ($mensajes as $mensaje) {
            echo("Persona que comenta: '$mensaje[0]'");

            echo ('<br>');
            echo("Comentario: '$mensaje[4]'");
            echo ('<br>');
            echo("Fecha de comentario: '$mensaje[2]'");
            echo ('<br>');
            if (isset($_SESSION['username']) && $mensaje[0] == $_SESSION['username']) { //formulario para borrar el mensaje si es tuyo
                echo ('<form action="../controlador/main.php?origen=borrarMensaje" method="POST">');
                echo ("<input type=\"hidden\" name=\"id_mensaje\" value=\"$mensaje[1]\">");
                echo ("<input type=\"submit\" value='borrar mensaje'>");
                echo ("</form>");
            }
        }
        ?>
    </div>


</html>