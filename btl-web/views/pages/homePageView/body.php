<div class="main main-raised">
	<div class="container mainn-raised" style="width:100%;">

		<div id="myCarousel" class="carousel slide" data-ride="carousel">
			<!-- Indicators -->


			<!-- Wrapper for slides -->
			<div class="carousel-inner">
				<div class="item active">
					<img src="public/img/banner3.jpg" alt="Los Angeles" style="width:100%;">
				</div>

				<div class="item">
					<img src="public/img/banner2.jpg" style="width:100%;">
				</div>

				<div class="item">
					<img src="public/img/banner4.jpg" alt="New York" style="width:100%;">
				</div>

				<div class="item">
					<img src="public/img/banner1.jpg" alt="New York" style="width:100%;">
				</div>
			</div>

			<!-- Left and right controls -->
			<a class="left carousel-control _26sdfg" href="#myCarousel" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control _26sdfg" href="#myCarousel" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>



	<!-- SECTION -->
	<div class="section mainn mainn-raised">

		<!-- container -->
		<div class="container">
			<div class="section-title">
				<h3 class="title">Colection</h3>
			</div>
			<!-- row -->
			<div class="row">
				<!-- shop -->
				<div class="col-md-4 col-xs-6">

					<a href="/store">
						<div class="shop">
							<div class="shop-img">
								<img src="public/img/shop01.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Laptop<br>Collection</h3>
								<a href="/store" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</a>
				</div>
				<!-- /shop -->

				<!-- shop -->
				<div class="col-md-4 col-xs-6">
					<a href="/store">
						<div class="shop">
							<div class="shop-img">
								<img src="public/img/shop03.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Accessories<br>Collection</h3>
								<a href="/store" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</a>
				</div>
				<!-- /shop -->

				<!-- shop -->
				<div class="col-md-4 col-xs-6">
					<a href="/store">
						<div class="shop">
							<div class="shop-img">
								<img src="public/img/shop02.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Cameras<br>Collection</h3>
								<a href="/store" class="cta-btn">Shop now <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</a>
				</div>
				<!-- /shop -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->



	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">New Products</h3>
					</div>
				</div>
				<!-- /section title -->

				<!-- Products tab & slick -->
				<div class="col-md-12 mainn mainn-raised">
					<div class="row">
						<div class="products-tabs">
							<!-- tab -->
							<div id="tab1" class="tab-pane active">
								<div class="products-slick" data-nav="#slick-nav-1">

									<?php



									foreach ($products1 as $product) {
										$pro_id = $product['product_id'];
										$pro_cat = $product['product_cat'];
										$pro_brand = $product['product_brand'];
										$pro_title = $product['product_title'];
										$pro_price = $product['product_price'];
										$pro_image = $product['product_image'];
										$pro_sale = $product['product_sale'];
										$cat_name = $product["cat_title"];
										$pro_old_price = $pro_price * ($pro_sale + 100) / 100;
										echo "	
					<div class='product' onclick=\"window.location.href='/store?product_id=$pro_id'\">
						<a href='/store?product_id=$pro_id'><div class='product-img'>
							<img src='public/product_images/$pro_image' style='max-height: 170px;' alt=''>
							<div class='product-label'>
								<span class='sale'>-$pro_sale%</span>
								<span class='new'>NEW</span>
							</div>
						</div></a>
						<div class='product-body'>
							<p class='product-category'>$cat_name</p>
							<h3 class='product-name header-cart-item-name'><a href='/store?product_id=$pro_id'>$pro_title</a></h3>
							<h4 class='product-price header-cart-item-info'>$pro_price<del class='product-old-price'> $$pro_old_price</del></h4>
							<div class='product-rating'>
								<i class='fa fa-star'></i>
								<i class='fa fa-star'></i>
								<i class='fa fa-star'></i>
								<i class='fa fa-star'></i>
								<i class='fa fa-star'></i>
							</div>
						</div>
					</div>
					";
									}
									;

									?>
									<!-- product -->


									<!-- /product -->


									<!-- /product -->
								</div>
								<div id="slick-nav-1" class="products-slick-nav"></div>
							</div>
							<!-- /tab -->
						</div>
					</div>
				</div>
				<!-- Products tab & slick -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- HOT DEAL SECTION -->
	<div id="hot-deal" class="section mainn mainn-raised">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<div class="col-md-12">
					<div class="hot-deal">
						<ul class="hot-deal-countdown">
							<li>
								<div>
									<h3>02</h3>
									<span>Days</span>
								</div>
							</li>
							<li>
								<div>
									<h3>10</h3>
									<span>Hours</span>
								</div>
							</li>
							<li>
								<div>
									<h3>34</h3>
									<span>Mins</span>
								</div>
							</li>
							<li>
								<div>
									<h3>60</h3>
									<span>Secs</span>
								</div>
							</li>
						</ul>
						<h2 class="text-uppercase">hot deal this week</h2>
						<p>New Collection Up to 50% OFF</p>
						<a class="primary-btn cta-btn" href="/store">Shop now</a>
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /HOT DEAL SECTION -->


	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">

				<!-- section title -->
				<div class="col-md-12">
					<div class="section-title">
						<h3 class="title">Top selling</h3>
					</div>
				</div>
				<!-- /section title -->

				<!-- Products tab & slick -->
				<div class="col-md-12 mainn mainn-raised">
					<div class="row">
						<div class="products-tabs">
							<!-- tab -->
							<div id="tab2" class="tab-pane fade in active">
								<div class="products-slick" data-nav="#slick-nav-2">
									<!-- product -->
									<?php
									foreach ($products2 as $product) {
										$pro_id = $product['product_id'];
										$pro_cat = $product['product_cat'];
										$pro_brand = $product['product_brand'];
										$pro_title = $product['product_title'];
										$pro_price = $product['product_price'];
										$pro_image = $product['product_image'];
										$pro_sale = $product['product_sale'];
										$cat_name = $product["cat_title"];
										$pro_old_price = $pro_price * ($pro_sale + 100) / 100;

										echo "
						<div class='product' onclick=\"window.location.href='/store?product_id=$pro_id'\">
							<a href='store?product_id=$pro_id'><div class='product-img'>
								<img src='public/product_images/$pro_image' style='max-height: 170px;' alt=''>
								<div class='product-label'>
									<span class='sale'>-$pro_sale%</span>
									<span class='new'>NEW</span>
								</div>
							</div></a>
							<div class='product-body'>
								<p class='product-category'>$cat_name</p>
								<h3 class='product-name header-cart-item-name'><a href='store?product_id=$pro_id'>$pro_title</a></h3>
								<h4 class='product-price header-cart-item-info'>$pro_price<del class='product-old-price'>$$pro_old_price</del></h4>
								<div class='product-rating'>
									<i class='fa fa-star'></i>
									<i class='fa fa-star'></i>
									<i class='fa fa-star'></i>
									<i class='fa fa-star'></i>
									<i class='fa fa-star'></i>
								</div>
							</div>
						</div>
					";
									}
									;

									?>
									<!-- /product -->
								</div>
								<div id="slick-nav-2" class="products-slick-nav"></div>
							</div>
							<!-- /tab -->
						</div>
					</div>
				</div>
				<!-- /Products tab & slick -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->

	<!-- SECTION -->

	<!-- /SECTION -->
</div>
