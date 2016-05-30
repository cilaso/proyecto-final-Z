<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>FormularioCrearHilo</title>
        <link rel="stylesheet" type="text/css" href="../css/cssForo.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </head>
    <body class="fondoCrearHilo">
        <?php
        session_start();
        ?>
        <div class="contenedorRegistro">
            <h1 class="titularRegistroForm">Crear hilo</h1>
            <form action="../controlador/main.php?origen=confirmarHilo" method="POST" enctype="multipart/form-data" >
                <div class="col-md-6 campoFormulario">
                    <label for="asunto">Asunto: </label>
                </div>
                <div class="col-md-6 campoFormulario">
                    <input type="text" id="asunto" name="asunto" required>
                </div>
                <div class="col-md-6 campoFormulario">
                    <label for="categoria">Categoria: </label>
                </div>
                <div class="col-md-6 campoFormulario">
                    <input type="text" id="categoria" name="categoria" required>
                </div>
                <div class="col-md-6 campoFormulario">
                    <label for="descripcion">Descripción: </label>
                </div>
                <div class="col-md-6 campoFormulario">
                    <input type="text" id="descripcion" name="descripcion" required>
                </div>
                <div class="col-md-6 campoFormulario">
                    <label for="imagen">Imagen: </label>
                </div>
                <div class="col-md-6 campoFormulario">
                    <input type="file" name="imagen" id="imagen"> 
                </div>
                <div class="col-md-12">
                    <input type="submit"  class="botonRegistro">
                </div>
            </form>   
        </div>       
    </body>
</html>
