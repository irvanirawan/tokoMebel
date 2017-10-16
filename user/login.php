<?php
session_start();
include 'koneksi.php';
$username = $_POST['username'];
$password = $_POST['pasword'];
$passmd5= md5($password);
// query untuk mendapatkan record dari username
$query = "SELECT * FROM tbl_login WHERE username = '$username' and pasword='$passmd5'";
$hasil = mysql_query($query);
$data = mysql_fetch_array($hasil);
// cek kesesuaian password
if ($passmd5 == $data['pasword'])
{
echo "sukses";
    // menyimpan username dan level ke dalam session
    $_SESSION['level'] = $data['level'];
    $_SESSION['username'] = $data['username'];
    header('location: admin.php');
}
else 
echo '<h1>Login gagal</h1>';
?>