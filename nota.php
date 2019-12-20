<?php
session_start();
include 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Invoice Detail</title>
	<link rel="stylesheet" type="text/css" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php'; ?>

<section class="konten">
	<div class="container" style="margin-top: 120px; margin-bottom: 100px;">
	<h2>Purchase Detail</h2>
	<?php
		$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
		$detail = $ambil->fetch_assoc();
	?>

	<?php
		$idpelangganyangbeli = $detail["id_pelanggan"];
		$idpelangganyanglogin = $_SESSION["pelanggan"]["id_pelanggan"];

		if($idpelangganyangbeli!==$idpelangganyanglogin){
			echo "<script>alert('Jangan membuka data orang lain !');</script>";
			echo "<script>location='riwayat.php';</script>";
			exit();
		}
	?>

<div class="row">
	<div class="col-md-4">
		<h3>Purchase</h3>
		<strong>Purchase Number: <?php echo $detail['id_pembelian']; ?></strong><br>
		Date: <?php echo $detail['tanggal_pembelian']; ?><br>
		Total: Rp. <?php echo number_format($detail['total_pembelian']); ?>
	</div>
	<div class="col-md-4">
		<h3>Customer</h3>
		<strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
				<p>
					<?php echo $detail['telepon_pelanggan']; ?><br>
					<?php echo $detail['email_pelanggan']; ?>
				</p>
	</div>
	<div class="col-md-4">
		<h3>Shipping</h3>
		<strong><?php echo $detail['nama_kota']; ?></strong><br>
		Shipping Fee: Rp. <?php echo number_format($detail['tarif']);	 ?><br>
		Address: <?php echo $detail['alamat_pengiriman']; ?>
	</div>
</div>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Product Name</th>
			<th>Price</th>
			<th>Weight</th>
			<th>Quantity</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1;?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk WHERE id_pembelian ='$_GET[id]'"); ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor;?></td>
			<td><?php echo $pecah['nama']; ?></td>
			<td><?php echo $pecah['harga']; ?></td>
			<td><?php echo $pecah['berat']; ?> Gram</td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>Rp. <?php echo number_format($pecah['subharga']); ?></td>
		</tr>
		<?php $nomor++; ?>
		<?php
			}
		?>
	</tbody>
</table>
	<div class="row">
		<div class="col-md-7">
			<div class="alert alert-info" style="background-color: rgba(45,45,45,0.98); border-color: black; color: white;">
				<p>
					Please make a payment &nbsp;<b style="font-size: 15px;"><i>Rp. <?php echo number_format($detail['total_pembelian']); ?></i></b><br>
					<strong>BANK BCA 72819281 (Oodiebangbang Official) </strong>
				</p>
			</div>
		</div>
	</div>
	<a href="index.php" class="btn btn-default">Back</a>
	<a href="riwayat.php" class="btn btn-warning" style="background-color: rgba(45,45,45,0.98); border-color: rgba(45,45,45,0.98);">Pay Now</a>
	</div>

</section>
	<?php include 'footer.php'; ?>	
</body>
</html>