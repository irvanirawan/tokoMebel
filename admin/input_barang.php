<?php 
include('koneksi.php');
include('header.php');
if(isset($_POST['save'])){
	$ini_query="insert into barang
	(nama_barang,kode_barang,modal,harga)
	values( '".$_POST['A']."',
			'".$_POST['B']."',
			'".$_POST['C']."',
			'".$_POST['D']."')";
			
$proses=mysql_query($ini_query);
if($proses){
    echo 'Input Barang Sukses';
	header("location:tampil_barang.php");
}else{
	echo mysql_error();
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
    background-color: #0099cc;
    color: black;
}
</style>

<br>
<div class="right_col" role="main">
<br><br><br>
    <div align="left">
        <h1><span class="glyphicon glyphicon-briefcase"></span>&nbsp; Form Tambah Barang</h1>		
      </div>          
<br><br><br>
<section class="content">
            <form class="form-horizontal" method="post" enctype="multipart/form-data">			
              <div class="box-body">
			  <input type="hidden" name="id" value="<?php echo $data['id_barang'] ?>" required>
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">Nama Barang</label>
                  <div class="col-sm-5">
                      <input type="text" class="form-control" name="A" required>
                  </div>
                </div>
				
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">Kode Barang</label>
                  <div class="col-sm-5">
                      <input type="number" class="form-control" name="B" required>
                  </div>
                </div>		
				
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">Modal</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="C" required>
                  </div>
                </div>
				
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">Harga</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="D" required>
                  </div>
                </div>				
              </div>
              <!-- /.box-body -->
              <div>
                <button type="submit" name="save" class="btn btn-primary">Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
</section> 

<br><br><br><br><br><br><br>
<?php
include('footer.php');
?>

</div>