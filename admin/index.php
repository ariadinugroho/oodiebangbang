<?php
session_start();
    $koneksi = new mysqli ("localhost","root", "","oodiebangbang");

if(!isset($_SESSION['admin'])){
    echo "<script>alert('Anda harus Login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
    header('location:login.php');
    exit();
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0; background-color: #202020;">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php" style="color: white; font-family: forte; font-size: 22px; background-color: #202020;">OodieBangBang</a>
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> <a href="index.php?halaman=logout" class="btn btn-danger square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
					
                <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="index.php?halaman=produk"><i class="fa fa-cube "></i> Product</a></li>
                <li><a href="index.php?halaman=pembelian"><i class="fa fa-shopping-cart "></i> Purchase History</a></li>
                <li><a href="index.php?halaman=laporan_pembelian"><i class="fa fa-file "></i> Report</a></li>
                <li><a href="index.php?halaman=pelanggan"><i class="fa fa-user "></i> Customer</a></li>
               
                    
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <?php
                    if(isset($_GET['halaman'])){
                        if($_GET['halaman']=="produk"){
                            include 'produk.php';
                        }elseif ($_GET['halaman']=="pembelian") {
                            include 'pembelian.php';
                        }elseif ($_GET['halaman']=="pelanggan") {
                            include 'pelanggan.php';
                        }elseif($_GET['halaman']=="detail"){
                            include 'detail.php';
                        }elseif($_GET['halaman']=="tambahproduk"){
                            include 'tambahproduk.php';
                        }elseif($_GET['halaman']=="hapusproduk"){
                            include 'hapusproduk.php';
                        }elseif($_GET['halaman']=="ubahproduk"){
                            include 'ubahproduk.php'; 
                        }elseif($_GET['halaman']=="logout"){
                            include 'logout.php';
                        }elseif($_GET['halaman']=="pembayaran") {
                            include 'pembayaran.php';
                        }elseif($_GET['halaman']=="laporan_pembelian") {
                            include 'laporan_pembelian.php';
                        }elseif($_GET['halaman']=="hapuspelanggan") {
                            include 'hapuspelanggan.php';
                        }
                    }else{
                        include 'home.php';
                    }
                ?>
            </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>

        <footer class="page-footer font-small cyan darken-3" style="background-color:#f2f2f2;">
  <div class="container">
    <div class="row" style="color: #333;">


      <div class="col-md-4">
        <h3 style="margin-bottom: 40px;"><b>FEEDBACK</b></h3>
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleFormControlTextarea1">Feedback</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter Your Feedback"></textarea>
          </div>
          <button type="submit" class="btn btn-primary" style="margin-bottom: 20px; background-color: black; border-color: black;">Send Feedback</button>
        </form>
       </div>


       <div class="col-md-5">
        <h3 style="margin-bottom: 40px;"><b>LOCATION</b></h3>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4082.707179978852!2d106.78049861306027!3d-6.200168894737065!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f6c2c52c3fcd%3A0xaff677f61779e018!2sKost+Haji+Indra!5e0!3m2!1sid!2sid!4v1557420168273!5m2!1sid!2sid" width="400" height="300" frameborder="0" style="border:0; margin-bottom:20px;" allowfullscreen></iframe>
       </div>


       <div class="col-md-3">
        <h3 style="margin-bottom: 40px;"><b>SOCIAL MEDIA</b></h3>
        <a href="#" style="color: #333; text-decoration:none;"><img src="../image/ig.png" height="30px" width="30px"> OodieBangBang</a><br><br>
        <a href="#" style="color: #333; text-decoration:none;"><img src="../image/fb.png" height="30px" width="30px"> OodieBang_Bang</a><br><br>
        <a href="#" style="color: #333; text-decoration:none;"><img src="../image/wa.png" height="30px" width="30px"> 085709927975</a><br><br>
        <a href="#" style="color: #333; text-decoration:none;"><img src="../image/line.png" height="30px" width="30px"> Oodie_BangBang</a>
       </div>
     </div>
   </div>
</footer>
     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- MORRIS CHART SCRIPTS -->
     <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>