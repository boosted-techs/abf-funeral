<?php
	include("others/functions.php");
	##
	$checker = false;
	## DELETE IN DATABASE
	if(isset($_GET['table']) && isset($_GET['attr']) && isset($_GET['data'])) {
		if($_GET['table'] == "funeral" || $_GET['table'] == "headstone" || $_GET['table'] == "church"){
			## DELETE TABLE
			delete($_GET['table'], $_GET['attr'], $_GET['data']);
			## 
			$service = read("services", ["service_id"], [$_GET['data']]);
			$service = $service[0];
			## DELETE THE IMAGE FILE
			if(!isset($_GET['logo'])){
				$path = "images/providers/".$service['service_type']."/".$_SESSION['provider']."/".$service["service_img"];
				if(!unlink($path)) echo "<script>alert('An error occurred in deleting image!')</script>";
			}
			## DELETE IN SERVICES
			delete("services", $_GET['attr'], $_GET['data']);
		}
		else {
			## CHECK IF PURCHASE ID EXIST IN DETAILS TABLE
			$details = read("details", ["purchase_id"], [$_GET['data']]);

			if(count($details)>0){
				delete("details", $_GET['attr'], $_GET['data']);

				## SEND EMAIL | PROVIDER
				$provider = DB::query("SELECT * FROM purchase a JOIN services b ON a.service_id = b.service_id JOIN church d ON d.service_id = b.service_id JOIN provider c ON b.provider_id = c.provider_id WHERE purchase_id = ?", array($_GET['data']), "READ");
				$provider = $provider[0];
				## SEND EMAIL | SEEKER
				$seeker = DB::query("SELECT * FROM purchase a JOIN seeker b ON a.seeker_id = b.seeker_id WHERE purchase_id = ?", array($_GET['data']), "READ");
				$seeker = $seeker[0];
				## SEND EMAIL | SEND TO EMAIL
				$to_provider = $provider['provider_email'];
				## SEND EMAIL | SUBJECT
				$subject = "Purchase Cancelled";
				## SEND EMAIL | MESSAGE
				$txt = "Hi {$provider['provider_fname']},\n\nPlease be advise that seeker:{$seeker['seeker_fname']} has canceled their schedule ".$provider['purchase_sched_time']." on ".date("M j, Y", strtotime($provider['church_mass_date'])).".\nThank you for your service!";
				$txt .= "\n\n\nBest regards,\nTeam Wakecords";

				mail($to_provider, $subject, $txt);
				## SEND EMAIL | SEND TO EMAIL
				$to_seeker = $seeker['seeker_email'];
				## SEND EMAIL | MESSAGE
				$txt = "Hi {$seeker['seeker_fname']},\n\nPlease be advise that your scheduled ".$provider['purchase_sched_time']." on ".date("M j, Y", strtotime($provider['church_mass_date']))." has successfully canceled.\nPlease visit services to find more available mass time!";
				$txt .= "\n\n\nBest regards,\nTeam Wakecords";

				mail($to_seeker, $subject, $txt);
				$checker = true;
			}
			delete($_GET['table'], $_GET['attr'], $_GET['data']);
		}
		
	}

	if(isset($_GET['url']) && isset($_GET['update'])){
		header("Location: ".$_GET['url'].".php?updated");
	}
	else if(isset($_GET['url'])){
		if($checker){
			header("Location: ".$_GET['url'].".php?canceled");
		}
		else header("Location: ".$_GET['url'].".php?deleted");
	}
	else {
		header("Location: cart.php?cart_deleted");
	}