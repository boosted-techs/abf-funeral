<!-- HEAD AREA -->
<?php 
	include("others/functions.php");
	include("others/head.php"); 

	## SUCCESSFULLY CREATED
	if(isset($_GET['success'])) echo "<script>alert('Created successfully!')</script>";

	## SUCCESSFULLY LOGOUT
	if(isset($_GET['logout'])) echo "<script>alert('Logout successfully!')</script>";

	## IF BTN LOGIN IS CLICKED
	if(isset($_POST['btnlogin'])){
		loginUser();
	}
?>

<body>
	<div class="form">
		<!-- LOGIN AREA -->
		<div class="form-img">
			<img src="images/banner-img.jpg" alt="">
		</div>

		<div class="form-con">
			<div class="form-logo">
				<img src="images/main-logo.png">
			</div>
			<form method="post">
				<input type="email" name="emuser" placeholder="Email Address">
				<input type="password" name="passpw" placeholder="Password">
				<p>
					Forgot password? Click <a href="resetpass.php">here</a>.
				</p>
				<button class="btn" type="submit" name="btnlogin">Login</button>
				<a class="btn" href="register.php">Register</a>
			</form>
		</div>
	</div>
</body>
</html>
