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
			$this_page = "feedback";
			include("others/sidebar.php"); ?>

			<!-- BANNER CONTENT -->
			<section class="banner-con">
				<div class="wrapper">
					<div class="banner-div">
						<h2>Feedback</h2>

						<div class="banner-cards">
							<div class="card-0 each_rate">
								<img src="images/coffin.png" alt="">
								<div class="rate_desc">	
									<div>
										<h3>St. Peter 
											<span>
												<i class="fa-solid fa-star"></i>
												<i class="fa-solid fa-star"></i>
												<i class="fa-solid fa-star"></i>
												<i class="fa-solid fa-star"></i>
											</span>
										</h3>
										<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ad corrupti beatae magni rerum doloribus, vitae inventore. Tempore quod fugit commodi!</p>
									</div>
								</div>
								<form action="">
									<div class="rating-con">
										<div class="rating">
											<input type="radio" id="star5-1" name="rate-1" value="5" required><label for="star5-1" title='Excellent'></label>
											<input type="radio" id="star4-1" name="rate-1" value="4" required><label for="star4-1" title='Very Good'></label>
											<input type="radio" id="star3-1" name="rate-1" value="3" required><label for="star3-1" title='Good'></label>
											<input type="radio" id="star2-1" name="rate-1" value="2" required><label for="star2-1" title='Bad'></label>
											<input type="radio" id="star1-1" name="rate-1" value="1" required><label for="star1-1" title='Very Bad'></label>
										</div>
										<textarea name="" id=""></textarea>
										<button class="btn trad">Rate Us Now!</button>
									</div>
								</form>
							</div>
							<div class="card-0 each_rate">
								<img src="images/coffin.png" alt="">
								<div class="rate_desc">	
									<div>
										<h3>St. Peter 
											<span>
												<i class="fa-solid fa-star"></i>
												<i class="fa-solid fa-star"></i>
												<i class="fa-solid fa-star"></i>
												<i class="fa-solid fa-star"></i>
											</span>
										</h3>
										<p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ad corrupti beatae magni rerum doloribus, vitae inventore. Tempore quod fugit commodi!</p>
									</div>
								</div>
								<form action="">
									<div class="rating-con">
										<div class="rating">
											<input type="radio" id="star5-2" name="rate-1" value="5" required><label for="star5-2" title='Excellent'></label>
											<input type="radio" id="star4-2" name="rate-1" value="4" required><label for="star4-2" title='Very Good'></label>
											<input type="radio" id="star3-3" name="rate-1" value="3" required><label for="star3-3" title='Good'></label>
											<input type="radio" id="star2-3" name="rate-1" value="2" required><label for="star2-3" title='Bad'></label>
											<input type="radio" id="star1-3" name="rate-1" value="1" required><label for="star1-3" title='Very Bad'></label>
										</div>
										<textarea name="" id=""></textarea>
										<button class="btn trad">Rate Us Now!</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</body>
</html>
