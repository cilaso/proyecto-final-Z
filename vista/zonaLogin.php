<?php

$url = $_SERVER["REQUEST_URI"];
$porciones = explode("?", $url);
$url = $porciones[0]; //url actual
$url = substr($url, 1);
$_SESSION['url'] = $url;

if (isset($_SESSION['username'])) { //sesion iniciada
    echo("<div id=\"zonaLoginCon\" class=\"row\">");
    echo ('<div class="col-md-7">');
    echo ($_SESSION['username']);
    echo ('<form action="../controlador/main.php?origen=desconect" method="POST">'); // Desconectarse
    echo ('<input type="submit" value="desconectarse">');
    echo ('</form>');
    echo ('<form action="../controlador/main.php?origen=crearHilo" method="POST">'); // Crear hilo
    echo ('<input type="submit" value="Crear hilo">');
    echo ('</form>');
    echo ('<form action="miPerfil.php" method="POST">'); // Mi perfil
    echo ('<input type="submit" value="Mi perfil">');
    echo ('</form>');
    echo ('</div>');
    if (!isset($_SESSION['rutaImagen'])) {
        header('Location: ../controlador/main.php?origen=consultarImagen');
    } else {
        echo ('<div class="col-md-5 divFoto">');
        echo "<img src='../uploads/" . $_SESSION['rutaImagen'] . "' class=fotoPerfil />";
        echo ('</div>');
    }

    echo("</div>");
} else { //sesion no iniciada
    echo("<div id=\"zonaLoginDesc\" class=\"row\">");
    echo ('<div class="col-md-12">');
    if (isset($_SESSION['usuarioIncorrecto'])) {
        echo 'USUARIO O PASSWORD INCORRECTO';
        echo '<br>';
        unset($_SESSION['usuarioIncorrecto']);
    }


    if (isset($_SESSION['usuarioRegistrado'])) { /* ___ MENSAJE PARA CUANDO SE HA REGISTRADO CON O SIN ÉXITO ___ */
        echo '<div id="mensajeRegistroUsuario">' . $_SESSION['usuarioRegistrado'] . '</div>';
        unset($_SESSION['usuarioRegistrado']);
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
