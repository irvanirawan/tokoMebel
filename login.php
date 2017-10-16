<?php
include('koneksi.php');
if(isset($_POST['login'])){
	$user = mysql_real_escape_string(htmlentities($_POST['username']));
	$pass = mysql_real_escape_string(htmlentities(md5($_POST['password'])));
 
	$sql = mysql_query("SELECT * FROM tbl_login WHERE username='$user' AND pasword='$pass'") or die(mysql_error());
	if(mysql_num_rows($sql) == 0){
		echo 'User tidak ditemukan';
	}else{
		$row = mysql_fetch_assoc($sql);
		if($row['level'] == 1){
			$_SESSION['admin']=$user;
			echo '<script language="javascript">alert("Welcome, Admin"); document.location="admin/home.php";</script>';
		}else{
			$_SESSION['user']=$user;
			echo '<script language="javascript">alert("Welcome, User"); document.location="user/home.php";</script>';
		}
	}
}
?>