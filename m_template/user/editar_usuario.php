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
<?php
    
print '<div id="window">
            <div id="profile">
                <h3> Bienvenido usuario  '. $_SESSION['nombre_user'].'! </h3>
            </div>
       </div>';
    
if(isset($_GET['user_id']) && is_numeric($_GET['user_id']))
{
   $query = "SELECT email, pass, telefono
			FROM usuarios2
			WHERE user_id={$_GET['user_id']}";
    
   
   if ($r = mysqli_query($dbc, $query))
   {
	  $row = mysqli_fetch_array($r);
	  		
      print '<div><center><h2>Editar Cuenta Usuario</h2>
      <form action="editar_usuario.php" method="post">
      <table id="table2" width="349" border="0">
        
        <tr>
          <td align="right"><label for="email">Email: </label></td>
          <td align="left"><label for="email"></label>'.$row['email'].'
          <span class="error">*</span>
          </td>
        </tr>
        
        <tr>
          <td align="right"><label for="password">Password: </label></td>
          <td align="left">
          <input type="password" name="password" id="password"  value="'.$row['pass'].'" required/> 
          <span class="error">*</span>
          </td>
        </tr>
        
        <tr>
          <td align="right"><label for="telefono">Teléfono: </label></td>
          <td align="left">
          <input type="tel" name="telefono" id="telefono" value="'.$row['telefono'].'"/> 
          <span class="error">*</span>
          </td>
        </tr>

        <tr>
        <td colspan="2" align="center">
          <input type="submit" name="Editar" id="Editar" value="Editar" />
		  <input type="hidden" name="user_id" value="'.$_GET['user_id'].'" />
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
	  $password = $_POST['password'];
	  $telefono = $_POST['telefono'];   

      $query = "UPDATE usuarios2 SET pass=$password, telefono=$telefono
		        WHERE user_id={$_POST['user_id']}";

	  if(mysqli_query($dbc, $query)) //Cambiar para usar script de alert y open window (js).
	        print '<h3>La información del usuario ha sido actualizada exitosamente!</h3>';
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
