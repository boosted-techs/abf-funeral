<!-- HEAD AREA -->
<?php 
	include("others/functions.php");
	include("others/head.php"); 

	if(isset($_GET['deleted'])){
		echo "<script>alert('Successfully deleted!')</script>";
	}

	if(isset($_GET['updated'])){
		echo "<script>alert('Successfully updated!')</script>";
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
			$this_page = "services";
			include("others/sidebar.php"); ?>

			<!-- BANNER CONTENT -->
			<section class="banner-con">
				<div class="wrapper">
					<div class="banner-div">
						<?php
						if(isset($_SESSION['provider'])){
							$user = provider();
						}
						?>
						<h2>Services <mark class="btn status type"><?php echo $user['provider_type']; ?></mark></h2>
						<a class="btn btn-link-absolute" href="services_add.php">+ Add Services</a>
						<!-- <form action="" class="search-form">
							<input type="text" placeholder="search here..">
							<button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
						</form> -->
						
						<!-- TABS -->
						<?php
						if($user['provider_type'] == "funeral"){
							echo "
							<ul>
								<li><a class='active' href='services.php' >Traditional</a></li>
								<li><a class='' href='services_cremation.php'>Cremation</a></li>
							</ul>
							";
						}
						?>

						<div class="banner-cards">
							<?php
							switch($user['provider_type']){
								case "funeral":
									provider_services("traditional");
								break;
								default:
									provider_services();
								break;
							}
							?>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
</html>
