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
        <?php
        session_start();
        ?>
        <form method="POST" action="../controlador/buscarHilos.php">
            Categoria:
            <input type="text" name="categoria"><br>
            Creador:
            <input type="text" name="creador"><br>
            Asunto:
            <input type="text" name="asunto"><br>
            Más likes que:
            <input type="number" name="likes1"><br>
            Menos likes que:
            <input type="number" name="likes2"><br>

            <input type="submit" value="buscar">
        </form>
        <?php
        if (isset($_SESSION['hilosBuscados'])) {
            
            $hilos = $_SESSION['hilosBuscados'];

            echo '<div class="tablaHilos  table-responsive">';
            echo '<h1>Hilos mas populares</h1>';
            echo '<table id="hilosFavoritos" class="table table-striped">';
            echo '<tr>
                        <th>Categoria</th>
                        <th>Asunto</th>
                        <th>Descripcion</th>
                        <th>Likes</th>
                        <th>Fecha de creacion</th>
                        <th>Creador</th>
                    </tr>';






            foreach ($hilos as $fila) {
                echo("<td>'$fila[3]'</td>");          // Categoria
                echo("<td>'$fila[1]'</td>");          // Asunto
                echo("<td>'$fila[4]'</td>");          // Descripcion
                echo("<td>'$fila[7]'</td>");          // Likes
                echo("<td>'$fila[6]'</td>");          // Fecha creacion
                echo("<td>'$fila[2]'</td>");          // Creador
                echo('<td><a href="hilo.php?id_hilo=' . $fila[0] . '">Ir</a></td>'); // Boton ir al hilo
                echo("</tr>");
//                echo("</a>");
            }

            echo '</table>
            </div>';
        }
        ?>
    </body>
</html>
