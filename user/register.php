<html>
<head>
<title>Register</title>
<style>.tengah{
position: absolute;margin-top: -240px;margin-left: -200px;left: 50%;top: 50%;width: 400px;height: 220px;
}
</style>
</head>
<body background="dist/img/stock-photo-142984111-1500x1000.jpg" text="purple">
<div align="center" class="tengah"><p align="center">
<form method="post" name="pendaftaran" action="proses_daftar.php">
<table align="center" cellpadding=5 cellspacing=2 >
<tr>
<td colspan=20><center><font size=6 color="black" face="comic sans ms" >Register New Account</font></center></td>
</tr>
<tr>
<td><font size=6 color="blue" face="Chiller" >Username</font></td><td>:</td><td><input type="text" name="username"></td>
</tr>
<tr>
<td><font size=6 color="blue" face="Chiller" >Password</font></td><td>:</td><td><input type="password" name="password"></td>
</tr>
<tr>
<td><font size=6 color="blue" face="Chiller" >Level</font></td><td>:</td><td><input type="text" name="level"></td>
</tr>
<tr>
<td><font size=6 color="blue" face="Chiller" >Status</font></td><td>:</td><td><input type="text" name="status"></td>
</tr>
<tr>
<td colspan=2>&nbsp;</td>
<td><input type="submit" name="submit" value="Register" class="btn btn-danger"/>
<input type="button" value="Back" onclick="history.back(-1)"/></td>
</tr>
</table>
</form>
</div>
</body>
</html>