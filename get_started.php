<!-- HEAD AREA -->
<?php 
	include("others/functions.php");
	include("others/head.php"); 
	
?>

<body>
	<div class="container">
		<!-- HEADER AREA -->
		<?php include("others/header.php"); ?>
		
		<!-- BANNER AREA -->
		<div class="banner">

			<!-- SIDEBAR AREA -->
			<?php 
			$this_page = "services";
			include("others/sidebar.php"); ?>

			<!-- BANNER CONTENT -->
			<section class="banner-con">
				<div class="wrapper">
					<div class="banner-div intro">
						<div class="">
							<h2>About Us</h2>
							<?php
							## TYPE [notify, success, error]
							messaging("notify", "Note: Please upload a death certificate and wait to be verified! Click <a href='profile.php'>here</a> to upload!");
							?>
							We manage your funeral to the best.
							<?php
								## CHECK IF USER IS VERIFIED
								echo "<a class='btn' href='./church.php'>Browse Services</a>";
							?>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
</html>
