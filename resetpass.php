<!-- HEAD AREA -->
<?php 
	include("others/functions.php");
	include("others/head.php"); 
	## BUTTON IS CLICKED
	if(isset($_POST['btn-reset'])){
		$emuser = trim($_POST['emuser']);
		## CHECK IF EMAIL EXIST AS USER
		$seeker = read("seeker", ["seeker_email"], [$emuser]);
		$provider = read("provider", ["provider_email"], [$emuser]);
		$admin = read("admin", ["admin_email"], [$emuser]);

		$temp_pass = password_generator(); ## GENERATES RANDOM 8-LETTER PASSWORD

		$subject = "Reset Password";
		$txt = "Hi there,\n\nPlease be advice that you must change your password after logging in.\nYou can use this temporary password: ".$temp_pass;
		$txt .= "\n\n\nBest regards,\nTeam Wakecords";

		if(empty($seeker) && empty($provider) && empty($admin)){
			echo "<script>alert('Email not registered yet! Please provide a registered email!')</script>";
		}
		else {
			if(mail($emuser, $subject, $txt)){
				if(!empty($seeker)) {
					$seeker = $seeker[0];
					update("seeker", ["seeker_pass"], [md5($temp_pass), $emuser], "seeker_email");
				}
				else if(!empty($provider)) {
					$provider = $provider[0];
					update("provider", ["provider_pass"], [md5($temp_pass), $emuser], "provider_email");
				}
				else {
					$admin = $admin[0];
					update("admin", ["admin_pass"], [md5($temp_pass), $emuser], "admin_email");
				}
				##
				echo "<script>alert('Please check your email for you temporary password!')</script>";
			}
			else
				echo "<script>alert('Error sending email!')</script>";
		}
		
		##
	}
?>

<body>
	<div class="form">
		<!-- RESET PASS AREA -->
		<div class="form-img">
			<img src="images/banner-img.jpg" alt="">
		</div>
		
		<div class="form-con">
			<div class="form-logo">
				<img src="images/main-logo.png">
			</div>
			<form method="post">
				<input type="email" name="emuser" placeholder="Email Address" required>
				<p>
					Back to login? Click <a href="index.php">here</a>.
				</p>
				<button class="btn" type="submit" name="btn-reset">Reset Pass</button>
			</form>
		</div>
	</div>
</body>
</html>
