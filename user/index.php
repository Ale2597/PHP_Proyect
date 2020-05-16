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
</head>
<body>
<?php 
	
?>
	<div id="header">
		<a href="index.html" class="logo">
			<img src="../images/Logo_icon.PNG" alt="">
		</a>
		<ul id="navigation">
			<li class="selected">
				<a href="index.php">Inicio</a>
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
				<a href="index.php">Creadores</a>
			</li>
			<li>
				<a href="../logout.php">Logout</a>
			</li>
		</ul>
	</div>
	<div id="body">
		<div id="featured">
			<img src="../images/logo_UPRA.JPEG" alt="">
			<div>
			    <h2> ¡Bienvenido <?php echo $_SESSION['nombre_user']; ?>! </h2>
				<h2></h2>
				<span>En esta página podrás ver y solicitar</span>
				<span>distintas becas y ayudas disponibles</span>
				<span>para fomentar tu dessarrollo educacional.</span>
				<a href="solicitud_ayuda_economica.php" class="more">Buscar Ahora</a>
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
	</div>
	
	<br><br><br><br>
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
