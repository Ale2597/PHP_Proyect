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
       
            if(isset($_GET['sol_id']) && is_numeric($_GET['sol_id']))
            {
                $query = "SELECT *
                FROM solicitud
                WHERE sol_id={$_GET['sol_id']}";
                
                if($r = mysqli_query($dbc, $query))
                {
                print '<form action="eliminar_solicitud.php" method="post">';
                print"<div><center><table id='table1'>";
                print"<h2>Esta Seguro que desea eliminar la siguiente Solicitud?</h2>";
                print"<tr id='table_header'>
                        <td><b>Nombre de Actividad</b></td>
                        <td><b>Costo</b></td>
                        <td><b>Fecha de Actividad</b></td>
                        <td><b>Fecha de Solicitud</b></td>
                        <td><b>Status</b></td>
                        </tr>";

                while($row=mysqli_fetch_array($r))
                {
                    print"<tr id='table_rows'>
                        <td>$row[actividad]</td>
                        <td>$row[costo]</td>
                        <td>$row[fecha_actividad]</td>
                        <td>$row[fecha_sol]</td>
                        <td>$row[status]</td>
                        </tr>";

                        
                }

                print"</table></center></div><br>";
                print '<input type="hidden" name="sol_id" value="'.$_GET['sol_id'].'">
                <input class="b1" type="submit" name="submit" value="Eliminar Solicitud">';
                print"</form>";
                }            
                
                else
                {
                    print '<p style="color:red;">No se pudo mostrar al estudiante que se desea eliminar porque: 
                    <br/>'.mysqli_error($dbc).'.</p>';
                }
            }
            elseif(isset($_POST['sol_id']) && is_numeric($_POST['sol_id']))
            {
                $query = "DELETE FROM solicitud WHERE sol_id={$_POST['sol_id']} LIMIT 1";
                $r = mysqli_query($dbc, $query);
                
                if(mysqli_affected_rows($dbc) == 1)
                {
                    echo "<script>alert('La Solicitud ha sido eliminada con exito!!')</script>";
                    echo "<script>window.open('./solicitudes_usuario.php','_self')</script>";
                }
                else
                    print '<p style="color:red;">No se pudo eliminar al estudiante porque: 
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
