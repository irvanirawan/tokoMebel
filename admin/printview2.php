<?php
include ('header.php');
$idget=$_GET['id'];
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
?>
<html>
<div class="right_col" role="main" >
<div id="div1">

 <?php
$queryfaktur="SELECT faktur.id_faktur, faktur.no_faktur, faktur.tanggal, customer.nama_customer, customer.alamat FROM faktur LEFT JOIN customer ON faktur.id_customer=customer.id_customer where faktur.id_faktur=".$_GET['id']."";
$equeryfaktur=mysqli_query($kon,$queryfaktur);
while($dqueryfaktur=mysqli_fetch_array($equeryfaktur)){?>

<table width=100%>
  <tr>
  <td align="left">
	Kepada YTH :
	<br><?php echo $dqueryfaktur['nama_customer']; ?>
	<br><?php echo $dqueryfaktur['alamat']; ?>
	<th style="text-align:right">
	<b><h2>KSI</b>
	</th>
	</td>
    <td align="right">
	 Tgr, <?php echo $dqueryfaktur['tanggal']; ?></b></th>
	<br>Faktur Penjualan
    <br>No. Fak : <?php echo $dqueryfaktur['no_faktur']; ?>    
    </td>
  </tr>
</table>

  <?php } ?>
<div>
</br>
<table width=100% border="2">
  <tr style="text align:center">
	<th style="text-align: center">No</th>
    <th style="text-align: center">Qty</th>
    <th style="text-align: center">Type</th>
    <th style="text-align: center">Harga @</th>
    <th style="text-align: center">Total</th>
  </tr>
<?php
$idy=$_GET['id'];
$q="SELECT detail_faktur.jumlah, barang.nama_barang, barang.harga, detail_faktur.total
from detail_faktur left join barang on barang.id_barang=detail_faktur.id_barang where detail_faktur.id_faktur=$idy";
$e=mysqli_query($kon,$q);
$no=1;
while($d=mysqli_fetch_array($e)){ ?>
  <tr>
	<td style="text-align:center"><?php echo $no++; ?>.</td>
    <td style="text-align:center"><?php echo $d['jumlah'];?>&nbsp;&nbsp;Lbr</td>
    <td style="text-align:center"><?php echo $d['nama_barang']; ?></td>
    <td style="text-align:center">Rp. <?php echo number_format ($d['harga']); ?>,-</td>
    <td style="text-align:center">Rp. <?php echo number_format ($d['total']); ?>,-</td>
  </tr>
<?php }
?>
<tr>

      <td colspan="4" style="text-align:right"><b>Sub Total : <b></td>
      <td style="text-align:center"><b>Rp. <?php echo number_format ($totalbayarsebelumdiskon); ?>,-<b></td>
</tr>
<tr>
      <td colspan="4" style="text-align:right"><b>Disc : <b></td>
      <td style="text-align:center"><b>Rp. <?php echo number_format ($rpdiskon); ?>,-<b></td>
</tr>
<tr>
      <td colspan="4" style="text-align:right"><b>Total : <b></td>
      <td style="text-align:center"><b>Rp. <?php echo number_format ($totalbayar); ?>,-<b></td>
</tr>
</table></br>
<div align="right">
<b>Hormat Kami,</b>
</br>
</br>
</br>
<b>(.......................)</b>
</div>
</div>
</div>
<script>
function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}
</script>
</body>

</html>
</br>
<button onclick="printContent('div1')">Print Content</button>
<div>
<style="text-align: center"><a href="penjualan.php" class="btn btn-primary">Back To Penjualan</a>
</div>
</br></br>
</br></br>
<?php
include 'footer.php';
?>
</div>
