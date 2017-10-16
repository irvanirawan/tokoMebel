<?php
include('koneksi.php');

if (isset($_POST['save'])) {
    $query = mysql_query("update barang set
				nama_barang='" . $_POST['A'] . "',				
				kode_barang='" . $_POST['B'] . "',
				modal='" . $_POST['C'] . "',
				harga='" . $_POST['D'] . "',
				status='" . $_POST['E'] . "'
				WHERE
				id_barang='" . $_POST['id'] . "'");

    if ($query) {
        header("location:tampil_barang.php");
    } else {
        echo mysql_error();
    }
}
include('header.php');
$tampilkan_data_yang_ingin_diedit = mysql_query("select * from barang where id_barang ='" . $_GET['id'] . "' ");
$data = mysql_fetch_array($tampilkan_data_yang_ingin_diedit);
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
    background-color: #0099cc;
    color: black;
}
</style>
</br></br>
<div class="right_col" role="main">
<div class="">
    <section class="content">
        </br></br>
            <div align="center">
				<h1><span class="glyphicon glyphicon-briefcase"></span>     Form Edit Barang</h1>		
				</div
            <!-- form start -->
			</br></br>
            <form class="form-horizontal" method="post" enctype="multipart/form-data">			
                <div class="box-body">
                    <input type="hidden" name="id" value="<?php echo $data['id_barang'] ?>">
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Nama Barang</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="A" value="<?php echo $data['nama_barang'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Kode Barang</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="B" value="<?php echo $data['kode_barang'] ?>"required>
                        </div>
                    </div>
					<div class="form-group">
                        <label for="" class="col-sm-3 control-label">Modal</label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" name="C" value="<?php echo $data['modal'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label">Harga</label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" name="D" value="<?php echo $data['harga'] ?>"required>
                        </div>
                    </div>             
</br></br>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" name="save" class="btn btn-success">Simpan</button>
                </div>
                <!-- /.box-footer -->
            </form>
        
    </section>
</br></br></br>
</br></br></br>
<?php
include ('footer.php');
?>
</div>
</div>