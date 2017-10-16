<?php
include('koneksi.php');
include('header.php');
if (isset($_POST['cari'])) {
    $kt = $_POST['katakunci'];
    $query = "select * from customer where nama_customer like '%$kt%'";
} else {
    $query = "select * from customer";
}
?>
</br></br>
<div class="right_col" role="main">
    <div align="center">
        <h1><span class="glyphicon glyphicon-user"></span>&nbsp; Data Customer</h1>
    </div>
	</br>

<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from customer");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-13">
	<table class="col-md-3">
		<tr>
			<td style="text-align: left"><h4><b>Jumlah Customer : </b></h4></td>		
			<td style="text-align: left"><h4><b><?php echo $jum; ?></b></h4></td>
		</tr>
		<tr>
			<td style="text-align: left"><h4><b>Jumlah Page : </b></h4></td>	
			<td style="text-align: left"><h4><b><?php echo $halaman; ?></b></h4></td>
		</tr>
	</table>
	
</br></br></br></br>
	</br></br></br>
</div>
  <div class="container-fluid form-outline nav navbar-left">
			<div class="box-tools form-group">
        <form method="post" action="tampil_customer.php">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="katakunci" class="form-control pull-left" placeholder="Cari Barang..." 
					style="width: 200px; height: 35px;" required>
                    
                        <button name="cari" type="submit" class="btn btn-default form-control pull-left" 
						style="width: 35px; height: 35px;"><i class="fa fa-search"></i></button>
                    </div>
                				
        </form>
            </div>
</div>
</br>

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
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #a3297a;
    color: black;
}
</style>
</br>
<h5><table class="table table-bordered table-striped table-hover table-responsive"></h5>
	<tr>
		<th class="col-md-1" style="text-align: center" ><h4><b>No<b></h4></th>
        <th class="col-md-2" style="text-align: center"><h4><b>Nama Customer<b></h4></th>       
        <th class="col-md-1" style="text-align: center"><h4><b>Jenis<b></h4></th>
		<th class="col-md-3" style="text-align: center"><h4><b>Alamat<b></h4></th>
		<th class="col-md-1"style="text-align: center"><h4><b>No Telp<b></h4></th>
	</tr>
			
<?php
include('koneksi.php');
if (isset($_POST['cari'])) {
    $kt = $_POST['katakunci'];
    $query = "select * from customer where nama_customer like '%$kt%'";
} else {
    $query = "select * from customer";
}
?>
	
	
<?php 
	include('koneksi.php');
	if (isset($_POST['cari'])) {
    $kt = $_POST['katakunci'];
    $brg =mysql_query("select * from customer where nama_customer like '%$kt%'");
}else{
	$brg=mysql_query("select * from customer limit $start, $per_hal");
	}
	$no=1;
	while($b=mysql_fetch_array($brg)){

?>
                <tr>
                    <td style="text-align: center"><?php echo $b['id_customer']; ?></td>
                    <td><?php echo $b['nama_customer']; ?></td>
                    <td><?php echo $b['jenis_customer']; ?></td>
                    <td><?php echo $b['alamat']; ?></td>
                    <td><?php echo $b['no_tlp']; ?></td>
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

<br><br><br>

<?php
include('footer.php');
?>

</div>