<!DOCTYPE html>
<html>
    <head>  
        <title>bIEnVEnIDoS sRs & SrAs</title>
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
        <div class="container contenedor">
            <?php
            session_start();

            if ($_SESSION['hilosPedidos'] == false) {
                header("Location: ../controlador/main.php?origen=pedir_hilos"); //llamada a la base de datos para las tablas de hilos
            }

            echo "La fecha actual es " . date("d") . " del " . date("m") . " de " . date("Y");
            echo '<i class="fa fa-themeisle fa-3x" aria-hidden="true"></i>';
            echo '<br>';
            ?>

            <!--LOGO Y COSAS CHULAS-->
            <ul id="menu" class="row"> <!--MENU DE ARRIBA TIPICO DE TODAS LAS WEBS-->
                <li class="col-md-3 boton"><a href="index.php">Inicio</a></li>
                <li class="col-md-3 boton"><a href="favoritos.php">Favoritos</a></li>
                <li class="col-md-3 boton"><a href="misHilos.php">Mis hilos</a></li>
                <li class="col-md-3 boton"><a href="buscarHilosForm.php">Buscar hilos</a></li>
            </ul>

            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4">

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
                        echo("<td>'$filaFav[7]'</td>");          // Likes
                        echo("<td>'$filaFav[6]'</td>");          // Fecha creacion
                        echo("<td>'$filaFav[2]'</td>");          // Creador
                        echo('<td><a href="hilo.php?id_hilo=' . $filaFav[0] . '">Ir</a></td>'); // Boton ir al hilo
                        echo("</tr>");
//                echo("</a>");
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
                        echo("<td>'$filaNow[7]'</td>");
                        echo("<td>'$filaNow[6]'</td>");
                        echo("<td>'$filaNow[2]'</td>");
                        echo('<td><a href="hilo.php?id_hilo=' . $filaNow[0] . '">Ir</a></td>');

                        echo("</tr>");
                    }

                    $_SESSION['hilosPedidos'] = false;
                    ?>
                </table>
            </div>
            <div class="footer">
                
            </div>
        </div>
    </body>
</html>
