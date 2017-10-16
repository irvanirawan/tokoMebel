<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>KSI Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<style>
#grad1 {
    height: 200px;
    background: linear-gradient(to bottom right, blue, pink,yellow);
}
#grad2 {
    height: 200px;
    background: linear-gradient(to bottom right, blue, pink,yellow);
}
h1 {
    color: gray;
    text-shadow: 1px 1px 2px black, 0 0 15px blue, 0 0 5px red;
}
h2 {
    text-shadow: 2px 2px 5px blue;
}
</style>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <h1><b>Welcome</b> <b>To</b> <b>KSI</b></h1>
  </div>

  <div class="login-box-body" id="grad1"
    style="text-align: center"><h3><b>Silahkan Login</h3>
    <form action="login.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
       </br></br>
       <div class="control-label col-sm-12">		   
          <input type="submit" name="login" class="btn btn-primary btn-block" value="LOGIN">
        </div>
      </div>
    </form>	
</br>
	<form>
		<div class="text-center">
            <h2><i class="fa fa-spinner" ></i>SeraphimZ</h2>
            <p>©2017 All Rights Reserved</p>
			<p>Privacy and Terms</p>
        </div>
	</form>
</div>
		
  </div>
</div>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-purple',
      radioClass: 'iradio_square-purple',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
