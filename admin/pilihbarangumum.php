<?php
include_once ('header.php');
// untuk count faktur
$cf = "SELECT count(id_faktur) as jf from faktur";
$ecf = mysqli_query($kon, $cf);
$dcf = mysqli_fetch_array($ecf);
$jumlahidfaktur=$dcf['jf']+1;
?>
<!-- end untuk count faktur -->
<!-- untuk save -->
<?php
if (isset($_POST['Save'])) {
  $a=$_POST['no_faktur'];
  $b=$_POST['id_customer'];
  $c=$_POST['tanggal'];
  $d=0;
  $e=1;
  $qif="INSERT INTO faktur (no_faktur, id_customer, tanggal, id_user, status) VALUES ('$a', '$b', '$c', '$d', '$e')";
  $eqif=mysqli_query($kon,$qif);
  if ($eqif) {
    $idfaktur=mysqli_insert_id($kon);
    $idbarang=$_POST['id_barang'];
    $jumlah=$_POST['jumlah'];
    $total=0;
    for ($i=0; $i < count($idbarang); $i++) {
      $idbarray=$idbarang[$i];
      $jarray=$jumlah[$i];
      $qhb="select harga, modal from barang where id_barang=$idbarray";
      $eqhb=mysqli_query($kon,$qhb);
      if ($dqhb=mysqli_fetch_array($eqhb)) {
        $total=$jarray*$dqhb['harga'];
		$modal = $dqhb['modal'];
		$ttlmodal = $modal*$jarray;
        $qtdf="INSERT INTO detail_faktur (id_faktur, id_barang, jumlah, total,modal) VALUES ($idfaktur, $idbarray, $jarray, $total,'$ttlmodal')";
        $cek=mysqli_query($kon,$qtdf);
      }			
    }header('Location:detailpenjualanumum.php?id='.$idfaktur."");
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
    background-color: #ffffcc;
    color: black;
}
</style>

<div class="right_col" role="main">
<!-- end untuk save -->
<!-- tampil info data -->

    <div align="center">
        <h1><span class="glyphicon glyphicon-briefcase"></span>  Penjualan Umum</h1>		
      </div>
</br>
<form method="post" enctype="multipart/form-data">
    <div class="center" style="text-align: center"> 
        <tr>
          <td><h4><b>Faktur</h4></td>
          <td><input type="hidden" name="tanggal" value="<?php $tt = date('Y-m-d'); echo $tt; ?>"/>
              <h4><input type="number" name="no_faktur" value="<?php $t = date('d'); echo '0'.$t.$jumlahidfaktur; ?>" readonly></h4></td>
        </tr>
        <tr>
            <td><h4><b>Customer</h4></td>
            <td><h4><input name="customer" type="text" value="UMUM" readonly>
            <input name="id_customer" type="hidden" value="0"></h4></td>
        </tr>
    </div>
<!-- end tampil info data -->
<!-- tambah textfield barang -->
    <?php
    $q = "SELECT * FROM barang";
    $w = mysqli_query($kon, $q);
    while ($h = mysqli_fetch_array($w)) {
        $account[] = array("id_barang" => $h['id_barang'], "nama_barang" => $h['nama_barang'], "harga" => $h['harga']);
    }
    ?>
<!-- end tambah textfield barang -->
</br></br></br>
    <table class="table table-striped table table-bordered">
        <tr id="baris">
            <th><h4><b>Nama Barang</h4></th>
            <th><h4><b>Jumlah Barang</h4></th>
        </tr>
        <tr>
        <td>
                <select name="id_barang[]" id="textfield2" class="form-control" />
                <?php
                $q = "SELECT * FROM barang";
                $w = mysqli_query($kon, $q);
                while ($d = mysqli_fetch_array($w)) {
                    ?>
            <option value="<?php echo $d['id_barang']; ?>"><?php echo $d['nama_barang']."_____Rp.".number_format ($d['harga']); ?></option><?php } ?>
        </select>
        </td>
        <td><input type="number" name="jumlah[]" id="textfield2" class="form-control" required/></td>
        </tr>
        <tr id="tambah">
            <td colspan="4">
             <span><input type="button" class="btn-large btn-success" id="tambah" name="baris" value="Tambahkan Barang"/></span>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <input type="submit" class="btn btn-small btn-danger" name="Save" value="View"/>
            </td>
        </tr>
    </table>


<!-- end pilih barang -->

<script src="jquery.min.js"></script>
<!-- fungsi tambah field -->
<script>
    $(document).ready(function (e) {
        var data = '<tr>'
                + '<td>'
                + '<select name="id_barang[]" id="acount" class="form-control">'
<?php foreach ($account as $b) { ?>
            + '<option value="<?php echo $b['id_barang']; ?>"><?php echo $b['nama_barang'].'_____Rp.'.number_format ($b['harga']); ?></option>'
<?php } ?>
        + '</select></td>'
                + '<td>'
                + '<input type="number" name="jumlah[]" value="" id="textfield2" class="form-control" required/></td>'
                + '<td>'
                + '</tr>';
        $("#tambah").click(function () {
            //  alert('ok');
            $("#tambah").before(data);

        });
    });
</script>
<!-- end fungsi tambah field -->




<?php
include ('footer.php');
?>

</div>