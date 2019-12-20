<nav class="navbar navbar-default navbar-fixed-top" style="background-color: rgba(45,45,45,0.98);">
	<div class="container">
		<ul class="nav navbar-nav">
		<li><a class="navbar-brand" href="index.php" style="color: white; font-family: forte; font-size: 22px;">OodieBangBang</a></li>	
			<form action="pencarian.php" method="get" class="navbar-form navbar-right">
				<div class="input-group">
					<input type="text" class="form-control" name="keyword">
					<div class="input-group-btn">
						<button class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
					</div>
				</div>
			</form>
		</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<?php if(isset($_SESSION["pelanggan"])):?>
						<li><a href="riwayat.php" style="color: white;"><span class="glyphicon glyphicon-inbox"></span> Order Status</a></li>
						<li><a href="logout.php" style="color: white;">Logout <span class="glyphicon glyphicon-log-out"></a></li>
					<?php else : ?>
						<li><a href="login.php" style="color: white;"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
					<?php endif ?>
			    </ul>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="keranjang.php" style="color: white;"><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</a></li>
			    </ul>

	</div>
</nav>