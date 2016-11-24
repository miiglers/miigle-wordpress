<?php
/**
 * Template Name: Brand Directory
 */

//use Miigle\Models\User;
//use Miigle\Models\Brand;

//$mgl_current_user = User\current();
?>

<div id="template-brand_directory">
  
  <section id="brand_directory">
		<div class="container">
			<div class="row">
				
				<!-- main section-->
				<div id="mainCol" class="col-lg-8 divider">
        	<div class="text-sm-center">
        		<?php the_field('bd_page_heading'); ?>
        	</div>       	
					
					<div class="browseWrapper mT">
						<div class="text-sm-center">
							<?php the_field('bd_browse_heading'); ?>
						</div>
						
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
									<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-clothing.png');">
										<div class="mask clothing"></div>
										<p>Clothing</p>
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
									<div class="card" style="background-image:url('<?= get_template_directory_uri() ?>/assets/images/brand-jewelry.png');">
										<div class="mask jewelry"></div>
										<p>Jewelry</p>
										<a href="https://miigle.com/category/jewelry?products"><div class="mask"></div></a>
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
          
          <div class="widgetBox text-sm-center cta-widget">
          	<?php the_field('bd_cta_section_content'); ?> 
          </div>
          
          <div class="widgetBox text-sm-center">
						<?php the_field('bd_social_widget_content'); ?>	         	
						<br>
						<?php echo do_shortcode('[TheChamp-Sharing]') ?>
					</div>
					
					<div class="widgetBox text-sm-center">
						<?php the_field('bd_newsletter_form_widget_content'); ?>
					</div>
					
				</div>
				<!-- /. side section-->
			
			</div>			
				<hr>
		</div>
  </section>
  
  <section class="cta-widget">
  	<div class="container">
  		<div class="row">				
				<div class="col-sm-10 col-sm-offset-1 text-center">
        	<?php the_field('bd_cta_section_content'); ?>        						
				</div>
			</div>
  	</div>
  </section>
</div>
