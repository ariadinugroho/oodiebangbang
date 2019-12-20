<?php
session_start();
include 'koneksi.php';
?>
<?php
	$id_produk = $_GET["id"];
	$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
	$detail = $ambil->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Detail Produk</title>
	<link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
<?php include 'menu.php'; ?>

<section class="kontent">
	<div class="container" style="margin-top: 120px; margin-bottom: 100px;">
		<div class="row">
			<div class="col-md-3">
				<img src="foto_produk/<?php echo $detail["foto_produk"]; ?>" alt="" class="img-responsive"> 
			</div>
			<div class="col-md-4">
				<h2><?php echo $detail["nama_produk"]; ?></h2>
				<h4>Rp. <?php echo number_format($detail["harga_produk"]); ?></h4>
				<h5>Stock: <?php echo $detail['stok_produk'] ?></h5>


				<form method="post">
					<div class="form-group">
						<div class="input-group">
							<input type="number" min="1" class="form-control" name="jumlah" max="<?php echo $detail['stok_produk'] ?>" required>
							<div class="input-group-btn">
								<button class="btn btn-primary" name="beli">Buy</button>
							</div>
						</div>
					</div>
				</form>

				<?php
					if (isset($_POST["beli"])) {
						$jumlah = $_POST["jumlah"];
						if($jumlah == NULL){
							echo "<script>alert{'Jumlah produk harus diisi'};</script>";
						}else{
						$_SESSION["keranjang"][$id_produk] = $jumlah;
						}
						echo "<script>alert{'Produk telah masuk ke keranjang belanja'};</script>";
						echo "<script>location='keranjang.php';</script>";
					}
				?>

				<p><?php echo $detail["deskripsi_produk"]; ?></p>
				<a href="index.php" class="btn btn-default">Back</a>
			</div>
		</div>
	</div>
</section>
	<?php include 'footer.php'; ?>	
</body>
</html>