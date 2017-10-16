<?PHP
include_once 'session.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> KSI Homepage </title>
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- bootstrap-progressbar -->
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="home.php" class="site_title"><i class="fa fa-home"></i> <span>KSI Homepage</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="images/ksii.png" style="width:90px" height="80px"> 
              </div>
              <div class="profile_info">
                <span><h3>&nbsp;&nbsp;Welcome</h3></span>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-user-secret"></i>&nbsp;&nbsp;&nbsp;User</a>
                    <tr>
                      <td><a href="tampil_barang.php" class="btn btn-primary"><h3>Data Barang HPP</h3></a></td>
                      <td><a href="tampil_customer.php" class="btn btn-primary"><h3>Data Customer</h3></a></td>
					  <td><a href="data_faktur.php" class="btn btn-primary"><h3>Data Penjualan</h3></a></td>
                      <td><a href="penjualan.php" class="btn btn-primary" ><h3>Entry Penjualan</h3></a></td>
					  <td><a href="data_return.php" class="btn btn-primary" ><h3>Data Return Penjualan</h3></a></td> 						  
					  <td><a href="returnpenjualan.php" class="btn btn-primary" ><h3>Entry Return Penjualan</h3></a></td>
					  				  
                  </tr>
                  </ul>
                </ul>
              </div>             
            </div>
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                 <a href="logout.php"><i class="fa fa-sign-out"></i> Log Out</a>                             
                </li>
              </ul>
            </nav>
          </div>
        </div>
	