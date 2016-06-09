<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>FormularioDeRegistro</title>
        <meta charset="UTF-8">
        <meta content="Antonio y Sergio" name="author" />
        <meta content="Foro General" name="description" />
        <meta content="foro, dudas, discusion, tema" name="keywords" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/342ee199d9.js"></script>

        <!-- Hojas de estilo general -->
        <link rel="stylesheet" type="text/css" href="../css/cssForo.css">

        <!-- Javascript para mostrar menú activo -->
        <script src="../js/javascriptForo.js" language="javascript" type="text/javascript"></script>
        <script src="../js/javascriptHeader.js" language="javascript" type="text/javascript"></script>

        <!-- Hojas de estilo para el header -->
        <link rel="stylesheet" href="../css/cssHeader.css">
        <script src="../js/javascriptHeader.js" language="javascript" type="text/javascript"></script>

        <!-- Hojas de estilo para el footer -->
        <link rel="stylesheet" href="../css/cssFooter.css">
        <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

    </head>
    <body class="decoradoRegistro"> 
        <header class="header-fixed">

            <div class="header-limiter">

                <h1><a href="#">Blog<span>Global</span></a></h1>

                <nav>
                    <a href="index.php">Inicio</a>
                    <a href="favoritos.php">Favoritos</a>
                    <a href="misHilos.php">Mis hilos</a>
                    <a href="buscarHilosForm.php">Buscar hilos</a>
                    <a href="contacto.php">Contacto</a>
                </nav>

            </div>

        </header>

        <!-- Es necesario este elemento para evitar que el contenido de la página salte -->
        <div class="header-fixed-placeholder"></div>

        <div class="container contenedorRegistro">
            <h1 class="titularRegistroForm">Registro</h1>
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
        <footer class="footer-distributed">

            <div class="footer-left">

                <h3>Blog <span>Global</span></h3>

                <p class="footer-links">
                    <a href="index.php" class="selected">Inicio</a> ·
                    <a href="favoritos.php">Favoritos</a> ·
                    <a href="misHilos.php">Mis hilos</a> ·
                    <a href="buscarHilosForm.php">Buscar hilos</a> ·
                    <a href="#">Contacto</a>        
                </p>

                <p class="footer-company-name">BlogGlobal &copy; 2016</p>
            </div>

            <div class="footer-center">
                <div>
                    <i class="fa fa-map-marker"></i>
                    <p><span>c/ Arturo Soria nº32</span> Madrid, España</p>
                </div>
                <div>
                    <i class="fa fa-phone"></i>
                    <p>91 463 11 72</p>
                </div>
                <div>
                    <i class="fa fa-envelope"></i>
                    <p><a href="mailto:support@blogglobal.com">support@bloggobal.com</a></p>
                </div>
            </div>

            <div class="footer-right">

                <p class="footer-company-about">
                    <span>Sobre la compañia</span>
                    Espacio dedicado a exponer dudas, consejos, sobre cualquier temática, de cualquier tipo.
                </p>

                <div class="footer-icons">

                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>

                </div>

            </div>

        </footer>
    </body>
</html>
