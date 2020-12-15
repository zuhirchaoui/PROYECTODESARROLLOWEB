<?php
session_start();

?>
<?php
//Conexion con la bd
include("db_conection.php");
//Condición If
if(isset($_POST['register']))
{
$user_email = $_POST['ruser_email'];
$user_password = $_POST['ruser_password'];
$user_firstname = $_POST['ruser_firstname'];
$user_lastname = $_POST['ruser_lastname'];
$user_address = $_POST['ruser_address'];

$answer = $_SESSION["answer"];
$user_answer = $_POST["answer"];


//Selecto guardado en variable
$check_user="select * from users WHERE user_email='$user_email'";
    $run_query=mysqli_query($dbcon,$check_user);
    //Condición If del captcha
    if ($answer == $user_answer) {

	
    //Condición If comprueba email
    if(mysqli_num_rows($run_query)>0)
    {
echo "<script>alert('El cliente ya existe. ¡Intente con otro!')</script>";
 echo"<script>window.open('index.php','_self')</script>";
exit();
    } //Inserta los datos en la bd
    $saveaccount="insert into users (user_email,user_password,user_firstname,user_lastname,user_address) VALUE ('$user_email','$user_password','$user_firstname','$user_lastname','$user_address')";
mysqli_query($dbcon,$saveaccount);
echo "<script>alert('Los datos se guardaron correctamente. ¡Ahora puede iniciar sesión!')</script>";				
echo "<script>window.open('index.php','_self')</script>";

}else{//comprueba el captcha
	echo "<script>alert('mal')</script>";
	echo"<script>window.open('index.php','_self')</script>";
}
 



				
	
			
		
	
		

}

?>
