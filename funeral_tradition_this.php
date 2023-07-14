<!-- HEAD AREA -->
<?php 
	include("others/functions.php");
	include("others/head.php"); 

	$provider = read("provider", ["provider_id"], [$_GET['id']]);
	$provider = $provider[0];

	if(isset($_GET['rated']))
		echo "<script>alert('Thank you for your feedback!')</script>";
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
							$service_type = read("services", ["service_id"], [$_GET['service_id']]);
							$service_type = $service_type[0];
							##
							$service = DB::query("SELECT * FROM services a JOIN {$service_type['service_type']} b ON a.service_id = b.service_id WHERE a.service_id=?", array($_GET['service_id']), "READ");
							$service = $service[0];
							
							if(isset($_SESSION['provider'])){
								$service_link = "services.php";
								$a_link = "services.php";
							}
							else if(isset($_SESSION['seeker'])){
								## FOR FUNERAL
								if($service_type['service_type'] == "funeral") {
									$service_link = "funeral.php";
									$a_link = "funeral_tradition.php";
								}
								## FOR CHURCH
								else if($service_type['service_type'] == "church") {
									$service_link = "church.php";
									$a_link = "church.php";
								}
								## FOR HEADSTONE
								else if($service_type['service_type'] == "headstone") {
									$service_link = "headstone.php";
									$a_link = "headstone.php";
								}
							}
							else {
								$service_link = "funeral.php";
								$a_link = "funeral_tradition.php";
							}

							if($service_type['service_type'] != "church"){
								## DECLARE ARRAYS
								$size_array = array();
								$font_array = array();
								$qty_array = array();
								// for($i=1; $i<=$service['service_qty']; $i++) array_push($qty_array, $i);
							}

							## NAME BASED ON SERVICE PROVIDER
							switch($service_type['service_type']){
								case "funeral":
									$size_array = explode(",",$service['funeral_size']);
									$qty_array = explode(",",$service['funeral_qty']);
									$price_array = explode(",",$service['funeral_price']);
									
									echo "
									<h2><a href='{$service_link}'>Services/Packages</a> <span>> <a href='{$a_link}?id={$provider['provider_id']}'>{$provider['provider_company']}</a> > {$service['funeral_name']}</span></h2>
									";
									## SERVICE NAME
									$service_name = $service['funeral_name'];
								break;

								case "headstone":
									$size_array = explode(",",$service['stone_size']);
									$font_array = explode(",",$service['stone_font']);
									## SERVICE NAME
									$service_name = $service['stone_color']." ".$service['stone_kind']." ".$service['stone_type'];
									$service_name = ucwords($service_name);
									##
									echo "
									<h2><a href='{$service_link}'>Services/Packages</a> <span>> <a href='{$a_link}'>{$provider['provider_company']}</a> > {$service_name}</span></h2>
									";
								break;

								case "church":
									echo "
									<h2><a href='{$service_link}'>Services</a> <span>> <a href='{$a_link}'>{$provider['provider_company']}</a> > {$service['church_church']}</span></h2>
									";
									## SERVICE NAME
									$service_name = $service['church_church'];
								break;
							}
						?>
						 
						<div class="banner-cards trad">
							<?php
								echo "
								<img class='card-img' src='images/providers/".$service['service_type']."/".$service['provider_id']."/".$service['service_img']."'>
								<div class='card-div'>
									<div>
										<h3>".$service_name."
											<span>
												".ratings($service['service_id'], true)."
												<i class='fa-solid fa-star'></i>
												(".ratings_count($service['service_id'], true).")
											</span>
										</h3>
										<p>
											".$service['service_desc']."
										</p>";

								if($service['service_type'] == "funeral" && isset($_SESSION['provider']))
									echo "<div class='card-price trad'>Casket Details <span style='color:gray;'>({$service['funeral_kind']})</span></div>";
								else 
									echo "<div class='card-price trad'>UGX <span id='card-price'>".number_format($service['service_cost'],2,'.',',')."</span></div>";
								
								## OUT OF STOCK IF QTY IS 0
								$qty_status = "";
								if($service_type['service_qty'] == 0 && $service['service_type'] != "funeral") $qty_status = "Out of Stock";
								##
								if(isset($_SESSION['seeker']) && !isset($_GET['rate']) && !isset($_GET['rated'])){
								echo "
								<form method='post'>
									<div class='selection-con'>";
									if($service_type['service_type'] != "church") {
										echo "
										<div class='gray-note'>
											\"Note: Sizes are measured in foot.\"
										</div>";
										## SELECT TAG FOR SIZES
										if(count($size_array) > 0 && $size_array[0] != NULL) {
											select_array($size_array, "sizes");
									 	}
										## SELECT TAG FOR QTY
										echo "
										<div>
											<label>Quantity: <span id='card-qty' style='color:red;'>{$qty_status}</span></label>
											<input type='hidden' name='maxqty' id='max-qty' value='' />
											<input type='hidden' name='hidprice' id='hidprice' value='' />
											<input type='number' name='numqty' value='' required/>
										</div>";
								 
									## FOR CHURCH
									} else {
									// echo time_available($service['church_mass_time'], $_GET['service_id']);
										echo mass_required_details();
									}
								echo "
									</div>	
										<button type='submit' name='btnadd' class='btn trad' onclick=\"return confirm('Confirm booking?');\">Book now</button>
								</form>";
								}
								## FOR PROVIDER & ADMIN
								else {
									if($service_type['service_type'] != "church" && $service_type['service_type'] != "funeral")
										echo "<h4 style='color:gray'>QUANTITY: x{$service['service_qty']}</h4>";
									
									if($service_type['service_type'] == "funeral"){
										echo "
										<ul class='desc-table main'>
											<li>Size (ft.)</li>
											<li>Quantity</li>
											<li>Price per qty</li>
										</ul>";
										
										for($i=0; $i<count($size_array); $i++){
											echo "
											<ul class='desc-table body'>
												<li>{$size_array[$i]}</li>
												<li>{$qty_array[$i]}</li>
												<li>UGX ".number_format($price_array[$i],2,'.',',')."</li>
											</ul>
											";
										}
									}
								}
								echo "
									</div>
								</div>";
								##
								if(isset($_POST['btnadd'])){
									$proceed = true;
									##
									switch($service_type['service_type']){
										## FOR FUNERAL
										case "funeral":
											$maxqty = $_POST['maxqty']; // OUTPUT "Out of Stock" or a number
											$hidprice = $_POST['hidprice'];
											$numqty = $_POST['numqty'];
											$cbosize = $_POST['cbosizes'];
											// 
											if($maxqty == "Out of Stock"){
												echo "<script>alert('Out of Stock! Cannot proceed.')</script>";
												$proceed = false;
											}
											else if($numqty > $maxqty) {
												echo "<script>alert('Inputted quantity is more than the available quantity!')</script>";
												$proceed = false;
											}
											else {
												$attr_list = ["service_id", "seeker_id", "cart_qty", "cart_size", "cart_price"];
												$data_list = [$service['service_id'], $_SESSION['seeker'], $numqty, $cbosize, $hidprice];
											}

										break;
										## FOR CHURCH
										case "church":
											$numdays = $_POST['numdays'];
											$massstart = $_POST['massstart'];
											$burialstart = $_POST['burialstart'];
											$waketime = trim($_POST['waketime']);
											$burialtime = trim($_POST['burialtime']);
											// CHECK IF CHURCH SERVICE EXIST IN PURCHASE
											$services = DB::query("SELECT * FROM purchase a JOIN services b ON a.service_id = b.service_id WHERE seeker_id = ?", array($_SESSION['seeker']), "READ");
											// 
											if(count($services) > 0){
												foreach($services as $service){
													// IF ALREADY HAVE PURCHASE CHURCH MASS SERVICE
													if($service['service_type'] == "church" && $service['purchase_status'] != "done" && $service['purchase_status'] != "rated"){
														$proceed = false;
														break;
													}
												}
											}
											// CHECK IF CHURCH SERVICE EXIST IN CART
											$services = DB::query("SELECT * FROM cart a JOIN services b ON a.service_id = b.service_id WHERE seeker_id = ?", array($_SESSION['seeker']), "READ");
											// 
											if(count($services) > 0){
												foreach($services as $service){
													// IF ALREADY HAVE PURCHASE CHURCH MASS SERVICE
													if($service['service_type'] == "church"){
														$proceed = false;
														break;
													}
												}
											}

											if($massstart < date("Y-m-d") || $burialstart < date("Y-m-d")){
												echo "<script>alert('Start Date must be future dates.')</script>";
												$proceed = false;
											}
											else if($massstart > $burialstart) {
												echo "<script>alert('Start cannot be greater than End date start.')</script>";
												$proceed = false;
											}
											else {
												if($proceed){
													$attr_list = ["service_id", "seeker_id", "cart_wake_start_date", "cart_wake_time", "cart_num_days", "cart_burial_start_date", "cart_burial_time"];
													$data_list = [$_GET['service_id'], $_SESSION['seeker'], $massstart, $waketime, $numdays, $burialstart, $burialtime];
												} 
												else {
													echo "<script>alert('You cannot book a package you already booked.')</script>";
												}
											}
											
										break;
										## FOR HEADSTONE
										case "headstone":
											$cbomaxqty = $_POST['cboquantity'];
											$cbosize = $_POST['cbosizes'];
											$cbofont = $_POST['cbofonts'];
											$attr_list = ["service_id", "seeker_id", "cart_qty", "cart_size", "cart_font"];
											$data_list = [$service['service_id'], $_SESSION['seeker'], $cbomaxqty, $cbosize, $cbofont];
										break;
									}
									
									##
									if($proceed){
										create("cart", $attr_list, qmark_generator(count($attr_list)), $data_list);

										header("Location: cart.php?cart_success");
										exit;
									}
								}
							?>
							
						</div>
						<div class="banner-ratings" id="ratings">
							<h2>Reviews</h2>
								
							<?php
							## BUTTON REVIEW IS CLICKED
							if(isset($_POST['btnrev'])) rate();

							if(isset($_GET['rate'])){
								messaging("notify", "Leave a review below by clicking <mark class='mark-style' id='open-subs'>here</mark>");
							}
							?>
							<!-- DIALOG FOR LEAVING A REVIEW -->
							<dialog class='modal-img' id='modal-subs'>
								<button id='close-subs'>+</button>
								<form class="feedback" method='post'>
									<h2>Leave a Review</h2>
									<p>Thank you!</p>
									<div class="rating-con">
										<div class="rating">
											<input type="radio" id="star5" name="star" value="5" required><label for="star5" title='Excellent'></label>
											<input type="radio" id="star4" name="star" value="4" required><label for="star4" title='Very Good'></label>
											<input type="radio" id="star3" name="star" value="3" required><label for="star3" title='Good'></label>
											<input type="radio" id="star2" name="star" value="2" required><label for="star2" title='Bad'></label>
											<input type="radio" id="star1" name="star" value="1" required><label for="star1" title='Very Bad'></label>
										</div>
										<textarea name="txtrev" placeholder='Leave a comment (optional)'></textarea>
										<button type='submit' name='btnrev' class="btn trad">Review</button>
									</div>
								</form>
							</dialog>

							<div class="ratings-con">
							<?php
							$ratings = read("feedback", ["service_id"], [$_GET['service_id']]);
							
							if(count($ratings)>0){
								foreach($ratings as $result){
									$seeker = read("seeker", ["seeker_id"], [$result['seeker_id']]);
									$seeker = $seeker[0];
									$days = (strtotime(date('Y-m-d')) - strtotime(date($result['feedback_date']))) /60/60/24;
									
									echo "
									<div class='rate'>
									";
									##
									if($days == 0) {
										echo "
										<span>
											<mark class='mark-style no-cursor'>new ratings</mark>	
										</span>
										";
									}
									else {
										echo "
										<span class='gray-italic'>
											rated ".$days." days ago
										</span>
										";
									}
									##
									echo "
										<h3>{$seeker['seeker_fname']} {$seeker['seeker_lname']}
											<span>
												".display_stars($result['feedback_star'])."
											</span>
										</h3>
										<p>{$result['feedback_comments']}</p>
									</div>
									";
								}
							}
							else messaging("notify", "No reviews yet!");
							?>

							</div>
							
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
	<script>
	<?php if(isset($_GET['rate'])) { ?>
		// FOR REVIEW MODAL
		let review = document.querySelector('#modal-subs');
		let open_review = document.querySelector('#open-subs');
		let close_review = document.querySelector('#close-subs');

		review.showModal();

		open_review.addEventListener('click', () => {
			review.showModal();
		})

		close_review.addEventListener('click', () => {
			review.close();
		})
	<?php } ?>

	// FOR NUMBER OF DAYS $service_type['service_type']
	<?php if($service_type['service_type'] == "church") { ?>
	let massstart = document.getElementById("massstart");
	let burialstart = document.getElementById("burialstart");
	let num_days1 = document.getElementById("numdays1");
	let num_days2 = document.getElementById("numdays2");
	
	burialstart.onchange = function () {
		let startdate = new Date(massstart.value);
		let enddate = new Date(burialstart.value);
		let daysBetweenDates = enddate.getTime() - startdate.getTime();
		let days = Math.ceil(daysBetweenDates / (1000 * 60 * 60 * 24));

		if(Number.isInteger(days) && days > 0) {
			num_days1.innerHTML = days;
			num_days2.value = days;
		}
		else {
			num_days1.innerHTML = 0;
			num_days2.value = 0;
		}
	}

	massstart.onchange = function () {
		let startdate = new Date(massstart.value);
		let enddate = new Date(burialstart.value);
		let daysBetweenDates = enddate.getTime() - startdate.getTime();
		let days = Math.ceil(daysBetweenDates / (1000 * 60 * 60 * 24));

		if(Number.isInteger(days) && days > 0) {
			num_days1.innerHTML = days;
			num_days2.value = days;
		}
		else {
			num_days1.innerHTML = 0;
			num_days2.value = 0;
		}
	}
	<?php } ?>

	<?php if($service_type['service_type'] == "funeral") { ?>
	// WHEN ON CHANGE IN SIZES 
	let cardSize = document.getElementById("card-sizes")
	
	cardSize.onchange = function () {
		let cardQty = document.getElementById("card-qty")
		let maxQty = document.getElementById("max-qty")
		let cardPrice = document.getElementById("card-price")
		let hidPrice = document.getElementById("hidprice")

		let stringSize = '<?php echo $service['funeral_size']; ?>'
		let stringQty = '<?php echo $service['funeral_qty']; ?>'
		let stringPrice = '<?php echo $service['funeral_price']; ?>'

		console.log(stringSize.split(","))
		cardQty.innerHTML = return_qty(stringSize.split(","), cardSize.value, stringQty.split(","))
		maxQty.value = cardQty.innerHTML
		cardPrice.innerHTML = return_formatted_price(stringSize.split(","), cardSize.value, stringPrice.split(","), true)
		hidPrice.value = return_formatted_price(stringSize.split(","), cardSize.value, stringPrice.split(","))
	}
	<?php } ?>

	function return_qty(size_array, size, my_array){
		index = 0
		for(let i=0; i<size_array.length; i++){
			if(size == size_array[i]) index = i
		}

		if(my_array[index] == 0)
			return "Out of Stock"
		else return my_array[index]
	}

	function return_formatted_price(size_array, size, my_array, bool=false){
		index = 0
		for(let i=0; i<size_array.length; i++){
			if(size == size_array[i]) index = i
		}
		
		if(bool) // RETURN NUMBER FORMAT IN JS
			return parseInt(my_array[index]).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
		else return my_array[index]
	}
	</script>
<!-- FOOTER JS -->
<?php include("others/footer-js.php"); ?>
