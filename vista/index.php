<!DOCTYPE html>
<html>
    <head>  
        <title>The_Global_Blog</title>
        <meta charset="UTF-8">
        <meta content="Antonio y Sergio" name="author" />
        <meta content="Foro General" name="description" />
        <meta content="foro, dudas, discusion, tema" name="keywords" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/342ee199d9.js"></script>
        
        <!-- Hojas de estilo general -->
        <link rel="stylesheet" type="text/css" href="../css/cssForo.css">
        
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

        <script>
            /*Para enlaces de menú con ruta relativa y sin parámetros:*/
            $(document).ready(function () {
            url_completa = location.href; //URL de la pagina actual
            url_incio = url_completa.lastIndexOf("/");
            pagina_actual = url_completa.slice(url_incio + 1); //Extraemos el nombre de la pagina
                // Asignamos la clase llamada "activo" 
                $("#menu li a[href='" + pagina_actual + "']").parent().addClass("activo");
            });
        </script>
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

        <!--<div class="container contenedor">-->
        <?php
        session_start();
        if ($_SESSION['hilosPedidos'] == false) {
            header("Location: ../controlador/main.php?origen=pedir_hilos"); //llamada a la base de datos para las tablas de hilos
        }
        ?>

        <div class="row">
            <div class="col-md-8" >
        <?php if(isset($_REQUEST['mensaje'])){
                    echo '<p>';
                    echo $_REQUEST['mensaje'];
                    echo '</p>';
                 }
                
                 ?>
            </div>
            <div class="col-md-4" >

        <?php
                if (isset($_REQUEST["mensaje"])) {
                    $mensaje = $_REQUEST["mensaje"];
                    echo '<p>' . $mensaje . '</p>';
                    var_dump($mensaje);
                }

                if (isset($_SESSION['usuarioRegistrado'])) {
                    echo '<div>' . $_SESSION['usuarioRegistrado'] . '</div>';
                }
                ?>
                <!--PARTE DE ARRIBA A LA DERECHA TIPICA DE TODAS LAS WEBS CON LAS OPCIONES-->
                <?php
                include ("zonaLogin.php");
                ?>

            </div>
        </div>

        <?php
        //TABLA DE HILOS FAVORITOS
        $hiloFav = array();
        $hiloFav = $_SESSION['hiloFav'];
        ?>
        <div class="tablaHilos  table-responsive">
            <h1>Hilos mas populares</h1>
            <table id="hilosFavoritos" class="table table-striped">
                <tr>
                    <th>Categoria</th>
                    <th>Asunto</th>
                    <th>Descripcion</th>
                    <th>Likes</th>
                    <th>Fecha de creacion</th>
                    <th>Creador</th>
                    <th></th>
                </tr>
        <?php
                foreach ($hiloFav as $filaFav) {
                    echo("<td>'$filaFav[3]'</td>");          // Categoria
                    echo("<td>'$filaFav[1]'</td>");          // Asunto
                    echo("<td>'$filaFav[4]'</td>");          // Descripcion
                    echo("<td>'$filaFav[6]'</td>");          // Likes
                    echo("<td>'$filaFav[5]'</td>");          // Fecha creacion
                    echo("<td>'$filaFav[2]'</td>");          // Creador
                    echo('<td><a href="hilo.php?id_hilo=' . $filaFav[0] . '">Ir</a></td>'); // Boton ir al hilo
                    echo("</tr>");
                }
                ?>
            </table>
        </div>
        <?php
        //TABLA DE HILOS RECIENTES

        $hiloNow = $_SESSION['hiloNow'];
        ?>
        <div class="tablaHilos  table-responsive">
            <h1>Hilos mas recientes</h1>    
            <table id="hilosRecientes" class="table table-hover">
                <tr>
                    <th>Categoria</th>
                    <th>Asunto</th>
                    <th>Descripcion</th>
                    <th>Likes</th>
                    <th>Fecha de creación</th>
                    <th>Creador</th>
                    <th></th>
                </tr>
        <?php
                foreach ($hiloNow as $filaNow) {
                    echo("<tr>");

                    echo("<td>'$filaNow[3]'</td>");
                    echo("<td>'$filaNow[1]'</td>");
                    echo("<td>'$filaNow[4]'</td>");
                    echo("<td>'$filaNow[6]'</td>");
                    echo("<td>'$filaNow[5]'</td>");
                    echo("<td>'$filaNow[2]'</td>");
                    echo('<td><a href="hilo.php?id_hilo=' . $filaNow[0] . '">Ir</a></td>');

                    echo("</tr>");
                }

                $_SESSION['hilosPedidos'] = false;
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
    </body>
</html>
