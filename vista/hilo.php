<!DOCTYPE html>
<html>
    <head>
        <title>Hilo</title>
        <meta charset="UTF-8">
        <meta content="Antonio y Sergio" name="author" />
        <meta content="Foro General" name="description" />
        <meta content="etiqueta1, etiqueta2, etiqueta3" name="keywords" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/cssForo.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/342ee199d9.js"></script>
        <script src="../js/javascriptForo.js" language="javascript" type="text/javascript"></script>
    </head>

    <?php
    include ("../modelo/DB.php");

    session_start();

    if (isset($_REQUEST['id_hilo'])) {
        $id_hilo = $_REQUEST['id_hilo'];
        $_SESSION['id_hilo'] = $id_hilo;
    } else {
        $id_hilo = $_SESSION['id_hilo'];
    }

    $resultadoHilo = pedirHiloPorId($mysqli, $id_hilo); //informacion del hilo actual

    $hilo = mysqli_fetch_array($resultadoHilo);

    $resultadoMensajes = pedirMensajes($mysqli, $id_hilo); //comentarios del hilo actual

    $mensajes = array();

    while ($fila = mysqli_fetch_array($resultadoMensajes, MYSQLI_BOTH)) {

        $mensajes[] = $fila;
    }
    ?>

    <div class="container contenedor">
        <?php
        echo "La fecha actual es " . date("d") . " del " . date("m") . " de " . date("Y");
        echo '<i class="fa fa-themeisle fa-3x" aria-hidden="true"></i>';
        echo '<br>';
        ?>
        <!--LOGO Y COSAS CHULAS-->
        <ul id="mainMenu" class="row"> <!--MENU DE ARRIBA TIPICO DE TODAS LAS WEBS-->
            <li class="col-md-3 boton"><a href="index.php">Inicio</a></li>
            <li class="col-md-3 boton"><a href="favoritos.php">Favoritos</a></li>
            <li class="col-md-3 boton"><a href="misHilos.php">Mis hilos</a></li>
            <li class="col-md-3 boton"><a href="buscarHilosForm.php">Buscar hilos</a></li>
        </ul>

        <!--PARTE DE ARRIBA A LA DERECHA TIPICA DE TODAS LAS WEBS CON LAS OPCIONES-->
        <!--<div class="row creadorHilo">
            <div class="col-md-12" hiloUsuario>
        -->
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <?php
                include ("zonaLogin.php");
                ?>
            </div>
        </div>
        <div class="row hiloCelda">
            <div class="col-md-4 hiloComentario">
                Propietario: <?php echo $hilo[2]; ?> 
            </div>
            <div class="col-md-8 hiloComentario">
                Nombre: <?php echo $hilo[1]; ?> <br>
                Categoria: <?php echo $hilo[3]; ?> <br>
                Descripcion: <?php echo $hilo[4]; ?> <br>
                Likes: <?php echo $hilo[6]; ?> <br>
                Creador: <?php echo $hilo[2]; ?> <br>
                Fecha de creacion: <?php echo $hilo[5]; ?> <br>
                <?php
                if (isset($_SESSION['username'])) {
                    echo ('<form action="../controlador/main.php?origen=marcarFav" method="POST">');
                    echo ("<input type='hidden' name='id_hilo' value=\"" . $hilo[0] . "\">");
                    echo ("<input type='submit' value='marcar como favorito'>");
                    echo("</form>");

                    echo "ESTO AUN NO FUNCIONA";
                    echo ('<form action="../controlador/main.php?origen=darLike" method="POST">');
                    echo ("<input type='hidden' name='id_hilo' value=" . $hilo[0] . ">");
                    echo ("<input type='submit' value='Like!'>");
                    echo("</form>");
                    echo '<div class="rating">';
                    echo '<span><i class="fa fa-thumbs-up fa-3x" aria-hidden="true"></i></span>'
                    . '<span><i class="fa fa-thumbs-down fa-3x" aria-hidden="true"></i></span>'
                    . '<span><i class="fa fa-thumbs-o-up fa-3x" aria-hidden="true"></i></span>'
                    . '<span><i class="fa fa-thumbs-o-down fa-3x" aria-hidden="true"></i></span>';
                    echo '</div>';
                }
                ?>

            </div>
        </div>


        <?php
        if (isset($_SESSION['username'])) {

            echo ("<div id='comentar'>");
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
                echo '<i class="fa fa-quote-right" aria-hidden="true"></i>';
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
                    echo '<i class="fa fa-trash-o" aria-hidden="true"></i>';
                    echo ("</form>");
                }
            }
            echo '</div>';
            echo '</div>';
            ?>
        </div>
    </div>

</html>
