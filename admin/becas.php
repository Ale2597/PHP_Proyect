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
<?php   
        $mostrar = 3;
        $id = $_SESSION['admin_id'];
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
			    
					<h2>Becas Disponibles <br><a class='head_b' href="crear_becas.php">Crear Becas</a>
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
													 <td align='left' class='head_a'><br>BECA |".$row['nombre_beca']."| </td>
													 <td style='padding-top:26px'><a class=\"aE\" href=\"editar_beca.php?beca_id=".$row['beca_id']."\">Editar</a></td>
                        	 <td style='padding-top:26px'><a class=\"aB\" href=\"eliminar_beca.php?beca_id=".$row['beca_id']."\">Borrar</a></td>
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
                        echo '<a class="link_a" href="becas.php?s='.($start - $mostrar).
                             '&p='.$pags .  '&orden='.$orden.'&id='.$id.'">anterior</a> ';
                    }
                    //mostrar los números de página
                    for ($k = 1; $k <= $pags; $k++)
                    {
                        if ($k != $pag_mostrada)
                        {
                            echo '<a class="link_a" href="becas.php?s='.($mostrar *($k-1)).'&p='. $pags . '&orden='.$orden.'&id='.$id.'">'.$k . '</a> ';
                        }
                        else
                            echo ' '.$k.' ';
                    }
                     //  si no es la última página presentar próximo enlace
                    if ($pag_mostrada != $pags )
                    {
                        echo '<a class="link_a" href="becas.php?s='. ($start + $mostrar) . '&p='.$pags.'&orden='.$orden.'&id='.$id.'"> próximo</a> ';
                    }
                     echo "</p>";                                                   
                }        
                
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
