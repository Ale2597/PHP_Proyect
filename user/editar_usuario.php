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
        <img src="../images/logo.jpg" alt="">
    </a>
    <ul id="navigation">
        <li>
            <a href="index.php">Inicio</a>
        </li>
        <li class="selected">
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
<?php
    
if(isset($_GET['user_id']) && is_numeric($_GET['user_id']))
{
   $query = "SELECT *
			 FROM usuarios
			 WHERE user_id={$_SESSION['user_id']}";
    
   
   if ($r = mysqli_query($dbc, $query))
   {
	  $row = mysqli_fetch_array($r);
	  		
      print '<div><center><h1 style="color:black">Editar Cuenta Usuario</h1>
      <form action="editar_usuario.php" method="post">
      <table id="table2" width="349" border="0">
        
        <tr>
          <td align="right"><h3 for="email">Email: </h3></td>
          <td align="left"><label for="email"></label>'.$row['email'].'
          </td>
        </tr>
        
        <tr>
          <td align="right"><h3 for="pass">Password: </h3></td>
          <td align="left">
          <h3><input type="pass" name="pass" id="pass"  value="'.$row['pass'].'" required/></h3> 
          </td>
        </tr>
        
        <tr>
          <td align="right"><h3 for="tel">Teléfono: </h3></td>
          <td align="left">
          <h3><input type="tel" name="tel" id="tel" value="'.$row['tel'].'"/></h3> 
          </td>
        </tr>

        <tr>
        <td colspan="2" align="center">
          <input class="b1" type="submit" name="Editar" id="Editar" value="Editar" />
		  <input type="hidden" name="user_id" value="'.$_SESSION['user_id'].'" />
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
else if(isset($_POST['user_id']) && is_numeric($_POST['user_id']))
{
	  $password = $_POST['pass'];
	  $telefono = $_POST['tel'];   

      $query = "UPDATE usuarios SET pass='$password', tel='$telefono'
		        WHERE user_id={$_POST['user_id']}";

	  if(mysqli_query($dbc, $query))
        {
            echo "<script>alert('La información del usuario ha sido actualizada exitosamente!')</script>";
            echo "<script>window.open('perfil_usuario.php','_self')</script>";
        }
	  else	  
	        print '<h3 style="color:red;">No se pudo actualizar la información del usuario ya que ocurrió el error:<br />' . mysqli_error($dbc). '</h3>';
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
