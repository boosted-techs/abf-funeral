<!-- HEAD AREA -->
<?php 
	include("others/functions.php");
	include("others/head.php");

	if(isset($_POST['btnreject'])){
		$reason = trim($_POST['reason']);
		$txtwake = trim($_POST['txtwake']);
		$txtburial = trim($_POST['txtburial']);
		$success = false;

		$seeker = DB::query("SELECT * FROM purchase a JOIN seeker b ON a.seeker_id = b.seeker_id WHERE purchase_id = ?", array($_GET['purchase_id']), "READ");
		$seeker = $seeker[0];
		$subject = "Purchase Rejected";
		## SEND EMAIL | MESSAGE
		$txt = "Hi {$seeker['seeker_fname']},\n\nPlease be advise that your purchase is rejected because your {$reason}.";
		## SUGGESTIONS FOR WAKE MASS TIME
		if(!empty($txtwake)){
			$txt .= "\nSuggestions for wake mass time: {$txtwake}.";
		}
		## SUGGESTIONS FOR BURIAL MASS TIME
		if(!empty($txtburial)){
			$txt .= "\nSuggestions for burial mass time: {$txtburial}.";
		}

		$txt .= "\nThank you for understanding!\n\n\nBest regards,\nTeam Wakecords";

		## SEND EMAIL
		try {
			mail($seeker['seeker_email'], $subject, $txt); // $seeker['seeker_email']
			$success = true;
		}
		catch (Exception $e) {
			echo "<script>alert('Error sending email! Error found: ".$e->getMessage()."')</script>";
		}

		if($success) {
			## UPDATE PURCHASE STATUS
			update("purchase", ["purchase_status"], ["rejected", $_GET['purchase_id']], "purchase_id");

			header("Location: purchase.php");
			exit;
		}
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
						<h2><a href="purchase.php">Purchase</a> <span>> Reject</span></h2>
						<form class="profile column" method="post">
							<div>
								<label>Reason for rejection</label>
								<input list='reason' name='reason' required>
								<datalist id='reason'>
									<option value="wake mass time conflicts">
									<option value="burial mass time conflicts">
								</datalist>
							</div>
							<div>
								<label>Time Suggestions</label>
								<input list="wake_time" name="txtwake" placeholder="(Optional) Wake mass time ex. 06:00pm - 07:00pm">
								<datalist id='wake_time'>
									<option value='03:00pm - 04:00pm'>
									<option value='04:00pm - 05:00pm'>
									<option value='05:00pm - 06:00pm'>
									<option value='06:00pm - 07:00pm'>
									<option value='07:00pm - 08:00pm'>
								</datalist>
							</div>
							<div>
								<input list="burial_time" name="txtburial" placeholder="(Optional) Burial mass time ex. 06:00pm - 07:00pm">
								<datalist id='burial_time'>
									<option value='03:00pm - 04:00pm'>
									<option value='04:00pm - 05:00pm'>
									<option value='05:00pm - 06:00pm'>
									<option value='06:00pm - 07:00pm'>
									<option value='07:00pm - 08:00pm'>
								</datalist>
							</div>
							<button class="btn" type="submit" name="btnreject">Reject</button>
						</form>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
</html>
