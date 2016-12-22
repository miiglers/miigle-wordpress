<?php
/**
 * Template Name: Brand Detail
 */
?>

<div id="template-brand_detail">
  
  <section id="brand_scroll" class="hidden-xs">
		<div class="container">
			<div class="row">				
				<div class="col-sm-12 mB">
        	<div id="myCarousel" class="carousel slide">                
						<!-- Carousel items -->
						<div class="carousel-inner">
							<div class="item active">
								<div class="row">
									<div class="col-sm-3">
										<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-accessories.png');">
											<div class="mask accessories"></div>
											<p>Accessories</p>
											<a href="https://miigle.com/category/accessories?products"><div class="mask"></div></a>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-beauty.png');">
											<div class="mask beauty"></div>
											<p>Beauty</p>
											<a href="https://miigle.com/category/beauty?products"><div class="mask"></div></a>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-clothing.png');">
											<div class="mask clothing"></div>
											<p>Clothing</p>
											<a href="https://miigle.com/category/clothing?products"><div class="mask"></div></a>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-electronics.png');">
											<div class="mask electronics"></div>
											<p>Electronics</p>
											<a href="https://miigle.com/category/electronics?products"><div class="mask"></div></a>
										</div>
									</div>
								</div>
								<!--/row-->
							</div>
							<!--/item-->
							<div class="item">
								<div class="row">
									<div class="col-sm-3">
										<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-foods.png');">
											<div class="mask foods"></div>
											<p>Foods</p>
											<a href="https://miigle.com/category/foods?products"><div class="mask"></div></a>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-gifts.png');">
											<div class="mask gifts"></div>
											<p>Gifts</p>
											<a href="https://miigle.com/category/gifts?products"><div class="mask"></div></a>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-health.png');">
											<div class="mask health"></div>
											<p>Health</p>
											<a href="https://miigle.com/category/health?products"><div class="mask"></div></a>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-home.png');">
											<div class="mask home"></div>
											<p>Home</p>
											<a href="https://miigle.com/category/home?products"><div class="mask"></div></a>
										</div>
									</div>
								</div>
								<!--/row-->
							</div>
							<!--/item-->
							<div class="item">
								<div class="row">
									<div class="col-sm-3">
										<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-kids.png');">
											<div class="mask kids"></div>
											<p>Kids</p>
											<a href="https://miigle.com/category/kids?products"><div class="mask"></div></a>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-jewelry.png');">
											<div class="mask jewelry"></div>
											<p>Jewelry</p>
											<a href="https://miigle.com/category/jewelry?products"><div class="mask"></div></a>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-pets.png');">
											<div class="mask pets"></div>
											<p>Pets</p>
											<a href="https://miigle.com/category/pets?products"><div class="mask"></div></a>
										</div>
									</div>
									<div class="col-sm-3">
										<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-shoes.png');">
											<div class="mask shoes"></div>
											<p>Shoes</p>
											<a href="https://miigle.com/category/Shoes?products"><div class="mask"></div></a>
										</div>
									</div>
								</div>
								<!--/row-->
							</div>
							<!--/item-->    
						</div>
						<!--/carousel-inner-->
						<a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
						<a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
					</div><!--/#myCarousel -->
       	</div>
      </div>
    </div>
   </section><!-- /#brand_scroll for Desktop -->   
   
   <?php require_once(locate_template('archive-mgl_brand.php')); ?>
   
   <section id="brand_detail"> 
   	<div class="container"> 
      <div class="row mB"> 
        <!-- brand detail title section-->
				<div class="col-sm-12 text-center">
        	<h1>Beauty</h1>
        	<p>57 brands</p>
        </div>				
			</div>
			
				<!-- brand -->
				<div class="row flexRow borderB">        
					<div class="col-sm-9 text-sm-center">
						<h3>Alabama Chanin <span class="badge"><img src="<?= get_template_directory_uri() ?>/assets/images/pl-badge.png" alt="badge"></span></h3>
						<p>Made in USA. Uses 100% organic cotton sourced responsibly.</p>
					</div>	
					<div class="col-sm-3 text-center">
						<a href="#" class="btn btn-default btn-cta">VISIT WEBSITE</a>
					</div>
				</div>
				<!-- brand -->
				<div class="row flexRow borderB">        
					<div class="col-sm-9 text-sm-center">
						<h3>Amour Vert </h3>
					</div>	
					<div class="col-sm-3 text-center">
						<a href="#" class="btn btn-default btn-cta">CLAIM THIS</a>
					</div>
				</div>
		
		</div>
  </section>
  
  <section id="brand_list" class="visible-xs mT">
		<div class="container">
			<div class="row">
				<div class="col-xs-6">
					<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-accessories.png');">
						<div class="mask accessories"></div>
						<p>Accessories</p>
						<a href="https://miigle.com/category/accessories?products"><div class="mask"></div></a>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-beauty.png');">
						<div class="mask beauty"></div>
						<p>Beauty</p>
						<a href="https://miigle.com/category/beauty?products"><div class="mask"></div></a>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-clothing.png');">
						<div class="mask clothing"></div>
						<p>Clothing</p>
						<a href="https://miigle.com/category/clothing?products"><div class="mask"></div></a>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-electronics.png');">
						<div class="mask electronics"></div>
						<p>Electronics</p>
						<a href="https://miigle.com/category/electronics?products"><div class="mask"></div></a>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-foods.png');">
						<div class="mask foods"></div>
						<p>Foods</p>
						<a href="https://miigle.com/category/foods?products"><div class="mask"></div></a>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-gifts.png');">
						<div class="mask gifts"></div>
						<p>Gifts</p>
						<a href="https://miigle.com/category/gifts?products"><div class="mask"></div></a>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-health.png');">
						<div class="mask health"></div>
						<p>Health</p>
						<a href="https://miigle.com/category/health?products"><div class="mask"></div></a>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-home.png');">
						<div class="mask home"></div>
						<p>Home</p>
						<a href="https://miigle.com/category/home?products"><div class="mask"></div></a>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-kids.png');">
						<div class="mask kids"></div>
						<p>Kids</p>
						<a href="https://miigle.com/category/kids?products"><div class="mask"></div></a>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-jewelry.png');">
						<div class="mask jewelry"></div>
						<p>Jewelry</p>
						<a href="https://miigle.com/category/jewelry?products"><div class="mask"></div></a>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-pets.png');">
						<div class="mask pets"></div>
						<p>Pets</p>
						<a href="https://miigle.com/category/pets?products"><div class="mask"></div></a>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-Shoes.png');">
						<div class="mask shoes"></div>
						<p>Shoes</p>
						<a href="https://miigle.com/category/Shoes?products"><div class="mask"></div></a>
					</div>
				</div>
			</div>
    </div>
  </section><!-- /#brand_list for Mobile/Tablet -->
     
</div>
