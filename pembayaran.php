<?php 
session_start();
include 'koneksi.php';

if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) {
	echo "<script>alert('silahkan login');</script>";
	echo "<script>location='login.php';</script>";
	exit();

}


$idpem = $_GET["id"];
$ambil = $koneksi->query("SELECT * FROM pembelian join pelanggan on pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE id_pembelian='$idpem'");
$detpem = $ambil->fetch_assoc();

$id_pelanggan_beli = $detpem["id_pelanggan"];
$id_pelanggan_login = $_SESSION["pelanggan"]["id_pelanggan"];

if ($id_pelanggan_login!==$id_pelanggan_beli) 
{
	echo "<script>alert('Jangan membuka data orang !');</script>";
	echo "<script>location='riwayat.php';</script>";
	exit();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Payment</title>
	<link rel="stylesheet"  href="admin/assets/css/bootstrap.css">

</head>
<body>

	<?php include 'menu.php';?>

	<div class="container" style="margin-top: 120px; margin-bottom: 100px;">
		<h2>Payment</h2>
		<div class="alert alert-info" style="background-color: rgba(45,45,45,0.98); color: white; border-color: rgba(45,45,45,0.98);">Your Bill Amount <strong> Rp. <?php echo number_format($detpem["total_pembelian"]) ?></strong></div>


		<form method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Name</label>
				<input type="text" name="nama" class="form-control" value="<?php echo $detpem["nama_pelanggan"]; ?>" required>
			</div>
			<div class="form-group">
				<label>Bank</label>
				<select class="form-control form-control-sm" name="bank">
				  <option value="BCA">BCA</option>
				  <option value="BCA">Mandiri</option>
				  <option value="BCA">BNI</option>
				  <option value="BCA">BRI</option>
				  <option value="BCA">Maybank</option>
				</select>
			</div>
			<div class="form-group">
				<label>Total</label>
				<input type="number" name="jumlah" class="form-control" min="1" value="<?php echo $detpem["total_pembelian"]; ?>" required>
			</div>
			<div class="form-group">
				<label>Photo</label>
				<input type="file" name="bukti" class="form-control" required>
				<p class="text-danger">Photos Max 2mb</p>
			</div>
			<a href="riwayat.php" class="btn btn-default">Back</a>
			<button class="btn btn-primary" name="kirim" style="background-color: black; border-color: black;">Send</button>
		</form>
	</div>

<?php
if (isset($_POST["kirim"])) 
{
	$namabukti = $_FILES["bukti"]["name"];
	$lokasibukti = $_FILES["bukti"]["tmp_name"];
	$namafiks = date("YmdHis").$namabukti;
	move_uploaded_file($lokasibukti, "bukti_pembayaran/$namabukti");

	$nama = $_POST["nama"];
	$bank = $_POST["bank"];
	$jumlah = $_POST["jumlah"];
	$tanggal = date("Y-m-d");

	if($jumlah < $detpem["total_pembelian"]){
		echo "<script>alert('your money is not enough');</script>";
	}else{

	$koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES ('$idpem','$nama','$bank','$jumlah','$tanggal','$namabukti')");

	$koneksi ->query("UPDATE pembelian SET status_pembelian ='Purchased' WHERE id_pembelian ='$idpem'");

	echo "<script>alert('Thankyou For Shopping :)');</script>";
	echo "<script>location='riwayat.php';</script>";
}
}

?>
	<?php include 'footer.php'; ?>	
</body>
</html>