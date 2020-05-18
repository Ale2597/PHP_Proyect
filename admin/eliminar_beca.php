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
                    <a href="creadores_admin.php">Creadores</a>
                </li>
                <li>
                    <a href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <div id="body">

            <div>
                <?php

                if(isset($_GET['beca_id']) && is_numeric($_GET['beca_id']))
                {
                    $query = "SELECT *
                              FROM (becas_departamento JOIN depto USING (depto_id)) RIGHT OUTER JOIN becas USING (beca_id)
                              WHERE beca_id = {$_GET['beca_id']}";


                    if($r = mysqli_query($dbc, $query))
                    {
                        print '<form action="eliminar_beca.php" method="post">';
                        print"<div><center><table id='table1'>";
                        print"<h2>Esta seguro que desea eliminar la siguiente beca?</h2>";
                        print"<tr id='table_header'>
                              <td><b>Nombre Beca</b></td>
                              <td><b>Fondo Total</b></td>
                              <td><b>Límite a ser Otorgado</b></td>
                              <td><b>Fondo Disponible</b></td>
                              <td><b>Promedio Mínimo</b></td>
                              <td><b>Departamento</b></td>
                              <td><b>Status</b></td>
                              </tr>";

                        while($row=mysqli_fetch_array($r))
                        {
                            print"<tr id='table_rows'>
                            <td>$row[nombre_beca]</td>
                            <td>$row[fondo_beca]</td>
                            <td>$row[tope_beca]</td>
                            <td>$row[balance_beca]</td>
                            <td>$row[promedio_min]</td>
                            <td>$row[nombre_depto]</td>
                            <td>$row[status]</td>
                            </tr>";
                        }

                        print"</table></center></div><br>";
                        print '<input type="hidden" name="beca_id" value="'.$_GET['beca_id'].'">
                               <input class="b1" type="submit" name="submit" value="Eliminar Beca">';
                        print"</form>";
                    }            

                    else
                    {
                        print '<p style="color:red;">No se pudo mostrar la beca que se desea eliminar porque: 
                        <br/>'.mysqli_error($dbc).'.</p>';
                    }
                }
                elseif(isset($_POST['beca_id']) && is_numeric($_POST['beca_id']))
                {
                    $query2 = "DELETE FROM becas WHERE beca_id={$_POST['beca_id']} LIMIT 1";
                    $r = mysqli_query($dbc, $query2);

                    if(mysqli_affected_rows($dbc) == 1)
                    {
                        echo "<script>alert('La beca ha sido eliminada con exito!!')</script>";
                        echo "<script>window.open('./becas.php','_self')</script>";
                    }
                    else
                        print '<p style="color:red;">No se pudo eliminar la beca porque: 
                <br/>'.mysqli_error($dbc).'.</p>';
                }
                else
                    print '<p style="color:red;">Esta pagina ha sido accedida con error!</p>';

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
