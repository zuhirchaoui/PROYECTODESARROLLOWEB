
<?php
//Conexión con la bd
include("db_conection.php");
//Condición If
if(isset($_POST['order_save']))
{
$user_id = $_POST['user_id'];
$order_name = $_POST['order_name'];
$order_price = $_POST['order_price'];
$order_quantity = $_POST['order_quantity'];
$order_total=$order_price * $order_quantity;
$order_status='Pending';



//Insert de datos en la bd
 
$save_order_details="insert into orderdetails (user_id,order_name,order_price,order_quantity,order_total,order_status,order_date) VALUE ('$user_id','$order_name','$order_price','$order_quantity','$order_total','$order_status',CURDATE())";
mysqli_query($dbcon,$save_order_details);				
echo "<script>window.open('shop.php?id=1','_self')</script>";


				
	
			
		
	
		

}

?>
