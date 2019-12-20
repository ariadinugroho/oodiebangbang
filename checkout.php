<?php
session_start();
include 'koneksi.php';

if(!isset($_SESSION["pelanggan"]))
{
echo "<script>alert('Please Login First');</script>";
echo "<script>location='login.php';</script>";
} else if(empty($_SESSION["keranjang"]) OR !isset($_SESSION["keranjang"])){
echo "<script>alert('Kumpulkan barang pembelian anda ke keranjang terlebih dahulu');</script>";
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
					<th>Produk</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Total</th>

				</tr>
			</thead>
			<tbody>
				<?php $nomor=1; ?>
				<?php $totalbelanja = 0; ?>
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
				</tr>
				<?php  $nomor++; ?>
				<?php  $totalbelanja+=$subharga; ?>
				<?php endforeach ?>
			</tbody>	
			<tfoot>
				<tr>
					<th colspan="4" >Total Price</th>
					<th>Rp. <?php echo number_format($totalbelanja); ?></th>
				</tr>
			</tfoot>
		</table>

		<form method="post">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['nama_pelanggan']?>" class="form-control">
			</div>
		</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<input type="text" readonly value="<?php echo $_SESSION["pelanggan"]['telepon_pelanggan']?>" class="form-control">
			</div>
		</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<select class ="form-control" name="id_ongkir" required>
							<option value="">Shipping Courier :</option>
							<?php
								$ambil = $koneksi->query("SELECT * FROM ongkir");
								while ($perongkir = $ambil->fetch_assoc()) {
							?>
							<option value="<?php echo $perongkir["id_ongkir"] ?>">
								<?php echo $perongkir['nama_kota'] ?> - Rp. <?php echo number_format($perongkir['tarif']) ?>
							</option>
							<?php } ?>
						</select>
				</div>
				<div class="form-group">
					<label>Address</label>
					<textarea class="form-control" name="alamat_pengiriman" placeholder="Input Your Address" required></textarea> 
				</div>
			<a href="keranjang.php" class="btn btn-default">Back</a>
			<button class="btn btn-success" name="checkout" style="background-color: black; border-color: black;">Purchase Now</button>
		</form>

		
		<?php
			if(isset($_POST["checkout"])){
				$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
				$id_ongkir = $_POST["id_ongkir"];
				$tanggal_pembelian = date("Y-m-d");
				$alamat_pengiriman = $_POST['alamat_pengiriman'];

				$ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir = '$id_ongkir'");
				$arrayongkir = $ambil->fetch_assoc();
				$nama_kota = $arrayongkir['nama_kota'];
				$tarif = $arrayongkir['tarif'];

				$total_pembelian = $totalbelanja + $tarif;
			
				$koneksi->query("INSERT INTO pembelian(id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian, nama_kota, tarif, alamat_pengiriman) VALUES ('$id_pelanggan', '$id_ongkir', '$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman')");

				$id_pembelian_barusan = $koneksi->insert_id;

				foreach ($_SESSION["keranjang"] as $id_produk => $jumlah) {
					$ambil=$koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
					$perproduk = $ambil->fetch_assoc();
					$nama = $perproduk['nama_produk'];
					$harga = $perproduk['harga_produk'];
					$berat = $perproduk['berat_produk'];

					$subberat = $perproduk['berat_produk']*$jumlah;
					$subharga = $perproduk['harga_produk']*$jumlah; 
					$ambil->fetch_assoc();
					$koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah) VALUES ('$id_pembelian_barusan','$id_produk','$nama','$harga', '$berat', '$subberat', '$subharga','$jumlah')");

					$koneksi->query("UPDATE produk SET stok_produk = stok_produk - $jumlah WHERE id_produk = '$id_produk'");
				}

					unset($_SESSION["keranjang"]);

					echo "<script>alert('Thankyou For Order');</script>";
					echo "<script>location='nota.php?id=$id_pembelian_barusan';</script>";
			}
		?>
	</div>	
</section>
	<?php include 'footer.php'; ?>	
</body>
</html>