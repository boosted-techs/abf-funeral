<!-- HEAD AREA -->
<?php 
	include("others/functions.php"); 
	include("others/head.php");

	$single_payment = (isset($_GET['purchaseid'])) ? true:false;
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
						<h2>
							<?php
								echo ($single_payment) ? "<a href='purchase.php'>Purchase</a>":"<a href='cart.php'>Transactions</a>";
							?>
						<span>> Payment</span></h2>
						
						<form method="post">
							<!-- PURCHASE DETAILS -->
							<div class="banner-section card">
								<h3>Payment Details <span><a class="status" href="purchase.php">pay later</a></span></h3>
								<ul>
									<li><h3>Purchases</h3></li>
									<li><h3>Qty</h3></li>
									<li><h3>Cost</h3></li>
								</ul>
								<?php
									if($single_payment) 
										$list = read("purchase", ["seeker_id", "purchase_id", "purchase_status"], [$_SESSION['seeker'], $_GET['purchaseid'], "to pay"]);
									else $list = read("purchase", ["seeker_id", "purchase_status"], [$_SESSION['seeker'], "to pay"]);

									$type_list = [];
		
									if(count($list)>0){
										$total = 0;
										$service_fee = 500;
										foreach($list as $results){
											$service_ = read("services", ["service_id"], [$results['service_id']]);
											$service_ = $service_[0];

											$differ_ = service_type($service_['service_type'], $service_['service_id']);
											$name = $differ_[1];

											if($service_['service_type'] == "headstone") {
												$headstone = read("headstone", ["service_id"], [$service_['service_id']]);
												$headstone = $headstone[0];

												$name = $headstone["stone_color"]." ".$headstone["stone_kind"]." ".$headstone["stone_type"];
												$name = ucwords($name);
											} 

											array_push($type_list, $service_['service_type']);

											echo "
											<ul>
												<li>{$name}</li>
												<li>x".$results['purchase_qty']."</li>
												<li>UGX ".number_format($results['purchase_total'],2,'.',',')."</li>
											</ul>
											";
											$total += $results['purchase_total'];
										}
										$total += $service_fee;
									}
								?>
								
								<div class='hr full-width'></div>
								<ul>
									<li></li>
									<li>Service Fee:</li>
									<li>UGX <?php echo number_format($service_fee,2,'.',','); ?></li>
								</ul>
								<ul>
									<li></li>
									<li><h3>Total Cost:</h3></li>
									<li><h3>UGX <?php echo number_format($total,2,'.',','); ?></h3></li>
								</ul>
							</div>
							<!-- ADDITIONAL DETAILS -->
							<div class="banner-section details card">
								
								
								<?php
								## TYPE [notify, success, error]
								messaging("notify", "Note: Take note that you can always update this data inputted later.");
								## DECEASE NAME FOR FUNERAL, CHURCH, HEADSTONE
								if(service_type_exist_bool("funeral", $type_list) || service_type_exist_bool("church", $type_list)) {
									echo "
									<h3>Additional Details</h3>
									<div class='details-con no-padding'>
										<div class='single'>
											<label>Deceased name <span>*<span></label>
											<input type='text' name='txtdeceasedname' required>
										</div>
									</div>
									";
								}
								
								if(service_type_exist_bool("funeral", $type_list)){
									echo "
									<div class='details-con no-padding'>
										<div>
											<label>Deceased location <span>*<span></label>
											<input type='text' name='txtdecloc' required>
										</div>
										<div>
											<label>Preferred date for deceased pickup <span>*<span></label>
											<input type='date' name='dpreferred' required>
										</div>
									</div>
									<div class='details-con no-padding'>
										<div class='single'>
											<label>Delivery address <span>*<span></label>
											<input type='text' name='txtdeliveryadd' required>
										</div>
									</div>
									<h5>Funeral</h5>
									<div class='details-con'>
										<div>
											<label>Burial date & time <span>*<span></label>
											<input type='datetime-local' name='dtburial' required>
										</div>
										<div>
											<label>Burial address <span>*<span></label>
											<input type='text' name='txtburialadd' required>
										</div>
									</div>
									";
								}

								if(service_type_exist_bool("candle", $type_list)){
									echo "
									<h5>Candle</h5>
									<div class='details-con'>
										<div>
											<label>Delivery date <span>*<span></label>
											<input type='date' name='datedeliverycandle' required>
										</div>
									</div>
									";
								}

								if(service_type_exist_bool("flower", $type_list)){
									echo "
									<h5>Flowers</h5>
									<div class='details-con'>
										<div>
											<label>Delivery date <span>*<span></label>
											<input type='date' name='datedeliveryflower' required>
										</div>
										<div>
											<label>Ribbon Message <span>*<span></label>
											<input type='text' name='txtribbonmsg' required>
										</div>
									</div>
									";
								}
								
								if(service_type_exist_bool("headstone", $type_list)){
									echo "
									<h5>Headstone</h5>
									<div class='details-con'>
										<div>
											<label>Date of birth <span>*<span></label>
											<input type='date' name='datebirth' required>
										</div>
										<div>
											<label>Date of death <span>*<span></label>
											<input type='date' name='datedeath' required>
										</div>
										<div>
											<label>Delivery date <span>*<span></label>
											<input type='date' name='datedeliveryheadstone' required>
										</div>
										<div>
											<label>Message <span>*<span></label>
											<input type='text' name='txtmsg' placeholder='Write a message here for the deceased.' required>
										</div>
									</div>
									";
								}

								if(service_type_exist_bool("catering", $type_list)){
									echo "
									<h5>Catering</h5>
									<div class='details-con'>
										<div>
											<label>Delivery date & time <span>*<span></label>
											<input type='datetime-local' name='dtdelivery' required>
										</div>
										<div>
											<label>Number of pax <span>*<span></label>
											<input type='number' name='numpax' required>
										</div>
									</div>
									";
								}

								if(service_type_exist_bool("church", $type_list)){
									// echo "
									// <h5>Church</h5>
									// <div class='details-con'>
									// 	<div>
									// 		<label>Cemetery address with plan (optional)</label>
									// 		<input type='text' name='txtcemaddress'>
									// 	</div>
									// </div>
									// ";
									echo "
									<h5>Church</h5>
									<div class='details-con'>
										<div style='width:100% !important;'>
											<label>Death Date</label>
											<input type='date' name='datedeath' required>
										</div>
									</div>
									";
								}
								
								?>

							</div>
							<!-- CARD DETAILS -->
							<div class="banner-section details card">
								<select name="cbomethod" onclick="payment_method(this);">
									<option value="">BROWSE PAYMENT METHOD</option>
									<option value="gcash" selected>Gcash</option>
									<!-- <option value="card">Card</option> -->
								</select>
								
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

								<div id='gcash-payment'>
									<h3>Gcash Details 
										<ul>
											<li><i class="fa-solid fa-g"></i></li>
										</ul>
									</h3>

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
							</div>

							<button type='submit' name='btnpay' class='btn'>Pay now!</button>

							<?php

							if(isset($_POST['btnpay'])){
								## USE FOR pay_purchase() FUNCTION
								$proceed = false;
								$_SESSION['field_array'] = [$_POST['cbomethod'], trim(ucwords($_POST['txtdeceasedname'])), trim(ucwords($_POST['gcash-name'])), $_POST['gcash-num'], $total];

								if(service_type_exist_bool("funeral", $type_list)){
									if($_POST['dpreferred'] < date("Y-m-d")) {
										echo "<script>alert('Preferred date must be future date.')</script>";
									}
									else if($_POST['dpreferred'] > date("Y-m-d", strtotime($_POST['dtburial']))) {
										echo "<script>alert('Preferred date for pickup must be lesser than burial date.')</script>";
									}
									else {
										## USE FOR pay_purchase() FUNCTION
										$_SESSION['field_array_funeral'] = [trim(ucwords($_POST['txtdecloc'])), $_POST['dpreferred'], trim(ucwords($_POST['txtdeliveryadd'])), $_POST['dtburial'], trim(ucwords($_POST['txtburialadd']))];

										$proceed = true;
									}
								}

								if(service_type_exist_bool("headstone", $type_list)){
									## USE FOR pay_purchase() FUNCTION
									$_SESSION['field_array_headstone'] = [$_POST['datebirth'], $_POST['datedeath'], $_POST['datedeliveryheadstone'], trim(ucwords($_POST['txtmsg']))];

									$proceed = true;
								}

								if(service_type_exist_bool("church", $type_list)){
									## USE FOR pay_purchase() FUNCTION
									$_SESSION['field_array_church'] = [$_POST['datedeath']];

									if($_POST['datedeath'] >= date("Y-m-d")) {
										echo "<script>alert('Date death cannot be future date.')</script>";
										$proceed = false;
									}
									else $proceed = true;
									
								}
								## PAYMENT FOR GCASH
								if($_POST['cbomethod'] == "gcash" && $proceed) {
									##
									$_SESSION['type_list'] = $type_list;
									$_SESSION['list'] = $list;
									ewallet_source($_POST['cbomethod'], number_format($total,2,'',''));
								}
								// header("Location: thanks.php");
								// exit;
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
