<?php
include ('header.php');
$idget=$_GET['id'];
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
    color: black;
}
</style>

<div class="right_col" role="main">
    <div align="center">
        <h1><span class="glyphicon glyphicon-credit-card"></span>&nbsp;&nbsp;Detail Faktur</h1>
    </div>
 
</br>

<?php
$qtf="SELECT faktur.no_faktur, customer.nama_customer FROM faktur left join customer on customer.id_customer=faktur.id_customer where faktur.id_faktur=$idget";
$eqtf=mysqli_query($kon,$qtf);
while ($dqtf=mysqli_fetch_array($eqtf)){
?>
<div id="div1"> 
<table width=100%>
  <tr>
  <td align="left">
	Kepada YTH :
	<br><?php echo $dqtf['nama_customer']; ?>
	</td>
    <td align="right">
	<b>KSI
	<br>Tangerang
	<br>Faktur Penjualan
    <br>No. Faktur : &nbsp;<?php echo $dqtf['no_faktur']; ?>  
    </td>
  </tr>
</table>
</br>
<?php } ?>
 <table width=100% border="2">
    <tr> 
		<th style="text-align: center">No</th>
		<th style="text-align: center">Type</th>
		<th style="text-align: center">Qty</th>
		<th style="text-align: center">Total</th>
    </tr>
                
<?php
$qtf="SELECT barang.nama_barang, detail_faktur.jumlah, detail_faktur.total, faktur.diskon, faktur.income
FROM detail_faktur
inner join barang on barang.id_barang=detail_faktur.id_barang
inner join faktur on faktur.id_faktur=detail_faktur.id_faktur
where detail_faktur.id_faktur=$idget";
$eqtf=mysqli_query($kon,$qtf);
$no=1;
while ($dqtf=mysqli_fetch_array($eqtf)) 

{ ?>
  <tr>
	<td style="text-align: center"><?php echo $no++ ?></td>
    <td style="text-align: left">&nbsp;&nbsp;<?php echo $dqtf['nama_barang']; ?></td>
    <td style="text-align: center"><?php echo $dqtf['jumlah']; ?>&nbsp;&nbsp;Lbr</td>	
    <td style="text-align: center">Rp. <?php echo number_format($dqtf['total']); ?>,-</td>
  </tr>
<?php } ?>

<?php
$qj="SELECT sum(income) as ttl
FROM faktur where faktur.id_faktur=$idget";
$eqj=mysqli_query($kon,$qj);
if ($dqj=mysqli_fetch_array($eqj)){
?>
<tr>
      <td colspan="3" style="text-align:right"><b>Disc :&nbsp;<b></td>
      <td style="text-align:center"><b>Rp. <?php echo number_format ($rpdiskon); ?>,-<b></td>
</tr>
<tr>
    <td colspan="3" style="text-align: right"><b>Total Pembayaran :&nbsp;</b></td>	
    <td style="text-align: center"><b>Rp. <?php echo number_format($dqj['ttl']); ?>,-</td>

	
  </tr>
<?php } ?>
</table></br>
<div align="right">
<b>Hormat Kami,</b>
</br>
</br>
</br>
<b>(.......................)</b>
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
</br>
<button onclick="printContent('div1')">Print Content</button>

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
