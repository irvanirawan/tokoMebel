<?php
include ('koneksi.php');
$idfaktur = (int) $_GET['id'];
if($idfaktur){
	mysql_query("delete from detail_faktur where id_faktur='{$idfaktur}'");
	mysql_query("delete from faktur where id_faktur='{$idfaktur}'");
	$qsids="SELECT id_return FROM toko.detail_return where id_faktur='{$idfaktur}'";
	$qsidr="SELECT id_return FROM toko.return where id_faktur='{$idfaktur}'";
	$d=mysql_fetch_array(mysql_query($qsids,$qsidr));
	$idreturn=$d['id_return'];
	mysql_query("delete from toko.detail_return where id_faktur='{$idfaktur}'");
	mysql_query("delete from toko.return where id_faktur='{$idfaktur}'");
	
}
header("Location: data_faktur.php");
exit;
?>