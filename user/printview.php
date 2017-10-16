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
	</td>
    <td align="right">
	<b>KSI</b>
	<br>Tgr,&nbsp;<?php echo $dqueryfaktur['tanggal']; ?></b></th>
	<br>Faktur Penjualan
    <br>No. Faktur : <?php echo $dqueryfaktur['no_faktur']; ?>     
    </td>
  </tr>
</table>

  <?php } ?>
<div>
<table rules="all" border="3"  width=100%>
		<th class="col-md-1" style="text-align: center" rules="all"><b>No<b></th>
		<th class="col-md-1" style="text-align: center" rules="all"><b>Qty<b></th>
        <th class="col-md-2" style="text-align: center" rules="all"><b>Type<b></th>       
        <th class="col-md-1" style="text-align: center" rules="all"><b>Harga @<b></th>
		<th class="col-md-2" style="text-align: center" rules="all"><b>Total<b></th>	
<?php
$q="SELECT faktur.no_faktur, customer.nama_customer, faktur.tanggal, detail_faktur.jumlah, customer_barang.harga_jual, detail_faktur.total, barang.nama_barang, faktur.id_faktur, detail_faktur.id_detail_faktur, faktur.status FROM detail_faktur INNER JOIN barang ON detail_faktur.id_barang = barang.id_barang LEFT JOIN customer_barang ON barang.id_barang = customer_barang.id_barang INNER JOIN faktur ON customer_barang.id_customer = faktur.id_customer AND faktur.id_faktur = detail_faktur.id_faktur INNER JOIN customer ON customer.id_customer = faktur.id_customer where faktur.id_faktur=".$_GET['id']."";
$e=mysqli_query($kon,$q);
$no=1;
while($d=mysqli_fetch_array($e)){ ?>
  <tr border="3">
	<td style="text-align: center"><?php echo $no++ ?>.</td>
    <td style="text-align:center" ><?php echo $d['jumlah'];?>&nbsp;&nbsp;Lbr</td>
    <td >&nbsp;&nbsp;<?php echo $d['nama_barang']; ?></td>
    <td style="text-align:center" >Rp. <?php echo number_format ($d['harga_jual']); ?>,-</td>
    <td style="text-align:center" >Rp. <?php echo number_format ($d['total']); ?>,-</td>
  </tr>
<?php }
?>
<tr>
      
      <td colspan="4" style="text-align:right"><b>Sub Total : &nbsp;<b></td>
      <td style="text-align:center"><b>Rp. <?php echo number_format ($totalbayarsebelumdiskon); ?>,-<b></td>
</tr>
<tr>
      <td colspan="4" style="text-align:right"><b>Disc : &nbsp;<b></td>
      <td style="text-align:center"><b>Rp. <?php echo number_format ($rpdiskon); ?>,-<b></td>
</tr>
<tr>
      <td colspan="4" style="text-align:right"><b>Total : &nbsp;<b></td>
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