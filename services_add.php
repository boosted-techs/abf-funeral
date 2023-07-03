<!-- HEAD AREA -->
<?php 
	include("others/functions.php");
	include("others/head.php"); 

	$user = provider();

	## 
	if(isset($_POST['btnadd'])) {
		service_adding();
	}
	## UPDATE FOR NO BOOKING
	if(isset($_POST['btn_upd0'])){
		service_adding();
		##
		if(isset($_POST['cblogo'])) {
			header("Location: deleting.php?table={$user['provider_type']}&attr=service_id&data=".$_GET['id']."&url=services&update&logo");
			exit;
		}
		else {
			header("Location: deleting.php?table={$user['provider_type']}&attr=service_id&data=".$_GET['id']."&url=services&update");
			exit;
		}
	}
	## UPDATE WITH BOOKING
	if(isset($_POST['btn_upd1'])){
		service_editing($_GET['id']);
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
						<h2><a href="services.php">Services</a> <span>> <?php echo (isset($_GET['edit'])) ? "Edit":"Add"; ?> Services</span></h2>
						<em style='color:#ccc;'> Service: <?php echo ucwords($user['provider_type']); ?> </em>

						<?php
						// } else {
						## FOR ADDING SERVICES
						## DECLARING VARIABLES
						$edit = false;
						$desc = "";
						$width = "";

						if(isset($_GET['edit']) && service_is_booked($_GET['id'])) $edit = true;
						?>
						
						<form class="profile <?php echo ($edit) ? "column":""; ?>" method="post" enctype="multipart/form-data">
							<?php 
							## FOR EDITING SERVICES
							if(isset($_GET['edit'])){
								$edit = true;
								##
								$service = read("services", ["service_id"], [$_GET['id']]);
								$service = $service[0];
								##
								$type = read($service['service_type'], ["service_id"], [$_GET['id']]);
								$type = $type[0];
								## PREVIEW IMAGE DIALOG
								echo "
								<dialog class='modal-img aspect-ratio' id='modal-img'>
									<button id='close-img'>+</button>
									<figure>
										<img src='images/providers/".$service['service_type']."/".$_SESSION['provider']."/".$service['service_img']."'>
									</figure>
								</dialog>
								";
								## NO ONE BOOKED
								if(isset($_GET['book'])){
									echo "<button class='btn btn-link-absolute higher-top' type='submit' name='btn_upd0'>Update Service</button>";
								## WITH BOOKING
								} else {
									echo "<button class='btn btn-link-absolute higher-top' type='submit' name='btn_upd1'>Update Service</button>";
								}
							## FOR ADDING SERVICES
							} else {
								echo "<button class='btn btn-link-absolute higher-top' type='submit' name='btnadd'>Add Service</button>";
							}

							// $others = "
							// <label class='label-span'>Others <span>(please specify separated by comma)</span></label>
							// <div>
							// 	<input type='text' name='txtothers' placeholder='Sample#1, Sample#2, Sample#3' value='";
							// $others .= ($edit) ? return_value("services", $_GET['id'], "others"):"";
							// $others .= "' >
							// </div>";
							## DO THIS IF SERVICE HAS NO BOOKING
							if((isset($_GET['edit']) && !service_is_booked($_GET['id'])) || $edit == false){
							## FOR CHECKBOX TO USE IMAGE
							if($edit){
								// echo "
								// <div style='width:100%;' class='checkbox'>
								// 	<div class='full'>
								// 		<input id='profile-logo' type='checkbox' name='cblogo'>
								// 		<label class='label-span'><span>Check to use existing service image below.</span></label>
								// 	</div>
								// </div>";
							}
							##
							echo "
							<div>
								<label>Image 
							";
							## FOR PREVIEWING 
							if($edit) echo "<mark class='mark-style' id='open-img'>preview</mark>"; ## ↑ 
							##
							echo "
								</label>
								<input id='image-file' type='file' name='file_img' required>
							</div>
							";
							// echo ($edit) ? "":"required";
							
							## SWITCH FOR DIFFERENT PROVIDER TYPE
							switch($user['provider_type']){
								## FOR FUNERAL SERVICES
								case "funeral":
									$width = "style='width:24%;'";
									if($edit){
										$funeral_sizes = explode(",",$type['funeral_size']);
										$funeral_qtys = explode(",",$type['funeral_qty']);
										$funeral_prices = explode(",",$type['funeral_price']);
										$count_value = count($funeral_sizes);
									}
									else $count_value = 1;
									##
									echo "
									<div>
										<label>Service Name</label>
										<input type='text' name='txtsname' value='"; 
										echo ($edit) ? return_value("services", $_GET['id'], "name"):"";
										echo "' required>
									</div>
									<div>
										<label>Type</label>
										<select name='cbotype' required>
											<option value=''>BROWSE OPTIONS </option>
											<option value='traditional'";
											echo ($edit) ? return_value("services", $_GET['id'], "type", "traditional"):"";
											echo ">Traditional</option>
											<option value='cremation'";
											echo ($edit) ? return_value("services", $_GET['id'], "type", "cremation"):"";
											echo ">Cremation</option>
										</select>
									</div>
									<div>
										<label>Kind</label>
										<select name='cbokind'>
											<option>BROWSE OPTIONS</option>
											<option value='metal'";
											echo ($edit) ? return_value("services", $_GET['id'], "kind", "metal"):"";
											echo ">Metal</option>
											<option value='wooden'";
											echo ($edit) ? return_value("services", $_GET['id'], "kind", "wooden"):"";
											echo ">Wooden</option>
										</select>
									</div>
									<div id='main-div' style='width:100%;'>
										<h3 style='margin-bottom:0;'>Casket Details <span class='status' id='add-desc' style='vertical-align:middle;margin:0 0 10px;'>+ Add New Details</span></h3>
										<input id='count' type='hidden' name='numcount' value='";
										## VALUE OF COUNT
										echo $count_value;
										echo "' />
										<div class='checkbox'>
											<div class='desc'>
												<label>Size (ft.)</label>
												<input type='text' name='txtsize1' placeholder='Ex. 6x3x4 (Length x Width x Height)' value='"; 
												echo ($edit) ? $funeral_sizes[0]:"";
												echo "' required />
											</div>
											<div class='desc'>
												<label>Quantity</label>
												<input type='number' name='numqty1' placeholder='' value='"; 
												echo ($edit) ? $funeral_qtys[0]:"";
												echo "' required/>
											</div>
											<div class='desc'>
												<label>Price</label>
												<input type='number' name='numprice1' value='"; 
												echo ($edit) ? $funeral_prices[0]:"";
												echo "' required/>
											</div>
										</div>";
										if($edit && $count_value >= 2){
											for($i=2; $i<=$count_value; $i++){
												echo "
												<div class='checkbox'>
													<div class='desc'>
														<label>Size</label>
														<input type='text' name='txtsize{$i}' placeholder='Ex in ft. 6x3x4 (Length x Width x Height)' value='{$funeral_sizes[$i-1]}' />
													</div>
													<div class='desc'>
														<label>Quantity</label>
														<input type='number' name='numqty{$i}' placeholder='' value='{$funeral_qtys[$i-1]}'/>
													</div>
													<div class='desc'>
														<label>Price</label>
														<input type='number' name='numprice{$i}' value='{$funeral_prices[$i-1]}'/>
													</div>
												</div>";
											}
										}
										echo "
									</div>
									";
								break;
								## FOR CHURCH SERVICES
								case "church":
									// <div>
									// 	<label>Date</label>
									// 	<input type='date' name='date' value='"; 
									// 	echo ($edit) ? return_value("services", $_GET['id'], "date"):"";
									// 	echo "' required>
									// </div>
									$width = "style='width:100%;'";

									// ## GETTING THE SPECIFIC ADDRESSES
									// if(user_type() == 'seeker') $address = $user['seeker_address'];
									// else $address = $user['provider_address'];
									// $empty_address = false;
									// ## CHECK IF ADDRESS IS EMPTY
									// if(empty($address)) $empty_address = true;
									// ## EXPLODED ADDRESS
									// $address = explode(",", $address);

									echo "
									<div>
										<label>Priest</label>
										<input type='text' name='txtpriest' value='"; 
										echo ($edit) ? return_value("services", $_GET['id'], "priest"):"";
										echo "' required>
									</div>
									<div>
										<label>Church</label>
										<input type='text' name='txtsname' value='"; 
										echo ($edit) ? return_value("services", $_GET['id'], "name"):"";
										echo "' required>
									</div>
									<div>
										<label>Cemetery</label>
										<input type='text' name='txtcemetery' value='"; 
										echo ($edit) ? return_value("services", $_GET['id'], "cemetery"):"";
										echo "' required>
									</div>

									<h3 style='width:100%;'>Complete Address</h3>
									<div style='width:100%;' class='checkbox'>
										<div class='full'>
											<input id='profile-address' type='checkbox' name='cbaddress'>
											<label class='label-span'><span>Check to use address in Profile.</span></label>
										</div>
									</div>

									<div>
										<label>House No. / Street</label>
										<input id='street' class='' type='text' name='txtstreet' value='"; 
										echo ($edit) ? return_value("services", $_GET['id'], "address_street"):"";
										echo "' required>
									</div>
									<div>
										<label>Sitio / Barangay</label>
										<input id='brgy' class='' type='text' name='txtbrgy' value='"; 
										echo ($edit) ? return_value("services", $_GET['id'], "address_brgy"):"";
										echo "' required>
									</div>
									<div>
										<label>Province</label>
										<input id='province' class='' type='text' name='txtprovince' value='"; 
										echo ($edit) ? return_value("services", $_GET['id'], "address_province"):"";
										echo "' required>
									</div>
									<div>
										<label>City</label>
										<input id='city' class='' type='text' name='txtcity' value='"; 
										echo ($edit) ? return_value("services", $_GET['id'], "address_city"):"";
										echo "' required>
									</div>
									";
								break;
								## FOR HEADSTONE SERVICES
								case "headstone":
									## HEADSTONE NAME IS A COMBINATION OF COLOR AND TYPE
									echo "
									<div>
										<label>Stone Type</label>
										<select name='cbotype' required>
											<option value=''>BROWSE OPTIONS </option>
											<option value='granite'";
											echo ($edit) ? return_value("services", $_GET['id'], "type", "granite"):"";
											echo ">Granite</option>
											<option value='marbles'";
											echo ($edit) ? return_value("services", $_GET['id'], "type", "marbles"):"";
											echo ">Marbles</option>
											<option value='bronze'";
											echo ($edit) ? return_value("services", $_GET['id'], "type", "bronze"):"";
											echo ">Bronze</option>
											<option value='limestone'";
											echo ($edit) ? return_value("services", $_GET['id'], "type", "limestone"):"";
											echo ">Limestone</option>
										</select>
									</div>
									<div>
										<label>Headstone Kind</label>
										<select name='cbokind' required>
											<option value=''>BROWSE OPTIONS </option>
											<option value='flat'";
											echo ($edit) ? return_value("services", $_GET['id'], "kind", "flat"):"";
											echo ">Flat</option>
										</select>
									</div>
									<div>
										<label>Color</label>
										<div class='checkbox'>
											<div>
												<input type='radio' name='cbcolor' value='black'";
												echo ($edit) ? return_value("services", $_GET['id'], "color", "black"):"";
												echo " required>
												<label>Black</label>
											</div>
											<div>
												<input type='radio' name='cbcolor' value='gray'";
												echo ($edit) ? return_value("services", $_GET['id'], "color", "gray"):"";
												echo " required>
												<label>Gray</label>
											</div>
											<div>
												<input type='radio' name='cbcolor' value='white'";
												echo ($edit) ? return_value("services", $_GET['id'], "color", "white"):"";
												echo " required>
												<label>White</label>
											</div>
										</div>
									</div>
									<div>
										<label class='label-span'>Font Available <span>(check all that applies)</span></label>
										<div class='checkbox'>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #1'";
												echo ($edit) ? return_value("services", $_GET['id'], "font", "font #1"):"";
												echo ">
												<label>Font #1</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #2'";
												echo ($edit) ? return_value("services", $_GET['id'], "font", "font #2"):"";
												echo ">
												<label>Font #2</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #3'";
												echo ($edit) ? return_value("services", $_GET['id'], "font", "font #3"):"";
												echo ">
												<label>Font #3</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #4'";
												echo ($edit) ? return_value("services", $_GET['id'], "font", "font #4"):"";
												echo ">
												<label>Font #4</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #5'";
												echo ($edit) ? return_value("services", $_GET['id'], "font", "font #5"):"";
												echo ">
												<label>Font #5</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #6'";
												echo ($edit) ? return_value("services", $_GET['id'], "font", "font #6"):"";
												echo ">
												<label>Font #6</label>
											</div>
										</div>
										{$others}
									</div>
									<div>
										<label class='label-span'>Size Available <span>(check all that applies)</span></label>
										<div class='checkbox'>
											<div>
												<input type='checkbox' name='cbsize[]' value='size #1'";
												echo ($edit) ? return_value("services", $_GET['id'], "size", "size #1"):"";
												echo ">
												<label>Size #1</label>
											</div>
											<div>
												<input type='checkbox' name='cbsize[]' value='size #2'";
												echo ($edit) ? return_value("services", $_GET['id'], "size", "size #2"):"";
												echo ">
												<label>Size #2</label>
											</div>
											<div>
												<input type='checkbox' name='cbsize[]' value='size #3'";
												echo ($edit) ? return_value("services", $_GET['id'], "size", "size #3"):"";
												echo ">
												<label>Size #3</label>
											</div>
											<div>
												<input type='checkbox' name='cbsize[]' value='size #4'";
												echo ($edit) ? return_value("services", $_GET['id'], "size", "size #4"):"";
												echo ">
												<label>Size #4</label>
											</div>
											<div>
												<input type='checkbox' name='cbsize[]' value='size #5'";
												echo ($edit) ? return_value("services", $_GET['id'], "size", "size #5"):"";
												echo ">
												<label>Size #5</label>
											</div>
											<div>
												<input type='checkbox' name='cbsize[]' value='size #6'";
												echo ($edit) ? return_value("services", $_GET['id'], "size", "size #6"):"";
												echo ">
												<label>Size #6</label>
											</div>
										</div>
										<label class='label-span'>Others <span>(please specify separated by comma)</span></label>
										<div>
											<input type='text' name='txtothers1' placeholder='Sample#1, Sample#2, Sample#3' value='"; 
											echo ($edit) ? return_value("services", $_GET['id'], "others1"):"";
											echo "'>
										</div>
									</div>
									";
								break;
								## FOR CANDLE SERVICES
								case "candle":
									$width = "style='width:24%;'";
									##
									echo "
									<div>
										<label>Service Name</label>
										<input type='text' name='txtsname' value='' required>
									</div>
									<div>
										<label class='label-span'>Color Available <span>(check all that applies)</span></label>
										<div class='checkbox'>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #1'>
												<label>Color #1</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #2'>
												<label>Color #2</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #3'>
												<label>Color #3</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #4'>
												<label>Color #4</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #5'>
												<label>Color #5</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #1'>
												<label>Color #6</label>
											</div>
										</div>
										{$others}
									</div>
									<div>
										<label class='label-span'>Size Available <span>(check all that applies)</span></label>
										<div class='checkbox'>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #1'>
												<label>Size #1</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #2'>
												<label>Size #2</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #3'>
												<label>Size #3</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #4'>
												<label>Size #4</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #5'>
												<label>Size #5</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #1'>
												<label>Size #6</label>
											</div>
										</div>
										<label class='label-span'>Others <span>(please specify separated by comma)</span></label>
										<div>
											<input type='text' name='txtothers1' placeholder='Sample#1, Sample#2, Sample#3'>
										</div>
									</div>
									<div>
										<label>Candle Type</label>
										<select name='cbotype' required>
											<option value=''>BROWSE OPTIONS </option>
											<option value='flat'>Box</option>
											<option value='flat'>Cylinder</option>
										</select>
									</div>
									";
								break;
								## FOR FLOWER SERVICES
								case "flower":
									$width = "style='width:24%;'";
									##
									echo "
									<div>
										<label>Service Name</label>
										<input type='text' name='txtsname' value='' required>
									</div>
									<div>
										<label class='label-span'>Flower Type <span>(check all that applies)</span></label>
										<div class='checkbox'>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #1'>
												<label>Flower Type #1</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #2'>
												<label>Flower Type #2</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #3'>
												<label>Flower Type #3</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #1'>
												<label>Flower Type #4</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #2'>
												<label>Flower Type #5</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #3'>
												<label>Flower Type #6</label>
											</div>
										</div>
										{$others}
									</div>
									<div>
										<label class='label-span'>Color Available <span>(check all that applies)</span></label>
										<div class='checkbox'>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #1'>
												<label>Color #1</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #2'>
												<label>Color #2</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #3'>
												<label>Color #3</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #4'>
												<label>Color #4</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #5'>
												<label>Color #5</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #1'>
												<label>Color #6</label>
											</div>
										</div>
										<label class='label-span'>Others <span>(please specify separated by comma)</span></label>
										<div>
											<input type='text' name='txtothers1' placeholder='Sample#1, Sample#2, Sample#3'>
										</div>
									</div>
									<div>
										<label>Flower</label>
										<input type='text' name='txtfn' required>
									</div>
									";
								break;
								## FOR CATERING SERVICES
								case "catering":
									echo "
									<div>
										<label>Service Name</label>
										<input type='text' name='txtsname' value='' required>
									</div>
									<div style='width:100%;'>
										<label class='label-span'>Food Package <span>(check all that applies)</span></label>
										<div class='checkbox'>
											<div>
												<input type='checkbox' name='cbfont[]' value='food #1'>
												<label>Lechon Baboy</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #2'>
												<label>Food #1</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #3'>
												<label>Food #2</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #4'>
												<label>Food #3</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #5'>
												<label>Food #4</label>
											</div>
											<div>
												<input type='checkbox' name='cbfont[]' value='font #1'>
												<label>Food #5</label>
											</div>
										</div>
										{$others}
									</div>
									";
								break;
							}
							## PAMISA PRICE
							if($user['provider_type'] != "funeral"){
								echo "
								<div {$width}>
									<label>Price</label>
									<input type='number' name='numprice' placeholder='Ex. 50000 for 50k' value='";
									echo ($edit) ? return_value("services", $_GET['id'], "price"):"";
									echo "' required>
								</div>
								";
							}

							} ## END OF, IF SERVICE IS NOT BOOKED
							
							if($user['provider_type'] != "catering" && $user['provider_type'] != "church" && $user['provider_type'] != "funeral"){
								echo "
								<div {$width}>
									<label>Quantity</label>
									<input type='number' name='numqty' value='";
									echo ($edit) ? return_value("services", $_GET['id'], "qty"):"";
									echo "' required>
								</div>
								";
							}

							if($user['provider_type'] == "church" && false){
								echo "
								<div style='width:100%;'>
									<label class='label-span'>Time <span>(please follow time format, separated by comma)</span></label>
									<input type='text' name='txttime' value='";
									echo ($edit) ? return_value("services", $_GET['id'], "time"):"10:00am - 11:00am, 11:00am - 12:00nn, 12:00nn - 01:00pm, 01:00pm - 02:00pm, 02:00pm - 03:00pm";
									echo "' required>
								</div>
								";
							}
							## FOR DESCRIPTIONS WIDTH
							if(isset($_GET['edit']) && service_is_booked($_GET['id']) && $user['provider_type'] != "church") {
								$width = "width:49.3%;";
							}
							else {
								$width = "width:100%;";
							}
							?>

							<div style='<?php echo $width; ?>'>
								<label class='label-span'>Description <span><?php echo (!empty($desc)) ? "({$desc})":""; ?></span></label>
								<textarea name="txtdesc" placeholder='Write here...' required><?php echo ($edit) ? return_value("services", $_GET['id'], "desc"):""; ?></textarea>
							</div>
						</form>
						<?php
						// }
						?>
					</div>
				</div>
			</section>
		</div>
	</div>
	<script>
	<?php 
	## FOR MODAL
	if($edit) { ?>
		let img = document.querySelector('#modal-img');
		let open = document.querySelector('#open-img');
		let close = document.querySelector('#close-img');

		open.addEventListener('click', () => {
			img.showModal();
		})

		close.addEventListener('click', () => {
			img.close();
		})
	<?php 
	} 
	
	if($user['provider_type'] == "church") { ?>
		let p_address = document.getElementById('profile-address');
		let street = document.getElementById('street');
		let brgy = document.getElementById('brgy');
		let province = document.getElementById('province');
		let city = document.getElementById('city');

		p_address.addEventListener("click", () => {
			if(p_address.checked) {
				street.classList.add("readonly");
				street.readOnly = true;
				street.required = false;

				brgy.classList.add("readonly");
				brgy.readOnly = true;
				brgy.required = false;

				province.classList.add("readonly");
				province.readOnly = true;
				province.required = false;

				city.classList.add("readonly");
				city.readOnly = true;
				city.required = false;
			} else {
				street.classList.remove("readonly");
				street.readOnly = false;
				street.required = true;

				brgy.classList.remove("readonly");
				brgy.readOnly = false;
				brgy.required = true;

				province.classList.remove("readonly");
				province.readOnly = false;
				province.required = true;

				city.classList.remove("readonly");
				city.readOnly = false;
				city.required = true;
			}
		})

		// FOR SERVICE IMAGE
		let profile_logo = document.getElementById("profile-logo");
		let image_file = document.getElementById("image-file");

		profile_logo.addEventListener("click", () => {
			if(profile_logo.checked){
				image_file.classList.add("readonly");
				image_file.readOnly = true;
				image_file.required = false;
			}
			else {
				image_file.classList.remove("readonly");
				image_file.readOnly = false;
				image_file.required = true;
			}
		})
	<?php
	} ?>

	let addDesc = document.getElementById("add-desc")
	let counter = document.getElementById("count")
	let count = counter.value

	addDesc.addEventListener("click", () => {
		count = parseInt(count) + 1
		counter.value = count

		let mainDiv = document.getElementById("main-div")
		let element1 = document.createElement("div")
		element1.className = "checkbox"

		let element2 = document.createElement("div")
		element2.className = "desc"

		let element3 = document.createElement("label")
		element3.innerText= "Size"

		let element4 = document.createElement("input")
		element4.setAttribute("type", "text")
		element4.setAttribute("name", "txtsize"+count)
		element4.setAttribute("placeholder", "Example in ft. 6x3x4 (Length x Width x Height)")

		let element5 = document.createElement("div")
		element5.className = "desc"

		let element6 = document.createElement("label")
		element6.innerText= "Quantity"

		let element7 = document.createElement("input")
		element7.setAttribute("type", "number")
		element7.setAttribute("name", "numqty"+count)

		let element8 = document.createElement("div")
		element8.className = "desc"

		let element9 = document.createElement("label")
		element9.innerText= "Price"

		let element10 = document.createElement("input")
		element10.setAttribute("type", "number")
		element10.setAttribute("name", "numprice"+count)

		mainDiv.appendChild(element1)
		element1.append(element2, element5, element8)
		// DESC 1
		element2.append(element3, element4)
		// DESC 2
		element5.append(element6, element7)
		// DESC 3
		element8.append(element9, element10)
	})
	</script>
</body>
</html>
