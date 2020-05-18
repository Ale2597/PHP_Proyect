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

        <style>
            #table1{
                background-color: azure;
                border-bottom: collapse;
                width: auto;
            }

            #table_header{
                text-align:center;
                background-color:#0ba39c;
                border-radius:5px;
            }

            #table_rows{
                text-align:center;
            }
            td{
                width: 300px;
                height: 50px;
            }
        </style>
    </head>
    <body>
        <div id="header">
            <a href="index.html" class="logo">
                <img src="../images/Logo_icon.PNG" alt="">
            </a>
            <ul id="navigation">
                <li>
                    <a href="index.php">Inicio</a>
                </li>
                <li class="selected">
                    <a href="perfil_usuario.php">Perfil</a>
                </li>
                <li>
                    <a href="solicitud_ayuda_economica.php">Solicitar Beca</a>
                </li>
                <li>
                    <a href="solicitudes_usuario.php">Mis Solicitudes</a>
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

            <?php 
            $query = "SELECT *
            FROM usuarios
            WHERE user_id={$_SESSION['user_id']}";

            if($r = mysqli_query($dbc, $query))
            {
                print"<div><center><table id='table1'>";
                print"<h2>Mi Perfil</h2>";
                print"<tr id='table_header'>
                        <td><b>Número de Usuario</b></td>
                        <td><b>Email</b></td>
                        <td><b>Contraseña</b></td>
                        <td><b>Teléfono</b></td>
                        <td><b>Status</b></td>
                        <td><b>Editar</b></td>
                        </tr>";

                while($row=mysqli_fetch_array($r))
                {
                    print"<tr id='table_rows'>
                        <td>$row[user_id]</td>
                        <td>$row[email]</td>
                        <td>$row[pass]</td>
                        <td>$row[tel]</td>
                        <td>$row[status]</td>
												<td ><a href='editar_usuario.php?user_id={$_SESSION['user_id']}'> 
												<img src='../images/edit_icon.png' width='20' height='20'></a></td>
                        </tr>";
                }

                print"</table></center></div><br>";
            }
            ?>
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
