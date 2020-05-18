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
                    <a href="solicitantes.php">Solicitantes</a>
                </li>
                <li>
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

            <h1>Solicitudes</h1>
        </div>
        <div id="body">

            <?php 
            $query = "SELECT nombre, apellido1, apellido2, nombre_depto, nombre_beca, costo
                      FROM (usuarios NATURAL JOIN estudiantes) 
                      JOIN solicitud USING (user_id) 
                      JOIN depto USING (depto_id)
                      JOIN becas USING (beca_id)
                      ORDER BY nombre_beca";

            if($r = mysqli_query($dbc, $query))
            {
                print"<div><center><table id='table1'>";
                print"<tr id='table_header'>
                        <td><b>Nombre Estudiante</b></td>
                        <td><b>Departamento</b></td>
                        <td><b>Beca</b></td>
                        <td><b>Cantidad Solicitada</b></td>
                        </tr>";

                while($row=mysqli_fetch_array($r))
                {
                    print"<tr id='table_rows'>
                        <td>$row[nombre] $row[apellido1] $row[apellido2]</td>
                        <td>$row[nombre_depto]</td>
                        <td>$row[nombre_beca]</td>
                        <td>$row[costo]</td>
                        </tr>";
                }

                print"</table></center></div><br>";

                // print '<button><a href="./ejecutar_otorgacion.php?otorgar=1">Hacer Otorgación</a></button>';
				print '<button><a href="./version2.php">Hacer Otorgación</a></button>';
				print '<button><a href="./ejecutar_otorgacion.php?otorgar=0">Reset</a></button>';
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
