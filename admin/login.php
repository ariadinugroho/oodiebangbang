<?php
session_start();
$koneksi = new mysqli("localhost","root","","oodiebangbang");
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
 
     <div class="container">
        <div class="row">
            <div class="col-md-2"></div>
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-6">
                    <ul>
                      <h3 style="border-bottom: 2px solid #f44c89; padding: 10px;">SIGN IN</h3>
                    </ul>
                    <form method="POST">
                        <label class="label control-label">Username</label>
                        <input type="text" class="form-control" name="user" placeholder="Username" />
                        <label class="label control-label">Password</label>
                        <input type="password" class="form-control"  name="pass" placeholder="Password" />
                        <button class="btn btn-dark" name="login">Login</button>
                    </form>
                  </div>
                 <?php
                    if (isset($_POST['login'])) {
                         $ambil = $koneksi->query("SELECT * FROM admin WHERE username ='$_POST[user]' AND password='$_POST[pass]'");
                               $yangcocok = $ambil->num_rows;
                                   if ($yangcocok==1) {
                                      $_SESSION['admin'] = $ambil->fetch_assoc();
                                       echo "<div class='alert alert-info'>Login Success</div>";
                                       echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                                    }else{
                                       echo "<div class='alert alert-danger'>Login Failed</div>";
                                        echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                                  }       
                                }   
                             ?>
                      <div class="col-md-6">
                    <img src="../image/4.png">
                  </div>
                </div>
              </div>
              <div class="col-md-2"></div>
            </div>
          </div>


     <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
   
</body>
</html>
