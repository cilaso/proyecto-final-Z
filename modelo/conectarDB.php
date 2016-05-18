<?php

class BD {
    /* Primero definimos la conexión a la base de datos */

    private $mysqli; // Nombre del conector
    private $host = "192.168.1.238"; // Nombre del host, nomalmente localhost
    private $usuario = "root"; // Usuario de la bbdd 
    private $password = "root"; // Contraseña de la bbdd 
    private $nombreBD = "foro_db"; // Nombre de la bbdd

    public function __construct() {

        $this->mysqli = mysqli_connect($host, $usuario, $password, $nombreBD);
    }

    function pedirUsuarios($mysqli) {

        $resultado = $mysqli->query("select * from usuario;");

        return $resultado;
    }

    function pedirHilosFavoritos($mysqli) { //hilos ordenador por numero de likes
        $resultado = $mysqli->query("select * from hilo order by likes desc;");

        return $resultado;
    }

    function pedirHilosRecientes($mysqli) { //ultimos hilos creados
        $resultado = $mysqli->query("select * from hilo order by fecha_creacion desc;");

        return $resultado;
    }

    function comprobarUsuario($mysqli, $username, $password) { //devuelve los usuarios con ese username y password
        $resultado = $mysqli->query("select * from usuario where username = '$username' and contrasenia = '$password'");

        return $resultado;
    }

    function registrarUsuario($mysqli, $username, $password, $nombre, $apellidos, $correo, $fecha_nacimiento) {

        $resultado = $mysqli->query("INSERT INTO usuario (username,contrasenia,nombre,apellidos,correo,fecha_alta,fecha_nacimiento) VALUES('$username', '$password', '$nombre', '$apellidos', '$correo', now(), '$fecha_nacimiento');");

        return $resultado;
    }

    function registrarUsuarioConImagen($mysqli, $username, $password, $nombre, $apellidos, $correo, $fecha_nacimiento, $data, $tipo) {

        $resultado = $mysqli->query("INSERT INTO usuario VALUES('$username', '$password', '$nombre', '$apellidos', '$correo', now(), '$fecha_nacimiento', '$data', '$tipo');");

        return $resultado;
    }

    function crearHilo($mysqli, $asunto, $categoria, $descripcion, $admin) {

        $resultado = $mysqli->query("INSERT INTO hilo (asunto,admin,categoria,descripcion,fecha_creacion,likes) VALUES('$asunto', '$admin', '$categoria', '$descripcion', now(), 0 );");

        return $resultado;
    }

    function crearHiloConImagen($mysqli, $asunto, $categoria, $descripcion, $admin, $data, $tipo) {

        $resultado = $mysqli->query("INSERT INTO hilo (asunto,admin,categoria,descripcion,fecha_creacion,likes, imagen) VALUES('$asunto', '$admin', '$categoria', '$descripcion', now(), 0 , '$data', '$tipo');");

        return $resultado;
    }

}
