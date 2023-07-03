<!-- HEAD AREA -->
<?php 
	include("others/functions.php");
	include("others/head.php");

	if(isset($_GET['verify'])){
		update("requirement", ["req_status"], ["verified", $_GET['verify']], "req_id");
		## SEND EMAIL
		$provider_reqs = DB::query("SELECT * FROM requirement a JOIN provider b ON a.provider_id = b.provider_id WHERE req_id = ?", array($_GET['verify']), "READ");
		$provider_reqs = $provider_reqs[0];
		##
		$subject = "Account Verification";
		$txt = "Hi {$provider_reqs['provider_fname']},\n\nAdmin successfully verified your account. You may now subscribe to post services!";
		$txt .= "\n\n\nBest regards,\nTeam Wakecords";
		##
		mail($provider_reqs['provider_email'], $subject, $txt);

		echo "<script>alert('Successfully verified user!')</script>";
	}

	if(isset($_GET['reject'])){
		update("requirement", ["req_status"], ["not verified", $_GET['reject']], "provider_id");
		## SEND EMAIL
		$reason = trim($_POST['listreason']);
		$provider_reqs = provider($_GET['reject']);
		##
		$subject = "Account Rejected";
		$txt = "Hi {$provider_reqs['provider_fname']},\n\nSorry to say this but your account has been rejected because of a ".$reason.".";
		$txt .= "\n\n\nBest regards,\nTeam Wakecords";
		##
		mail($provider_reqs['provider_email'], $subject, $txt);

		echo "<script>alert('Successfully rejected user!')</script>";
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
			$this_page = "users";
			include("others/sidebar.php"); ?>

			<!-- BANNER CONTENT -->
			<section class="banner-con">
				<div class="wrapper">
					<div class="banner-div">
						<h2>Users</h2>

						<!-- TABS -->
						<?php
						$current_tab = "users";
						$this_tab = "provider";
						include("others/tabs.php");?>
						
						<div class='banner-ratings profile-lists div-7'>
							<div class='list'>
								<div>ID#</div>
								<div>Company</div>
								<div>Name</div>
								<div>Type</div>
								<div>Address</div>
								<div>Phone</div>
								<div>Email</div>
								<div>Status</div>
								<div>Image</div>
								<div>Actions</div>
							</div>

							<?php users("provider"); ?>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
<?php
include("others/footer-js.php");
