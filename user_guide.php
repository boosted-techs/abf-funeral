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
			$this_page = "guide";
			include("others/sidebar.php"); ?>

			<!-- BANNER CONTENT -->
			<section class="banner-con">
				<div class="wrapper">
					<div class="banner-div">
						<h2>User Guide</h2>
						
						<?php
						if(isset($_SESSION['seeker'])){
						?>
							<h3>Seeker</h3>
							<div class="guide-con">
								<div class="guide-step">
									<i class="fa-solid fa-clipboard-check"></i>
									<h4>Choose Services</h4>
									<p>Go to 'Get Started' and 'Browse Services'</p>
								</div>
								<div class="guide-step">
									<i class="fa-solid fa-credit-card"></i>
									<h4>Proceed to Payment</h4>
									<p>Choose payment method then pay</p>
								</div>
								<div class="guide-step">
									<i class="fa-solid fa-dove"></i>
									<h4>Grieve Peacefully</h4>
									<p>You can now grieve peacefully not worrying about the processes</p>
								</div>
							</div>
						<?php
						} else {
						?>
							<h3>Provider</h3>
							<div class="guide-con">
								<div class="guide-step">
									<i class="fa-solid fa-circle-check"></i>
									<h4>Get Verified & Subscribed</h4>
									<p>Submit business permit to get verified and choose subscription</p>
								</div>
								<div class="guide-step">
								<i class="fa-solid fa-paste"></i>
									<h4>Post Services</h4>
									<p>Post services offered to seeker</p>
								</div>
								<div class="guide-step">
									<i class="fa-solid fa-credit-card"></i>
									<h4>Payment Payout</h4>
									<p>Receive payment payout for your done services</p>
								</div>
							</div>
						<?php
						}
						?>
						
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
</html>
