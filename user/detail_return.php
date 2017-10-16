<?php include ('header.php');
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "toko";
$kon = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
$idget=$_GET['id'];
$qsr="SELECT return.id_return, return.tanggal, return.keterangan, faktur.no_faktur 
FROM toko.return LEFT JOIN toko.faktur on return.id_faktur=faktur.id_faktur where return.id_return=$idget";
$eqsr=mysqli_query($kon,$qsr);
$dr=mysqli_fetch_array($eqsr);
$qt="SELECT sum(total) as jumlahttl from detail_return where id_return=$idget";
$eqt=mysqli_query($kon,$qt);
$dqt=mysqli_fetch_array($eqt);
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
<?php
$qsr="SELECT return.id_return, return.tanggal, return.keterangan, faktur.no_faktur 
FROM toko.return 
LEFT JOIN toko.faktur on return.id_faktur=faktur.id_faktur where return.id_return=$idget";
$eqsr=mysqli_query($kon,$qsr);
$no=1;
while ($dr=mysqli_fetch_array($eqsr)){
?>
<div id="div1"> 
<table width=100%>
  <tr>
    <td align="right">
	<b>KSI
	<br>TGR,&nbsp;<?php echo $dr['tanggal']; ?>
	<br>Faktur Return 
    <br>No. Fak : &nbsp;<?php echo $dr['no_faktur']; ?>  
    </td>
  </tr>
</table>
<?php } ?>
 <table width=100% border="3px solid black">
		<th class="col-md-1" style="text-align: center"><b>No<b></th>
		<th class="col-md-2" style="text-align: center"><b>Type<b></th>
        <th class="col-md-1" style="text-align: center"><b>Qty<b></th>       
		<th class="col-md-2" style="text-align: center"><b>Total<b></th>

   <?php
   $qsrd="SELECT detail_return.id_return, detail_return.jumlah, detail_return.total, barang.nama_barang 
   FROM toko.detail_return 
   LEFT JOIN toko.barang on detail_return.id_barang=barang.id_barang where detail_return.id_return=$idget";
   $eqsrd=mysqli_query($kon,$qsrd);
   while($drd=mysqli_fetch_array($eqsrd)){
    ?>
   <tr>
	 <td style="text-align: center"><?php echo $no++ ?>.</td>
     <td style="text-align: left">&nbsp;&nbsp;<?php echo $drd['nama_barang']; ?></td>
     <td style="text-align: center"><?php echo $drd['jumlah']; ?>&nbsp;Lbr</td>
     <td style="text-align: center">Rp.&nbsp;<?php echo number_format($drd['total']); ?>,-</td>
   </tr>
 <?php } ?>
<tr>
      <td colspan="3" style="text-align:right"><b>Total Return: &nbsp;<b></td>
      <td style="text-align:center"><b>Rp. <?php echo number_format ($dqt['jumlahttl']); ?>,-<b></td>
</tr>
 </table>
 <div align="right"></br>
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
</body>

</html>
</br></br>
<button onclick="printContent('div1')">Print Content</button>
 
</br></br></br></br></br>
 
 <?php include ('footer.php'); ?> 
 
 </div>