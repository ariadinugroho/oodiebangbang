<?php
session_start();
include 'koneksi.php';

if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])){
	echo "<script>alert('Upss! Empty Cart, Please Shopping First');</script>";
	echo "<script>location='index.php';</script>";

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Shopping Cart</title>
	<link rel="stylesheet"  href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php'; ?>

<section class="konten">
	<div class="container" style="margin-top: 120px; margin-bottom: 100px;">
		<h1>Shopping Cart</h1>
		<hr>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Product</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Total</th>
					<th>Option</th>

				</tr>
			</thead>
			<tbody>
				<?php $nomor=1; ?>
				<?php foreach ($_SESSION["keranjang"] as $id_produk => $jumlah): ?>
				<?php
				$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
				$pecah = $ambil ->fetch_assoc();
				$subharga = $pecah["harga_produk"]*$jumlah;
				?>
				<tr>
					<td><?php echo $nomor; ?></td>
					<td><?php echo $pecah["nama_produk"]; ?></td>
					<td>Rp. <?php echo number_format($pecah["harga_produk"]); ?></td>
					<td><?php echo $jumlah; ?></td>
					<td>Rp. <?php echo number_format($subharga);?></td>	
					<td>
						<a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Cancel</a>
					</td>
				</tr>
				<?php  $nomor++; ?>
				<?php endforeach ?>
			</tbody>	
		</table>

		<a href="index.php" class="btn btn-default">Back to Shopping</a>
		<a href="checkout.php" class="btn btn-primary" style="background-color: black; border-color: black;">Checkout</a>

	</div>	
</section>
	<?php include 'footer.php'; ?>	
</body>
</html>