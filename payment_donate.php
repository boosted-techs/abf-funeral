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
			$this_page = "profile";
			include("others/sidebar.php"); ?>

			<!-- BANNER CONTENT -->
			<section class="banner-con">
				<div class="wrapper">
					<div class="banner-div">
						<h2><a href='profile.php'>Subscription</a> <span>> Payment</span></h2>
						
						<form method="post">
							<div class="banner-section card">
								<ul>
									<li><h3>Donation</h3></li>
									<li><h3>Cost</h3></li>
								</ul>
								<ul>
									<li>PH</li>
									<?php
									$type = "";
									$cost = 0;
									?>
								</ul>
								<div class='hr full-width'></div>
								<ul>
									<li></li>
									<li>Total Cost:</li>
									<?php
									?>
								</ul>
							</div>
							<!-- CARD DETAILS -->
							<div class="banner-section details card">
								<select name="cbomethod" onclick="payment_method(this);">
									<option value="">BROWSE PAYMENT METHOD</option>
									<option value="gcash" selected>Gcash</option>
									<!-- <option value="card">Card</option> -->
								</select>

								<div id='gcash-payment'>
									<h3><i class="fa-solid fa-g"></i> Gcash Details</h3>

									<div class="details-con">
										<div>
											<label>Account Name <span>*<span></label>
											<input type="text" id="gcash-name" name="gcash-name" required>
										</div>
										<div>
											<label>Account Number <span>*<span></label>
											<input type="text" id="gcash-num" name="gcash-num" minlength='11' maxlength='11' placeholder='Format: 09XX' required>
										</div>
									</div>
								</div>
								
								<div id='card-payment' style='display:none;'>
									<h3>Card Details 
										<ul>
											<li><i class="fa-brands fa-cc-mastercard"></i></li>
											<li><i class="fa-brands fa-cc-amex"></i></li>
											<li><i class="fa-brands fa-cc-visa"></i></li>
										</ul>
									</h3>

									<div class="details-con">
										<div>
											<label>Account Name <span>*<span></label>
											<input type="text" id="card-name" name="card-name">
										</div>
										<div>
											<label>Card Number <span>*<span></label>
											<input type="text" id="card-num" name="card-num" minlength='16' maxlength='16'>
										</div>
										<div>
											<label>Expiration Date <span>*<span></label>
											<input type="month" id="card-expiry" name="mthexpiry">
										</div>
										<div>
											<label>CVV <span>*<span></label>
											<input type="text" id="card-cvv" name="txtcvv" minlength='3' maxlength='3'>
										</div>
									</div>
								</div>
							</div>

							<button type='submit' name='btnpay' class='btn'>Pay now!</button>

							<?php
							if(isset($_POST['btnpay'])){
								$_SESSION['subscription_type'] = $type;
								$_SESSION['subscription_price'] = number_format($cost,2,'.','');

								ewallet_source("gcash", number_format($cost,2,'',''));
							}
							?>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
	<script>
		function payment_method(that){
			const gcash = document.getElementById("gcash-payment");
			const card = document.getElementById("card-payment");

			if(that.value == "gcash") {
				gcash.style.display = "block";
				document.getElementById("gcash-name").required = true;
				document.getElementById("gcash-num").required = true;

				card.style.display = "none";
				document.getElementById("card-name").required = false;
				document.getElementById("card-num").required = false;
				document.getElementById("card-expiry").required = false;
				document.getElementById("card-cvv").required = false;
			}
			else if(that.value == "card") {
				gcash.style.display = "none";
				document.getElementById("gcash-name").required = false;
				document.getElementById("gcash-num").required = false;

				card.style.display = "block";
				document.getElementById("card-name").required = true;
				document.getElementById("card-num").required = true;
				document.getElementById("card-expiry").required = true;
				document.getElementById("card-cvv").required = true;
			}
		}
	</script>
</body>
</html>
