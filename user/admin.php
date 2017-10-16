<?php
// memulai session
session_start();
error_reporting(0);
if (isset($_SESSION['level']))
{
	// jika level admin
	if ($_SESSION['level'] == "admin")
   {  
	include 'home.php';
   }
   // jika kondisi level user maka akan diarahkan ke halaman lain
   else if ($_SESSION['level'] == "user")
   {
       include 'user.php';
   }
}
if (!isset($_SESSION['level']))
{
	header('location:../index.php');
}
 ?>