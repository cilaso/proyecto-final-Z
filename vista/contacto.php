<!DOCTYPE html>
<html>
    <head>  
        <title>The_Global_Blog</title>
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

        <script>
            /*Para enlaces de menú con ruta relativa y sin parámetros:*/
            $(document).ready(function () {
                url_completa = location.href; //URL de la pagina actual
                url_incio = url_completa.lastIndexOf("/");
                pagina_actual = url_completa.slice(url_incio + 1); //Extraemos el nombre de la pagina
                // Asignamos la clase llamada "activo" 
                $("#menu li a[href='" + pagina_actual + "']").parent().addClass("activo");
            });
        </script>
    </head>
    <body>

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

        <form action="" class="contact-form">				
            <div class="formulario">
                <div class="column">
                    <label for="nombre">Nombre <span>(requerido)</span></label>
                    <input type="text" name="nombre" class="form-input" required="required"/>

                    <label for="email">Email <span>(requerido)</span></label>
                    <input type="email" name="email" class="form-input" required="required"/>

                    <label for="asunto">Asunto</label>
                    <input type="text" name="asunto" class="form-input" />
                </div>

                <div class="column">
                    <label for="mensaje">Mensaje <span>(requerido)</span></label>
                    <textarea name="mensaje" class="form-input" required="required"></textarea>
                </div>				

                <input class="form-btn" type="submit" value="Enviar Mensaje" />
            </div>		
        </form>

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
