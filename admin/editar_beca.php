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

            table h3{
                color:black;
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
        </div>

        <div id="body">

            <?php

            if(isset($_GET['beca_id']) && is_numeric($_GET['beca_id']))
            {
                $query = "SELECT *
                          FROM (becas_departamento JOIN depto USING (depto_id)) RIGHT OUTER JOIN becas USING (beca_id)
                          WHERE beca_id = {$_GET['beca_id']}";


                if ($r = mysqli_query($dbc, $query))
                {
                    $row = mysqli_fetch_array($r);

                    print '<div><center><h1 style="color:black">Editar Beca</h1>
                   <form action="editar_beca.php" method="post">
                   <table id="table2" width="349" border="0">

                   <tr>
                        <td align="right"><h3 for="nombre_beca">Nombre Beca: </h3></td>
                        <td align="left">
                        <h3><input style="padding:6px" type="text" name="nombre_beca" id="nombre_beca"  value="'.$row['nombre_beca'].'"/></h3> 
                        </td>
                    </tr>

                    <tr>
                        <td align="right"><h3 for="fondo_beca">Fondo Total: </h3></td>
                        <td align="left">
                        <h3><input style="padding:6px" type="text" name="fondo_beca" id="fondo_beca" value="'.$row['fondo_beca'].'"/></h3> 
                        </td>
                    </tr>

                    <tr>
                        <td align="right"><h3 for="tope_beca">Limite a ser Otorgado: </h3></td>
                        <td align="left">
                        <h3><input style="padding:6px" type="text" name="tope_beca" id="tope_beca" value="'.$row['tope_beca'].'"/></h3> 
                        </td>
                    </tr>

                     <tr>
                        <td align="right"><h3 for="balance_beca">Fondo Disponible: </h3></td>
                        <td align="left">
                        <h3><input style="padding:6px" type="text" name="balance_beca" id="balance_beca" value="'.$row['balance_beca'].'"/></h3> 
                        </td>
                    </tr>

                     <tr>
                        <td align="right"><h3 for="promedio_min">Promedio Minimo: </h3></td>
                        <td align="left">
                        <h3><input style="padding:6px" type="text" name="promedio_min" id="promedio_min" value="'.$row['promedio_min'].'"/></h3> 
                        </td>
                    </tr>

                    <tr>
                        <td align="right"><h3>Departamento</h3></td>
                        <td align="left">
                        <select name="depto_id" id="nombre_depto" required>
                      '; ?>

            <?php

                    //Query para seleccionar departamentos.
                    $query2 = "SELECT d.depto_id, d.nombre_depto
                               FROM depto d";

                    $r2 = mysqli_query($dbc,$query2);

                    if($r2 = mysqli_query($dbc, $query2))
                    {
                        while($row2=mysqli_fetch_array($r2))
                        {
                            print "<option value='$row2[depto_id]'";
                            if ($row['depto_id']==$row2['depto_id']) echo "selected";

                            print ">$row2[nombre_depto]</option>";
                        }
                    }
            ?>

            <?php

                    print '
                  </select>

                   </td>
                    </tr>

                    <tr>

                     <tr>
                      <td align="right"><h3 for="status">Status: </h3></td>
                      <td align="left">
                      <h3><input style="padding:6px" type="text" name="status" id="status" value="'.$row['status'].'"/></h3> 
                      </td>
                    </tr>

                    <tr>
                    <td colspan="2" align="center">
                      <input class="b1" type="submit" name="Editar" id="Editar" value="Editar" />
                      <input type="hidden" name="beca_id" value="'.$_GET['beca_id'].'" />
                    </td>
                    </tr>
                </table>
                </form>
                </center>
               </div>';
                }

                else
                    print '<h3 style="color:red;">No se puede mostrar la información del usuario ya que ocurrió el error:<br />' . mysqli_error($dbc) . '</h3>';

            }

            else if(isset($_POST['beca_id']) && is_numeric($_POST['beca_id']))
            {
                $nombre_beca = $_POST['nombre_beca'];
                $fondo_beca = $_POST['fondo_beca'];
                $tope_beca = $_POST['tope_beca'];
                $balance_beca = $_POST['balance_beca'];
                $promedio_min = $_POST['promedio_min'];
                $status = $_POST['status'];   

                $query = "UPDATE becas SET nombre_beca= '$nombre_beca', fondo_beca = '$fondo_beca', tope_beca='$tope_beca', 
                                           balance_beca='$balance_beca', promedio_min = '$promedio_min', status = '$status'
                          WHERE beca_id={$_POST['beca_id']}";
                
                if(mysqli_query($dbc, $query))
                {
                    echo "<script>alert('La beca ha sido actualizada exitosamente!')</script>";
                    echo "<script>window.open('becas.php','_self')</script>";
                }

                else	  
                    print '<h3 style="color:red;">No se pudo actualizar la información de la beca ya que ocurrió el error:<br />' . mysqli_error($dbc). '</h3>';
            }

            else
            {
                print '<h3 style="color:red;">Esta página ha sido accedida por error!</h3>';
            }

            mysqli_close($dbc);
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
