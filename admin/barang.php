<?php
include "koneksi.php";
include "header.php";
if
//    (isset($_POST['cari']) && ($_POST['dari']) && ($_POST['sampai'])) {
//    $kt = $_POST['katakunci'];
//    $tglawal = $_POST['dari'];
//    $tglakhir = $_POST['sampai'];
//    $query = "select barang.nama_barang, barang.jumlah, kategori.nama_kategori, merek.nama_merek, barang.harga, barang.tanggal, barang.status, barang.gambar from barang where nama_barang like '%$kt%' and (tanggal between '$tglawal' and '$tglakhir')";
//} elseif 
 (isset($_POST['cari'])) {
    $kt = $_POST['katakunci'];
    $query = "select * from barang where nama_barang like '%$kt%'";
} else {
    $query = "SELECT
  `barang`.`id_barang`,
  `barang`.`kode_barang`,
  `barang`.`nama_barang`,
  `barang`.`jumlah`,
  `barang`.`harga`,
  `kategori`.`nama_kategori`,
  `merek`.`nama_merek`,
  `barang`.`tanggal`,
  `barang`.`status`,
  `barang`.`gambar`
FROM
  `barang`
  LEFT JOIN `merek` ON `merek`.`id_merek` = `barang`.`id_merek`
  LEFT JOIN `kategori` ON `kategori`.`id_kategori` = `barang`.`id_kategori`";
    $tab1 = "active";
    $tab2 = "";
}
?>
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_1" data-toggle="tab">Data Barang</a></li>
        <li><a href="#tab_2" data-toggle="tab">Data Kategori</a></li>
        <li><a href="#tab_3" data-toggle="tab">Data Merk</a></li>
    </ul>
    <div class="tab-content">
        <!-- ini tab 1 -->
        <div class="tab-pane <?php echo $tab1; ?>" id="tab_1">         
            <div class="container-fluid"><br>                
                <span class="container-fluid nav navbar-left"><a href="input_barang.php" class="box fa fa-plus btn btn-primary form-group"> Tambah Barang</a></span>
                <div class="container-fluid form-inline nav navbar-right">
                    <div class="box-tools form-group">
                        <form method="post" action="barang.php">
                            <div class="input-group input-group-sm date" style="width: 250px;">
                                <input type="text" name="katakunci" class="form-control pull-right" placeholder="Cari berdasarkan kode barang...">
                                <span class="input-group-btn">
                                    <button name="cari" type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <section class="content">
                <table id="example2" class="table table-bordered table-striped table-hover table-responsive">            
                    <tr>
                        <th>No.</th>
                        <th>Nama Barang</th>
                        <th>Kode Barang</th>
                        <th>Jumlah</th>
                        <th>Kategori</th>
                        <th>Merek</th>
                        <th>Harga</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Gambar</th>
                        <th colspan="2" style="text-align: center"> Opsi </th>
                    </tr>
                    <?php
                    $no = 1;
                    $data_peserta = mysql_query($query);
                    while ($tampil = mysql_fetch_array($data_peserta)) {
                        ?>	
                        <tr>
                            <td style="text-align: center"><?php echo $no++; ?></td>
                            <td><?php echo $tampil['nama_barang']; ?></td>
                            <td><?php echo $tampil['kode_barang']; ?></td>
                            <td><?php echo $tampil['jumlah']; ?></td>
                            <td><?php echo $tampil['nama_kategori']; ?></td>
                            <td><?php echo $tampil['nama_merek']; ?></td>
                            <td><?php echo $tampil['harga']; ?></td>
                            <td><?php echo $tampil['tanggal']; ?></td>
                            <td class="text-center"><?php
                                $tampil['status'];
                                if ($tampil['status'] == 1) {
                                    echo '<small class="label bg-blue">Active</small>';
                                } else {
                                    echo '<small class="label bg-red">Deactive</small>';
                                }
                                ?></td>
                            <td><img class="img-circle img-md" src="image/<?php echo $tampil['gambar']; ?>"></td>
                            <td><a href="edit_barang.php?id=<?php echo $tampil['id_barang']; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                            <td><a href="hapus_barang.php?id=<?php echo $tampil['id_barang']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
                        </tr>

<?php } ?>

                </table>
            </section>
        </div>
        <!-- ini Tab 2 -->
        <div class="tab-pane <?php echo $tab2; ?>" id="tab_2">
            <div class="container-fluid"><br>                
                <span class="container-fluid nav navbar-left"><a href="" class="box fa fa-plus btn btn-primary form-group"> Tambah Kategori Barang</a></span>
            </div>
            <section class="content">
                <table id="example2" class="table table-bordered table-striped table-hover table-responsive">            
                    <tr>
                        <th>ID</th>
                        <th>Nama Kategori</th>
                        <th>Status</th>
                        <th>Keterangan</th>
                        <th colspan="2" style="text-align: center"> Opsi </th>
                    </tr>
                    <?php
                    if (isset($_POST['cari2']) && ($_POST['dari2']) && ($_POST['sampai2'])) {
                        $kt = $_POST['katakunci2'];
                        $tglawal = $_POST['dari2'];
                        $tglakhir = $_POST['sampai2'];
                        $query = "select * from barang where nama_barang like '%$kt%' and (tanggal between '$tglawal' and '$tglakhir')";
                        $tab1 = "";
                        $tab2 = "active";
                    } elseif (isset($_POST['cari2'])) {
                        $kt = $_POST['katakunci2'];
                        $query = "select * from kategori where nama_kategori like '%$kt%'";
                        $tab1 = "tab-pane";
                        $tab2 = "active";
                    } else {
                        $query = "select * from kategori";
                    }
                    $no = 1;
                    $data_peserta = mysql_query($query);
                    while ($tampil = mysql_fetch_array($data_peserta)) {
                        ?>	
                        <tr>
                            <td><?php echo $tampil['id_kategori']; ?></td>
                            <td><?php echo $tampil['nama_kategori']; ?></td>
                            <td><?php echo $tampil['status']; ?></td>
                            <td><?php echo $tampil['keterangan']; ?></td>
                            <td style="text-align: center"><a href=".php?id=<?php echo $tampil['id_kategori']; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                            <td style="text-align: center"><a href=".php?id=<?php echo $tampil['id_kategori']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
                        </tr>

<?php } ?>

                </table>
            </section>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_3">
            <div class="container-fluid"><br>                
                <span class="container-fluid nav navbar-left"><a href="" class="box fa fa-plus btn btn-primary form-group"> Tambah Merek</a></span>
            </div>
            <section class="content">
                <table id="example2" class="table table-bordered table-striped table-hover table-responsive">            
                    <tr>
                        <th>ID</th>
                        <th>Nama Merek</th>
                        <th>Keterangan</th>
                        <th colspan="2" style="text-align: center"> Opsi </th>
                    </tr>
                    <?php
                    $query = "select * from merek";
                    $no = 1;
                    $data_peserta = mysql_query($query);
                    while ($tampil = mysql_fetch_array($data_peserta)) {
                        ?>	
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $tampil['nama_merek']; ?></td>
                            <td><?php echo $tampil['Keterangan']; ?></td>
                            <td style="text-align: center"><a href=".php?id=<?php echo $tampil['id_merek']; ?>"><span class="glyphicon glyphicon-edit"></span></a></td>
                            <td style="text-align: center"><a href=".php?id=<?php echo $tampil['id_merek']; ?>"><span class="glyphicon glyphicon-trash"></span></a></td>
                        </tr>

<?php } ?>

                </table>
            </section>
        </div>
    </div>
    <!-- /.tab-content -->
</div>
<?php
include "footer.php";
?>