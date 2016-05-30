<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Mis Hilos</title>
        <link rel="stylesheet" type="text/css" href="../css/cssForo.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/342ee199d9.js"></script>
        <script src="../js/javascriptForo.js" language="javascript" type="text/javascript"></script>
    </head>
    <body>
        <div class="container contenedor">
            <?php
            echo "La fecha actual es " . date("d") . " del " . date("m") . " de " . date("Y");
            echo '<i class="fa fa-themeisle fa-3x" aria-hidden="true"></i>';
            echo '<br>';
            ?>
            <div id="cabecera"> <!--LOGO Y COSAS CHULAS-->
                <ul id="menu" class="row"> <!--MENU DE ARRIBA TIPICO DE TODAS LAS WEBS-->
                    <li class="col-md-3 boton"><a href="index.php">Inicio</a></li>
                    <li class="col-md-3 boton"><a href="favoritos.php">Favoritos</a></li>
                    <li class="col-md-3 boton"><a href="misHilos.php">Mis hilos</a></li>
                    <li class="col-md-3 boton"><a href="buscarHilosForm.php">Buscar hilos</a></li>
                </ul>

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
            if ($_SESSION['misHilosPedidos'] == false) {

                header("Location: ../controlador/main.php?origen=pedir_mis_hilos"); //llamada a la base de datos para las tablas de hilos
            }

            $misHilos = $_SESSION['misHilos'];
            ?>
            <div class="tablaHilos table-responsive">
                <h1>Mis favoritos</h1>
                <table id="hilosFavoritos"  class="table table-striped">
                    <tr>
                        <th>Categoria</th>
                        <th>Asunto</th>
                        <th>Descripcion</th>
                        <th>Likes</th>
                        <th>Fecha de creacion</th>
                        <th>Creador</th>
                    </tr>
                    <?php
                    foreach ($misHilos as $fila) {

                        echo("<td>'$fila[3]'</td>");
                        echo("<td>'$fila[1]'</td>");
                        echo("<td>'$fila[4]'</td>");
                        echo("<td>'$fila[7]'</td>");
                        echo("<td>'$fila[6]'</td>");
                        echo("<td>'$fila[2]'</td>");
                        echo('<td><a href="hilo.php?id_hilo=' . $fila[0] . '">Ir</a></td>');
                        echo ('<td>');
                        echo ('</td>');
                        echo("</tr>");
                    }


                    $_SESSION['misHilosPedidos'] = false;
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>
