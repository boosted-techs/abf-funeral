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
			$this_page = "transact";
			include("others/sidebar.php"); ?>

			<!-- BANNER CONTENT -->
			<section class="banner-con">
				<div class="wrapper">
					<div class="banner-div">
						<h2><a href="purchase.php">Purchase</a> <span>> <a href="status.php?purchaseid=<?php echo $_GET['purchaseid']; ?>">Status</a></span> <span>> Details</span></h2>

						<?php
						##
						$details = DB::query("SELECT * FROM details WHERE purchase_id=?", array($_GET['purchaseid']), "READ");
						$details = $details[0];

						$services = DB::query("SELECT * FROM purchase a JOIN services b ON a.service_id = b.service_id WHERE purchase_id=?", array($_GET['purchaseid']), "READ");
						$services = $services[0];

						echo "
						<form class='profile' method='post'>
							<button class='btn btn-link-absolute higher-top' type='submit' name='btnupdate'>Update</button>
							<div>
								<label>Deceased name</label>
								<input type='text' name='txtname' value='".$details['deceased_name']."'>
							</div>
						";

						switch($services['service_type']){
							## FOR FUNERAL SERVICES
							case "funeral":
								echo "
								<div>
									<label>Preferred deceased pickup date</label>
									<input type='date' name='dpreferred' value='".date("Y-m-d", strtotime($details['pickup_date']))."'>
								</div>
								<div>
									<label>Deceased location</label>
									<input type='text' name='txtdecloc' value='".$details['deceased_loc']."'>
								</div>
								<div>
									<label>Delivery address</label>
									<input type='text' name='txtdadd' value='".$details['delivery_add']."'>
								</div>
								<div>
									<label>Burial date & time</label>
									<input type='datetime-local' name='dtburial' value='".date("Y-m-d\TH:i", strtotime($details['burial_datetime']))."'>
								</div>
								<div>
									<label>Burial address</label>
									<input type='text' name='txtbadd' value='".$details['burial_add']."'>
								</div>";
							break;
							## FOR CHURCH SERVICES
							case "church":
								echo "
								<div>
									<label>Date of death</label>
									<input type='datetime-local' name='dtdeath' value='".date("Y-m-d\TH:i", strtotime($details['death_date']))."'>
								</div>
								<div style='margin-bottom:0;'>
									<label>Wake Mass Start Date: ".date("M j, Y", strtotime($services["purchase_wake_date"]))."</label>
									<input type='hidden' name='massstart' id='massstart' value='{$services["purchase_wake_date"]}' required>
								</div>
								<div style='width:100%;font-style:italic;color:gray;'>
									<label>No. of days between wake & burial mass start date: <span id='numdays1'>{$services["purchase_num_days"]}</span> days</label>
									<input type='hidden' name='numdays' id='numdays2' value='{$services["purchase_num_days"]}'>
								</div>
								<div>
									<label>Burial Mass Start Date: </label>
									<input type='date' name='burialstart' id='burialstart' value='{$services["purchase_burial_date"]}' required>
								</div>
								<div>
									<label>Burial Mass Time: </label>
									<input list='burial_time' name='burialtime' value='{$services["purchase_burial_time"]}' placeholder='Ex. 06:00pm - 07:00pm' required>
									<datalist id='burial_time'>
										<option value='03:00pm - 04:00pm'>
										<option value='04:00pm - 05:00pm'>
										<option value='05:00pm - 06:00pm'>
										<option value='06:00pm - 07:00pm'>
										<option value='07:00pm - 08:00pm'>
									</datalist>
								</div>";
							break;
							## FOR HEADSTONE SERVICES
							case "headstone":
								echo "
								<div>
									<label>Birth date</label>
									<input type='date' name='dbirth' value='".date("Y-m-d", strtotime($details['birth_date']))."'>
								</div>

								<div>
									<label>Death date</label>
									<input type='date' name='ddeath' value='".date("Y-m-d", strtotime($details['death_date']))."'>
								</div>
								
								<div>
									<label>Delivery date</label>
									<input type='date' name='ddeliver' value='".date("Y-m-d", strtotime($details['delivery_date']))."'>
								</div>
								
								<div>
									<label>Delivery address</label>
									<input type='text' name='txtdadd' value='".$details['delivery_add']."'>
								</div>
								
								<div>
									<label>Headstone message</label>
									<input type='text' name='txtmsg' value='".$details['message']."'>
								</div>
								";
							break;
						}

						echo "
						</form>";

						if(isset($_POST['btnupdate'])){
							update_details($services['service_type']);
						}
						?>
					</div>
				</div>
			</section>
		</div>
	</div>
	<script>
		// FOR NUMBER OF DAYS
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
	</script>
</body>
</html>
