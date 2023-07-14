<?php
include_once "header.php";
?>
<section class="page_title ds s-pt-120 s-pb-50 s-pt-lg-130 s-pb-lg-90 page_title s-parallax s-overlay">
					<div class="divider-55 d-none d-lg-block"></div>
					<div class="container">
						<div class="row">

							<div class="col-md-12 text-center text-lg-left">
								<h1 class="color-main">Our Services</h1>
								<ol class=" breadcrumb">
									<li class="breadcrumb-item">
										<a href="./">Home</a>
									</li>
									<li class="breadcrumb-item">
										<a href="">Pages</a>
									</li>
									<li class="breadcrumb-item active">
										Services
									</li>
								</ol>
							</div>

						</div>
					</div>
				</section>
<section class="ls ms s-pt-55 s-pb-30 s-pb-md-15 s-pt-lg-95 s-pb-lg-55 s-pt-xl-145 s-pb-xl-105 c-gutter-45">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<p class="subtitle text-center">today, tomorrow and beyond.</p>
							<h3 class="special-heading"><span class="color-main">ABF Funeral </span>Services</h3>
							<div class="divider-65 d-none d-lg-block"></div>
							<div class="row c-mb-30 c-mb-md-45">
                                <?php
                                $services = [
                                    ["service" => "Coffin / Casket, Coffin Tent diiferent categories", "desc" => "We do all coffins of all sizes ad colors. Shipped and locally made"], 
                                    ["service" => "Flower stands in different categories", "desc"=> ""]
                                ];
                                foreach ($services as $service) :
                                ?>
								<div class="col-lg-4 col-md-6">
									<div class="icon-box hero-bg box-shadow text-center">
										<div class="icon-styled fs-40">
											<i class="color-main ico-planning"></i>
										</div>
										<h6>
											<a href="service-single.html"><?=$service['service']?></a>
										</h6>
										<p>
											<?=$service['desc']?>
										</p>
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