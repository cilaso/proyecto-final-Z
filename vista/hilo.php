<!DOCTYPE html>
<html>
    <head>
        <title>Hilo</title>
        <meta charset="UTF-8">
        <meta charset="UTF-8">
        <meta content="Antonio y Sergio" name="author" />
        <meta content="Foro General" name="description" />
        <meta content="foro, dudas, discusion, tema" name="keywords" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" type="text/css" href="../css/cssForo.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/342ee199d9.js"></script>

        <!-- Hojas de estilo gneraler -->
        <link rel="stylesheet" href="../css/cssHeader.css">

        <!-- Javascript para mostrar menú activo -->
        <script src="../js/javascriptForo.js" language="javascript" type="text/javascript"></script>
        <script src="../js/javascriptHeader.js" language="javascript" type="text/javascript"></script>

        <!-- Hojas de estilo para el header -->
        <link rel="stylesheet" href="../css/cssHeader.css">
        <script src="../js/javascriptHeader.js" language="javascript" type="text/javascript"></script>

        <!-- Hojas de estilo para el footer -->
        <link rel="stylesheet" href="../css/cssFooter.css">
        <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

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

    $mensajes = pedirMensajes($mysqli, $id_hilo); //comentarios del hilo actual
    
    $username = adminHilo($mysqli,  $id_hilo );
    $ruta_imagen_creador = usuarioConImagen($mysqli, $username );

    ?>

    <header class="header-fixed">

        <div class="header-limiter">

            <h1><a href="#">Blog<span>Global</span></a></h1>

            <nav>
                <a href="index.php">Inicio</a>
                <a href="favoritos.php">Favoritos</a>
                <a href="misHilos.php">Mis hilos</a>
                <a href="buscarHilosForm.php">Buscar hilos</a>
                <a href="contacto.php">Contacto</a>
            </nav>

        </div>

    </header>

    <!-- Es necesario este elemento para evitar que el contenido de la página salte -->
    <div class="header-fixed-placeholder"></div>

    <div class="container contenedor">

        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <?php
                include ("zonaLogin.php");
                ?>
            </div>
        </div>
        <div class="row hiloCeldaCreador">
            <div class="col-md-4 hiloComentario">
                <div class="posicion">Propietario: <?php echo $hilo[2]; ?></div>
                <div class="posicion"><?php echo "<img src='../uploads/" . $ruta_imagen_creador . "'/>"; ?></div>
                <?php
                //                $_SESSION["id_hilo"] = $hilo[0];
