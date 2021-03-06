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
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/mobile.css" media="screen and (max-width : 568px)">
        <script type="text/javascript" src="js/mobile.js"></script>
        <style>

            .input_box{
                padding:10px;
                font-size: 14px;
                border: 1px solid gray;
                border-radius: 5px;
            }
            /*Letter size*/
            .td_letter{
                font-size:18px;
                padding-right: 16px;
            }
            /*Button style*/
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
            /* a LINKS*/
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
                        $con_pass = $_POST['con_pass'];

                        //            echo "<br><h3>Email: $email</h3>";
                        //            echo "<h3>Password: $password</h3><br>";

                        $query = "SELECT * FROM usuarios WHERE email = '$email'  AND pass = '$password'";
                        $r = mysqli_query($dbc, $query);

                        if ($row = mysqli_fetch_array($r))
                        {

                            if ( (strtolower($_POST['email']) == $row['email']))
                            { // El usuario existe en la tabla usuarios2... escoger otro email o password

                                echo "<h3 style='color:red;'>Email y/o Password escogidos ( ".$_POST['email']." , ".$_POST['password']." ) ya existen, por favor escoger otro o haga login.</h3>";

                                echo "<a href='index.php'> Login </a><br>";
                                echo "<a href='register.php'> Volver a Intentar </a>";

                            } 
                        }
                        else 
                        { // Usuario NO existe en tabla usuarios2.

                            $query2 = "SELECT * FROM estudiantes WHERE email = '$email'";
                            $r2 = mysqli_query($dbc, $query2);

                            if ($row2 = mysqli_fetch_array($r2))
                            {

                                if ( (strtolower($_POST['email']) == $row2['email']) && ($password == $con_pass))
                                {//Usuario es estudiante (Existe en la tabla estudiante2) 
                                    //Passwords entrados concuerdan.
                                    //Hacer query de insert.


                                    $telefono = $_POST['telefono'];

                                    $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_SPECIAL_CHARS);

                                    $status = 'activo';


                                    //Query para insertar usuario.
                                    $query3 = "INSERT INTO usuarios
                                                (email, pass, telefono, status)
                                                VALUES ('".$email."', '".$password."', '".$telefono."', '".$status."')";

                                    echo "<h3>$query3</h3>";

                                    $r3 = mysqli_query($dbc,$query3);


                                    if(mysqli_affected_rows($dbc) == 1)
                                    {
                                        print '<h3>El usuario ha sido insertado con éxito.</h3>';

                                        $query4 = "SELECT * FROM usuarios WHERE email = '$email'                                                         AND pass = '$password'";
                                        $r4 = mysqli_query($dbc, $query4);

                                        if ($row4 = mysqli_fetch_array($r4))
                                        {
                                            $_SESSION['user_id'] = $row4['user_id'];
                                            $_SESSION['nombre_user'] = $row2['nombre'];
                                            header('Location: user/index.php');
                                        }
                                    }
                                    else
                                        print '<h3 style="color:red;">No se pudo insertar al usuario porque:<br />' . mysqli_error($dbc) . '</h3>';   
                                    mysqli_close($dbc);

                                }//Passwords no concuerda!!!
                                else
                                {
                                    //                                    print '<h3>Passwords no concuerda!!!</h3>';
                                    $err_message = 'Passwords no concuerdan!';
                                    $_SESSION['err_mess'] = $err_message;
                                    $_SESSION['email'] = $email;
                                    $_SESSION['tel'] = $telefono;

                                    header('Location: register.php');
                                }
                            }
                            else//VISITANTE
                            {//Usuario no es estudiante (NO existe en tabla estudiante2)
                                print '<h3>Solo estudiantes pueden registrarse!</h3>';
                                print '<h3>Si es estudiante, asegúrese entrar su email correctamente. Vuelva a intentarlo...<br /><a href="register.php" class="link_a"> Registrar </a></h3>';
                            }

                        }
                    }
                    else
                        print'<h3> No se pudo conectar a servidor MYSQL</h3>';

                }
                else
                {
                    // No entró uno de los campos

                    print '<h3>Asegúrese de entrar su email y password. Vuelva a intentarlo...<br /><a class="link_a" href="register.php"> Registrar </a></h3>';



                }
            } 
            else // No llegó por un submit, por lo tanto hay que presentar el formulario
            {  

                if(empty($_SESSION['email']))
                {
                    $_SESSION['email'] = "";
                    $_SESSION['tel'] = ""; 
                    $_SESSION['err_mess'] = "";
                }

                print '<div id="container"><center>
<h2> Registración </h2>
<p><span class="error">* campo requerido</span></p>
<form id="form1" name="form1" method="POST" action="register.php">
  <table id="table2" width="349" border="0">

    <tr>
      <td class="td_letter" align="right">*E-mail: </td>
      <td align="left"><label for="email"></label>
      <input class="input_box" type="email" name="email" id="email" value="'.$_SESSION['email'].'" required/>
      <span class="error"></span>
      </td>
    </tr>

    <tr>
      <td class="td_letter" align="right">*Password: </td>
      <td align="left"><label for="password"></label>
      <input class="input_box" type="password" name="password" id="password" required/>
      <span class="error"></span>
      </td>
    </tr>

    <tr>
    <span class="error">'.$_SESSION['err_mess'].'</span>
      <td class="td_letter" align="right">*Confirm Password: </td>
      <td align="center"><label for="con_pass"></label>
      <input class="input_box" type="password" name="con_pass" id="con_pass" required/>
      <span class="error"></span>
      </td>
    </tr>

    <tr>
      <td class="td_letter" align="right">Telefono: </td>
      <td align="left"><label for="telefono"></label>
      <input class="input_box" type="tel" name="telefono" id="telefono" value="'.$_SESSION['tel'].'"/>
      </td>
    </tr>

    <tr>
      <td colspan="2" align="center"><input class="b1" type="submit" name="submit" id="submit" value="Registrar"/></td>
      </tr>
  </table>
</form>
<br>
<a class="link_a" href="index.php" id="botton"> Regresar </a>

</center></div>';			  
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
