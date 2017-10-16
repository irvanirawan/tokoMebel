<?php
include "session.php";
if ($_SESSION['authorized']=0){
	echo "nollllll";
}
include "header.php";
?>	

<div class="right_col" role="main">

		<div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-caret-square-o-right"></i></div>
                  <div class="count"><h1><?php $query=mysql_query('select count(id_barang) as jumlah from barang');
			  $jumlaha=mysql_fetch_array($query);
			  echo $jumlaha['jumlah'];
			  ?></h1></div>
                  <h3>Jumlah Barang</h3>             
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-comments-o"></i></div>
                  <div class="count"><h1><?php $query=mysql_query('select count(id_customer) as jumlah from customer');
			  $jumlah=mysql_fetch_array($query);
			  echo $jumlah['jumlah'];
			  ?></h1></div>
                  <h3>Jumlah Customer</h3>                 
                </div>
              </div>
            </div>			

    <div align="center">
        <h1><span class="glyphicon glyphicon-briefcase"></span><b> Data Barang</b></h1>		
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
 <div class="container-fluid form-outline nav navbar-right">
        <span ><a href="input_barang.php" class="box-title fa fa-plus btn btn-primary form-group pull-right" style="width: 170px;"> Tambah Barang</a></span>
  </div>
  <div class="container-fluid form-outline nav navbar-left">
			<div class="box-tools form-group">
        <form method="post" action="tampil_barang.php">
                <div class="input-group input-group-sm" style="width: 300px;">
                    <input type="text" name="katakunci" class="form-control pull-left" placeholder="Cari..." required>
                    <div class="input-group-btn">
                        <button name="cari" type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>				
        </form>
            </div>
</div>
    
</br></br></br>

<style>
h1 {
    text-shadow: 1px 2px black;
}
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #0099cc;
    color: black;
}
</style>

<h5><table id="example" class="table table-bordered table-striped table-hover table-responsive"></h5>
	<tr>
		<th class="col-md-1" style="text-align: center" ><h5><b>ID Barang<b></h5></th>
        <th class="col-md-3" style="text-align: center"><h5><b>Nama Barang<b></h5></th>       
        <th class="col-md-1" style="text-align: center"><h5><b>Kode Barang<b></h5></th>
		<th class="col-md-1" style="text-align: center"><h5><b>Modal<b></h5></th>
		<th class="col-md-1"style="text-align: center"><h5><b>Harga Jual<b></h5></th>	
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
include('koneksi.php');
if (isset($_POST['cari'])) {
    $kt = $_POST['katakunci'];
    $query = "select * from customer where nama_customer like '%$kt%'";
} else {
    $query = "select * from customer";
}
?>
     <div align="center">
        <h1><span class="glyphicon glyphicon-user"></span><b> Data Customer</b></h1>		
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
	</br></br>
	</br></br></br></br></br></br></br>
	
</div>
 <div class="container-fluid form-outline nav navbar-right">
        <span ><a href="input_customer.php" class="box-title fa fa-plus btn btn-primary form-group pull-right" style="width: 180px;">Tambah Customer</a></span>
  </div>
  <div class="container-fluid form-outline nav navbar-left">
			<div class="box-tools form-group">
        <form method="post" action="tampil_customer.php">
                <div class="input-group input-group-sm" style="width: 300px;">
                    <input type="text" name="katakunci" class="form-control pull-left" placeholder="Cari Customer..." required>
                    <div class="input-group-btn">
                        <button name="cari" type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>				
        </form>
            </div>
</div>
</br>


</br></br>
<h5><table id="example" class="table table-bordered table-striped table-hover table-responsive"></h5>
	<tr>
		<th class="col-md-1" style="text-align: center" ><h5><b>No<b></h5></th>
        <th class="col-md-2" style="text-align: center"><h5><b>Nama Customer<b></h5></th>       
        <th class="col-md-1" style="text-align: center"><h5><b>Jenis<b></h5></th>
		<th class="col-md-3" style="text-align: center"><h5><b>Alamat<b></h5></th>
		<th class="col-md-1"style="text-align: center"><h5><b>No Telp<b></h5></th>
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