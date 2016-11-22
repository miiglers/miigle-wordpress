<?php
/**
 * Template Name: Brand Thank You
 */
 
$user = wp_get_current_user();
?>

<div id="template-brand_thankyou">
  
 	<section id="brand_thankyou" class="mT mB"> 
   	<div class="container"> 
			<div class="row flexRow mB">        
				<div class="col-sm-1 text-sm-center">
					<img src="<?= get_template_directory_uri() ?>/assets/images/pl-icon-success.png">
				</div>
				<div class="col-sm-8 text-sm-center">
        	<? the_field('bt_page_heading'); ?>
        </div>
        <div class="col-sm-3 text-sm-center">
        	<a class="btn btn-default btn-cta" href="<? the_field('bt_thank_you_cta_link'); ?>"><? the_field('bt_thank_you_cta_link_text'); ?></a>
        </div>
			</div>
			
				<hr>
			
			<div class="row mB mT">        
				<div class="col-sm-12 whats-next text-sm-center">
        	<? the_field('bt_whats_next_content'); ?>
        </div>
			</div>	
			
				<hr>
		</div>
  </section>
  
  <section id="brand_scroll" class="hidden-xs">
		<div class="container">
			<div class="row">        
				<div class="col-sm-12 text-sm-center">
        	<? the_field('bt_explore_categories_content'); ?>
        </div>
			</div>	
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
										<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-clothings.png');">
											<div class="mask clothings"></div>
											<p>Clothings</p>
											<a href="https://miigle.com/category/clothings?products"><div class="mask"></div></a>
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
										<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-jewlery.png');">
											<div class="mask jewlery"></div>
											<p>Jewlery</p>
											<a href="https://miigle.com/category/jewlery?products"><div class="mask"></div></a>
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
  
  	<section id="brand_list" class="visible-xs mT">
		<div class="container">
			<div class="row mT">        
				<div class="col-sm-12 text-sm-center">
        	<? the_field('bt_explore_categories_content'); ?>
        </div>
			</div>	
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
					<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-clothings.png');">
						<div class="mask clothings"></div>
						<p>Clothings</p>
						<a href="https://miigle.com/category/clothings?products"><div class="mask"></div></a>
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
					<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-jewlery.png');">
						<div class="mask jewlery"></div>
						<p>Jewlery</p>
						<a href="https://miigle.com/category/jewlery?products"><div class="mask"></div></a>
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
