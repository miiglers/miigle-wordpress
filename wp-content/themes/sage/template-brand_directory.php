<?php
/**
 * Template Name: Brand Directory
 */
 
$user = wp_get_current_user();
?>

<div id="template-brand_directory">
  
  <section id="brand_directory" class="mT">
		<div class="container">
			<div class="row">
				
				<!-- main section-->
				<div id="mainCol" class="col-sm-9">
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
									<div class="card">
										<div class="mask beauty"></div>
										<p>Beauty</p>
										<a href="https://miigle.com/category/beauty?products"><div class="mask"></div></a>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="card">
										<div class="mask kids"></div>
										<p>Kids</p>
										<a href="https://miigle.com/category/kids?products"><div class="mask"></div></a>
									</div>
								</div>							
								<div class="col-sm-6">
									<div class="card">
										<div class="mask clothings"></div>
										<p>Clothings</p>
										<a href="https://miigle.com/category/clothing?products"><div class="mask"></div></a>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="card">
										<div class="mask foods"></div>
										<p>Foods</p>
										<a href="https://miigle.com/category/foods?products"><div class="mask"></div></a>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="card">
										<div class="mask shoes"></div>
										<p>Shoes</p>
										<a href="https://miigle.com/category/shoes?products"><div class="mask"></div></a>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="card">
										<div class="mask health"></div>
										<p>Health</p>
										<a href="https://miigle.com/category/health?products"><div class="mask"></div></a>
									</div>
								</div>
							</div>	
						</div>
						
						<div class="banner-section mT mB">
							<div class="banner lg txt">BANNER</div>	
						</div>
					
					</div>
				</div>
				<!-- /. main section-->
				
				<!-- side section-->
				<div id="sideCol" class="col-sm-3">
          	<h3>Spread The Word</h3>
          	         	

				</div>
				<!-- /. side section-->
			
			</div>
			
				<hr>
				
			<div class="row">
				
				<!-- cta section-->
				<div id="cta" class="col-sm-10 col-sm-offset-1">
        	<?php the_field('cta_section'); ?>        						
				</div>
				<!-- /. cta section-->
				
			</div>
		
		</div>
  </section>
  
   
</div>
