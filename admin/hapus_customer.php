<?php
include('koneksi.php');
if(isset($_POST['save'])){
$query= mysql_query("delete from customer WHERE id_customer='".$_GET['id']."' ");
				
if ($query)
{
	echo 'Data Berhasil Dihapus';
	header("Location:tampil_customer.php");
        
}
else { echo mysql_error(); }
}

$tampilkan_data_yang_ingin_diedit=mysql_query("select * from customer where id_customer ='".$_GET['id']."' ");
$data=mysql_fetch_array($tampilkan_data_yang_ingin_diedit);

include('header.php');
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

<div class="right_col" role="main">	
    <div align="left">
        <h1><span class="glyphicon glyphicon-briefcase"></span>&nbsp;Form Hapus Customer</h1>		
      </div>
		<div class="box-header with-border">
            <h4 class="box-title">Yakin Ingin Menghapus Data?</h4>
        </div>
			<br>

            <!-- form start -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data">			
              <div class="box-body">
			  <input type="hidden" name="id" value="<?php echo $data['id_karyawan'] ?>">
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">Nama</label>
                  <div class="col-sm-5">
                    <input type="text" disabled class="form-control" name="A" value="<?php echo $data['nama_customer'] ?>" >
                  </div>
                </div>
				
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">Jenis Customer</label>
                  <div class="col-sm-5">
                    <input type="text" disabled class="form-control" name="B" value="<?php echo $data['jenis_customer'] ?>">
                  </div>
                </div>
				
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">Alamat</label>
                  <div class="col-sm-5">
                    <input type="text" disabled class="form-control" name="C" value="<?php echo $data['alamat'] ?>">
                  </div>
                </div>
				
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">No Telp</label>
                  <div class="col-sm-5">
                    <input type="text" disabled class="form-control" name="D" value="<?php echo $data['no_tlp'] ?>">
                  </div>
                </div>            
				
              </div>
              <!-- /.box-body -->
			  <br>
              <div>
                <button type="submit" name="save" class="btn btn-warning">Hapus</button>
              </div>
              <!-- /.box-footer -->
            </form>
         

<?php
include('footer.php');
?>

</div>