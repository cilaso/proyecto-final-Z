<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>bIEnVEnIDoS sRs & SrAs</title>
        <meta content="Antonio y Sergio" name="author" />
        <meta content="Foro General" name="description" />
        <meta content="etiqueta1, etiqueta2, etiqueta3" name="keywords" />
    </head>
    <body>
        <?php
        include ("../modelo/DB.php");
        session_start();
        
        echo "La fecha actual es " . date("d") . " del " . date("m") . " de " . date("Y"); echo '<br>';       
        ?>

        <form action="../controlador/imagen.php" method="POST" enctype="multipart/form-data" >
            <label for="imagen">Imagen: </label><input type="file" name="imagen" id="imagen">
            <input type="submit">
        </form>

        <div id="cabeceraIndex"> <!--LOGO Y BOTONES DE LOGIN-->
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
        <?php
        //TABLA DE HILOS FAVORITOS
        $tablaFav = pedirHilosFavoritos($mysqli);

        $hiloFav = array();

        while ($filaFav = mysqli_fetch_array($tablaFav, MYSQLI_BOTH)) {

            $hiloFav[] = $filaFav;
        }
        ?>
        <h1>Hilos mas populares</h1>
        <table id='hilosFavoritos'>
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

//                echo('<a href="www.google.com">');
                echo('<tr href="http://www.google.com">');

                echo("<td>'$filaFav[3]'</td>");
                echo("<td>'$filaFav[1]'</td>");
                echo("<td>'$filaFav[4]'</td>");
                echo("<td>'$filaFav[7]'</td>");
                echo("<td>'$filaFav[6]'</td>");
                echo("<td>'$filaFav[2]'</td>");

                echo("</tr>");
//                echo("</a>");
            }
            ?>
        </table>
        <?php
        //TABLA DE HILOS RECIENTES

        $tablaNow = pedirHilosRecientes($mysqli);

        $hiloNow = array();

        while ($filaNow = mysqli_fetch_array($tablaNow, MYSQLI_BOTH)) {

            $hiloNow[] = $filaNow;
        }
        ?>
        <h1>Hilos mas recientes</h1>    
        <table id='hilosRecientes'>
            <tr>
                <th>Categoria</th>
                <th>Asunto</th>
                <th>Descripcion</th>
                <th>Likes</th>
                <th>Fecha de felación</th>
                <th>Creador</th>
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
            ?>
        </table>
    </body>
</html>
