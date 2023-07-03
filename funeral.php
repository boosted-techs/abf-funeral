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
					<div class="banner-div">
						<h2>Services</h2>
						<!-- <form action="" class="search-form">
							<input type="text" placeholder="search here..">
							<button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
						</form> -->
						
						<!-- TABS -->
						<?php
						$current_tab = "services";
						$this_tab = "funeral";
						include("others/tabs.php");?>

						<div class="banner-cards">
							<?php
								services("funeral");
							?>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
</html>