//                if (!isset($_SESSION['rutaImagen'])) {
//                    header('Location: ../controlador/main.php?origen=consultarImagenHilo');
//                } else {
//                    echo ('<div class="col-md-5 divFoto">');
//                    echo "<img src='../uploads/" . $_SESSION['rutaImagen'] . "' class=fotoPerfil />";
//                    echo ('</div>');
//                }
                ?>    
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
                    $fav = comprobarHiloFavorito($mysqli, $_SESSION['username'], $id_hilo);
                    $like = comprobarLikeHilo($mysqli, $_SESSION['username'], $id_hilo);
                    if ($fav == false) {
                        echo ('<form action="../controlador/main.php?origen=marcarFav" method="POST">');
                        echo ("<input type='hidden' name='id_hilo' value=\"" . $hilo[0] . "\">");
                        echo ("<input type='submit' value='marcar como favorito'>");
                        echo("</form>");
                    } else {
                        echo ('<form action="../controlador/main.php?origen=desmarcarFav" method="POST">');
                        echo ("<input type='hidden' name='id_hilo' value=\"" . $hilo[0] . "\">");
                        echo ("<input type='submit' value='desmarcar como favorito'>");
                        echo("</form>");
                    }


                    if ($like == false) {
                        echo ('<form action="../controlador/main.php?origen=darLike" method="POST">');
                        echo ("<input type='hidden' name='id_hilo' value=" . $hilo[0] . ">");
                        echo ("<input type='submit' id ='likeNegro' value='&nbsp;❤'>");
                        echo("</form>");
                    } else {
                        echo ('<form action="../controlador/main.php?origen=desmarcarLike" method="POST">');
                        echo ("<input type='hidden' name='id_hilo' value=" . $hilo[0] . ">");
                        echo ("<input type='submit' id ='likeRojo' value='&nbsp;❤'>");
                        echo("</form>");
                    }

                    echo '<div class="rating">';
                    echo '<span><i class="fa fa-thumbs-o-up fa-3x" aria-hidden="true"></i></span>'
                    . '<span><i class="fa fa-thumbs-o-down fa-3x" aria-hidden="true"></i></span>';
                    echo '</div>';
                }
                ?>

            </div>
        </div>

        <?php
        foreach ($mensajes as $mensaje) {
            echo '<div class="row hiloCelda">';
            $fecha_insercion = pedirHoraMensajes($mysqli, $mensaje[1]); // Comentarios del hilo actual
            echo '<div class="col-md-12 hiloComentario" style="border-bottom: 1px solid #D1D1D1;"><p style="margin-top: 0.5%;">Fecha de comentario: ' . $fecha_insercion . '</p></div>';

            echo '<div class="col-md-3 hiloComentario">';
            $ruta_imagen = usuarioConImagen($mysqli, $mensaje[0]);
            echo(" <div class='posicion'><p>Persona que comenta: '$mensaje[0]'</p></div>");
            echo " <div class='posicion'><img src='../uploads/" . $ruta_imagen . "'/></div>";
            echo '</div>';
            echo '<div class="col-md-9 hiloComentario">';
            echo '<i class="fa fa-quote-right fa-5x" aria-hidden="true"></i>';
            echo("<div><p>Comentario: '$mensaje[4]'</p>");
            echo("<p>Fecha de comentario: '$mensaje[2]'</p></div>");
            if (isset($_SESSION['username']) && $mensaje[0] == $_SESSION['username']) { //formulario para borrar el mensaje si es tuyo
                echo ('<form action="../controlador/main.php?origen=borrarMensaje" method="POST">');
                echo ("<input type=\"hidden\" name=\"id_mensaje\" value=\"$mensaje[1]\">");
                echo ("<input type=\"submit\" value='borrar mensaje'>");
                echo '<i class="fa fa-trash-o" aria-hidden="true"></i>';
                echo ("</form>");
            }
            echo '</div>';
            echo '</div>';
        }
        ?>

        <?php
        if (isset($_SESSION['username'])) {
            echo ("<div class='row'>");
            echo ("<div class='col-md-12 '>");
            echo ('<form action="../controlador/main.php?origen=insertarMensaje" method="POST">');
            echo ("<input type=\"text\" name='comentario'>");
            echo ("<input type='hidden' name='id_hilo' value=" . $hilo[0] . ">");
            echo ("<input type='submit' value='enviar comentario'>");
            echo("</form>");
            echo("</div>");
            echo("</div>");
        }
        ?>
    </div>
    <footer class="footer-distributed">

        <div class="footer-left">

            <h3>Blog <span>Global</span></h3>

            <p class="footer-links">
                <a href="index.php" class="selected">Inicio</a> ·
                <a href="favoritos.php">Favoritos</a> ·
                <a href="misHilos.php">Mis hilos</a> ·
                <a href="buscarHilosForm.php">Buscar hilos</a> ·
                <a href="#">Contacto</a>        
            </p>

            <p class="footer-company-name">BlogGlobal &copy; 2016</p>
        </div>

        <div class="footer-center">
            <div>
                <i class="fa fa-map-marker"></i>
                <p><span>c/ Arturo Soria nº32</span> Madrid, España</p>
            </div>
            <div>
                <i class="fa fa-phone"></i>
                <p>91 463 11 72</p>
            </div>
            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:support@blogglobal.com">support@bloggobal.com</a></p>
            </div>
        </div>

        <div class="footer-right">

            <p class="footer-company-about">
                <span>Sobre la compañia</span>
                Espacio dedicado a exponer dudas, consejos, sobre cualquier temática, de cualquier tipo.
            </p>

            <div class="footer-icons">

                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-github"></i></a>

            </div>

        </div>

    </footer>
</html>
