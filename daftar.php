<?php include 'koneksi.php';?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet"  href="admin/assets/css/bootstrap.css">
</head>
<body>
	<?php include 'menu.php';?>
	<div class="container" style="margin-top: 120px; margin-bottom: 100px;">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading" style="background-color: rgba(45,45,45,0.98); color: white;">
						<h3 class="panel-title">Register New Account</h3>
					</div>
					<div class="panel-body">
						<form method="post" class="form-horizontal">
							<div class="form-group">
								<label class="control-label col-md-3">Name</label>
								<div class="col-md-7">
									<input type="text" class="form-control"
									name="nama" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Email</label>
								<div class="col-md-7">
									<input type="email" class="form-control"
									name="email" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Password</label>
								<div class="col-md-7">
									<input type="password" class="form-control"
									name="password" required>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Address</label>
								<div class="col-md-7">
									<textarea class="form-control" name="alamat" required></textarea>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-md-3">Handphone</label>
								<div class="col-md-7">
									<input type="text" class="form-control"
									name="telepon" required>
								</div>
							</div>
							<div class="form-group">
								<div class="col-md-7 col-md-offset-3">
									<button class="btn btn-primary" name="daftar" style="background-color: rgba(45,45,45,0.98); border-color: rgba(45,45,45,0.98);">Sign Up</button>
									<h6>Returning Customer ?<b><a href="login.php" style="color: black;">Login</a></b></h6>
								</div>
							</div>
						</form>
						<?php 
							if(isset($_POST["daftar"]))
							{
								$nama = $_POST["nama"];
								$email = $_POST["email"];
								$password = $_POST["password"];
								$alamat = $_POST["alamat"];
								$telepon = $_POST["telepon"];

								$ambil = $koneksi-> query("SELECT* FROM pelanggan
									WHERE email_pelanggan = '$email'");
								$yangcocok = $ambil->num_rows;
								if ($yangcocok==1) {
									echo "<script>alert('pendaftaran gagal, email sudah digunakan');</script>";
									echo "<script>location ='daftar.php'</script>";
								}else{
								$koneksi->query("INSERT INTO pelanggan (email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan, alamat_pelanggan) VALUES('$email','$password','$nama','$telepon','$alamat')");

								echo "<script>alert('Registration Success');</script>";
								echo "<script>location ='login.php'</script>";
								}
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include 'footer.php'; ?>	
</body>
</html>