<?php

//CONEXION CON LA BASE DE DATOS 
//$mysqli = new mysqli("192.168.1.177", "tony", "tony", "foro_db");  // PC SOAINT TONY
$mysqli = new mysqli("192.168.1.146", "root", "root", "foro_db");    // PC SOAINT SERGIO
//$mysqli = new mysqli("192.168.1.238", "root", "root", "foro_db");  // PC CASA SERGIO


if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

/* FUNCIONES DE REGISTRO USUARIO O RELACIONADAS CON EL USUARIO */

function registrarUsuario($mysqli, $username, $password, $nombre, $apellidos, $correo, $fecha_nacimiento) {

    $resultado = $mysqli->query("INSERT INTO usuario (username,contrasenia,nombre,apellidos,correo,fecha_alta,fecha_nacimiento) VALUES('$username', '$password', '$nombre', '$apellidos', '$correo', now(), '$fecha_nacimiento');");

    return $resultado;
}

function registrarUsuarioConImagen($mysqli, $username, $password, $nombre, $apellidos, $correo, $fecha_nacimiento, $nombre_imagen) {

    $resultado = $mysqli->query("INSERT INTO usuario VALUES('$username', '$password', '$nombre', '$apellidos', '$correo', now(), '$fecha_nacimiento', '$nombre_imagen');");

    return $resultado;
}

function pedirUsuarios($mysqli) {

    $resultado = $mysqli->query("SELECT * FROM usuario;");

    return $resultado;
}

function pedirInfoUsuario($mysqli, $username) {

    $resultado = $mysqli->query("SELECT * FROM usuario where username = '$username';");
    
    $resul = mysqli_fetch_array($resultado);
    
    return $resul;
 
}

function comprobarUsuario($mysqli, $username, $password) { //devuelve los usuarios con ese username y password
    
    $resultado = $mysqli->query("SELECT * FROM usuario WHERE username = '$username' AND contrasenia = '$password'");

    return $resultado;
}

function usuarioConImagen($mysqli, $username) {

    $resultado = $mysqli->query("SELECT nombre_imagen FROM usuario WHERE username = '$username' ");

    $ruta_imagen = mysqli_fetch_array($resultado);

    if ($ruta_imagen[0] == NULL) {
        return "no-avatar.png";
    } else {
        return $ruta_imagen[0];
    }
}

function confirmarUsuario($mysqli, $pass, $username){
    
    $resultado = $mysqli->query("SELECT * FROM usuario WHERE username = '$username' AND contrasenia = '$pass'");
    
    if ($resultado->num_rows > 0){
        return true;
    }else{
        return false;
    }
    
}

function actualizarPass($mysqli, $passNueva1, $username){
    
    $mysqli->query("update usuario set contrasenia = '$passNueva1' where username = '$username'");
    
}

/* FUNCIONES DE REGISTRO HILO O RELACIONADAS CON HILOS */

function crearHilo($mysqli, $asunto, $categoria, $descripcion, $admin) {

    $resultado = $mysqli->query("INSERT INTO hilo (asunto,admin,categoria,descripcion,fecha_creacion,likes) VALUES('$asunto', '$admin', '$categoria', '$descripcion', now(), 0 );");

    return $resultado;
}

function crearHiloConImagen($mysqli, $asunto, $categoria, $descripcion, $admin, $nombre_imagen) {

    $resultado = $mysqli->query("INSERT INTO hilo (asunto,admin,categoria,descripcion,fecha_creacion,likes, nombre_imagen) VALUES('$asunto', '$admin', '$categoria', '$descripcion', now(), 0 , '$nombre_imagen');");

    return $resultado;
}

function pedirHilosRecientes($mysqli) { //ultimos hilos creados
    $tablaNow = $mysqli->query("SELECT * FROM hilo ORDER BY fecha_creacion DESC;");

    $hiloNow = array();

    while ($filaNow = mysqli_fetch_array($tablaNow, MYSQLI_BOTH)) {

        $hiloNow[] = $filaNow;
    }

    return $hiloNow;
}

