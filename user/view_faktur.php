<?php
include('koneksi.php');
include('header.php');
if (isset($_POST['cari'])) {
    $kt = $_POST['katakunci'];	
	$query = "select * from faktur where no_faktur like '%$kt%'";
}elseif(isset($_POST ['carix'])) {
	$tglawal = $_POST['dari'];
	$tglakhir = $_POST['sampai'];
	$query = "select * from faktur where id_faktur like '%".$_POST['katakunci']."%' and tanggal between '$tglawal' and '$tglakhir'";
    $query = "select * from faktur where id_faktur like '%".$_POST['katakunci']."%' and tanggal between '$tglawal' and '$tglakhir'";
	$query_tanggal=Mysql_query($query);
	$query_tanggal1=Mysql_query($query);
} else {
    $query = "select * from faktur";
}
?>


<div class="right_col" role="main">
    <div class="box-header">
        <h3><span class="glyphicon glyphicon-briefcase"></span>  Data Penjualan</h3>
    </div>
	<p></p>

	<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from faktur");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-13">
	<table class="col-md-2">
		<tr>
			<td>Total Faktur</td>		
			<td><?php echo $jum; ?></td>
		</tr>
		<tr>
			<td>Jumlah Halaman</td>	
			<td><?php echo $halaman; ?></td>
		</tr>
	</table>
	
	<br><br><br><br>
	
</div>
 <div class="container-fluid form-outline nav navbar-right">
        <span ><a href="input_barang.php" class="box-title fa fa-plus btn btn-primary form-group pull-right" style="width: 170px;"> Tambah Barang</a></span>
  </div>
  <div class="container-fluid form-outline nav navbar-left">
			<div class="box-tools form-group">
        <form method="post" action="view_faktur.php">
                <div class="input-group input-group-sm" style="width: 300px;">
                    <input type="text" name="katakunci" class="form-control pull-left" placeholder="Cari..." required>
                    <div class="input-group-btn">
                        <button name="cari" type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>				
        </form>
            </div>
</div>
    

<br/>


 <table id="example2" class="table table-bordered table-striped table-hover table-responsive">
	<tr>
		<th>ID Faktur</th>
        <th>No.Faktur</th>               
        <th>Tanggal</th>           
		<th>Total</th>
        <th colspan="2" style="text-align: center"> Opsi </th>
	</tr>
	
<?php
include('koneksi.php');
if (isset($_POST['cari'])) {
    $kt = $_POST['katakunci'];
    $query = "select * from faktur where no_faktur like '%$kt%'";
} else {
    $query = "select * from faktur";
}
?>
	
	
<?php 
	include('koneksi.php');
	if (isset($_POST['cari'])) {
    $kt = $_POST['katakunci'];
    $brg =mysql_query("select * from faktur where no_faktur like '%$kt%'");
	}else{
	$brg=mysql_query("select * from faktur limit $start, $per_hal");
	}
	$no=1;
	while($b=mysql_fetch_array($brg)){

?>
		<tr>
			<td><?php echo $b['id_faktur'] ?></td>
			<td><?php echo $b['no_faktur'] ?></td>
			<td><?php echo $b['tanggal'] ?></td>
			<td><?php echo number_format($b['total'],0,',','.'); ?></td>
			
            <td><a href="edit_barang.php?id=<?php echo $b['id_barang']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><a href="hapus_barang.php?id=<?php echo $b['id_barang']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>

		</tr>		
		<?php 
	}
	?>
</table>
<ul class="pagination">			
<?php 
for($x=1;$x<=$halaman;$x++){
?>
<li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
<?php } ?>						
</ul>


<?php
include('footer.php');
?>

</div>