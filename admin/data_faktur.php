<?php include('header.php'); ?>

<div class="right_col" role="main">
    <div align="center">
        <h1><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Data Penjualan</h1>
    </div></br></br>
	
<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT COUNT(*) from faktur");
$jum=mysql_result($jumlah_record, 0);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-13">
	<table class="col-md-3">
		<tr>
			<td style="text-align: left"><h4><b>Jumlah Faktur : </b></h4></td>		
			<td style="text-align: left"><h4><b><?php echo $jum; ?></b></h4></td>
		</tr>
		<tr>
			<td style="text-align: left"><h4><b>Jumlah Page : </b></h4></td>	
			<td style="text-align: left"><h4><b><?php echo $halaman; ?></b></h4></td>
		</tr>
	</table>
	
	</br></br></br></br></br>
	
</div>	
	
 <div class="container-fluid form-outline nav navbar-right"></div>
        <div class="container-fluid form-inline nav navbar-right">       
        <div class="box-tools form-group">
        <form method="post" action="data_faktur.php">               
				<div class="input-group input-group-sm" style="width: 100px;">
					<input type="date" name="dari" class="form-control right" placeholder="dari" style="width: 200px; height: 35px;">
				</div>
				<div class="input-group input-group-sm" style="width: 100px;">
					<input type="date" name="sampai" class="form-control pull-right" placeholder="sampai" style="width: 200px; height: 35px;">				                   
					<div class="input-group-btn" style="width: 50px;">
					<button name="carix" type="submit" class="btn btn-default" style="width: 35px; height: 35px;"><i class="fa fa-search"></i></button>
                    </div>
                </div>	
        </form>
        </div>
		</div>
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
    background-color: #00802b;
    color: black;
}
</style>
</br></br>
<table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th class="col-md-1" style="text-align: center"><h4><b>No Faktur<b></h4></th>
        <th class="col-md-2" style="text-align: center"><h4><b>Customer<b></h4></th>       
        <th class="col-md-1" style="text-align: center"><h4><b>Tanggal<b></h4></th>
		<th class="col-md-1" style="text-align: center"><h4><b>Sebelum Diskon<b></h4></th>
		<th class="col-md-1" style="text-align: center"><h4><b>Diskon %<b></h4></th>	
		<th class="col-md-1" style="text-align: center"><h4><b>Sesudah Diskon<b></h4></th>
		<th class="col-md-1" style="text-align: center"><h4><b>Laba Netto<b></h4></th>
		<th class="col-md-2" style="text-align: center"><h4><b>Opsi<b></h4></th>
      </tr>
    </thead>
 <tbody>
                
<?php
if (isset($_POST['carix'])){
$dari=$_POST['dari'];
$sampai=$_POST['sampai'];
$qtf="select faktur.id_customer, faktur.id_faktur, faktur.no_faktur, customer.nama_customer, faktur.tanggal, faktur.diskon 
from faktur left join customer on faktur.id_customer=customer.id_customer 
where tanggal between '$dari' and '$sampai'";
$qsf="select sum(income) as inc from faktur where tanggal between '$dari' and '$sampai'";
$qsfl="select sum(laba) as lab from faktur where tanggal between '$dari' and '$sampai'";
}
else {
$qtf="select faktur.id_customer, faktur.id_faktur, faktur.no_faktur, customer.nama_customer, faktur.tanggal, faktur.diskon 
from faktur left join customer on faktur.id_customer=customer.id_customer";
$qsf="select sum(income) as inc from faktur";
$qsfl="select sum(laba) as lab from faktur";
}

$eqtf=mysqli_query($kon,$qtf);
while ($dqtf=mysqli_fetch_array($eqtf)) { ?>
  <tr>
    <td style="text-align: center"><?php $a=$dqtf['id_faktur']; echo $dqtf['no_faktur']; ?></td>
    <td><?php if ($dqtf['id_customer']==0){echo 'UMUM';} else { echo $dqtf['nama_customer']; }?></td>
    <td style="text-align: center"><?php echo $dqtf['tanggal']; ?></td>
    <td>Rp. <?php $qttl="select sum(total) as ttl from detail_faktur where id_faktur=$a";
              $eqttl=mysqli_query($kon,$qttl);
              if ($dqttl=mysqli_fetch_array($eqttl)) {$subtotal=$dqttl['ttl']; echo number_format($subtotal);} ?></td>
    <?php $qm="select sum(modal) as ttlmodal from detail_faktur where id_faktur=$a";
              $eqm=mysqli_query($kon,$qm);
              if ($dqm=mysqli_fetch_array($eqm)) {$mdf=$dqm['ttlmodal'];$laba=$subtotal-$mdf; number_format($laba);} ?>
    <td style="text-align: center"><?php echo $dqtf['diskon']; ?></td>
    <?php $diskonrp=($dqtf['diskon']/100)*$subtotal;?>
    <td>Rp. <?php $rpsetelahdiskon=$subtotal-$diskonrp; echo number_format($rpsetelahdiskon); ?></td>
    <td>Rp. <?php $lbbersih=$rpsetelahdiskon-$mdf; echo number_format($lbbersih); ?></td>
	<td style="text-align: center"><a href="detail_faktur.php?id=<?php echo $a; ?>" class="btn btn-primary">Detail</a>
	<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_data_faktur.php?id=<?php echo $dqtf['id_faktur']; ?>' }" class="btn btn-danger">Hapus</a>
	
	</td>
	
  </tr>
<?php } ?>
                </tbody>
                <tfoot>
                <tr>
                </tr>
                </tfoot>
              </table>
<table class="table table-bordered table-striped table-hover table-responsive">
 <tr>
<td colspan="6" style="text-align: center"><b><h4>Total Pemasukan :</b></h4></td>
<td style="text-align: center"><b><h4>Rp. <?php $eqsf=mysqli_query($kon,$qsf); if ($dqsf=mysqli_fetch_array($eqsf)) {echo number_format ($dqsf['inc']);}  ?></b></h4></td>
	</tr>
	
 <tr>
<td colspan="6" style="text-align: center"><b><h4>Total Laba :</b></h4></td>
<td style="text-align: center"><b><h4>Rp. <?php $eqsfl=mysqli_query($kon,$qsfl); if ($dqsfl=mysqli_fetch_array($eqsfl)) {echo number_format ($dqsfl['lab']);}  ?></b></h4></td>
	</tr>	
</table>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="../bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>	

<br><br>		
</br></br>		
		
		<footer>
          <div class="pull-right">
			<i class="fa fa-spinner"></i> SeraphimZ
                  <p>©2017 All Rights Reserved. SeraphimZ. Privacy and Terms
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
</div>