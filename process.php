<?php 
session_start();

$answer = $_SESSION["answer"];
$user_answer = $_POST["answer"];
//Condición If
if ($answer == $user_answer) {
	echo "<script>alert('bien')</script>";
	echo"<script>window.open('index.php','_self')</script>";
	
} else{
	echo "<script>alert('mal')</script>";
	echo"<script>window.open('index.php','_self')</script>";
}
 ?>


