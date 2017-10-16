<?php
session_start();
include_once 'koneksi.php';
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "toko";
$kon = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if(isset($_POST['login'])? $_POST['login']:''){
 $username= isset($_POST['username'])? $_POST['username']:'';
 $password= isset($_POST['password'])? $_POST['password']:'';
 $passmd5= md5($password);
 if(empty($username) || empty($password)){
     echo ("<script type='text/javascript'> alert ('Silakan Isi Semua Data');document.location='javascript:history.back(1)';</script>");
 }  else {
    $query=  mysql_query("select * from tbl_login where username='$username' and pasword='$passmd5'");
    $data= mysql_fetch_array($query);
    if($username==$data['username'] && $passmd5==$data['pasword']){
        $_SESSION['username']=$data['username'];
        $_SESSION['level']=$data['level'];
        $_SESSION['autorized']=1;
        header('Location:home.php');
        $q=  mysql_query("select * from tbl_login where username='$username'");
    } else {
      echo ("<script type='text/javascript'> alert ('Username atau Password Salah');document.location='javascript:history.back(1)';</script>");
    }
 }
 
}
?>