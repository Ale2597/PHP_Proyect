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
    </style>
</head>
<body>
	<div id="header">
		<a href="index.html" class="logo">
			<img src="../images/logo.jpg" alt="">
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
		<div id="featured">
			<img src="../images/the-beacon.jpg" alt="">
			<div>
			    <h2> Welcome User <?php echo $_SESSION['nombre_user']; ?>! </h2>
				<h2>the beacon to all mankind</h2>
				<span>Our website templates are created with</span>
				<span>inspiration, checked for quality and originality</span>
				<span>and meticulously sliced and coded.</span>
				<a href="#" class="more">read more</a>
			</div>
		</div>
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
                        <td><b>Nombre Actividad</b></td>
                        <td><b>Costo</b></td>
                        <td><b>Fecha de Actividad</b></td>
                        <td><b>Fecha de Solicitud</b></td>
                        <td><b>Status</b></td>
                        <td><b>Editar</b></td>
                        </tr>";

                while($row=mysqli_fetch_array($r))
                {
                    print"<tr id='table_rows'>
                        <td>$row[actividad]</td>
                        <td>$row[costo]</td>
                        <td>$row[fecha_actividad]</td>
                        <td>$row[fecha_sol]</td>
                        <td>$row[status]</td>
                        <td>$row[status]</td>
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
