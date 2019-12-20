<h2>Purchase Detail</h2>
<?php
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$_GET[id]'");
$detail = $ambil->fetch_assoc();
?>


<div class="row">
	<div class="col-md-4">
		<h3>Puchase</h3>
		<p>
			<b>Date:</b> <?php echo $detail['tanggal_pembelian']; ?><br>
			<b>Total:</b> Rp. <?php echo number_format($detail['total_pembelian']);?><br>
			<b>Status:</b> <?php echo $detail['status_pembelian'];?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Customer</h3>
		<p>
			<strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
			<b>Handphone:</b> <?php echo $detail['telepon_pelanggan']; ?><br>
			<b>Email:</b> <?php echo $detail['email_pelanggan']; ?>
		</p>
	</div>
	<div class="col-md-4">
		<h3>Shipping</h3>
		<p>
			<strong><?php echo $detail['nama_kota']; ?></strong><br>
			<b>Shipping Fee:</b> Rp. <?php echo number_format($detail['tarif']); ?><br>
			<b>Address:</b> <?php echo $detail['alamat_pengiriman']; ?>
		</p>
	</div>
</div>
<br>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>No</th>
			<th>Product Namek</th>
			<th>Price</th>
			<th>Unit</th>
			<th>Total</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1;?>
		<?php $ambil=$koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk = produk.id_produk WHERE pembelian_produk.id_pembelian ='$_GET[id]'"); ?>
		<?php while($pecah=$ambil->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $nomor;?></td>
			<td><?php echo $pecah['nama_produk']; ?></td>
			<td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
			<td><?php echo $pecah['jumlah']; ?></td>
			<td>Rp. <?php echo number_format($pecah['harga_produk']*$pecah['jumlah']);?></td>
		</tr>
		<?php $nomor++; ?>
		<?php
			}
		?>
	</tbody>
</table>
		<a href="index.php?halaman=pembelian" class="btn btn-default">Back</a>