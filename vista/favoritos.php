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
    <body>
        <div id="cabecera"> <!--LOGO Y COSAS CHULAS-->
            <ul id="mainMenu"> <!--MENU DE ARRIBA TIPICO DE TODAS LAS WEBS-->
                <li>Inicio</li>
                <li>Favoritos</li>
                <li>Mis hilos</li>
                <li>Buscar hilos</li>
            </ul>

            <!--PARTE DE ARRIBA A LA DERECHA TIPICA DE TODAS LAS WEBS CON LAS OPCIONES-->
            <?php
            session_start();
            include ("zonaLogin.php");
            ?>

        </div>
        <?php
        if ($_SESSION['misFavPedidos'] == false) {

            header("Location: ../controlador/main.php?origen=pedir_mis_fav"); //llamada a la base de datos para las tablas de hilos
        }

        $hiloFav = $_SESSION['misFavs'];
        ?>
        <div class="tablaHilos">
            <h1>Mis favoritos</h1>
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

                    echo("<td>'$filaFav[3]'</td>");
                    echo("<td>'$filaFav[1]'</td>");
                    echo("<td>'$filaFav[4]'</td>");
                    echo("<td>'$filaFav[7]'</td>");
                    echo("<td>'$filaFav[6]'</td>");
                    echo("<td>'$filaFav[2]'</td>");
                    echo('<td><a href="hilo.php?id_hilo=' . $filaFav[0] . '">Ir</a></td>');

                    echo("</tr>");
                }


                $_SESSION['misFavPedidos'] = false;
                ?>
            </table>
        </div>
    </body>
</html>
