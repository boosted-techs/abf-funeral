<!-- HEAD AREA -->
<?php 
	include("others/functions.php");
	include("others/head.php"); 
	
	## CART SUCCESSFULLY ADDED
	if(isset($_GET['cart_success'])){
		echo "<script>alert('Successfully added to cart!')</script>";
	}

	## CART SUCCESSFULLY DELETE
	if(isset($_GET['cart_deleted'])){
		echo "<script>alert('Successfully deleted!')</script>";
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
			$this_page = "transact";
			include("others/sidebar.php"); ?>

			<!-- BANNER CONTENT -->
			<section class="banner-con">
				<div class="wrapper">
					<div class="banner-div">
						<h2>Transactions</h2>

						<!-- TABS -->
						<?php
						$current_tab = "transact";
						$this_tab = "cart";
						include("others/tabs.php"); 
						
						my_cart();
						?>
					</div>
				</div>
			</section>
		</div>
	</div>
<!-- FOOTER AREA -->
<?php include("others/footer-js.php"); ?>

