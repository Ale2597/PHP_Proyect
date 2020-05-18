<!doctype html>
<!-- Website Template by freewebsitetemplates.com -->
<?php 
include('../conectiondb.php');
//Empezar Sesion.
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Becas UPRA</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/mobile.css" media="screen and (max-width : 568px)">
        <script type="text/javascript" src="../js/mobile.js"></script>
    </head>
    <body>
        <?php 

        ?>
        <div id="header">
            <a href="index.html" class="logo">
                <img src="../images/Logo_icon.PNG" alt="">
            </a>
            <ul id="navigation">
                <li>
                    <a href="index.php">Inicio</a>
                </li>
                <li>
                    <a href="perfil_usuario.php">Perfil</a>
                </li>
                <li>
                    <a href="solicitud_ayuda_economica.php">Solicitar Beca</a>
                </li>
                <li>
                    <a href="solicitudes_usuario.php">Mis Solicitudes</a>
                </li>
                <li class="selected">
                    <a href="creadores_user.php">Creadores</a>
                </li>
                <li>
                    <a href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>

        <div id="body">
            <div id="featured">
                <h2 style="color:black">Desarrolladores del Sistema de Becas</h2>

                <div>
                </div>
            </div>
            <ul>
                <li>
                    <img src="../images/hiram.png" alt="" width='297' height='238'>
                    <span>Hiram Vera</span>
                    <span>Programador</span>
                </li>
                <li>
                    <img src="../images/alejandro.png" alt="" width='297' height='238'>
                    <span>Alejandro Zeno</span>
                    <span>Programador</span>
                </li>
                <li>
                    <img src="../images/gabriel.png" alt="" width='297' height='238'>
                    <span>Gabriel X. Ferrer</span>
                    <span>Programador</span>
                </li>

                <li>
                    <br><br>
                    <img src="../images/logo_upra.png" alt="" width='297' height='238'>
                    <span>Aixa Ramírez</span>
                    <span>Profesora</span>
                </li>
            </ul>
        </div>

        <br><br><br><br>
        <div id="footer">
            <div>
                <p>&copy; 2023 by Mustacchio. All rights reserved.</p>
                <ul>
                    <li>
                        <a href="http://freewebsitetemplates.com/go/twitter/" id="twitter">twitter</a>
                    </li>
                    <li>
                        <a href="http://freewebsitetemplates.com/go/facebook/" id="facebook">facebook</a>
                    </li>
                    <li>
                        <a href="http://freewebsitetemplates.com/go/googleplus/" id="googleplus">googleplus</a>
                    </li>
                    <li>
                        <a href="http://pinterest.com/fwtemplates/" id="pinterest">pinterest</a>
                    </li>
                </ul>
            </div>
        </div>
    </body>
</html>
