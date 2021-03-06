<h2>Update Product</h2>

<?php
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk ='$_GET[id]'");
$pecah = $ambil->fetch_assoc();
?>

<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Product Name</label>
		<input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_produk']; ?>" required>
	</div>
	<div class="form-group">
		<label>Price (Rp)</label>
		<input type="number" name="harga" class="form-control" value="<?php echo $pecah['harga_produk']; ?>" required>
	</div>
	<div class="form-group">
		<label>Stock</label>
		<input type="number" name="stok" class="form-control" value="<?php echo $pecah['stok_produk']; ?>" required>
	</div>
	<div class="form-group">
		<label>Weight (Gr)</label>
		<input type="number" name="berat" class="form-control" value="<?php echo $pecah['berat_produk']; ?>" required>
	</div>
	<div class="form-group">
		<img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="200" required>
	</div>
	<div class="form-group">
		<label>Photo</label>
		<input type="file" name="foto" class="form-control">
	</div>
	<div class="form-group">
		<label>Description</label>
		<textarea name="deskripsi"  class="form-control" rows="10" required>
			<?php echo  $pecah['deskripsi_produk']; ?>	
		</textarea>
	</div>
	<a href="index.php?halaman=produk" class="btn btn-default">Back</a>
	<button class="btn btn-primary" name="ubah">Update Product</button>
</form>

<?php
if (isset($_POST['ubah'])) 
{
	$namafoto=$_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	if (!empty($lokasifoto)) 
	{
		move_uploaded_file($lokasifoto, "../foto_produk/".$namafoto);
	
		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
		harga_produk='$_POST[harga]',stok_produk='$_POST[stok]', berat_produk= '$_POST[berat]',
		foto_produk='$namafoto',deskripsi_produk='$_POST[deskripsi]'
		WHERE id_produk='$_GET[id]' ");
	}
	else
	{
		$koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',
		harga_produk='$_POST[harga]',stok_produk='$_POST[stok]', berat_produk= '$_POST[berat]',
		deskripsi_produk='$_POST[deskripsi]' WHERE id_produk='$_GET[id]' ");
	}
	echo "<script>alert('Product Has Been Changed');</script>";
	echo "<script>location='index.php?halaman=produk';</script>";
}

?>