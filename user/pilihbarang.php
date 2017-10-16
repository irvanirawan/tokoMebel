<?php
include_once ('session.php');
include ('header.php');
$qcustomer = "SELECT * from customer
 where id_customer=" . $_GET['id'] . "";
$ecustomer = mysqli_query($kon, $qcustomer);
$datacustomer = mysqli_fetch_array($ecustomer);
$cf = "SELECT count(id_faktur) as jf from faktur";
$ecf = mysqli_query($kon, $cf);
$dcf = mysqli_fetch_array($ecf);
$jumlahidfaktur=$dcf['jf']+1;
?>
<?php if (isset($_POST['Save'])) {
    $header = "insert into faktur(no_faktur,id_customer,tanggal,id_user,status)
    values('" . $_POST['no_faktur'] . "','" . $_POST['id_customer'] . "','" . $_POST['tanggal'] . "',' .1. ','.0 ')";
    $header_proses = mysqli_query($kon, $header);
    if ($header_proses) {
        $idcb = $_POST['id'];
        $jumlah = $_POST['jumlah'];
        $idfaktur = mysqli_insert_id($kon);
        $total = 0;
        for ($i = 0; $i < count($idcb); $i++) {
            $idcbarray = $idcb[$i];
            $jumlaharray = $jumlah[$i];
            $q = "select id_barang, harga_jual from customer_barang where id='$idcbarray'";
            if ($hasil = mysqli_fetch_array(mysqli_query($kon, $q))) {
                $idbarang=$hasil['id_barang'];
                $harga_barang = $hasil['harga_jual'];
                $total=$jumlaharray*$harga_barang;
            }
			$qm = "select modal from barang where id_barang = '$idbarang'";
			if ($dm = mysqli_fetch_array(mysqli_query($kon, $qm))) {
				$modal = $dm['modal'];
				$ttlmodal = $modal*$jumlaharray;
			}
            $detail = "insert into detail_faktur(id_faktur,id_barang,jumlah,total,modal)
		values('$idfaktur','$idbarang','$jumlaharray','$total','$ttlmodal')";
            $a = mysqli_query($kon, $detail);

        }
		$qsum = "select sum(total) as sttl from detail_faktur where id_faktur = $idfaktur";
			if ($dsum = mysqli_fetch_array(mysqli_query($kon, $qsum))) {
				$subttl = $dsum['sttl'];
			}
		$qst="UPDATE faktur SET subtotal = $subttl WHERE id_faktur = $idfaktur";
		 var_dump($qst);
		header("Location:detailpenjualan.php?id=".$idfaktur."");
    }
} ?>

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
    <div align="center">
        <h1><span class="glyphicon glyphicon-shopping-cart"></span>     Penjualan Khusus Customer</h1>
    </div>
	<p></p>
</br>
<b><b><b><b><b><b>

<form method="post" enctype="multipart/form-data">
    <div class="center" style="text-align: center"> 
        <tr>
          <td><h4><b>Faktur</h4></td>
          <td><input type="hidden" name="tanggal" value="<?php $t = date('Y-m-d'); echo $t; ?>"/>
              <h4><input type="number" name="no_faktur" value="<?php $t = date('d'); echo $_GET['id'].$t.$jumlahidfaktur; ?>" readonly></h4></td>
        </tr>
        <tr>
            <td><h4><b>Customer</h4></td>
            <td><h4><input name="customer" type="text" value="<?php echo $datacustomer['nama_customer']?>" readonly>
            <input name="id_customer" type="hidden" value="<?php echo $datacustomer['id_customer']?>"></h4></td>
        </tr>
    </div>
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
      INNER JOIN barang ON barang.id_barang = customer_barang.id_barang
     where id_customer=" . $_GET['id'] . "";
    $w = mysqli_query($kon, $q);
    while ($h = mysqli_fetch_array($w)) {
        $account[] = array("id" => $h['id'], "nama_barang" => $h['nama_barang'], "harga_jual" => $h['harga_jual']);
    }
    ?>
</br></br></br>
    <table class="table table-striped table table-bordered">
        <tr id="baris">
            <th><h4><b>Nama Barang</h4></th>
            <th><h4><b>Jumlah Barang</h4></th>
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
                  INNER JOIN barang ON barang.id_barang = customer_barang.id_barang
                 where id_customer=" . $_GET['id'] . "";
                $w = mysqli_query($kon, $q);
                while ($d = mysqli_fetch_array($w)) {
                    ?>
        <option value="<?php echo $d['id']; ?>"><?php echo $d['nama_barang']."_____Rp.".number_format ($d['harga_jual']); ?></option><?php } ?>       
        </td>
        <td><input type="number" name="jumlah[]" id="textfield2" class="form-control" required></td>
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
</form>

<script src="jquery.min.js"></script>

<script>
    $(document).ready(function (e) {
        var data = '<tr>'
                + '<td>'
                + '<select name="id[]" id="acount" class="form-control">'
<?php foreach ($account as $b) { ?>
            + '<option value="<?php echo $b['id']; ?>"><?php echo $b['nama_barang'].'_____Rp.'.number_format ($b['harga_jual']); ?></option>'
<?php } ?>
        + '</select></td>'
                + '<td>'
                + '<input type="number" name="jumlah[]" value="" id="textfield2" class="form-control" required/></td>'
   
                + '</tr>';
        $("#tambah").click(function () {
            //  alert('ok');
            $("#tambah").before(data);

        });
    });


</script>


</br>

<?php
include ('footer.php');
?>

</div>