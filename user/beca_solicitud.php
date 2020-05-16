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
				<a href="index.php">Home</a>
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
				<a href="../logout.php">Logout</a>
			</li>
		</ul>
	</div>
	<div id="body">
		<div >
			
			<div>
			    <!--<h2> User <?php echo $_SESSION['nombre_user']; 
                                $u_id = $_SESSION['user_id'];?> </h2>--><br>
                <?php 
                if(isset($_GET['enter'])){
                    $act_N = $_GET['act_name'];
                    $act_D = $_GET['act_date'];
                    $beca_nombre = $_SESSION['beca_n'];
                    $beca_fondo = $_SESSION['fondo_b'];
                    $current_date = $_SESSION['c_date'];
                    $costo = $_GET['costo'];
                    $status = $_GET['status'];
                        
                    $beca_p = $_SESSION['beca'];
                    $b_query = "SELECT * FROM becas WHERE beca_id=$beca_p";
                    $Bq = mysqli_query($dbc,$b_query);/*Query para verificar costo de tope beca*/
                    $row_b = mysqli_fetch_array($Bq);
                    $calc_cost = $row_b['tope_beca'] - $costo;
                    if($calc_cost <= 0){
                        echo "<p style='color:red'>Entre un numero entre ".$row_b['tope_beca']." y 1</p>";
                        
                    }
                    else
                    {
                        $resta_beca = $row_b['balance_beca'] - $costo;
                        $beca_query = "UPDATE beca SET balance_beca='$resta_beca'
                        WHERE beca_id={$_GET['beca']}";
                        
                        $solicitud_query = "INSERT INTO solicitud (user_id, beca_id, fecha_sol, actividad, costo, fecha_actividad, status)
                            VALUES ('$u_id','$beca_p','$current_date','$act_N','$costo','$act_D','$status')";

                        if(mysqli_query($dbc, $beca_query))
                            print '<p>La información de beca se actualizo</p>';
                        else
                        {
                            print '<p style="color:red;">No se pudo actualizar la información ya que ocurrió el error:<br />' . mysqli_error($dbc);
                        }
                        if(mysqli_query($dbc, $solicitud_query))
                        {
                            print '<p>La información de la solicitud se entro con éxito</p>';
                            header('Location: solicitud_ayuda_economica.php');
                            exit();
                        }
                        else{	  
                            print '<p style="color:red;">No se pudo entrar la información de solicitud ya que ocurrió el error:<br />' . mysqli_error($dbc);
                        }
                    }
                        
                }
                
                else{
                ?>
				<h1 style="color:black">Solicitud de Beca </h1><br>
                <?php $_SESSION['beca'] = $_GET['beca'];?>
                <form action="beca_solicitud.php" method="GET">
				
                <table>
                <tr><td align="left"><h3>Nombre de Actividad </h3></td><td align='right'><h3><input style="padding:6px" type="text" name="act_name" placeholder="" required></h3></td></tr>
                <tr><td align='left'><h3>Fecha de Actividad </h3></td><td align='right'><h3><input style="padding:6px" type="date" name="act_date" placeholder="" required></h3></td></tr>
                <?php $beca = $_GET['beca']; 
                    $m_query = "SELECT * FROM becas WHERE beca_id=$beca"; 
					$Mq = mysqli_query($dbc,$m_query);
					if(mysqli_num_rows($Mq) == 0){
								echo "NO hay ninguna beca disponible ;-;";
									//header("insertar_user.php");
					} 
					else{
							while($row = mysqli_fetch_array($Mq)){
                                        $_SESSION['beca_n'] = $row['nombre_beca'];
                                        $_SESSION['fondo_b'] = $row['fondo_beca'];
										print "<tr><td align='left'><h3>Nombre de Beca </h3></td><td align='right'><h3>
                                        <b style='color:black'>".$row['nombre_beca']."</b></h3></td></tr>
                                        <tr><td align='left'><h3>Fondo de Beca </h3></td><td align='right'><h3>
                                        <b style='color:green'> $".$row['fondo_beca']."</b></h3></td></tr>";
							}
					} 
		          ?>
                
                <tr><td align='left'><h3>Fecha </h3></td><td align='right'><h3>
                    <?php $Dquery = "SELECT CURRENT_DATE();"; 
					$Dq = mysqli_query($dbc,$Dquery);
                    while($row = mysqli_fetch_array($Dq)){
                        $_SESSION['c_date'] = $row['CURRENT_DATE()'];
                        echo "".$row['CURRENT_DATE()']."";
                    }
                    ?></h3></td></tr>
                <tr><td align='left'><h3>Costo requerido </h3></td><td align='right'><h3><input style="padding:6px" type="number" name="costo" 
                placeholder="$100" required></h3></td></tr> 
                <tr><td align='right'><h3><input style="padding:6px" type="hidden" name="status" 
                value="pendiente"></h3></td></tr> 
                </table>
                <input class="b1" style="margin-left:10px" type="submit" name="enter" value="Save"><br>
                </form>
				<!--<a href="#" class="more">read more</a>-->
                <?php 
                }
                ?>
			</div>
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
