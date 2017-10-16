<?php
include_once('header.php');
$idget=$_GET['id'];
// b
if (isset($_POST['delete'])) {
  $idhapus=$_POST['hapus'];
  for ($i=0; $i < count($idhapus); $i++) {
    $idharray=$idhapus[$i];
    $qhc="DELETE FROM customer_barang WHERE id = $idharray";
   mysqli_query($kon,$qhc);
  }

}
// end b
if (isset($_POST['Save'])) {
  $idcustomer=$_GET['id'];
  $idbarang=$_POST['id_barang'];
  $hargajual=$_POST['harga'];
  for ($i=0; $i < count($idbarang); $i++) {
  $idbarray=$idbarang[$i];
  $harray=$hargajual[$i];
  $qth="INSERT INTO customer_barang (id_customer, id_barang, harga_jual) VALUES ('$idcustomer', '$idbarray', '$harray')";
  mysqli_query($kon,$qth);
  }
}
 ?>
 <!-- tambah textfield barang -->
     <?php
     $q = "SELECT * FROM barang";
     $w = mysqli_query($kon, $q);
     while ($h = mysqli_fetch_array($w)) {
         $account[] = array("id_barang" => $h['id_barang'], "nama_barang" => $h['nama_barang'], "harga" => $h['harga']);
     }
     ?>
 <!-- end tambah textfield barang -->
<!-- pilih barang -->


<div class="right_col" role="main">
<div align="center">
        <h1><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Input Harga Customer</h1>
    </div>
	</br></br>

<form class="" action="" method="post">
    <table class="table table-striped table table-bordered">
        <tr id="baris">
            <td>Barang</td>
            <td>Harga</td>
        </tr>
        <tr>
            <td>
                <select name="id_barang[]" id="textfield2" class="form-control" />
                <?php
                $q = "SELECT * FROM barang";
                $w = mysqli_query($kon, $q);
                while ($d = mysqli_fetch_array($w)) {
                    ?>
            <option value="<?php echo $d['id_barang']; ?>"><?php echo $d['nama_barang']."_____Rp. ". number_format ($d['harga']); ?></option><?php } ?>
        </select>
        </td>
        <td><input type="number" name="harga[]" id="textfield2" class="form-control" required/></td>
        </tr>
        <tr id="tambah">
            <td colspan="">
             <span><input type="button" class="btn-large btn-success" id="tambah" name="baris" value="Tambah Barang"/></span>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <input type="submit" class="btn btn-small btn-danger" name="Save" value="Simpan"/>
            </td>
        </tr>
    </table>
    </form>
<!-- end pilih barang -->



<form class="" action="" method="post">
<table id="example2" class="table table-bordered table-striped table-hover table-responsive">
	<tr>
		<th class="col-md-1" style="text-align: center"><h5>No</h5></th>
        <th class="col-md-3" style="text-align: center"><h5>Nama Barang</h5></th>       
        <th class="col-md-2" style="text-align: center"><h5>Harga</h5></th>
		<th class="col-md-2" style="text-align: center"><h5>Hapus</h5></th>
	</tr>

 <?php
  $no=1;
  $qcb="SELECT customer_barang.id, customer_barang.harga_jual, barang.nama_barang FROM customer_barang LEFT JOIN barang on barang.id_barang = customer_barang.id_barang where id_customer=$idget";
  $eqcb=mysqli_query($kon, $qcb);
  while ($dqcb=mysqli_fetch_array($eqcb)) { ?>
    <tr>
      <td style="text-align: center"><?php echo $no++; ?></td>
      <td><?php echo $dqcb['nama_barang']; ?></td>
      <td>Rp.<?php echo number_format($dqcb['harga_jual']) ?>,-</td>
      <td style="text-align: center">
	  <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_customerbarang.php?id=<?php echo $dqcb['id']; ?>' }" class="btn btn-danger">Hapus</a></td>
    </tr>
<?php  }  ?>
</table>
</form>



<script src="jquery.min.js"></script>
<!-- fungsi tambah field -->
<script>
    $(document).ready(function (e) {
        var data = '<tr>'
                + '<td>'
                + '<select name="id_barang[]" id="acount" class="form-control">'
<?php foreach ($account as $b) { ?>
            + '<option value="<?php echo $b['id_barang']; ?>"><?php echo $b['nama_barang']."_____Rp. ". number_format ($b['harga']); ?></option>'
<?php } ?>
        + '</select></td>'
                + '<td>'
                + '<input type="number" name="harga[]" value="" id="textfield2" class="form-control" required/></td>'
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