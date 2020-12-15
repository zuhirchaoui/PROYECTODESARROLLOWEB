<?php
session_start();

?>
<?php
//Coexión co la bd
include("db_conection.php");

//Condición If

if(isset($_POST['admin_login']))
{
    $admin_username=$_POST['admin_username'];
    $admin_password=$_POST['admin_password'];
	
    //Select guardado en variable
    $check_admin="select * from admin WHERE admin_username='$admin_username' AND admin_password='$admin_password'";

 
    $run=mysqli_query($dbcon,$check_admin);
    //Condición If
    if(mysqli_num_rows($run))
    {
	 
       
 echo "<script>window.open('Admin/index.php','_self')</script>";
       
$_SESSION['admin_username']=$admin_username;



    }
    else
    {
        echo "<script>alert('¡Nombre de usuario o contraseña incorrectos!')</script>";
		  echo "<script>window.open('index.php','_self')</script>";
		
		 exit();
		
    }
}
?>