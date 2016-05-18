<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        session_start();
        ?>
        <form action="../controlador/main.php?origen=confirmarHilo" method="POST" enctype="multipart/form-data" >
            <label for="asunto">Asunto: </label><input type="text" id="asunto" name="asunto" required>
            <label for="categoria">Categoria: </label><input type="text" id="categoria" name="categoria" required>
            <label for="descripcion">Descripción: </label><input type="text" id="descripcion" name="descripcion" required>
            <label for="imagen">Imagen: </label><input type="file" name="imagen" id="imagen"> 
            <input type="submit">
        </form>   
    </body>
</html>
