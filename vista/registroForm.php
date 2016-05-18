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
        // put your code here
        ?>
        
                Registrarse
                <form action="../controlador/registro.php" method="POST" enctype="multipart/form-data" >
                <label for="username">Nombre de usuario: </label><input type="text" id="username" name="username" required>
                <label for="password">Contraseña: </label><input type="password" id="password" name="password" required>
                <label for="password2">Repite la contraseña: </label><input type="password" id="password2" name="password2" required>
                <label for="nombre">Nombre: </label><input type="text" name="nombre" id="nombre" required>
                <label for="apellidos">Apellidos: </label><input type="text" name="apelidos" id="apelidos" required>
                <label for="correo">Correo: </label><input type="email" name="correo" id="correo" required>
                <label for="cumpleanios">Cumpleaños: </label><input type="date" name="cumpleanios" id="cumpleanios" min="1950-01-01" required>
                <label for="imagen">Imagen: </label><input type="file" name="imagen" id="imagen">
                <input type="submit">
                </form>
    </body>
</html>
