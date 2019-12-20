<?php
session_start();
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet"  href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include 'menu.php'; ?>


	<div class="container" style="margin-top: 120px; margin-bottom: 100px;">
		<div class="row">
			<div class="col-md-4 col-sm-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading" style="background-color: rgba(45,45,45,0.98); color: white;">
						<h3 class="panel-title">Login</h3>
					</div>
					<div class="panel-body">
						<form method="post">
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="email" class="form-control">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="Password" name="password" class="form-control">
							</div>
							<button class="btn btn-primary" name="login" style="background-color: rgba(45,45,45,0.98); border-color: rgba(45,45,45,0.98);">Login</button>
							<h6>New Customer ? <b><a href="daftar.php" style="color: black;">Sign Up</a></b></h6>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>

	<?php 
		if( isset($_POST["login"]))
		{
			$email = $_POST["email"];
			$password = $_POST["password"];
			$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan = '$email' AND password_pelanggan = '$password'");

			$akunyangcocok = $ambil->num_rows;
			if($akunyangcocok == 1)
			{
				$akun = $ambil->fetch_assoc();
				$_SESSION["pelanggan"] = $akun;

				echo "<script>alert('You Have Logged In');</script>";
				
				if(isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"])){
					echo "<script>location='checkout.php';</script>";
				}else{
					echo "<script>location='index.php';</script>";
				}
			}
			else
			{
				echo "<script>alert('You Failed To Log In, Check Your Account');</script>";
				echo "<script>location='login.php';</script>";
			}

		}

	?>
<?php include 'footer.php'; ?>
</body>
</html>