<?php 
session_start();
include 'koneksi.php';

if (!isset($_SESSION["pelanggan"]) OR empty($_SESSION["pelanggan"])) {
	echo "<script>alert('silahkan login');</script>";
	echo "<script>location='login.php';</script>";
	exit();

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Order Status</title>
	<link rel="stylesheet"  href="admin/assets/css/bootstrap.css">
</head>
<body>

	<?php include 'menu.php';?>

	<section class="riwayat">
		<div class="container" style="margin-top: 120px; margin-bottom: 100px;">
			<h3>Status Order<b> <?php echo $_SESSION["pelanggan"]["nama_pelanggan"] ?></b></h3>

			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Date</th>
						<th>Status</th>
						<th>Total</th>
						<th>Option</th>


					</tr>
				</thead>
				<tbody>
					<?php
					$nomor=1;
					$id_pelanggan = $_SESSION["pelanggan"]['id_pelanggan'];
					$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan= '$id_pelanggan'");
					while($pecah = $ambil->fetch_assoc()){
					 ?>

					<tr>
						<td><?php echo $nomor; ?></td>
						<td><?php echo $pecah["tanggal_pembelian"]; ?></td>
						<td>
							<?php echo $pecah["status_pembelian"]; ?>
							<br>
							<?php if(!empty($pecah['resi_pengiriman'])): ?>
								Receipt Number: <b><?php echo $pecah['resi_pengiriman']; ?></b>
							<?php endif?>
						</td>
						<td>Rp. <?php echo number_format($pecah["total_pembelian"]); ?></td>
						<td>
							<a href="nota.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-info">Invoice</a>

						<?php if($pecah['status_pembelian']=="Pending"): ?>
							<a href="pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-warning">Pay Now</a>
						<?php elseif($pecah['status_pembelian']!=="Pending" && $pecah['status_pembelian']=="Purchased"): ?>
							<a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-danger">Product is being packaged</a>	
							<?php else: ?>
							<a href="lihat_pembayaran.php?id=<?php echo $pecah["id_pembelian"]; ?>" class="btn btn-success">Payment History</a>
						<?php endif ?>
						</td>
					</tr>
				<?php $nomor++; ?>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</section>
		<?php include 'footer.php'; ?>	
</body>
</html>