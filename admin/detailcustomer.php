<?php include 'header.php'; ?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Customer</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Customer</button>
<br/>
<br/>

<div class="right_col" role="main">
<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from customer_barang");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-12">
	<table class="col-md-2">
		<tr>
			<td>Jumlah Record</td>		
			<td><?php echo $jum; ?></td>
		</tr>
		<tr>
			<td>Jumlah Halaman</td>	
			<td><?php echo $halaman; ?></td>
		</tr>
	</table>
</div>

<br/>
<table class="table table-hover">
	<tr>
		<th>No</th>
		<th>ID Customer</th>
		<th>ID Barang</th>
		<th>Harga Jual</th>

		
	</tr>
<?php
include('koneksi.php');
if(isset($_POST['save'])){
$query= mysql_query("update customer_barang set
				id_customer='".$_POST['A']."',
				id_barang='".$_POST['B']."',
				harga_jual='".$_POST['C']."',
				WHERE
				id_customer='".$_POST['id']."'");
				
if ($query)
{
	header("location:tampil_customer.php");
}
}else {
$brg=mysql_query("select * from customer_barang");
}
$no=1;
while($b=mysql_fetch_array($brg)){
?>

		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['id_customer'] ?></td>
			<td><?php echo $b['id_barang'] ?></td>
			<td><?php echo $b['harga_jual'] ?></td>
		</tr>		
 <?php } ?>
</table>
<ul class="pagination">			
			<?php 
			for($x=1;$x<=$halaman;$x++){
				?>
				<li><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
				<?php
			}
			?>						
		</ul>
<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Customer</h4>
			</div>
			<div class="modal-body">
				<form action="tmb_cus_act.php" method="post">
					<div class="form-group">
						<label>Nama Customer</label>
						<input name="nama" type="text" class="form-control" placeholder="Nama Customer ..">
					</div>
					<div class="form-group">
						<label>Jenis</label>
						<input name="jenis" type="text" class="form-control" placeholder="Jenis ..">
					</div>
					<div class="form-group">
						<label>Alamat</label>
						<input name="alamat" type="text" class="form-control" placeholder="Alamat ..">
					</div>
					<div class="form-group">
						<label>No Telp</label>
						<input name="tlp" type="text" class="form-control" placeholder="No Telp ..">
					</div>	
					
									
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</form>
		</div>
	</div>
</div>



<?php 
include 'footer.php';

?>

</div>