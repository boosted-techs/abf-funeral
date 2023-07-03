<!-- HEAD AREA -->
<?php 
	include("others/functions.php");
	include("others/head.php");

	if(isset($_GET['verify'])){
		update("requirement", ["req_status"], ["verified", $_GET['verify']], "req_id");

		echo "<script>alert('Successfully verified user!')</script>";
	}

	if(isset($_GET['reject'])){
		update("requirement", ["req_status"], ["not verified", $_GET['reject']], "req_id");

		echo "<script>alert('Successfully rejected user!')</script>";
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
			$this_page = "users";
			include("others/sidebar.php"); ?>

			<!-- BANNER CONTENT -->
			<section class="banner-con">
				<div class="wrapper">
					<div class="banner-div">
						<h2>Users</h2>

						<!-- TABS -->
						<?php
						$current_tab = "users";
						$this_tab = "seeker";
						include("others/tabs.php");?>
						
						<div class='banner-ratings profile-lists div-7'>
							<div class='list'>
								<div>ID#</div>
								<div>Name</div>
								<div>Address</div>
								<div>Phone</div>
								<div>Email</div>
								<div>Status</div>
								<div>Image</div>
								<div>Actions</div>
							</div>

							<?php users("seeker"); ?>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
<?php
include("others/footer-js.php");
