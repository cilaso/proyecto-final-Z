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
        session_start();
        
        if(isset($_SESSION['infoUsuario'])){
            
            $info = $_SESSION['infoUsuario'];
            
        }else{
            header('Location: ../controlador/main.php?origen=pedirInfoUsuario');
        }
        
        $info = $_SESSION['infoUsuario'];
        
        var_dump($info);
        
        ?>
        <form id="actualizar" method="POST" action="">
            
            
        
        </form>
    </body>
</html>
