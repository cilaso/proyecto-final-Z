<?php

$url = $_SERVER["REQUEST_URI"];
    $porciones = explode("?", $url);
    $url = $porciones[0]; //url actual
    $url = substr($url, 1);
    $_SESSION['url'] = $url;

echo("<div id=\"zonaLogin\">");

if (isset($_SESSION['username'])) { //sesion iniciada
    echo ($_SESSION['username']);
    echo ('<form action="../controlador/main.php?origen=desconect" method="POST">');
    echo ('<input type="submit" value="desconectarse">');
    echo ('</form>');
    echo ('<form action="../controlador/main.php?origen=crearHilo" method="POST">');
    echo ('<input type="submit" value="Crear hilo">');
    echo ('</form>');
    
    if (!isset($_SESSION['ruta'])) {
        header('Location: ../controlador/main.php?origen=consultarImagen');
    } else {
        echo "<img src='../uploads/" . $_SESSION['ruta'] . "' />";
    }
} else { //sesion no iniciada
    if (isset($_SESSION['usuarioIncorrecto'])) {
        echo 'USUARIO O PASSWORD INCORRECTO';
    }

    echo('iniciar sesion:');
    echo('<br>');
    echo("<form action=\"../controlador/main.php?origen=login&url=".$_SESSION['url']."\" method=\"POST\">");
    echo('<br>');
    echo('<input type="text" name="username">');
    echo('<br>');
    echo('<input type="password" name="password">');
    echo('<br>');
    echo('<input type="submit">');
    echo('<br>');
    echo('</form>');
    echo('<br>');
    echo('<form action="registroForm.php" method="POST">');
    echo('<br>');
    echo('<input type="submit" value="Registrarse">');
    echo('<br>');
    echo('</form>');
    echo('<br>');

    if (isset($_SESSION['usuarioRegistrado'])) { /* ___ MENSAJE PARA CUANDO SE HA REGISTRADO CON O SIN ÉXITO ___ */

        echo '<div id="mensajeRegistroUsuario">' . $_SESSION['usuarioRegistrado'] . '</div>';
        /* echo '<div id="mensajeRegistroUsuario2">' . $_SESSION['usuarioRegistrado2'] . '</div>'; */
        unset($_SESSION['usuarioRegistrado']);
    }
}
echo("</div>");
?>
