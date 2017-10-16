<?php
ob_start();
include_once('header.php');
$idget=$_GET['id'];
if (isset($_POST['print'])) {
	$c=$_POST['id_faktur'];
	$subttl=$_POST['subttl'];
	$incm=$_POST['incm'];
	$moda=$_POST['modal'];
	$modal=array_sum($moda);
	$laba=$incm-$modal;
	$qupf="UPDATE faktur SET subtotal = '$subttl', income = '$incm', laba = '$laba' WHERE id_faktur = '$c'";
	mysqli_query($kon, $qupf);
	header("Location:printview.php?id=".$c);
}
// <!-- total belanja -->
$qt="SELECT sum(total) as ttl from detail_faktur where id_faktur=$idget";
$eqt=mysqli_query($kon,$qt);
if ($dqt=mysqli_fetch_array($eqt)) {
  $totalbayarsebelumdiskon=$dqt['ttl']; }
// <!-- end total belanja -->
// tampilkan diskon
$qtd="SELECT diskon FROM faktur WHERE id_faktur=$idget";
$eqtd=mysqli_query($kon,$qtd);
if ($dqtd=mysqli_fetch_array($eqtd)) {
  $persentasediskon=$dqtd['diskon'];
}
// end tampilkan diskon
// buat rupiah diskon
$rpdiskon=($persentasediskon/100)*$totalbayarsebelumdiskon;
$totalbayar=$totalbayarsebelumdiskon-$rpdiskon;
// end rupiah diskon
// untuk batalkan
if (isset($_POST['batal'])) {
  $idfaktur=$_POST['id_faktur'];
  $qhf="DELETE FROM faktur where id_faktur=$idfaktur";
  mysqli_query($kon,$qhf);
  $qhdf="DELETE FROM detail_faktur WHERE id_faktur=$idfaktur";
  mysqli_query($kon, $qhdf);
  header("Location:penjualan.php");
}
// end untuk batalkan
// untuk koreksi
if (isset($_POST['koreksi'])) {

  $a=$_POST['jumlah'];
  $b=$_POST['id_detail_faktur'];
  $c=$_POST['id_faktur'];
  $d=$_POST['harga'];
  $idbarang=$_POST['idbarang'];
// a
  for ($i=0; $i < count($b); $i++) {
    $darray=$d[$i];
    $barray=$b[$i];
    $aarray=$a[$i];
    $idbarangarray=$idbarang[$i];
    $total=$darray*$aarray;
		$qhb="select modal from barang where id_barang=$idbarangarray";
		$eqhb=mysqli_query($kon,$qhb);
		if ($dqhb=mysqli_fetch_array($eqhb)) {
				$upm=$aarray*$dqhb['modal'];
		}
    $qupj="update detail_faktur set jumlah=$aarray, total=$total, modal=$upm where id_detail_faktur=$barray";
    mysqli_query($kon,$qupj);
  }
// end a
// b
  if (!empty($_POST['hapus'])) {
    $idhapus=$_POST['hapus'];
    for ($i=0; $i < count($idhapus); $i++) {
      $idharray=$idhapus[$i];
      $qhc="DELETE FROM detail_faktur WHERE id_detail_faktur = $idharray";
      mysqli_query($kon,$qhc);
    }

  }
// end b
// c
$db=$_POST['pdiskon'];
$qsd="UPDATE faktur SET diskon=$db WHERE id_faktur=$c";
mysqli_query($kon, $qsd);
// end c
header("Location:detailpenjualan.php?id=".$c);
}
// end untuk koreksi
 ?>
 <div class="right_col" role="main">
 <div align="center">
        <h1><span class="glyphicon glyphicon-shopping-cart"></span>Detail Penjualan Khusus</h1>
 </div>

 </br></br>
<form action="detailpenjualan.php" method="post">

<?php
$queryfaktur="SELECT faktur.id_faktur, faktur.no_faktur, faktur.tanggal, customer.nama_customer
FROM faktur LEFT JOIN customer ON faktur.id_customer=customer.id_customer where faktur.id_faktur=".$_GET['id']."";
$equeryfaktur=mysqli_query($kon,$queryfaktur);
while($dqueryfaktur=mysqli_fetch_array($equeryfaktur)){?>
  <input type="hidden" name="id_faktur" value="<?php $idf=$dqueryfaktur['id_faktur']; echo $idf; ?>">
  <div class="col-md-15">
	<table class="col-md-6">
		<tr>
			<td style="text-align: left"><h4><b>No Faktur : </b></h4></td>
			<td style="text-align: left"><h4><input type="text" name="a" value="<?php echo $dqueryfaktur['no_faktur']; ?>" readonly></b></h4></td>
		</tr>
		<tr>
			<td style="text-align: left"><h4><b>Customer : </b></h4></td>
			<td style="text-align: left"><h4><input type="text" name="a" value="<?php echo $dqueryfaktur['nama_customer']; ?>" readonly><b></h4></td>
		</tr>
		<tr>
			<td style="text-align: left"><h4><b>Tanggal : </b></h4></td>
			<td style="text-align: left"><h4><input type="text" name="a" value="<?php echo $dqueryfaktur['tanggal']; ?>" readonly><b></h4></td>
		</tr>
	</table>

	</br></br></br></br>
	</br></br></br></br>
</div>
</br>
  <?php
} ?>
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
    padding: 10px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #75a3a3;
    color: black;
}
</style>
</br></br>

