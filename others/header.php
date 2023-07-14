<div class="header">
	<button class="header-btn" data-menu-icon>
		<i class="fa-solid fa-bars"></i>
	</button>
	<picture>
		<?php
			if(isset($_SESSION['seeker'])){
		?>
			
		<?php
			}

			if(isset($_SESSION['provider'])){
				// $provider = read("provider", ["provider_id"], [$_SESSION['provider']]);
				// $provider = $provider[0];
				$provider = provider();

				if(empty($provider['provider_logo'])){
				## PROVIDER DEFAULT LOGO
		?>
				
		<?php
				}
				else echo ".";
			}
			else echo "";
		?>

		<div><a href="./index.php">
		ABF FUNERAL SERVICES
		</a>
	</div>
	</picture>	
</div>