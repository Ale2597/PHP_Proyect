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
			<li class="selected">
				<a href="index.php">home</a>
			</li>
			<li>
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
	</div>
	<div id="body">
	<?php
		//Tabla de Otorgaciones por Beca
		$query = "SELECT nombre_beca, COUNT(sol_id) AS otorgaciones, SUM(cantidad_aprobada) AS cantidad_otorgada
		FROM becas NATURAL JOIN solicitud";

		if($r = mysqli_query($dbc, $query))
		{
			print"<div><center><table id='table1'>";
			print "<h2> Solicitantes Denegados </h2>";
			print"<tr id='table_header'>
					<td><b>Nombre de Beca</b></td>
					<td><b>Numero de Otorgaciones</b></td>
					<td><b>Cantidad Otorgada</b></td>
					</tr>";

			while($row=mysqli_fetch_array($r))
			{
				print"<tr id='table_rows'>
					<td>$row[nombre_beca]</td>
					<td>$row[otorgaciones]</td>
					<td>$row[cantidad_otorgada]</td>
					</tr>";
			}

			print"</table></center></div><br>";
		}

		//Tabla de Solicitantes Denegados
		$query2 = "SELECT nombre, apellido1, apellido2, email, promedio, nombre_depto, fecha_sol
		FROM solicitud NATURAL JOIN usuarios NATURAL JOIN estudiantes NATURAL JOIN depto
		WHERE status_sol = 'Denegado'";

		if($r = mysqli_query($dbc, $query2))
		{
			print"<div><center><table id='table1'>";
			print "<h2> Solicitantes Denegados </h2>";
			print"<tr id='table_header'>
					<td><b>Nombre de Estudiante</b></td>
					<td><b>Email</b></td>
					<td><b>Promedio</b></td>
					<td><b>Departamento</b></td>
					<td><b>Fecha de Solicitud</b></td>
					</tr>";

			while($row=mysqli_fetch_array($r))
			{
				print"<tr id='table_rows'>
					<td>$row[nombre] $row[apellido1] $row[apellido2]</td>
					<td>$row[email]</td>
					<td>$row[promedio]</td>
					<td>$row[nombre_depto]</td>
					<td>$row[fecha_sol]</td>
					</tr>";
			}

			print"</table></center></div><br>";
		}

		//Tabla de Balance por Beca
		$query3 = "SELECT nombre_beca, nombre_depto, fondo_beca, SUM(cantidad_aprobada) AS cantidad_otorgada, balance_beca
		FROM becas LEFT OUTER JOIN (depto NATURAL JOIN becas_departamento NATURAL JOIN solicitud) USING (beca_id)";

		if($r = mysqli_query($dbc, $query3))
		{
			print"<div><center><table id='table1'>";
			print "<h2> Balance por Beca </h2>";
			print"<tr id='table_header'>
					<td><b>Nombre de Beca</b></td>
					<td><b>Departamento</b></td>
					<td><b>Cantidad Inicial</b></td>
					<td><b>Cantidad Otorgada</b></td>
					<td><b>Balance</b></td>
					</tr>";

			while($row=mysqli_fetch_array($r))
			{
				print"<tr id='table_rows'>
					<td>$row[nombre_beca]</td>
					<td>$row[nombre_depto]</td>
					<td>$row[fondo_beca]</td>
					<td>$row[cantidad_otorgada]</td>
					<td>$row[balance_beca]</td>
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
