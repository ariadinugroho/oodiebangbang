<h2>Add Product</h2>
<?php
	if (isset($_POST['save'])){
		$nama = $_FILES['foto']['name'];
		$lokasi = $_FILES['foto']['tmp_name'];
		move_uploaded_file(($lokasi), "../foto_produk/".$nama);
		$koneksi->query("INSERT INTO produk 
			(nama_produk,harga_produk,stok_produk,berat_produk,foto_produk,deskripsi_produk)
			VALUES('$_POST[nama]','$_POST[harga]','$_POST[stok]','$_POST[berat]','$nama','$_POST[deskripsi]')");

		echo "<div class='alert alert-info'>Product Has Been Added</div>";
		echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=produk'>";
	}
?>
<form method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label>Product Name</label>
		<input type="text" class="form-control" name="nama">
	</div>
	<div class="form-group">
		<label>Price (Rp)</label>
		<input type="number" class="form-control" name="harga">
	</div>
	<div class="form-group">
		<label>Stock </label>
		<input type="number" class="form-control" name="stok">
	</div>
	<div class="form-group">
		<label>Weight (Gr)</label>
		<input type="number" class="form-control" name="berat">
	</div>
	<div class="form-group">
		<label>Description</label>
		<textarea class="form-control" name="deskripsi" rows="10"></textarea>
	</div>
	<div class="form-group">
		<label>Photo</label>
		<input type="file" class="form-control" name="foto">
	</div>
	<a href="index.php?halaman=produk" class="btn btn-default">Back</a>
	<button class="btn btn-primary" name="save">Add Product</button>
</form> 

