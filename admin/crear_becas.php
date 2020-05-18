<!doctype html>
<!-- Website Template by freewebsitetemplates.com -->
<?php 
//Empezar Sesion.
include('../conectiondb.php');
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
        <style>
            .head_a{
                background-color: none;
                color: #0ba39c;
                border-radius: 6px;
                position: relative;
                text-decoration-line: none;
            }

            .head_a:hover:not(.active){
                border-radius: 6px;
                background-color: none;
                color: #0ba39c;
            }
            .head_b{
                background-color: none;
                color: #0ba39c;
                border-radius: 6px;
                position: relative;
                text-decoration-line: none;
            }

            .head_b:hover:not(.active){
                border-radius: 6px;
                background-color: none;
                color: black;
            }
            .aE{

                color: #00FF40;
                position: relative;
                border: 3px;
                border-radius: 3px solid #00FF40;
                text-decoration-line: none;
            }

            .aE:hover:not(.active){
                color: #04B431;
                border: 3px;
                border-radius: 3px solid #04B431;
                text-decoration-line: none;
            }
            .aB{

                color: #FA5858;
                position: relative;
                border: 3px;
                border-radius: 3px solid #00FF40;
                text-decoration-line: none;
            }

            .aB:hover:not(.active){
                color: #B40404;
                border: 3px;
                border-radius: 3px solid #B40404;
                text-decoration-line: none;
            }
            .link_a{
                color: #0ba39c;
                display: inline-block;
                font-family: "Arial Black", Gadget, sans-serif;
                font-size: 14px;
                font-weight: normal;
                margin: 0;
                padding: 0 0 3px;
                text-decoration: none;
                text-transform: uppercase;
            }
            .link_a:hover{
                color: #1fc3bc;
                display: inline-block;
                font-family: "Arial Black", Gadget, sans-serif;
                font-size: 14px;
                font-weight: normal;
                margin: 0;
                padding: 0 0 3px;
                text-decoration: none;
                text-transform: uppercase;
            }

        </style>
    </head>
    <body>

        <div id="header">
            <a href="index.html" class="logo">
                <img src="../images/Logo_icon.png" alt="">
            </a>
            <ul id="navigation">
                <li>
                    <a href="index.php">home</a>
                </li>
                <li>
                    <a href="solicitantes.php">Solicitantes</a>
                </li>
                <li class="selected">
                    <a href="becas.php">Becas</a>
                </li>
                <li>
                    <a href="informes.php">Informes</a>
                </li>
                <li>
                    <a href="creadores.php">Creadores</a>
                </li>
                <li>
                    <a href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <div id="body">
            <div id="featured">
                <!--<img src="../images/Logo_icon.png" alt="">-->
                <img src="../images/logo_UPRA.JPEG" alt="">
                <div>

                    <h2>Entrar Beca Nueva <br>
                        <table>
                            <?php 





                            ?>
                        </table></h2>
                    <?php     

                    ?>

                    <br>
                    <a></a>	
                </div>
            </div>
            <ul>

            </ul>
        </div>
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
