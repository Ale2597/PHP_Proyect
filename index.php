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
        <!--<link REL="SHORTCUT ICON" href="https://www.flaticon.com/authors/freepik">--> 
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
        <style>
            .input_box{
                padding:10px;
                font-size: 14px;
                border: 1px solid gray;
                border-radius: 5px;
            }
            .td_letter{
                font-size:18px;
                padding-right: 16px;
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
            .link_a{
                color: #252525;
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
        </style>
        <script type="text/javascript" src="js/mobile.js"></script>
    </head>
    <body>
        <div id="header">
            <a href="index.html" class="logo">
                <img src="images/Logo_icon.png" alt="">
            </a>
        </div>
        <div id="body">
            <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST') 
            {
                if( (!empty($_POST['email'])) && (!empty($_POST['password'])) ) 
                { //conectarme a ver si existe usuario    
                    if(include_once('conectiondb.php')) // Conectarse al servidor SQL
                    {
                        $email = $_POST['email'];
                        $password = $_POST['password'];

                        //                echo "<br><h3>Email: $email</h3>";
                        //                echo "<h3>Password: $password</h3><br>";
                        $query = "SELECT * FROM usuarios WHERE email = '$email'  AND pass = '$password'";
                        $r = mysqli_query($dbc, $query);

                        $query2 = "SELECT * FROM admins WHERE email = '$email'  AND pass = '$password'";
                        $r2 = mysqli_query($dbc, $query2);

                        $query3 = "SELECT nombre FROM estudiantes WHERE email = '$email'";
                        $r3 = mysqli_query($dbc, $query3);
                        $row3 = mysqli_fetch_array($r3);

                        if ($row = mysqli_fetch_array($r))
                        {
                            if ( (strtolower($_POST['email']) == $row['email']) && ($_POST['password'] ==$row['pass']) && ($row['status'] == 'Activo') )
                            { // El usuario existe en la tabla de usuarios2.

                                $_SESSION['user_id'] = $row['user_id'];
                                $_SESSION['nombre_user'] = $row3['nombre'];
                                header('Location: user/index.php');
                                exit();
                            }
                            else{
                                print '<h3>Su cuenta aparenta estar inactiva! Por favor contacte un administrador para restaurar el acceso a su cuenta.<br><br><a href="index.php"> Login </a></h3>';
                            }
                        }
                        else if($row2 = mysqli_fetch_array($r2))
                        {
                            if ( (strtolower($_POST['email']) == $row2['email']) && ($_POST['password'] ==$row2['pass']) && ($row2['status'] == 'activo') )
                            {//El usuario es admin.

                                $_SESSION['nombre_admin'] = $row2['nombre'];
                                $_SESSION['admin_id'] = $row2['admin_id'];
                                header('Location: admin/index.php');
                                exit();
                            }
                        }
                        else 
                        { // Usuario no existe en la tabla

                            print '<h3>El email y/o password entrados no concuerdan con nuestros archivos!<br><br>Vuelva a intentarlo.<br><a href="index.php"> Login </a></h3>';

                        }
                    }
                    else
                        print'<p> No se pudo conectar a servidor MYSQL</p>';

                }
                else
                {
                    // No entró uno de los campos

                    print '<p>Asegúrese de entrar su username y password. Vuelva a intentarlo...<br /><a href="index.php"> Login </a></p>';



                }
            } 
            else // No llegó por un submit, hay que presentar el formulario
            {  		
                print '<div id="container"><center>

    <form action="index.php" method="post">
    <table id="table3">
    <h2>Aceder Cuenta</h2>
    <tr>
     <td colspan="2" align="center"><h3> LOGIN </h3></td
    </tr>
    <tr>
    <td class="td_letter" align="right">Email: </td>
    <td align="left">
    <input class="input_box" type="email" name="email"  required/>
    <span class="error"></span>
    </td>
    </tr>
    <tr>
     <td class="td_letter" align="right">Password: </td>
    <td align="left">
    <input class="input_box" type="password" name="password"  required/>
    <span class="error"></span>
    </td>
    </tr>
    <tr>
     <td colspan="2" align="center">
     <input class="b1" type="submit" name="submit" value="Login" /></td>
    </tr>
    <tr>
     <td colspan="2" align="center">
     <br>
     <a class="link_a" href="register.php"> Estudiante? Regístrate! </a></td>
    </tr>
    </table>
    </form></center></div>';
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
