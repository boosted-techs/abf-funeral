<!-- HEAD AREA -->
<?php 
	include("others/functions.php");
	include("others/head.php"); 

	$provider = read("provider", ["provider_id"], [$_GET['id']]);
	$provider = $provider[0];
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
						<h2><a href="funeral.php">Services</a> <span>> <?php echo $provider['provider_company']; ?></span></h2> <!-- NAME BASED ON SERVICE PROVIDER -->
						
						<!-- TABS -->
						<?php
						echo "
							<ul>
								<li><a class='' href='funeral_tradition.php?id={$provider['provider_id']}' >Traditional</a></li>
								<li><a class='active' href='funeral_cremate.php?id={$provider['provider_id']}'>Cremation</a></li>
							</ul>
						";
						?>

						<div class="banner-cards">
							<?php
								services("funeral", "cremation");
							?>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
</html>