function pedirHiloPorId($mysqli, $id_hilo) { //ultimos hilos creados
    $resultado = $mysqli->query("SELECT * FROM hilo WHERE id_hilo = '$id_hilo';");

    return $resultado;
}

function pedirHilosFavoritos($mysqli) { //hilos ordenador por numero de likes
    $tablaFav = $mysqli->query("SELECT * FROM hilo ORDER BY likes DESC;");

    $hiloFav = array();

    while ($filaFav = mysqli_fetch_array($tablaFav, MYSQLI_BOTH)) {

        $hiloFav[] = $filaFav;
    }

    return $hiloFav;
}

function pedirMisFav($mysqli, $username) { //hilos marcados por mi como favorito
    $resultado = $mysqli->query("SELECT id_hilo FROM favorito where username = '$username';");

    $hilosFav = array();

    while ($idFav = mysqli_fetch_array($resultado, MYSQLI_BOTH)) {

        $hilosFav[] = $idFav[0];
    }

    $misFavs = array();

    foreach ($hilosFav as $id_hilo) {

        $resul = $mysqli->query("SELECT * FROM hilo where id_hilo = '$id_hilo';");

        $fav = mysqli_fetch_array($resul, MYSQLI_BOTH);


        $misFavs[] = $fav;
    }

    return $misFavs;
}

function pedirMisHilos($mysqli, $username) { //hilos ordenador por numero de likes
    $misHilos = $mysqli->query("SELECT * FROM hilo where admin = '$username';");

    $hilo = array();

    while ($filaFav = mysqli_fetch_array($misHilos, MYSQLI_BOTH)) {

        $hilo[] = $filaFav;
    }

    return $hilo;
}

function marcarHiloFavorito($mysqli, $username, $id_hilo) { //marcas un hilo como favorito tuyo
    $mysqli->query("insert into favorito values ('$username', '$id_hilo');");
}

function desmarcarHiloFavorito($mysqli, $username, $id_hilo) { //marcas un hilo como favorito tuyo
    $mysqli->query("delete from favorito where username = '$username' and id_hilo = '$id_hilo'");
}

function buscarHilo($mysqli, $query){
    
    $resultado = $mysqli->query("$query");
    
    
    $hilos = array();

    while ($hilo = mysqli_fetch_array($resultado, MYSQLI_BOTH)) {

        $hilos[] = $hilo;
    }


    return $hilos;
}

function hiloConImagen($mysqli, $id_Hilo) {

    $resultado = $mysqli->query("SELECT nombre_imagen FROM hilo WHERE id_Hilo = '$id_Hilo' ");

    $ruta_imagen = mysqli_fetch_array($resultado);

    if ($ruta_imagen[0] == NULL) {
        return "no-avatar.png";
    } else {
        return $ruta_imagen[0];
    }
}

/* FUNCIONES DE INSERTAR MENSAJE O RELACIONADAS CON LOS MENSAJES */

function insertarMensaje($mysqli, $remitente, $id_hilo, $mensaje) {

    $resultado = $mysqli->query("INSERT INTO mensaje (remitente, fecha_insercion, id_hilo_perteneciente, mensaje) VALUES('$remitente', now(), '$id_hilo', '$mensaje');");

    return $resultado;
}

function insertarMensajeConImagen($mysqli, $remitente, $id_hilo, $mensaje, $nombre_imagen) {

    $resultado = $mysqli->query("INSERT INTO mensaje (remitente, fecha_insercion, id_hilo_perteneciente, mensaje , nombre_imagen) VALUES('$remitente', now(), '$id_hilo', '$mensaje' , '$nombre_imagen');");

    return $resultado;
}

function pedirMensajes($mysqli, $id_hilo) { //devuelve los mensajes del hilo con id que le pases
    $resultado = $mysqli->query("SELECT * FROM mensaje WHERE id_hilo_perteneciente = '$id_hilo'");

    return $resultado;
}

function borrarMensaje($mysqli, $id_mensaje) {

    $resultado = $mysqli->query("delete from mensaje where id_mensaje = $id_mensaje;");
}

?>
