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

        if ($_SESSION['infoPedida'] == false) {

            header('Location: ../controlador/main.php?origen=pedirInfoUsuario'); //llamada a la base de datos para la info del usuario
        }

        $info = $_SESSION['infoUsuario'];
        ?>

        <!--LOGO Y COSAS CHULAS-->
        <ul id="mainMenu" class="row"> <!--MENU DE ARRIBA TIPICO DE TODAS LAS WEBS-->
            <li class="col-md-3 boton"><a href="index.php">Inicio</a></li>
            <li class="col-md-3 boton"><a href="favoritos.php">Favoritos</a></li>
            <li class="col-md-3 boton"><a href="misHilos.php">Mis hilos</a></li>
            <li class="col-md-3 boton"><a href="buscarHilosForm.php">Buscar hilos</a></li>
        </ul>

        <div class="row">
            <div class="col-md-8"></div>
            <div class="col-md-4">
                <!--PARTE DE ARRIBA A LA DERECHA TIPICA DE TODAS LAS WEBS CON LAS OPCIONES-->
                <?php
                include ("zonaLogin.php");
                ?>

            </div>
        </div>

        <form id="actualizar" method="POST" action="../controlador/main.php?origen=actualizarUsuario">
            <?php
            echo 'Username: ';
            echo $info[0];
            echo '<br>';
            echo 'Nombre';
            echo ("<input type=\"text\" name=\"nombre\" value=\"" . $info[2] . "\">");
            echo '<br>';
            echo 'Apellidos: ';
            echo ("<input type=\"text\" name=\"apellidos\" value=\"" . $info[3] . "\">");
            echo '<br>';
            echo 'Correo: ';
            echo $info[4];
            echo '<br>';
            echo 'Fecha de alta: ';
            echo $info[5];
            echo '<br>';
            echo 'Fecha de nacimiento: ';
            echo $info[6];
            echo '<br>';
            if (!isset($_SESSION['rutaImagen'])) {
                header('Location: ../controlador/main.php?origen=consultarImagen');
            } else {
                echo ('<div class="col-md-5 divFoto">');
                echo "<img src='../uploads/" . $_SESSION['rutaImagen'] . "' class=fotoPerfil />";
                echo ('</div>');
            }
            echo("</div>");
            echo("</div>");
            ?>
            <input type='submit' value='Actualizar perfil'>
        </form>
        
        <?php
        
        if(isset($_SESSION['cambiarPass'])){
            echo $_SESSION['cambiarPass'];
            unset($_SESSION['cambiarPass']);
        }
        
        ?>
        
        <form id="cambiarContraseña" method="POST" action="../controlador/main.php?origen=cambiarPass">
            CAMBIAR CONTRASEÑA:
            <br>
            Contraseña antigua:
            <input type="password" name="passActual"><br>
            Contraseña nueva:
            <input type="password" name="passNueva1"><br>
            Repetir contraseña nueva:
            <input type="password" name="passNueva2"><br>
            <input type="submit" vslue="confirmar">
        </form>
    </body>
</html>
