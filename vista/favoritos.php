<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mis Favoritos</title>
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
    <body>
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

        <!--PARTE DE ARRIBA A LA DERECHA TIPICA DE TODAS LAS WEBS CON LAS OPCIONES-->
        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <?php
                session_start();
                include ("zonaLogin.php");
                ?>
            </div>
        </div>
    </div>
    <?php
    if ($_SESSION['misFavPedidos'] == false) {
        header("Location: ../controlador/main.php?origen=pedir_mis_fav"); // Llamada a la base de datos para las tablas de hilos
    }

    $hiloFav = $_SESSION['misFavs'];
    ?>
    <div class="tablaHilos table-responsive">
        <h1>Mis favoritos</h1>
        <table id="hilosFavoritos" class="table table-striped">
            <tr>
                <th>Categoria</th>
                <th>Asunto</th>
                <th>Descripcion</th>
                <th>Likes</th>
                <th>Fecha de creacion</th>
                <th>Creador</th>
            </tr>
            <?php
            foreach ($hiloFav as $filaFav) {

                echo("<td>'$filaFav[3]'</td>");
                echo("<td>'$filaFav[1]'</td>");
                echo("<td>'$filaFav[4]'</td>");
                echo("<td>'$filaFav[7]'</td>");
                echo("<td>'$filaFav[6]'</td>");
                echo("<td>'$filaFav[2]'</td>");
                echo('<td><a href="hilo.php?id_hilo=' . $filaFav[0] . '">Ir</a></td>');
                echo ('<td>');
                echo ('<form action="../controlador/main.php?origen=desmarcarFav" method="POST">');
                echo ("<input type='hidden' name='id_hilo' value=" . $filaFav[0] . ">");
                echo ("<input type='submit' value='Desmarcar de favoritos'>");
                echo("</form>");
                echo ('</td>');
                echo("</tr>");
            }


            $_SESSION['misFavPedidos'] = false;
            ?>
        </table>
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

            <p class="footer-company-name">BlogGlobal&copy; 2016</p>
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
</body>
</html>
