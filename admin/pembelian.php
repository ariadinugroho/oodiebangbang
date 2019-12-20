<h2>Purchase History</h2>
<div class="scrollabel" style="max-height:1000px; overflow: scroll;">
<table class="table table-bordered">	
	<thead>
		<tr>
			<th>No</th>
			<th>Customer Name</th>
			<th>Date</th>
			<th>Status</th>
			<th>Total</th>
			<th>Option</th>
		</tr>
	</thead>
	<tbody>
		<?php $nomor=1;?>
		<?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan"); ?>
		<?php while($pecah = $ambil->fetch_assoc()) { ?>
		<tr>
			<td><?php echo $nomor;?></td>
			<td><?php echo $pecah['nama_pelanggan']; ?></td>
			<td><?php echo $pecah['tanggal_pembelian']; ?></td>
			<td><?php echo $pecah['status_pembelian']; ?><br>
				<?php if(!empty($pecah['resi_pengiriman'])): ?>
					Receipt Number: <b><?php echo $pecah['resi_pengiriman']; ?></b>
				<?php endif?>
			</td>
			<td>Rp. <?php echo number_format($pecah['total_pembelian']); ?></td>
			<td>
				<a href="index.php?halaman=detail&id=<?php echo $pecah['id_pembelian'];?>" class="btn btn-info">Purchase Detail</a>
				<?php if($pecah['status_pembelian']!=="Pending" && $pecah['status_pembelian']!=="Purchased"): ?>
					<a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-success">Payment History</a>
				<?php elseif($pecah['status_pembelian']!=="Pending" && $pecah['status_pembelian']=="Purchased"): ?>
				<a href="index.php?halaman=pembayaran&id=<?php echo $pecah['id_pembelian']; ?>" class="btn btn-warning">Product Needs to be Sent</a>
				<?php endif ?>
			</td>
		</tr>
		<?php $nomor++; ?>
		<?php
			}
		?>
	</tbody>
</table>
</div>