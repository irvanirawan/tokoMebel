<?php
include_once('./koneksi.php');
include_once ('./header.php');
//include_once ('lib/fn.inc');
if(isset($_POST['save'])){
$header="insert into project(id_customer,nama_project,no_project,tanggal_project) values('".$_POST['id_customer']."',
'".$_POST['nm_project']."',
'".$_POST['no_project']."',
'".$_POST['tgl']."')";
$header_proses=mysql_query($header);
if($header_proses){
	$data_id_komponen=$_POST['id_komponen'];
	$allowed_ext	= array("doc", "docx", "xls", "xlsx", "ppt", "pptx", "pdf", "rar", "zip");
	$file_name		=$_FILES['file']['name'];
	$file_size		=$_FILES['file']['size'];
	$file_tmp		=$_FILES['file']['tmp_name'];
	$nama			=$_POST['nm_gambar'];
//if(in_array($file_ext, $allowed_ext) === true){
	$id_project = mysql_insert_id();
	for($i=0; $i<count($data_id_komponen); $i++)
	{
        $id_komponen=$data_id_komponen[$i];
        $nm_project =$nama[$i];
        //$ext        = $file_ext[$i];
		$gambar     = $file_name[$i];
		$file_ext   = strtolower(end(explode(".",$gambar)));
		$tmp        = $file_tmp[$i];
		$lokasi     = 'files/'.$nm_project.'.'.$file_ext;
		move_uploaded_file($tmp,$lokasi);
		$detail="insert into project_detail(id_project,id_komponen,nama_project,gambar)
		values('$id_project','$id_komponen','$nm_project','$lokasi')";
		$a=mysql_query($detail);

	}
//}else{
	//echo "salah";
	//die;
//}
	if($a){
    header("location:list_project.php");
	}else{
		echo mysql_error();
		die;
	}
}else{
	echo mysql_error();
}

}
?>
<script src="jquery.js"></script>
<form action="" method="post" enctype="multipart/form-data">
    <table class="table top-block">
        <tr>
            <td>Nama Customer</td>
            <td><select name="id_customer" class="form-control" />
            <option>----Pilih Customer ------</option>
            <?php $cs=mysql_query("select * from customer");
            while ($data=mysql_fetch_array($cs)) { ?>
           <option value="<?php echo $data['id_customer'];?>"><?php echo $data['nama_customer'];?></option> 	
           <?php  } ?>
            </select></td>
        </tr>
         <tr>
            <td>Nama Project</td>
            <td><input type="text" name="nm_project" class="form-control" /></td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td><input type="text" name="tgl" class="form-control datepicker" /></td>
       
        <tr>
            <td>No Project</td>
            <td><input type="text" name="no_project" class="form-control"/></td>
        </tr>
    </table>
    <p>&nbsp;</p> 
    <?php $q=mysql_query("select * from barang");
        while ($h=mysql_fetch_array($q)) { 
        	$account[] = array("id_barang" => $h['id_barang'], "nama_barang" => $h['nama_barang']);
       }?>
    <table class="table table-striped table table-bordered">
        <tr id="baris">
            <td>Bagaian Komponen</td>
            <td>Nama gambar</td>
            <td>Gambar</td>
        </tr>
        <tr>
        <td> <select name="id_komponen[]" id="textfield2" class="form-control" /><?php 
        $q=mysql_query("select * from komponen_project");
        while ($d=mysql_fetch_array($q)) { ?>
               
     			<option value="<?php echo $d['id_komponen'];?>"><?php echo $d['nama_komponen'];?></option>
            	<?php } ?>
                </select> </td>
            
            <td>
                <input type="text" name="nm_gambar[]" id="textfield2" class="form-control" /></td>
            <td>
                <input type="file" name="file[]" id="textfield3" class="form-control" /></td>
        </tr>
        <tr id="tambah">
            <td colspan="4"><input type="button" class="btn-large btn-success" id="tambah" name="baris" value="tambah baris"/></td>
        </tr>
        <tr>
            <td colspan="4"><input type="submit" class="btn btn-small btn-danger" name="save" value="simpan"/></td>
        </tr>
    </table>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</form>
<script>
    $(document).ready(function(e) {

        var data = '<tr>'
        		 + '<td>'
                + '<select name="id_komponen[]" id="acount" class="form-control">'
                   <?php foreach ($account as $b) { ?>
                  + '<option value="<?php echo $b['id_komponen']; ?>"><?php echo $b['nama_komponen']; ?></option>'
                  <?php } ?>
                 + '</select></td>'
                + '<td>'
                + '<input type="text" name="nm_gambar[]" id="textfield2" class="form-control" /></td>'
                + '<td>'
                + '<input type="file" name="file[]" id="textfield3"  class="form-control"/></td>'
                + '</tr>';
        $("#tambah").click(function() {
            $("#tambah").before(data);

        });
    });


</script>
<?php
include_once "footer.php";
?>