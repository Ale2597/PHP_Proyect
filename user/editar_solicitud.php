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
                background-color:darkkhaki;
            }

            #table_rows{
                text-align:center;
            }
            td{
                width: 300px;
                height: 50px;
            }
            table h3{
                color:cadetblue;
            }
            .b1{
                color:white;
                background-color:blue;
                font-size: 20px;
                background-image: linear-gradient(to bottom right, aqua, gray);
                padding: 9px;
                border: none;
                border-radius: 3px;
            }
            .b1:hover{
                color:white;
                background-color:darkgray;
                background-image: linear-gradient(to bottom right, aqua, black);
                padding: 9px;
                border: none;
                border-radius: 3px;
            }
        </style>
    </head>
    <body>
        <div id="header">
            <a href="index.html" class="logo">
                <img src="../images/Logo_icon.png" alt="">
            </a>
            <ul id="navigation">
                <li class="selected">
                    <a href="index.php">Home</a>
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
                <li>
                    <a href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <div id="body">

            <div>
                <?php

                if(isset($_GET['sol_id']) && is_numeric($_GET['sol_id']))
                {
                    $query = "SELECT *
                        FROM solicitud
                        WHERE sol_id={$_GET['sol_id']}";


                    if ($r = mysqli_query($dbc, $query))
                    {
                        $row = mysqli_fetch_array($r);

                        print '<div><center><h1>Editar Solicitud</h1>
                <form action="editar_solicitud.php" method="post">
                <table id="table2" width="349" border="0">

                    <tr>
                        <td align="right"><h3 for="nombre">Nombre de Actividad: </h3></td>
                        <td align="left">
                        <input style="padding:6px" type="text" name="nombre_actividad" id="nombre" value="' .$row['actividad'].'" required />
                        <span class="error">*</span>
                        </td>
                    </tr>

                    <tr>
                        <td align="right"><h3 for="costo">Costo: </h3></td>
                        <td align="left">
                        <input style="padding:6px" type="number" name="costo" id="costo" min="0" value="' .$row['costo'].'" required/> 
                        <span class="error">*</span>
                        </td>
                    </tr>

                    <tr>
                        <td align="right"><h3 for="fecha_actividad">Fecha de Actividad: </h3></td>
                        <td align="left">
                        <input style="padding:6px" type="date" name="fecha_actividad" id="fecha_actividad" value="' .$row['fecha_actividad'].'" />
                        </td>
                    </tr>

                    <tr>
                        <td align="right"><h3 for="fecha_solicitud">Fecha de Solicitud: </h3></td>
                        <td align="left"><label for="fecha_solicitud"></label>'.$row['fecha_sol'].'
                        <span class="error">*</span>
                        </td>
                    </tr>

                    <tr>
                        <td align="right"><h3 for="status">Status: </h3></td>
                        <td align="left"><label for="status"></label>'.$row['status'].'
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" align="center">
                        <input class="b1" type="submit" name="Editar" id="Editar Solicitud" value="Editar" />
                        <input type="hidden" name="sol_id" value="'.$_GET['sol_id'].'" />
                        </td>
                    </tr>
                </table>
                </form>
                </center>
            </div>';
                    }
                    else
                        print '<h3 style="color:red;">No se puede mostrar la información del admin ya que ocurrió el error:<br />' . mysqli_error($dbc) . '</h3>';

                }
                else if(isset($_POST['sol_id']) && is_numeric($_POST['sol_id']))
                {
                    $nombre_actividad = $_POST['nombre_actividad'];
                    $costo = $_POST['costo'];
                    $fecha_actividad = $_POST['fecha_actividad'];   

                    $query2 = "UPDATE solicitud 
                        SET actividad='$nombre_actividad', costo='$costo', fecha_actividad='$fecha_actividad'
                        WHERE sol_id={$_POST['sol_id']}";

                    if(mysqli_query($dbc, $query2)){
                        echo "<script>alert('La información de la Solicitud ha sido actualizada exitosamente!!')</script>";
                        echo "<script>window.open('./solicitudes_usuario.php','_self')</script>";
                    }
                    else	  
                        print '<h3 style="color:red;">No se pudo actualizar la información del admin ya que ocurrió el error:<br />' . mysqli_error($dbc). '</h3>';
                }
                else
                {
                    print '<h3 style="color:red;">Esta página ha sido accedida por error!</h3>';
                }

                mysqli_close($dbc);
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
