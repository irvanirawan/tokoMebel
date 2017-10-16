<?php 
include 'koneksi.php';
$idget = $_GET['id'];
$idcustomer = $_GET['id_customer'];
mysql_query("DELETE FROM customer_barang WHERE id='$idget'")or die(mysql_error());

header("location:tampil_customer.php");
exit;
?>