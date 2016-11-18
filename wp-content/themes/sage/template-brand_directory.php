<?php
/**
 * Template Name: Brand Directory
 */
 
$user = wp_get_current_user();
?>

<div id="template-brand_directory">
  
  <section id="brand_directory">
		<div class="container">
			<div class="row">
				
				<!-- main section-->
				<div id="mainCol" class="col-lg-8 divider">
        	<?php the_field('page_heading'); ?>        	
					
					<div class="browseWrapper mT">
						<?php the_field('browse_heading'); ?>
						
						<div class="btn-group btn-group-justified msT brand-btn" role="group" aria-label="brand-filter">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default active">All</button>
							</div>
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default">Women</button>
							</div>
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default">Men</button>
							</div>
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default">Kids</button>
							</div>
						</div>
					
						<div class="brand-cards mT">
							<div class="row">								
								<div class="col-sm-6">
									<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-accessories.png');">
										<div class="mask accessories"></div>
										<p>Accessories</p>
										<a href="https://miigle.com/category/accessories?products"><div class="mask"></div></a>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-beauty.png');">
										<div class="mask beauty"></div>
										<p>Beauty</p>
										<a href="https://miigle.com/category/beauty?products"><div class="mask"></div></a>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-clothings.png');">
										<div class="mask clothings"></div>
										<p>Clothings</p>
										<a href="https://miigle.com/category/clothing?products"><div class="mask"></div></a>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-electronics.png');">
										<div class="mask electronics"></div>
										<p>Electronics</p>
										<a href="https://miigle.com/category/electronics?products"><div class="mask"></div></a>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-foods.png');">
										<div class="mask foods"></div>
										<p>Foods</p>
										<a href="https://miigle.com/category/foods?products"><div class="mask"></div></a>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-gifts.png');">
										<div class="mask gifts"></div>
										<p>Gifts</p>
										<a href="https://miigle.com/category/gifts?products"><div class="mask"></div></a>
									</div>
								</div>	
								<div class="col-sm-6">
									<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-health.png');">
										<div class="mask health"></div>
										<p>Health</p>
										<a href="https://miigle.com/category/health?products"><div class="mask"></div></a>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-home.png');">
										<div class="mask home"></div>
										<p>Home</p>
										<a href="https://miigle.com/category/home?products"><div class="mask"></div></a>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-kids.png');">
										<div class="mask kids"></div>
										<p>Kids</p>
										<a href="https://miigle.com/category/kids?products"><div class="mask"></div></a>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-jewlery.png');">
										<div class="mask jewlery"></div>
										<p>Jewlery</p>
										<a href="https://miigle.com/category/jewlery?products"><div class="mask"></div></a>
									</div>
								</div>	
								<div class="col-sm-6">
									<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-pets.png');">
										<div class="mask pets"></div>
										<p>Pets</p>
										<a href="https://miigle.com/category/pets?products"><div class="mask"></div></a>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-shoes.png');">
										<div class="mask shoes"></div>
										<p>Shoes</p>
										<a href="https://miigle.com/category/shoes?products"><div class="mask"></div></a>
									</div>
								</div>
							</div>	
							
							<!--	
							<div class="col-sm-12 banner-section">
								<div class="banner lg txt">BANNER</div>	
							</div>
							-->
						</div>
					
					</div>
				</div>
				<!-- /. main section-->
				
				<!-- side section-->
				<div id="sideCol" class="col-lg-4 divider">
          
          <div class="widgetBox">
						<?php the_field('social_widget_content'); ?>	         	
						<br>
						<p><a href="#" class="btn btn-default btn-cta">EMAIL THIS PAGE</a></p>
						<p><a href="#" class="btn btn-default btn-cta">TWEET THIS PAGE</a></p>
						<p><a href="#" class="btn btn-default btn-cta">SHARE ON FACEBOOK</a></p>
						<p><a href="#" class="btn btn-default btn-cta">BOOKMARK THIS PAGE</a></p>
					</div>
					
					<div class="widgetBox">
						<?php the_field('newsletter_form_widget_content'); ?>
						<br>
						<div class="input-group form-cta">
							<input type="text" class="form-control" placeholder="Enter your email">
							<span class="input-group-btn">
								<button class="btn btn-default" type="button">SUBMIT</button>
							</span>
						</div>
					</div>
					
				</div>
				<!-- /. side section-->
			
			</div>			
				<hr>		
		</div>
  </section>
  
  <section id="cta">
  	<div class="container">
  		<div class="row">				
				<div class="col-sm-10 col-sm-offset-1 text-center">
        	<?php the_field('cta_section_content'); ?>        						
				</div>
			</div>
  	</div>
  </section>
</div>
