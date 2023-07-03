<?php
	include("others/functions.php");

	## UPDATING IN DATABASE
	if(isset($_GET['purchase'])){
		$purchase = read("purchase", ["purchase_id"], [$_GET['id']]);
		$purchase = $purchase[0];

		$progress = $purchase["purchase_progress"] + 1;
		update("purchase", ["purchase_progress"], [$progress, $_GET['id']], "purchase_id");
		
		if(progress_limits($_GET['id']))
			update("purchase", ["purchase_status"], ["done", $_GET['id']], "purchase_id");
	}

	header("Location: status.php?purchaseid=".$_GET['id']."&updated");
	exit;