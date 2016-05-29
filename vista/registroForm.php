<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>FormularioDeRegistro</title>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/cssForo.css">
    </head>
    <body> 
        <div class="container contenedorRegistro">
            <h1 class="titularRegistroForm">Registrarse</h1>
            <form action="../controlador/registro.php" method="POST" enctype="multipart/form-data" class="row">
                <div class="col-md-6 campoFormulario">
                    <label for="username">Nombre de usuario: </label>
                </div>
                <div class="col-md-6 campoFormulario">
                    <input type="text" id="username" name="username" required class="campoFormularioInput">
                </div>
                <div class="col-md-6 campoFormulario">
                    <label for="password">Contraseña: </label>
                </div>
                <div class="col-md-6 campoFormulario">
                    <input type="password" id="password" name="password" required class="campoFormularioInput">
                </div>
                <div class="col-md-6 campoFormulario">
                    <label for="password2">Repite la contraseña: </label>
                </div>
                <div class="col-md-6 campoFormulario">
                    <input type="password" id="password2" name="password2" required class="campoFormularioInput">
                </div>
                <div class="col-md-6 campoFormulario">
                    <label for="nombre">Nombre: </label>
                </div>
                <div class="col-md-6 campoFormulario">
                    <input type="text" name="nombre" id="nombre" required class="campoFormularioInput">
                </div>
                <div class="col-md-6 campoFormulario">
                    <label for="apellidos">Apellidos: </label>
                </div>
                <div class="col-md-6 campoFormulario">
                    <input type="text" name="apellidos" id="apellidos" required class="campoFormularioInput">
                </div>
                <div class="col-md-6 campoFormulario">
                    <label for="correo">Correo: </label>
                </div>
                <div class="col-md-6 campoFormulario">
                    <input type="email" name="correo" id="correo" required  class="campoFormularioInput">
                </div>
                <div class="col-md-6 campoFormulario">
                    <label for="cumpleanios">Cumpleaños: </label>
                </div>
                <div class="col-md-6 campoFormulario">
                    <input type="date" name="cumpleanios" id="cumpleanios" min="1950-01-01" required  class="campoFormularioInput">
                </div>
                <div class="col-md-6 campoFormulario">
                    <label for="imagen">Imagen: </label>
                </div>
                <div class="col-md-6 campoFormulario">
                    <input type="file" name="imagen" id="imagen" class="campoFormularioInput">
                </div>
                <div class="col-md-12">
                    <input type="submit" class="botonRegistro">
                </div>
            </form>
        </div>
    </body>
</html>
