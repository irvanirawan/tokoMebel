<?php
include('koneksi.php');
include('header.php');
if (isset($_POST['cari'])) {
    $kt = $_POST['katakunci'];
    $query = "select * from barang where nama_barang like '%$kt%'";
} else {
    $query = "select * from barang";
}
?>

</br></br></br>
<div class="right_col" role="main">
    <div align="center">
        <h1><span class="glyphicon glyphicon-briefcase"></span>&nbsp; Data Barang</h1>		
      </div>
	  
<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from barang");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-13">
	<table class="col-md-3">
		<tr>
			<td style="text-align: left"><h4><b>Jumlah Barang : </b></h4></td>		
			<td style="text-align: left"><h4><b><?php echo $jum; ?></b></h4></td>
		</tr>
		<tr>
			<td style="text-align: left"><h4><b>Jumlah Page : </b></h4></td>	
			<td style="text-align: left"><h4><b><?php echo $halaman; ?></b></h4></td>
		</tr>
	</table>
	
	</br></br></br></br></br></br></br>
	
</div>
  <div class="container-fluid form-outline nav navbar-left">
			<div class="box-tools form-group">
        <form method="post" action="tampil_barang.php">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="katakunci" class="form-control pull-left" placeholder="Cari Barang..." 
					style="width: 200px; height: 35px;" required>
                    
                        <button name="cari" type="submit" class="btn btn-default form-control pull-left" 
						style="width: 35px; height: 35px;"><i class="fa fa-search"></i></button>
                    </div>
                				
        </form>
            </div>
</div>
    
</br></br>

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

<h5><table class="table table-bordered table-striped table-hover table-responsive"></h5>
	<tr>
		<th class="col-md-1" style="text-align: center" ><h4><b>ID Barang<b></h4></th>
        <th class="col-md-3" style="text-align: center"><h4><b>Nama Barang<b></h4></th>       
        <th class="col-md-1" style="text-align: center"><h4><b>Kode Barang<b></h4></th>
		<th class="col-md-1" style="text-align: center"><h4><b>Modal<b></h4></th>
		<th class="col-md-1"style="text-align: center"><h4><b>Harga Jual<b></h4></th>
	</tr>
	<?php
include('koneksi.php');
if (isset($_POST['cari'])) {
    $kt = $_POST['katakunci'];
    $query = "select * from barang where nama_barang like '%$kt%'";
} else {
    $query = "select * from barang";
}
?>
	
	
<?php 
	include('koneksi.php');
	if (isset($_POST['cari'])) {
    $kt = $_POST['katakunci'];
    $brg =mysql_query("select * from barang where nama_barang like '%$kt%'");
	}else{
	$brg=mysql_query("select * from barang limit $start, $per_hal");
	}
	$no=1;
	while($b=mysql_fetch_array($brg)){

?>
		<tr>
			<td style="text-align: center"><h5><?php echo $no++ ?></h5></td>
			<td><h5><?php echo $b['nama_barang'] ?></h5></td>
			<td><h5><?php echo $b['kode_barang'] ?></h5></td>
			<td><h5>Rp. <?php echo number_format($b['modal'],0,',','.'); ?>,-</h5></td>
            <td><h5>Rp. <?php echo number_format($b['harga'],0,',','.'); ?>,-</h5></td>
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

<br><br>

    


<?php 
include 'footer.php';

?>
</div>