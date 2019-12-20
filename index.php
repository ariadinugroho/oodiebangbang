<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>OodieBangBang</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<?php include 'menu.php'; ?>
<div class="container" style="margin-bottom: 80px; margin-top: 120px;">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="image/banner.jpg" style="width:100%;">
      </div>

      <div class="item">
        <img src="image/banner.jpg" style="width:100%;">
      </div>
    
      <div class="item">
        <img src="image/banner.jpg" style="width:100%;">
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<section class="konten">
	<div class="container">
		<div class="row">
			<?php $ambil = $koneksi->query("SELECT * FROM produk"); ?>
			<?php while($perproduk  = $ambil-> fetch_assoc()){ ?>
			
			<div class="col-md-3">
				<div class="thumbnail">
					<img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" alt="" style="width: 12	0px; height: 180px;">
					<div class="caption">
						<h5><b><?php echo $perproduk['nama_produk']; ?></b></h5>
						<h6>Rp. <?php echo number_format($perproduk['harga_produk']); ?></h6>
						<a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary" style="background-color: black; border-color: black;">Buy</a>
						<a href="detail.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-default">Detail</a>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php include 'footer.php'; ?>
</body>
</html>