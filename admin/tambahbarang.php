<?php
include_once ('session.php');
if (isset($_POST['Save'])) {
  $idfaktur=$_POST['id_faktur'];
  $idbarang=$_POST['id'];
  $jumlah=$_POST['jumlah'];
  $total=0;
  for ($i=0; $i < count($idbarang); $i++) {
    $idbarray=$idbarang[$i];
    $jarray=$jumlah[$i];
    $q = "select id_barang, harga_jual from customer_barang where id='$idbarray'";
    if ($hasil = mysqli_fetch_array(mysqli_query($kon, $q))) {
        $idbarang=$hasil['id_barang'];
        $harga_barang = $hasil['harga_jual'];
        $total=$jarray*$harga_barang;
    }
    $detail = "insert into detail_faktur(id_faktur,id_barang,jumlah,total)
values('$idfaktur','$idbarang','$jarray','$total')";
    $a = mysqli_query($kon, $detail);
  }header("Location:detailpenjualan.php?id=".$idfaktur."");
}
?>
<div class="box-primary box">
    <div class="box-header box text-center"> <h3>Penjualan</h3> </div>
<form method="post" enctype="multipart/form-data">
    <table class="table">
        <tr>
          <td>Faktur</td>
<?php
$qnf="SELECT faktur.id_faktur, faktur.no_faktur, faktur.id_customer, customer.nama_customer FROM faktur LEFT JOIN customer ON faktur.id_customer=customer.id_customer where id_faktur=".$_GET['id']."";
$eqnf = mysqli_query($kon, $qnf);
while ($dqnf = mysqli_fetch_array($eqnf)) {
?>
          <td><input type="hidden" name="id_faktur" value="<?php echo $dqnf['id_faktur']; ?>"/>
              <input type="number" name="no_faktur" value="<?php echo $dqnf['no_faktur']; ?>" readonly/></td>
            </tr>
            <tr>
                <td>Customer</td>
                <td><input name="customer" type="text" value="<?php echo $dqnf['nama_customer']; $zz=$dqnf['id_customer'];?>" readonly></td>
            </tr>
    </table>
<?php
}
?>

<!-- tambah textfield barang -->
    <?php
    $q = "SELECT
      customer_barang.id,
      customer_barang.id_customer,
      customer_barang.id_barang,
      customer_barang.harga_jual,
      barang.nama_barang
    FROM
      customer_barang
      INNER JOIN barang ON barang.id_barang = customer_barang.id_barang where id_customer=$zz";
    $w = mysqli_query($kon, $q);
    while ($h = mysqli_fetch_array($w)) {
        $account[] = array("id" => $h['id'], "nama_barang" => $h['nama_barang'], "harga_jual" => $h['harga_jual']);
    }
    ?>

    <table class="table table-striped table table-bordered">
        <tr id="baris">
            <td>Barang</td>
            <td>Jumlah</td>
        </tr>
        <tr>
            <td>
                <select name="id[]" id="textfield2" class="form-control" />
                <?php
                $q = "SELECT
                  customer_barang.id,
                  customer_barang.id_customer,
                  customer_barang.id_barang,
                  customer_barang.harga_jual,
                  barang.nama_barang
                FROM
                  customer_barang
                  INNER JOIN barang ON barang.id_barang = customer_barang.id_barang where id_customer=$zz";
                $w = mysqli_query($kon, $q);
                while ($d = mysqli_fetch_array($w)) {
                    ?>
            <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_barang']."->".$d['harga_jual']; ?></option><?php } ?>
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
</div>
<script src="jquery.min.js"></script>

<script>
    $(document).ready(function (e) {
        var data = '<tr>'
                + '<td>'
                + '<select name="id[]" id="acount" class="form-control">'
<?php foreach ($account as $b) { ?>
            + '<option value="<?php echo $b['id']; ?>"><?php echo $b['nama_barang'].'->'.$b['harga_jual']; ?></option>'
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
