<?php

session_start();
//Cierra la sesion
session_destroy();
header("Location: ../index.php");
?>