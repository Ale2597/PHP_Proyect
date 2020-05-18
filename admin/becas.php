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

            <h1>Administrar Becas</h1>
        </div>
        <div id="body">

            <!--
<ul>
<li>
<a href="#">
<img src="../images/the-father.jpg" alt="">
<span>Hiram Vera</span>
</a>
</li>
<li>
<a href="#">
<img src="../images/the-actor.jpg" alt="">
<span>Alejandro Zeno</span>
</a>
</li>
<li>
<a href="#">
<img src="../images/the-nerd.jpg" alt="">
<span>Gabriel Ferrer</span>
</a>
</li>
</ul>
-->


            <?php 
            $query = "SELECT *
                      FROM (becas_departamento JOIN depto USING (depto_id)) RIGHT OUTER JOIN becas USING (beca_id)";

            if($r = mysqli_query($dbc, $query))
            {
                print"<div><center><table id='table1'>";
                print"<tr id='table_header'>
                        <td><b>Nombre Beca</b></td>
                        <td><b>Fondo Total</b></td>
                        <td><b>Límite a ser Otorgado</b></td>
                        <td><b>Fondo Disponible</b></td>
                        <td><b>Promedio Mínimo</b></td>
                        <td><b>Departamento</b></td>
												<td><b>Status</b></td>
												<td>------</td>
												<td>------</td>
                        </tr>";

                while($row=mysqli_fetch_array($r))
                {
                    if(is_null($row["nombre_depto"]))
                    {
                        $nombre_depto = "N/A";
                    }

                    else
                        $nombre_depto = $row["nombre_depto"];

                    print"<tr id='table_rows'>
                        <td>$row[nombre_beca]</td>
                        <td>$row[fondo_beca]</td>
                        <td>$row[tope_beca]</td>
                        <td>$row[balance_beca]</td>
                        <td>$row[promedio_min]</td>
                        <td>".$nombre_depto."</td>
				        <td>$row[status]</td>
				        <td><a class=\"aE\" href=\"editar_beca.php?beca_id=".$row['beca_id']."\">Editar</a></td>
                        <td><a class=\"aB\" href=\"eliminar_beca.php?beca_id=".$row['beca_id']."\">Borrar</a></td>
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
