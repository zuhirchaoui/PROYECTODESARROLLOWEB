
<?php
//Conexión con la bd
include("db_conection.php");
//Condición If
if(isset($_POST['opinion_save']))
{
$nombre_user = $_POST['nombre_user'];
$item_id = $_POST['item_id'];
$coment = $_POST['coment'];
$votos = $_POST['rating'];
$user_id = $_POST['user_id'];


 //Insert de datos en la bd
$save_order_details="insert into opinion (
nombre_user, item_id, coment, fecha ) VALUE ('$nombre_user','$item_id','$coment',CURDATE())";

//Insert de datos en la bd
$save_votes="insert into votes (
user_id, item_id, rango) VALUE ('$user_id','$item_id','$votos')";
mysqli_query($dbcon,$save_order_details);
mysqli_query($dbcon,$save_votes);
				
echo "<script>window.open('shop.php?id=1','_self')</script>";


				
	
			
		
	
		

}

?>
