<?php
session_start();

if(!$_SESSION['admin_username'])
{

    header("Location: ../index.php");//redirigir a la página de inicio de sesión para asegurar la página de bienvenida sin acceso de inicio de sesión.
}

?>

<?php
//Conexión con la base de datos
include("db_conection.php");
//Condición if que guarda parámetros en variables
if(isset($_POST['item_save']))
{
$item_name = $_POST['item_name'];
$item_price = $_POST['item_price'];
$item_description = $_POST['item_description'];

 //Chekea la base de datos
 $check_item="select * from items WHERE item_name='$item_name'";
    $run_query=mysqli_query($dbcon,$check_item);

    if(mysqli_num_rows($run_query)>0)
    {
 echo"<script>window.open('index.php','_self')</script>";
exit();
    }
 
$imgFile = $_FILES['item_image']['name'];
$tmp_dir = $_FILES['item_image']['tmp_name'];
$imgSize = $_FILES['item_image']['size'];
//Comprueba la extensión y guarda las imágenes de los productos en el directorio
$upload_dir = 'item_images/';
$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); 
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); 
$itempic = rand(1000,1000000).".".$imgExt;


				
		//Condición if
			if(in_array($imgExt, $valid_extensions)){			
		
				if($imgSize < 5000000)				{
					move_uploaded_file($tmp_dir,$upload_dir.$itempic);
					//Inserta los datos en la bd
					$saveitem="insert into items (item_name,item_description,item_price,item_image,item_date) VALUE ('$item_name','$item_description','$item_price','$itempic',CURDATE())";
					mysqli_query($dbcon,$saveitem);				
					 echo "<script>window.open('items.php','_self')</script>";
				}
				else{
					
					 echo "<script>window.open('items.php','_self')</script>";			
					 
				}
			}
			else{
				
				 echo "<script>window.open('items.php','_self')</script>";
				
			}
		
	
		

}

?>









