<!-- HEAD AREA -->
<?php 
	include("others/functions.php");
	include("others/head.php"); 

	if(isset($_POST['btnupdate'])){
		if(isset($_SESSION['seeker'])){
			upload_required("seeker", $_SESSION['seeker']);
		}
		else {
			upload_required("provider", $_SESSION['provider']);
		}
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
						<h2><a href="profile.php">Profile</a> <span>> Requirements</span></h2>
						<form enctype="multipart/form-data" class="profile column" method="post">
							<button class="btn btn-link-absolute higher-top" type="submit" name="btnupdate">Upload</button>
							<div>
								<label for="label-name">Upload An Image</label>
								<input type="file" name="file_req" id="label-name" required>
							</div>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
</html>
