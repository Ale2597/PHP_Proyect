<!doctype html>
<!-- Website Template by freewebsitetemplates.com -->
<?php 
include('../conectiondb.php');
//Empezar Sesion.
session_start();
unset($_SESSION['beca_n']); 
unset($_SESSION['fondo_b']);
unset($_SESSION['c_date']);

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
                color: black;
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
                    <a href="index.php">Inicio</a>
                </li>
                <li>
                    <a href="perfil_usuario.php">Perfil</a>
                </li>
                <li class="selected">
                    <a href="solicitud_ayuda_economica.php">Solicitar Beca</a>
                </li>
                <li>
                    <a href="solicitudes_usuario.php">Mis Solicitudes</a>
                </li>
                <li>
                    <a href="creadores_user.php">Creadores</a>
                </li>
                <li>
                    <a href="../logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <div id="body">
            <?php   
            $mostrar = 3;
            $id = $_SESSION['user_id'];
            if (isset($_GET['p']))
                $pags = $_GET['p'];
            else 
            {
                //determinar total páginas requeridas para presentar todos los récords
                $q2 = "SELECT COUNT(beca_id) t FROM becas WHERE balance_beca>0";
                $r2 = mysqli_query($dbc, $q2);

                $row2 = mysqli_fetch_array($r2);
                $records = $row2['t'];//total de récords que trae el query
                if ($records > $mostrar)
                    $pags = ceil ($records/$mostrar);
                else
                    $pags = 1;

            }
            if (isset($_GET['s']))
                $start = $_GET['s'];
            else
                $start = 0;

            if (isset($_GET['orden']))
                $orden=$_GET['orden'];
            else
                $orden='b';

            switch($orden)
            {
                case 'b':   $order_by = 'balance_beca DESC';
                    break;

                default:    $order_by = 'tope_beca DESC';
            }
            ?>
            <div id="featured">
                <img src="../images/logo_UPRA.JPEG" alt="">
                <div style="padding-top:15px">
                    <h2> Welcome User <?php echo $_SESSION['nombre_user']; ?>! </h2>
                    <h2>Becas Disponibles <br>
                        <table>
                            <?php 
                            $m_query = "SELECT * 
                              FROM becas 
                              WHERE balance_beca>0
                              ORDER BY $order_by LIMIT $start, $mostrar"; 
                            $Mq = mysqli_query($dbc,$m_query);
                            if(mysqli_num_rows($Mq) == 0){
                                echo "NO hay ninguna beca disponible ;-;";
                                //header("insertar_user.php");
                            } 
                            else{
                                while($row = mysqli_fetch_array($Mq)){
                                    print "<tr>
													 <td><a class='head_a' href='beca_solicitud.php?beca=".$row['beca_id']."'><br>BECA |".$row['nombre_beca']."|</a> </td>
													 <td>  Fondo de Beca <b style='color:green'>$".$row['fondo_beca']."</b></td>
													 </tr>
													 ";
                                }
                            } 




                            ?>
                        </table></h2>
                    <?php mysqli_close($dbc);
                    if ($pags > 1)
                    {
                        echo "<br /><p>";

                        $pag_mostrada = ($start / $mostrar) + 1;
                        //si no es la primera página crear enlace a página anterior
                        if ($pag_mostrada != 1)
                        {
                            echo '<a class="link_a" href="solicitud_ayuda_economica.php?s='.($start - $mostrar).
                                '&p='.$pags .  '&orden='.$orden.'&id='.$id.'">anterior</a> ';
                        }
                        //mostrar los números de página
                        for ($k = 1; $k <= $pags; $k++)
                        {
                            if ($k != $pag_mostrada)
                            {
                                echo '<a class="link_a" href="solicitud_ayuda_economica.php?s='.($mostrar *($k-1)).'&p='. $pags . '&orden='.$orden.'&id='.$id.'">'.$k . '</a> ';
                            }
                            else
                                echo ' '.$k.' ';
                        }
                        //  si no es la última página presentar próximo enlace
                        if ($pag_mostrada != $pags )
                        {
                            echo '<a class="link_a" href="solicitud_ayuda_economica.php?s='. ($start + $mostrar) . '&p='.$pags.'&orden='.$orden.'&id='.$id.'"> próximo</a> ';
                        }
                        echo "</p>";                                                   
                    }        

                    ?>

                </div>
            </div>
<br><br><br><br><br><br><br><br>
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
