<!doctype html>
<!-- Website Template by freewebsitetemplates.com -->
<?php 
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
	<div id="header">
		<a href="index.html" class="logo">
			<img src="../images/logo.jpg" alt="">
		</a>
		<ul id="navigation">
			<li class="selected">
				<a href="index.html">home</a>
			</li>
			<li>
				<a href="#">about</a>
			</li>
			<li>
				<a href="#">gallery</a>
			</li>
			<li>
				<a href="#">blog</a>
			</li>
			<li>
				<a href="#">contact</a>
			</li>
		</ul>
	</div>
	<div id="body">
		<div id="featured">
			<img src="../images/the-beacon.jpg" alt="">
			<div>
			    <h2> Welcome Admin <?php echo $_SESSION['nombre_admin']; ?>! </h2>
				<h2>the beacon to all mankind</h2>
				<span>Our website templates are created with</span>
				<span>inspiration, checked for quality and originality</span>
				<span>and meticulously sliced and coded.</span>
				<a href="#" class="more">read more</a>
			</div>
		</div>
		<ul>
			<li>
				<a href="#">
					<img src="../images/the-father.jpg" alt="">
					<span>Gabriel Ferrer</span>
				</a>
			</li>
			<li>
				<a href="#">
					<img src="../images/the-actor.jpg" alt="">
					<span>Hiram Vera</span>
				</a>
			</li>
			<li>
				<a href="#">
					<img src="../images/the-nerd.jpg" alt="">
					<span>Alejandro Zeno</span>
				</a>
			</li>
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
