<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Registro</title>
    </head>
    <body> 
        Registrarse
        <form action="../controlador/registro.php" method="POST" enctype="multipart/form-data" >
            <label for="username">Nombre de usuario: </label><input type="text" id="username" name="username" required>
            <label for="password">Contraseña: </label><input type="password" id="password" name="password" required>
            <label for="password2">Repite la contraseña: </label><input type="password" id="password2" name="password2" required>
            <label for="nombre">Nombre: </label><input type="text" name="nombre" id="nombre" required>
            <label for="apellidos">Apellidos: </label><input type="text" name="apellidos" id="apellidos" required>
            <label for="correo">Correo: </label><input type="email" name="correo" id="correo" required>
            <label for="cumpleanios">Cumpleaños: </label><input type="date" name="cumpleanios" id="cumpleanios" min="1950-01-01" required>
            <label for="imagen">Imagen: </label><input type="file" name="imagen" id="imagen">
            <input type="submit">
        </form>
    </body>
</html>