<h5><table class="table table-bordered table-striped table-hover table-responsive"></h5>
	<tr>
		<th class="col-md-1" style="text-align: center" ><h4><b>Jumlah Barang<b></h4></th>
        <th class="col-md-2" style="text-align: center"><h4><b>Nama Barang<b></h4></th>
        <th class="col-md-1" style="text-align: center"><h4><b>Harga Satuan<b></h4></th>
		<th class="col-md-1" style="text-align: center"><h4><b>Harga Total<b></h4></th>
		<th class="col-md-1"style="text-align: center"><h4><b>Pilih Untuk Batal<b></h4></th>
	</tr>

<?php
$q="SELECT faktur.no_faktur, customer.nama_customer, faktur.tanggal, detail_faktur.jumlah,
customer_barang.harga_jual, detail_faktur.total, barang.nama_barang, faktur.id_faktur, detail_faktur.id_detail_faktur, detail_faktur.modal, faktur.status, detail_faktur.id_barang
FROM detail_faktur INNER JOIN barang ON detail_faktur.id_barang = barang.id_barang
LEFT JOIN customer_barang ON barang.id_barang = customer_barang.id_barang
INNER JOIN faktur ON customer_barang.id_customer = faktur.id_customer AND faktur.id_faktur = detail_faktur.id_faktur
INNER JOIN customer ON customer.id_customer = faktur.id_customer where faktur.id_faktur=".$_GET['id'];
$e=mysqli_query($kon,$q);
while($d=mysqli_fetch_array($e)){ ?>
  <tr>
    <input type="hidden" name="id_detail_faktur[]" value="<?php echo $d['id_detail_faktur']; ?>">
    <td style="text-align: center"><input type="number" name="jumlah[]" value="<?php echo $d['jumlah']; ?>"></td>
    <td style="text-align: center"><?php echo $d['nama_barang']; ?></td>
		<input type="hidden" name="harga[]" value="<?php echo $d['harga_jual']; ?>">
		<input type="hidden" name="total[]" value="<?php echo $d['total']; ?>">
		<input type="hidden" name="idbarang[]" value="<?php echo $d['id_barang']; ?>">
    <td style="text-align: center">Rp. <?php echo number_format ($d['harga_jual']); ?></td>
    <td style="text-align: center">Rp. <?php echo number_format ($d['total']); ?></td>
    <td style="text-align: center"><input type="checkbox" name="hapus[]" value="<?php echo $d['id_detail_faktur']; ?>"<?php if($d['total']==1){echo readonly;} ?>> Batal</td>
<input type="hidden" style="width: 100px;" name="modal[]" value="<?php echo $d['modal']; ?>" >
  </tr>
<?php }
?>
<tr style="height: 35px;">
<td colspan="2" style="text-align:right"><h5><b>Diskon :</h5></td>
<td style="text-align: center"><input type="text" style="width: 100px;" name="pdiskon" value="<?php echo $persentasediskon; ?>" ></td>
<td style="text-align: center">Rp. <?php echo number_format ($rpdiskon); ?></td>
<input type="hidden" style="width: 100px;" name="subttl" value="<?php echo $totalbayarsebelumdiskon; ?>" >
</tr>
<tr style="height: 35px;">
  <td colspan="3" style="text-align:right"><h5><b>Total Bayar:</h5></td>
  <td>
  <!-- total belanja -->
  Rp. <?php echo number_format ($totalbayar); ?>
<input type="hidden" style="width: 100px;" name="incm" value="<?php echo $totalbayar; ?>" >
   <!-- end total belanja -->
   </td>
</tr>
</table>

<?php
  $queryfaktur="SELECT faktur.id_faktur, faktur.no_faktur, faktur.tanggal, customer.nama_customer
  FROM faktur LEFT JOIN customer ON faktur.id_customer=customer.id_customer where faktur.id_faktur=".$_GET['id']."";
  $equeryfaktur=mysqli_query($kon,$queryfaktur);
  while($dqueryfaktur=mysqli_fetch_array($equeryfaktur)){?>

<?php } ?>

</br></br>

<div class="container-fluid form-outline nav navbar-left">
	<span><input type="submit" name="batal" value="Batalkan"
	class="box-title btn btn-danger form-group pull-rleft"
	style="width: 200px; height: 35px;"></span>
</div>

<div class="container-fluid form-outline nav navbar-left">
	<span><a href="tambahbarang.php?id=<?php echo $idget;?>"
	class="box-title btn btn-success form-group pull-left"
	style="width: 200px; height: 35px;">Tambah Barang</a></span>
</div>

<div class="container-fluid form-outline nav navbar-right">
	<span><input type="submit" name="print" value="Save & Print"
	class="box-title btn btn-info form-group pull-right"
	style="width: 200px; height: 35px;"></span>
</div>

<div class="container-fluid form-outline nav navbar-right">
	<span><input type="submit" name="koreksi" value="Update"
	class="box-title btn btn-primary form-group pull-right"
	style="width: 200px; height: 35px;"></span>
</div>


</br></br></br>
</br></br></br>
</br></br></br>

<?php
include ('footer.php');

?>

</div>
