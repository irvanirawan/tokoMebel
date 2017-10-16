<?php include('session.php');
$idget=$_GET['id'];

if (isset($_POST['Save'])) {
$idfaktur=$_POST['idfaktur'];
$a=$_POST['id'];
$b=$_POST['jumlah'];
for ($i=0; $i < count($a); $i++) {
$idbarang=$a[$i];
$jumlah=$b[$i];
$qhb="SELECT harga, modal from barang where id_barang=$idbarang";
$eqhb=mysqli_query($kon, $qhb);
if ($dqhb=mysqli_fetch_array($eqhb)) {
  $harga=$dqhb['harga'];
  $modal=$dqhb['modal'];
  $modal2=$modal*$jumlah;
}
$total=$jumlah*$harga;
$qib="INSERT INTO detail_faktur (id_faktur, id_barang, jumlah, total, modal) VALUES ($idfaktur, $idbarang, $jumlah, $total, $modal2)";
mysqli_query($kon,$qib);
}echo "sukses";
  header('Location:detailpenjualanumum.php?id='.$idfaktur);
}
$q = "SELECT * FROM barang";
$w = mysqli_query($kon, $q);
while ($h = mysqli_fetch_array($w)) {
    $account[] = array("id_barang" => $h['id_barang'], "nama_barang" => $h['nama_barang'], "harga" => $h['harga']);
}
$qtf = "SELECT no_faktur from faktur where id_faktur=$idget";
$eqtf = mysqli_query($kon, $qtf);
if ($dqtf = mysqli_fetch_array($eqtf)){
    $nofaktur=$dqtf['no_faktur'];
}
 ?>
 <!-- batas php ---------------------------------------------------------------->

<form class="" action="" method="post">
<input type="hidden" name="idfaktur" value="<?php echo $idget; ?>">
<input type="text" name="nofaktur" value="<?php echo $nofaktur; ?>"><br>
<!-- ko -->
<table>
<tr>
  <td>
<select name="id[]" id="textfield2" class="form-control" />
<?php
$q = "SELECT * FROM barang";
$w = mysqli_query($kon, $q);
while ($d = mysqli_fetch_array($w)) { ?>
<option value="<?php echo $d['id_barang']; ?>"><?php echo $d['nama_barang']."->".$d['harga']; ?></option>
<?php } ?>
</select>
</td>
<td><input type="number" name="jumlah[]" id="textfield2" class="form-control" required/></td>
</tr>
<tr id="tambah">
<td colspan="">
<span><input type="button" class="btn-large btn-success" id="tambah" name="baris" value="tambah barang"/></span>
</td>
</tr>
<tr>
    <td colspan="4">
        <input type="submit" class="btn btn-small btn-danger" name="Save" value="simpan"/>
    </td>
</tr>
</table>
</form>
<!-- ko -->
<script src="jquery.min.js"></script>
<script>
    $(document).ready(function (e) {
        var data = '<tr>'
                + '<td>'
                + '<select name="id[]" id="acount" class="form-control">'
<?php foreach ($account as $b) { ?>
            + '<option value="<?php echo $b['id_barang']; ?>"><?php echo $b['nama_barang'].'->'.$b['harga']; ?></option>'
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
