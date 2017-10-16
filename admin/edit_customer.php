<?php
include('koneksi.php');
if(isset($_POST['save'])){
$query= mysql_query("update customer set
				nama_customer='".$_POST['A']."',
				jenis_customer='".$_POST['B']."',
				alamat='".$_POST['C']."',
				no_tlp='".$_POST['D']."'
				WHERE
				id_customer='".$_POST['id']."'");
				
if ($query)
{
	header("location:tampil_customer.php");
}
else { echo mysql_error(); }
}

$tampilkan_data_yang_ingin_diedit=mysql_query("select * from customer where id_customer ='".$_GET['id']."' ");
$data=mysql_fetch_array($tampilkan_data_yang_ingin_diedit);
include 'header.php';
?>
</br></br>
<div class="right_col" role="main"></br></br>
	<div class="box-header">
       <h1><span class="glyphicon glyphicon-folder-open"></span>     Form Edit Customer </h1>		
     </div>
    <section class="content">
        </br></br>
            
            <!-- form start -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data">			
                <div class="box-body">
                    <input type="hidden" name="id" value="<?php echo $data['id_customer'] ?>">
                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label"><h5><b>Nama Customer<b></h5></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="A" value="<?php echo $data['nama_customer'] ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label"><h5><b>Jenis Customer<b></h5></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="B" value="<?php echo $data['jenis_customer'] ?>"required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label"><h5><b>Alamat Customer<b></h5></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="C" value="<?php echo $data['alamat'] ?>"required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="col-sm-3 control-label"><h5><b>No Telp<b></h5></label>
                        <div class="col-sm-5">
                            <input type="number" class="form-control" name="D" value="<?php echo $data['no_tlp'] ?>"required>
                        </div>
                    </div>

                </div></br></br>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" name="save" class="btn btn-primary">Simpan</button>
                </div>
                <!-- /.box-footer -->
            </form>
        
    </section>

</br></br></br></br>
</br></br></br>
<?php
include ('footer.php');
?>

</br>
</div>