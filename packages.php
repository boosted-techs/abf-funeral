<?php
include_once "others/db.php";
$packages = DB::query("SELECT * FROM services s JOIN church f ON s.service_id=f.service_id WHERE provider_id=13 and s.service_status = \"ACTIVE\"", array(), "READ");

//$packages = DB::query("select * from services where provider_id = 13 and service_status = 'ACTIVE' order by service_id asc",[], "READ");
?>
<?php
include_once "header.php";
?>
				<section class="page_title ds s-pt-120 s-pb-50 s-pt-lg-130 s-pb-lg-90 page_title s-parallax s-overlay">
					<div class="divider-55 d-none d-lg-block"></div>
					<div class="container">
						<div class="row">

							<div class="col-md-12 text-center text-lg-left">
								<h1 class="color-main">Our Packages</h1>
								<ol class=" breadcrumb">
									<li class="breadcrumb-item">
										<a href="./">Home</a>
									</li>
									<li class="breadcrumb-item">
										<a href="">Pages</a>
									</li>
									<li class="breadcrumb-item active">
										Packages
									</li>
								</ol>
							</div>

						</div>
					</div>
				</section>
			
			<section class="ls ms s-pt-55 s-pb-10 s-pb-md-15 s-pt-lg-95 s-pb-lg-50 s-pt-xl-145 s-pb-xl-100 c-gutter-30">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<p class="subtitle text-center">today, tomorrow and beyond.</p>
							<h3 class="special-heading"><span class="color-main">Our </span> packages</h3>
							<div class="divider-65 d-none d-lg-block"></div>
                            <?php
                        
                            foreach($packages as $package) :
                            ?>
							<div class="row c-mb-0">
								<div class="col-lg-4 col-md-6">
									<div class="vertical-item text-center">
										<div class="item-media">
											<img src="./images/providers/church/13/<?=$package['service_img']?>" alt="">
											<div class="media-links">
												<a class="abs-link" title="" href="./"></a>
											</div>
										</div>
										<div class="item-content hero-bg box-shadow relative-content">
											<p class="big">
												<a href="./"><?=$package['church_church']?></a>
                                                
											</p>
                                            <p>
                                            (UGX <?=number_format($package['service_cost'],0)?>)
                                            </p>
                                            <a href="package.php?package=<?=$package['service_id']?>">
                                                <button class="btn btn-primary">Read more</button>
                                            </a>
										</div>
									</div>
								</div><!-- .col-* -->
								
								<?php
                                endforeach;
                                ?>
								
							</div>
						</div>
					</div>
				</div>
			</section>




<?php
include_once "footer.php";
?>