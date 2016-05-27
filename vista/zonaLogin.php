<?php
$url = $_SERVER["REQUEST_URI"];
$porciones = explode("?", $url);
$url = $porciones[0]; //url actual
$url = substr($url, 1);
$_SESSION['url'] = $url;


if (isset($_SESSION['username'])) { //sesion iniciada
    ?>

    <div id="zonaLoginCon" class="row">
        <div class="col-md-12 nombreUsuario">
            <?php echo ($_SESSION['username']); ?>
        </div>
        <div class="row">
            <div class="col-md-7">
                <?php
                ?>
                <div class="row">
                    <div class="col-md-12 perfilBoton">
                        <i class="fa fa-power-off fa-2x" aria-hidden="true"></i>
                        <form action="../controlador/main.php?origen=desconect" method="POST"> <!-- Desconectarse -->
                            <input type="submit" value="Desconectarse">
                        </form>
                    </div>
                    <div class="col-md-12 perfilBoton">
                        <i class="fa fa-file-o fa-2x" aria-hidden="true"></i>
                        <form action="../controlador/main.php?origen=crearHilo" method="POST"> <!--  Crear hilo -->
                            <input type="submit" value="Crear hilo">
                        </form>
                    </div>
                    <div class="col-md-12 perfilBoton">
                        <i class="fa fa-user fa-2x" aria-hidden="true"></i>
                        <form action="miPerfil.php" method="POST"> <!--  Mi perfil -->
                            <input type="submit" value="Mi perfil">
                        </form>
                    </div>
                </div>
            </div>
            <?php
            if (!isset($_SESSION['rutaImagen'])) {
                header('Location: ../controlador/main.php?origen=consultarImagen');
            } else {
                echo ('<div class="col-md-5 divFoto">');
                echo "<img src='../uploads/" . $_SESSION['rutaImagen'] . "' class=fotoPerfil />";
                echo ('</div>');
            }
            echo("</div>");
            echo("</div>");
        } else { //sesion no iniciada
            echo("<div id=\"zonaLoginDesc\" class=\"row\">");
            echo ('<div class="col-md-12">');

            if (isset($_SESSION['usuarioIncorrecto'])) {
                echo 'USUARIO O PASSWORD INCORRECTO';
                echo '<br>';
                unset($_SESSION['usuarioIncorrecto']);
            }
            
            

            echo('iniciar sesion:');
            echo('<br>');
            echo("<form action=\"../controlador/main.php?origen=login&url=" . $_SESSION['url'] . "\" method=\"POST\">");
            echo('<br>');
            echo('<input type="text" name="username" class="campos" placeholder="username">');
            echo('<br>');
            echo('<input type="password" name="password" class="campos"  placeholder="password">');
            echo('<br>');
            echo('<input type="submit" class="campos" value="INICIAR SESIÓN">');
            echo('<br>');
            echo('</form>');

            if (isset($_SESSION['usuarioRegistrado'])) { /* ___ MENSAJE PARA CUANDO SE HA REGISTRADO CON O SIN ÉXITO ___ */
                echo '<div id="mensajeRegistroUsuario">' . $_SESSION['usuarioRegistrado'] . '</div>';
                unset($_SESSION['usuarioRegistrado']);
            }

            echo('<br>');
            echo('<form action="registroForm.php" method="POST">');
            echo('<br>');
            echo('<input type="submit" value="REGISTRARSE" class="campos">');
            echo('<br>');
            echo('</form>');
            echo('<br>');

            echo("</div>");
            echo("</div>");
        }
        ?>
