<?php
session_start();

?>
<?php
//Conexión con la bd
include("db_conection.php");


//Condición If
if(isset($_POST['user_login']))
{
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
	
    //Selecto guaradado en un variable
    $check_user="select * from users WHERE user_email='$user_email' AND user_password='$user_password'";

 
    $run=mysqli_query($dbcon,$check_user);
    //Condición If
    if(mysqli_num_rows($run))
    {
	 
       
 echo "<script>window.open('Customers/index.php','_self')</script>";
       
$_SESSION['user_email']=$user_email;



    }
    else
    {
        echo "<script>alert('¡Correo electrónico o la contraseña son incorrectos!')</script>";
		  echo "<script>window.open('index.php','_self')</script>";
		
		 exit();
		
    }
}
?>