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
                <li><a href="index.php">Inicio</a></li>
                <li><a href="favoritos.php">Favoritos</a></li>
                <li><a href="misHilos.php">Mis hilos</a></li>
                <li><a href="buscarHilos.php">Buscar hilos</a></li>
            </ul>

            <!--PARTE DE ARRIBA A LA DERECHA TIPICA DE TODAS LAS WEBS CON LAS OPCIONES-->
            <?php
            session_start();
            include ("zonaLogin.php");
            ?>

        </div>
        <?php
        if ($_SESSION['misHilosPedidos'] == false) {

            header("Location: ../controlador/main.php?origen=pedir_mis_hilos"); //llamada a la base de datos para las tablas de hilos
        }

        $misHilos = $_SESSION['misHilos'];
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
    </body>
</html>
