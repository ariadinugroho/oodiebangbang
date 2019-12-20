<h2>Payment Data</h2>

<?php 
$id_pembelian = $_GET['id'];
$ambil = $koneksi->query("SELECT* FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$detail = $ambil->fetch_assoc();	
?>

<div class="row">
	<div class="col-md-6">
		<table class="table">
			<tr>
				<th>Name</th>
				<td><?php echo $detail['nama'] ?></td>
			</tr>
			<tr>
				<th>Bank</th>
				<td><?php echo $detail['bank'] ?></td>
			</tr>
			<tr>
				<th>Price</th>
				<td>Rp. <?php echo number_format($detail['jumlah']) ?></td>
			</tr>
			<tr>
				<th>Date</th>
				<td><?php echo $detail['tanggal'] ?></td>
			</tr>
		</table>
	</div>
	 <div class="col-md-6">
	 	<img src="../bukti_pembayaran/<?php echo $detail['bukti'] ?>" alt="" class="img-responsive" width="400" height="400">
	 </div>
</div>

<form method="post">
	<div class="form-group">
		<label>Shipping Receipt Number</label>
		<input type="text" name="resi" class="form-control" required>
	</div>
	<div class="form-group">
		<label>Status</label>
		<select class="form-control" name="status" required>
			<option value="">Status Option</option>
			<option value="Your Order Has Been Sent">Your Order Has Been Sent</option>
		</select>
	</div>
	<a href="index.php?halaman=pembelian" class="btn btn-default">Back</a>
	<button class="btn btn-primary" name="proses">Process Now</button>
</form>

<?php 
if (isset($_POST["proses"])) {
	$resi = $_POST["resi"];
	$status = $_POST["status"];
	$koneksi->query("UPDATE pembelian SET resi_pengiriman ='$resi',status_pembelian='$status' WHERE id_pembelian = '$id_pembelian'");

	echo "<script>alert('Status Purchase Order Has Been Changed');</script>";
	echo "<script>location='index.php?halaman=pembelian';</script>";

}
?>
