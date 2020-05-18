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
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="perfil_usuario.php">Perfil</a>
                </li>
                <li>
                    <a href="solicitud_ayuda_economica.php">Solicitar Beca</a>
                </li>
                <li class="selected">
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

            <div>
                <?php 
                $query = "SELECT *
            FROM solicitud
            WHERE user_id={$_SESSION['user_id']}";

                if($r = mysqli_query($dbc, $query))
                {
                    print"<div><center><table id='table1'>";
                    print"<h2>Mis Solicitudes</h2>";
                    print"<tr id='table_header'>
                        <td><b>Nombre de Actividad</b></td>
                        <td><b>Costo</b></td>
                        <td><b>Fecha de Actividad</b></td>
                        <td><b>Fecha de Solicitud</b></td>
                        <td><b>Status</b></td>
						<td><b>Editar</b></td>
						<td><b>Eliminar</b></td>
                        </tr>";

                    while($row=mysqli_fetch_array($r))
                    {
                        print"<tr id='table_rows'>
                        <td>$row[actividad]</td>
                        <td>$row[costo]</td>
                        <td>$row[fecha_actividad]</td>
                        <td>$row[fecha_sol]</td>
                        <td>$row[status_sol]</td>
                        <td><a class='link_a' href=\"editar_solicitud.php?sol_id={$row['sol_id']}\">
				            <img width='25px' height='25px' alt=\"Edit\" src=\"../images/edit_icon.png\"></a></td>
				        <td><a class='link_a' href=\"eliminar_solicitud.php?sol_id={$row['sol_id']}\">
                            <img width='25px' height='25px' alt=\"Edit\" src=\"../images/eliminar_icon.png\"></a></td>
                        </tr>";
                    }

                    print"</table></center></div><br>";
                }
                ?>
            </div>
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
