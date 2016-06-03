<!DOCTYPE html>
<html>
    <head>  
        <title>bIEnVEnIDoS sRs & SrAs</title>
        <meta charset="UTF-8">
        <meta content="Antonio y Sergio" name="author" />
        <meta content="Foro General" name="description" />
        <meta content="etiqueta1, etiqueta2, etiqueta3" name="keywords" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../css/cssForo.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://use.fontawesome.com/342ee199d9.js"></script>
        <script src="../js/javascriptForo.js" language="javascript" type="text/javascript"></script>

        <!-- Hojas de estilo para el header -->
        <!--<link rel="stylesheet" href="assets/demo.css">
        <link rel="stylesheet" href="assets/header-fixed.css">-->
        <link rel="stylesheet" href="../css/cssHeader.css">
        

        <!-- Hojas de estilo para el footer -->
        <!--<link rel="stylesheet" href="css/demo.css">
        <link rel="stylesheet" href="css/footer-distributed-with-address-and-phones.css">-->
         <link rel="stylesheet" href="../css/cssFooter.css">
        
        <link href='http://fonts.googleapis.com/css?family=Cookie' rel='stylesheet' type='text/css'>

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">

        <script>
            $(document).ready(function () {

                var showHeaderAt = 150;

                var win = $(window),
                        body = $('body');

                // Show the fixed header only on larger screen devices

                if (win.width() > 600) {

                    // When we scroll more than 150px down, we set the
                    // "fixed" class on the body element.

                    win.on('scroll', function (e) {

                        if (win.scrollTop() > showHeaderAt) {
                            body.addClass('fixed');
                        } else {
                            body.removeClass('fixed');
                        }
                    });

                }

            });

        </script>

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

                <h1><a href="#">Blog<span>Enterate</span></a></h1>

                <nav>
                    <a href="#" class="selected">Inicio</a>
                    <a href="#">Favoritos</a>
                    <a href="#">Mis hilos</a>
                    <a href="#">About</a>
                    <a href="#">Contact</a>
                </nav>

            </div>

        </header>

        <!-- You need this element to prevent the content of the page from jumping up -->
        <div class="header-fixed-placeholder"></div>

        <div class="container contenedor">
            <?php
            session_start();

            if ($_SESSION['hilosPedidos'] == false) {
                header("Location: ../controlador/main.php?origen=pedir_hilos"); //llamada a la base de datos para las tablas de hilos
            }

            echo "La fecha actual es " . date("d") . " del " . date("m") . " de " . date("Y");
            echo '<i class="fa fa-themeisle fa-3x" aria-hidden="true"></i>';
            echo '<br>';
            ?>

            <!--LOGO Y COSAS CHULAS-->
            <ul id="menu" class="row"> <!--MENU DE ARRIBA TIPICO DE TODAS LAS WEBS-->
                <li class="col-md-3 boton"><a href="index.php">Inicio</a></li>
                <li class="col-md-3 boton"><a href="favoritos.php">Favoritos</a></li>
                <li class="col-md-3 boton"><a href="misHilos.php">Mis hilos</a></li>
                <li class="col-md-3 boton"><a href="buscarHilosForm.php">Buscar hilos</a></li>
            </ul>

            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4">

                    <?php
                    if (isset($_REQUEST["mensaje"])) {
                        $mensaje = $_REQUEST["mensaje"];
                        echo '<p>' . $mensaje . '</p>';
                        var_dump($mensaje);
                    }

                    if (isset($_SESSION['usuarioRegistrado'])) {
                        echo '<div>' . $_SESSION['usuarioRegistrado'] . '</div>';
                    }
                    ?>

                    <!--PARTE DE ARRIBA A LA DERECHA TIPICA DE TODAS LAS WEBS CON LAS OPCIONES-->
                    <?php
                    include ("zonaLogin.php");
                    ?>

                </div>
            </div>

            <?php
            //TABLA DE HILOS FAVORITOS
            $hiloFav = array();
            $hiloFav = $_SESSION['hiloFav'];
            ?>
            <div class="tablaHilos  table-responsive">
                <h1>Hilos mas populares</h1>
                <table id="hilosFavoritos" class="table table-striped">
                    <tr>
                        <th>Categoria</th>
                        <th>Asunto</th>
                        <th>Descripcion</th>
                        <th>Likes</th>
                        <th>Fecha de creacion</th>
                        <th>Creador</th>
                        <th></th>
                    </tr>
                    <?php
                    foreach ($hiloFav as $filaFav) {
                        echo("<td>'$filaFav[3]'</td>");          // Categoria
                        echo("<td>'$filaFav[1]'</td>");          // Asunto
                        echo("<td>'$filaFav[4]'</td>");          // Descripcion
                        echo("<td>'$filaFav[7]'</td>");          // Likes
                        echo("<td>'$filaFav[6]'</td>");          // Fecha creacion
                        echo("<td>'$filaFav[2]'</td>");          // Creador
                        echo('<td><a href="hilo.php?id_hilo=' . $filaFav[0] . '">Ir</a></td>'); // Boton ir al hilo
                        echo("</tr>");
//                echo("</a>");
                    }
                    ?>
                </table>
            </div>
            <?php
            //TABLA DE HILOS RECIENTES

            $hiloNow = $_SESSION['hiloNow'];
            ?>
            <div class="tablaHilos  table-responsive">
                <h1>Hilos mas recientes</h1>    
                <table id="hilosRecientes" class="table table-hover">
                    <tr>
                        <th>Categoria</th>
                        <th>Asunto</th>
                        <th>Descripcion</th>
                        <th>Likes</th>
                        <th>Fecha de creación</th>
                        <th>Creador</th>
                        <th></th>
                    </tr>
                    <?php
                    foreach ($hiloNow as $filaNow) {
                        echo("<tr>");

                        echo("<td>'$filaNow[3]'</td>");
                        echo("<td>'$filaNow[1]'</td>");
                        echo("<td>'$filaNow[4]'</td>");
                        echo("<td>'$filaNow[7]'</td>");
                        echo("<td>'$filaNow[6]'</td>");
                        echo("<td>'$filaNow[2]'</td>");
                        echo('<td><a href="hilo.php?id_hilo=' . $filaNow[0] . '">Ir</a></td>');

                        echo("</tr>");
                    }

                    $_SESSION['hilosPedidos'] = false;
                    ?>
                </table>
            </div>

        </div>
        <footer class="footer-distributed">

            <div class="footer-left">

                <h3>Aqui me <span>entero</span></h3>

                <p class="footer-links">
                    <a href="#">Inicio</a>
                    ·
                    <a href="#">Favoritos</a>
                    ·
                    <a href="#">Mis hilos</a>
                    ·
                    <a href="#">About</a>
                    ·
                    <a href="#">Faq</a>
                    ·
                    <a href="#">Contacto</a>
                </p>

                <p class="footer-company-name">ForoEnterate</h3> &copy; 2016</p>
            </div>

            <div class="footer-center">

                <div>
                    <i class="fa fa-map-marker"></i>
                    <p><span>21 Revolution Street</span> Paris, France</p>
                </div>

                <div>
                    <i class="fa fa-phone"></i>
                    <p>+1 555 123456</p>
                </div>

                <div>
                    <i class="fa fa-envelope"></i>
                    <p><a href="mailto:support@company.com">support@company.com</a></p>
                </div>

            </div>

            <div class="footer-right">

                <p class="footer-company-about">
                    <span>Sobre la compañia</span>
                    Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.
                </p>

                <div class="footer-icons">

                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-github"></i></a>

                </div>

            </div>

        </footer>
        <!--
                <div id="footer_top">
                </div>
        
                <div id="footer_middle" >
                    <div id="footer_middle_img" >
                    </div>
                </div>
                <div id="footer_bottom" >
        
                    <table id="footer-bottom-table">
                        <tbody>
                            <tr>
                                <td>
                                    <table id="footer-nav">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="/index.php">
                                                        <img src="/wp-content/themes/default/images/footer_nav_home.gif" alt="home" />
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="/index.php/about/">
                                                        <img src="/wp-content/themes/default/images/footer_nav_about_us.gif" alt="about us" />
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="/index.php/services/">
                                                        <img src="/wp-content/themes/default/images/footer_nav_services.gif" alt="services" />
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="/index.php/blog/">
                                                        <img src="/wp-content/themes/default/images/footer_nav_blog.gif" alt="blog" />
                                                    </a>
                                                </td>
                                                <td>
                                                    <a href="/index.php/testimonials/">
                                                        <img src="/wp-content/themes/default/images/footer_nav_testimonial.gif" alt="testimonials" />
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="footer-copyright" colspan="5">
                                                    <img src="/wp-content/themes/default/images/footer_copyright.gif" alt="Copyright © yuru 2010 All rights reserved." />
        
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <a href="/index.php">
                                        <img src="/wp-content/themes/default/images/footer_yuru_text.gif" alt="home" />
                                    </a>
                                </td>
                            </tr>
                            <tr>
                              <td align="right" style="padding-right: 34px;"><span id="rftb">Web Design by <a href="http://www.rideforthebrand.net/" target="_blank"><!--<img src="/wp-content/themes/default/images/ride_bug.gif" height="19" width="107" alt="Ride For The Brand" />Fort Worth Web Designer</a> Ride For The Brand</span></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
        
                </div>
                
        -->

        <!--
               <div id="footer">
                   <div id="footerWrap">                           
                       <div id="footerfoot">
                           <p><a href="mailto:info@lakers.com">info@lakersOnProject.com</a><br>
                               <a href="#">© Foro Archive Records</a>&nbsp; //&nbsp; <a href="http://www.google.com">Website Design by Sergi & Tony</a></p>
                       </div>
                   </div>
               </div>
        -->
    </body>
</html>
