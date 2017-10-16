<?php
include('koneksi.php');
include('header.php');
if (isset($_POST['batal'])) {
  $idfaktur=$_POST['id_faktur'];
  $qhf="DELETE FROM faktur where id_faktur=$idfaktur";
  mysqli_query($kon,$qhf);
  $qhdf="DELETE FROM detail_faktur WHERE id_faktur=$idfaktur";
  mysqli_query($kon, $qhdf);
  header("Location:penjualan.php");
  
if ($query)
{
	header("Location:data_faktur.php");
        echo 'Data Faktur Berhasil Dihapus';
}
else { echo mysql_error('GAGAL'); }
}

?>


