<?php 
session_start();
include 'koneksi.php';

$id_pembelian = $_GET["id"];

$ambil = $koneksi->query("SELECT * FROM pembayaran 
		LEFT JOIN pembelian ON pembayaran.id_pembelian = pembelian.id_pembelian WHERE pembelian.id_pembelian='$id_pembelian'");
$detbay = $ambil->fetch_assoc();

if (empty($detbay)) {
	echo "<script>alert ('belum ada data pembayaran');</script>";
	echo "<script>location ='riwayat.php';</script>";
	exit();
}

if($_SESSION["pelanggan"]['id_pelanggan']!==$detbay["id_pelanggan"]){

	echo "<script>alert ('Anda tidak bisa liat transaksi orang lain');</script>";
	echo "<script>location ='riwayat.php';</script>";
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Payment History</title>
	<link rel="stylesheet"  href="admin/assets/css/bootstrap.css">

</head>
<body>

	<?php include 'menu.php';?>

	<div class="container" style="margin-top: 120px; margin-bottom: 100px;">
		<h3>Payment History</h3>
		<div class="col-md-7">
			<table class="table">
				<tr>
					<th>Name</th>
					<td><?php  echo $detbay["nama"] ?></td>
				</tr>
				<tr>
					<th>Bank</th>
					<td><?php  echo $detbay["bank"] ?></td>
				</tr>
				<tr>
					<th>Date</th>
					<td><?php  echo $detbay["tanggal"] ?></td>
				</tr>
				<tr>
					<th>Total</th>
					<td>Rp. <?php  echo number_format( $detbay["jumlah"]) ?></td>
				</tr>
			</table>
			<a href="riwayat.php" class="btn btn-default">Back</a>
		</div>
		<div class="col-md-5">
			<img src="bukti_pembayaran/<?php echo $detbay["bukti"]?>" alt="" class="img-responsive" width="300"height="300">
		</div>
	</div>
	<?php include 'footer.php'; ?>	
</body>
</html>