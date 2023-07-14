<?php
include_once "others/db.php";
$package = $_GET['package'];
$packages = DB::query("SELECT * FROM services s JOIN church f ON s.service_id=f.service_id WHERE provider_id=13 and s.service_status = \"ACTIVE\" and s.service_id = ?", array($_GET['package']), "READ");

//$packages = DB::query("select * from services where provider_id = 13 and service_status = 'ACTIVE' order by service_id asc",[], "READ");
?>
<?php
include_once "header.php";
?>
				<section class="page_title ds s-pt-120 s-pb-50 s-pt-lg-130 s-pb-lg-90 page_title s-parallax s-overlay">
					<div class="divider-55 d-none d-lg-block"></div>
					<div class="container">
						<div class="row">

							<div class=" col-md-12 text-center text-lg-left mx-auto">
								<h1 class="color-main">Package Details</h1>
								<ol class=" breadcrumb">
									<li class="breadcrumb-item">
										<a href="./">Home</a>
									</li>
									<li class="breadcrumb-item">
										<a href="">Pages</a>
									</li>
									<li class="breadcrumb-item active">
                                    <?=$packages[0]['church_church']?>
									</li>
								</ol>
							</div>

						</div>
					</div>
				</section>
                <section class="ls s-pt-60 s-pb-0 s-pt-lg-100 s-pb-lg-90 s-pt-xl-150 s-pb-xl-140 c-gutter-70 c-mb-50 c-mb-lg-0">
				<div class="container">
					<div class="row">
						<div class="col-md-7 col-lg-8">
                            <?php
                            foreach($packages as $package) :
                                ?>
							<div>
								<img src="./images/providers/church/13/<?=$package['service_img']?>" alt="">
							</div>

							<h3 class="mt-30"><span class="color-main"><?=$package['church_church']?> </span> UGX<?=number_format($package['service_cost'])?></h3>
							<p><?=$package['service_desc']?>
                            <p>
                                <A href="./funeral_tradition_this.php?service_id=<?=$package['service_id']?>&id=<?=$package['provider_id']?>">
                                    <button class="btn btn-primary">Book Now</button>
                                </A>
                            </p>
                            <?php
                            endforeach;
                            ?>
						</div><!-- .col-* -->
					</div>
					<div class="divider-3"></div>
				</div>
			</section>

                           
							




<?php
include_once "footer.php";
?>