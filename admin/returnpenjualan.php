<?php include ('header.php');
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "toko";
$kon = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (isset($_POST['save'])) {
  $idfaktur=$_POST['idfaktur'];
  $tanggal=$_POST['tanggal'];
  $keterangan=$_POST['keterangan'];
    $header = "INSERT INTO toko.return (id_faktur, tanggal, keterangan) VALUES ('$idfaktur', '$tanggal', '$keterangan')";
    $header_proses = mysqli_query($kon, $header);
    if ($header_proses) {
        $iddetailfaktur=$_POST['iddetailfaktur'];
        $idbarang = $_POST['idbarang'];
        $jumlah = $_POST['jumlahreturn'];
        $idreturn = mysqli_insert_id($kon);
        $total = 0;
        for ($i = 0; $i < count($iddetailfaktur); $i++) {
            $iddetailfakturarray = $iddetailfaktur[$i];
            $jumlaharray = $jumlah[$i];
            $idbarangarray = $idbarang[$i];
            $qsdf="SELECT jumlah, total, modal FROM detail_faktur where id_detail_faktur=$iddetailfakturarray";
            $eqsdf=mysqli_query($kon,$qsdf);
            if ($dqsdf= mysqli_fetch_array($eqsdf)) {
                $jumlahawaldf=$dqsdf['jumlah'];
                $hargasatuan=$dqsdf['total']/$dqsdf['jumlah'];
            }
            $totalreturn=$hargasatuan*$jumlaharray;
            $qsf="SELECT diskon,id_customer FROM faktur where id_faktur=$idfaktur";
            $eqsf=mysqli_query($kon,$qsf);
            if ($dqsf= mysqli_fetch_array($eqsf)) {
              $ddiskon=$dqsf['diskon'];
                $potongan=($ddiskon/100)*$totalreturn;
                $totalreturndiskon=$totalreturn-$potongan;
                $idcustomer=$dqsf['id_customer'];
            }
            $qidr="INSERT INTO detail_return (id_faktur, id_return, id_barang, jumlah, total) VALUES ($idfaktur, $idreturn, $idbarangarray, $jumlaharray, $totalreturndiskon)";
            mysqli_query($kon,$qidr);
            if ($idcustomer > 0) {
              $qshjc="SELECT harga_jual FROM customer_barang where id_customer=$idcustomer AND id_barang=$idbarangarray";
              $eqshjc=mysqli_query($kon,$qshjc);
              $dqshjc= mysqli_fetch_array($eqshjc);
                  $hargabarangcustomer=$dqshjc['harga_jual'];
            }
            if ($idcustomer == 0) {
              $qshjc="SELECT harga FROM barang where id_barang=$idbarangarray";
              $eqshjc=mysqli_query($kon,$qshjc);
              $dqshjc= mysqli_fetch_array($eqshjc);
                  $hargabarangcustomer=$dqshjc['harga'];
            }
            $qsm="SELECT modal FROM barang where id_barang=$idbarangarray";
            $eqsm=mysqli_query($kon,$qsm);
            $dqsm= mysqli_fetch_array($eqsm);
                $modal=$dqsm['modal'];
            $jumlahbarudf=$jumlahawaldf-$jumlaharray;
            $totalbarudf=$jumlahbarudf*$hargabarangcustomer;
            $modalbarudf=$jumlahbarudf*$modal;
            $qudf="UPDATE toko.detail_faktur SET jumlah = '$jumlahbarudf', total = '$totalbarudf', modal = '$modalbarudf' WHERE  detail_faktur.id_detail_faktur = $iddetailfakturarray";
            mysqli_query($kon,$qudf);
            $qsumdf="SELECT sum(total) as ttl, sum(modal) as mdl FROM detail_faktur where id_faktur=$idfaktur";
            $eqsumdf=mysqli_query($kon,$qsumdf);
            $dqsumdf= mysqli_fetch_array($eqsumdf);
                $totalpf=$dqsumdf['ttl'];
                $modalpf=$dqsumdf['mdl'];
            $subtotalbaru=$totalpf;
            $incomebaru=$subtotalbaru-(($ddiskon/100)*$subtotalbaru);
            $lababaru=$incomebaru-$modalpf;
            $quf="UPDATE toko.faktur SET subtotal = $subtotalbaru, income = $incomebaru, laba = $lababaru WHERE faktur.id_faktur = $idfaktur";
            mysqli_query($kon, $quf);

					}
					header("location:viewreturn.php?id=$idreturn");
				}
			}
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
    background-color: #8a8a5c;
    color: black;
}
</style>
 
 <div class="right_col" role="main"> 
  </br></br>
    <div align="center">
        <h1><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;&nbsp;Return Penjualan</h1>		
      </div></br></br></br></br></br>
   <form method="post" action="returnpenjualan.php">
                <div class="input-group input-group-sm" style="width: 250px;">
		<h5><b><input type="text" name="tanggal" value="<?php $t = date('Y-m-d'); echo $t; ?>" style="width: 200px; height: 35px; text-align: center" readonly/></h5><b>
		<input type="text" name="nofaktur" class="form-control pull-left" placeholder="Masukan No.Faktur....." 
					style="width: 200px; height: 35px;">
                <button name="cari" type="submit" class="btn btn-default form-control pull-left" 
					style="width: 35px; height: 35px;"><i class="fa fa-search"></i></button>
                </div>
                		
  <?php
  if (isset($_POST['cari'])) {
    $nofaktur=$_POST['nofaktur'];
    $qf="SELECT id_faktur FROM faktur WHERE no_faktur=$nofaktur";
    $eqf=mysqli_query($kon,$qf);
    $dqf=mysqli_fetch_array($eqf);
    $a=$dqf['id_faktur'];
    $qdf="SELECT detail_faktur.id_detail_faktur, detail_faktur.id_barang, barang.nama_barang, detail_faktur.jumlah, detail_faktur.id_faktur from detail_faktur left join barang on barang.id_barang=detail_faktur.id_barang where detail_faktur.id_faktur=$a";
    $eqdf=mysqli_query($kon,$qdf);
    while ($dqdf=mysqli_fetch_array($eqdf))	{ ?>
      <input type="hidden" name="iddetailfaktur[]" value="<?php echo $dqdf['id_detail_faktur']; ?>">
      <input type="hidden" name="idbarang[]" value="<?php echo $dqdf['id_barang']; ?>">
	  <input type="hidden" name="idfaktur" value="<?php echo $dqdf['id_faktur']; ?>">
      <input style="text-align:center" type="text" name="namabarang[]" value="<?php echo $dqdf['nama_barang']; ?>" readonly>
      <input style="text-align:center" type="number" name="jumlah[]" value="<?php echo $dqdf['jumlah']; ?>" readonly>
      <input type="number" name="jumlahreturn[]" value="" min="0" max="<?php echo $dqdf['jumlah']; ?>"><br></br>
<?php }
echo "<input type='submit' name='save' value='Simpan'>"."<br>"."</br>"
      ."<textarea name='keterangan'></textarea>";
  }
  ?>
</form>
</br></br>
</br></br></br></br></br></br>
</br></br></br></br></br>
</br></br></br>
<?php include ('footer.php'); ?>
</div>