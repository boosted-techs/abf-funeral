<!-- HEAD AREA -->
<?php 
	include("others/functions.php");
	include("others/head.php");

	if(isset($_POST['btncreate'])){
		createUser("admin");
	}
?>

<body>
	<div class="container">
		<!-- HEADER AREA -->
		<?php include("others/header.php"); ?>
		
		<!-- BANNER AREA -->
		<div class="banner">

			<!-- SIDEBAR AREA -->
			<?php 
			$this_page = "profile";
			include("others/sidebar.php"); ?>

			<!-- BANNER CONTENT -->
			<section class="banner-con">
				<div class="wrapper">
					<div class="banner-div">
						<h2><a href="profile.php">Account</a> <span>> Add New Admin</span></h2>
						<form class="profile column" method="post">
							<div>
								<label for="label-name">First name</label>
								<input type="text" name="txtfn" id="label-name" required>
							</div>
							<div>
								<label for="label-name">Middle initial</label>
								<input type="text" name="txtmi" id="label-name" maxlength="1" required>
							</div>
							<div>
								<label for="label-name">Last name</label>
								<input type="text" name="txtln" id="label-name" required>
							</div>
							<div>
								<label for="label-name">Email</label>
								<input type="email" name="emea" id="label-name" required>
							</div>
							<div>
								<label for="label-name">Password</label>
								<input type="password" name="passpw" id="label-name" required>
							</div>
							<button class="btn btn-link-absolute higher-top" type="submit" name="btncreate">Create Admin</button>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
</html>
