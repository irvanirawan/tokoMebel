<?php
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
            $qidr="INSERT INTO detail_return (id_return, id_barang, jumlah, total) VALUES ($idreturn, $idbarangarray, $jumlaharray, $totalreturndiskon)";
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
<form class="" action="returnpenjualan1.php" method="post">
  <input type="text" name="nofaktur" value="">
  <input type="submit" name="cari" value="Cari"><br>
	<input type="text" name="tanggal" value="<?php $t = date('Y-m-d'); echo $t; ?>" readonly/><br>

  <?php include('session.php');
  if (isset($_POST['cari'])) {
    $nofaktur=$_POST['nofaktur'];
    $qf="SELECT id_faktur FROM faktur WHERE no_faktur=$nofaktur";
    $eqf=mysqli_query($kon,$qf);
    $dqf=mysqli_fetch_array($eqf);
    $a=$dqf['id_faktur'];
    $qdf="SELECT detail_faktur.id_detail_faktur, detail_faktur.id_barang, barang.nama_barang, detail_faktur.jumlah, detail_faktur.id_faktur from detail_faktur left join barang on barang.id_barang=detail_faktur.id_barang where detail_faktur.id_faktur=$a";
    $eqdf=mysqli_query($kon,$qdf);
    while ($dqdf=mysqli_fetch_array($eqdf)) { ?>
      <input type="hidden" name="iddetailfaktur[]" value="<?php echo $dqdf['id_detail_faktur']; ?>">
      <input type="hidden" name="idbarang[]" value="<?php echo $dqdf['id_barang']; ?>">
	    <input type="hidden" name="idfaktur" value="<?php echo $dqdf['id_faktur']; ?>">
      <input type="text" name="namabarang[]" value="<?php echo $dqdf['nama_barang']; ?>" readonly>
      <input type="number" name="jumlah[]" value="<?php echo $dqdf['jumlah']; ?>" readonly>
      <input type="number" name="jumlahreturn[]" value="" min="0" max="<?php echo $dqdf['jumlah']; ?>"><br>
<?php }
echo "<input type='submit' name='save' value='Simpan'>"."<br>"
      ."<textarea name='keterangan'>Nama Barang / Masalah</textarea>";
  }
  ?>
</form>

<!-- menampilkan data return -->
<table>
<?php $qtr="SELECT return.id_return, faktur.no_faktur, return.tanggal, return.keterangan
            FROM toko.return
            LEFT JOIN toko.faktur
            on faktur.id_faktur = return.id_faktur";
      $eqtr=mysqli_query($kon,$qtr);
      while ($dqtr=mysqli_fetch_array($eqtr)) { ?>
  <tr>
    <td><?php echo $dqtr['id_return']; ?></td>
    <td><?php echo $dqtr['no_faktur']; ?></td>
    <td><?php echo $dqtr['tanggal']; ?></td>
    <td><?php $id=$dqtr['id_return'];
    $qs="SELECT sum(total) as ttl FROM toko.detail_return where detail_return.id_return=$id";
    $eqs=mysqli_query($kon,$qs);
    if ($dqs=mysqli_fetch_array($eqs)) { echo $dqs['ttl']; } ?> </td>
    <td><?php echo $dqtr['keterangan']; ?></td>
	<td><a href="viewreturn.php" class="btn btn-primary">Detail</a></td>
  </tr>
  <?php } ?>
</table>
<!-- end menampilkan data return -->
