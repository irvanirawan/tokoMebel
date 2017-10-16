<?php include ('header.php');
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "toko";
$kon = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
 ?>
<style>
h1 {
    text-shadow: 1px 2px black;
}
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: center;
    padding: 10px;
}
	
tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #0099cc;
    color: black;
}
</style>
 <div class="right_col" role="main">
    <div align="center">
        <h1><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;Detail Return</h1>
    </div>
 <?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from detail_return");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-13">
	<table class="col-md-3">
		<tr>
			<td style="text-align: left"><h4><b>Jumlah Return : </b></h4></td>		
			<td style="text-align: left"><h4><b><?php echo $jum; ?></b></h4></td>
		</tr>
		<tr>
			<td style="text-align: left"><h4><b>Jumlah Page : </b></h4></td>	
			<td style="text-align: left"><h4><b><?php echo $halaman; ?></b></h4></td>
		</tr>
	</table>
	
	</br></br></br></br></br></br></br>
	
</div>
</br>
 <h5><table class="table table-bordered table-striped table-hover table-responsive"></h5>
	<tr>
		<th class="col-md-1" style="text-align: center" ><h4><b>No<b></h4></th>
        <th class="col-md-1" style="text-align: center"><h4><b>No Faktur<b></h4></th>       
        <th class="col-md-1" style="text-align: center"><h4><b>Tanggal<b></h4></th>
		<th class="col-md-1" style="text-align: center"><h4><b>Total<b></h4></th>
		<th class="col-md-2" style="text-align: center"><h4><b>Keterangan<b></h4></th>
		<th class="col-md-1" style="text-align: center"><h4><b>Option<b></h4></th>
	</tr>
	
	
<?php 
$qtr="SELECT return.id_return, faktur.no_faktur, return.tanggal, return.keterangan
            FROM toko.return
            LEFT JOIN toko.faktur
            on faktur.id_faktur = return.id_faktur";
      $eqtr=mysqli_query($kon,$qtr);
      while ($dqtr=mysqli_fetch_array($eqtr)) { ?>

  <tr>
    <td style="text-align: center"><?php echo $dqtr['id_return']; ?></td>
    <td style="text-align: center"><?php echo $dqtr['no_faktur']; ?></td>
    <td style="text-align: center"><?php echo $dqtr['tanggal']; ?></td>
    <td style="text-align: center">Rp.<?php $id=$dqtr['id_return'];
    $qs="SELECT sum(total) as ttl FROM toko.detail_return where detail_return.id_return=$id";
    $eqs=mysqli_query($kon,$qs);
    if ($dqs=mysqli_fetch_array($eqs)) { echo number_format($dqs['ttl']); } ?>,-</td>
    <td style="text-align: center"><?php echo $dqtr['keterangan']; ?></td>
	<td style="text-align: center"><a href="detail_return.php?id=<?php echo $id; ?>" class="btn btn-primary">Detail</a>
  </tr>
	<?php } ?>
</table>

<ul class="pagination">			
<?php 
for($x=1;$x<=$halaman;$x++){
?>
<li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
<?php } ?>						
</ul>

</br></br></br></br></br></br></br></br>
<?php include ('footer.php'); ?>
</div>