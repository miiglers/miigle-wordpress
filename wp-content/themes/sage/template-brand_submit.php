<?php
/**
 * Template Name: Brand Submit
 */
 
$user = wp_get_current_user();
?>

<div id="template-brand_submit">
  
 	<section id="brand_price" class="pT pB"> 
   	<div class="container"> 
      <div class="row borderB"> 
        <!-- brand detail title section-->
				<div class="col-sm-4 text-sm-center white-text">
        	<?php the_field('bs_page_header'); ?>
        </div>	
        <div class="col-sm-1">
        	&nbsp;
        </div>
        <div class="col-sm-7 white-text priceList">
        	<?php the_field('bs_benefit_content'); ?>
        </div>				
			</div>
			<!-- price -->
			<div class="row msB">        
				<div class="col-sm-3 text-center">
        	<div class="well <?php the_field('bs_pricing_card_price_1_recommended'); ?>">
        		<span class="badge"><?php the_field('bs_pricing_card_price_1_recommended'); ?></span>
        		<?php the_field('bs_pricing_card_price_1'); ?>
        	</div>
        </div>	
        <div class="col-sm-3 text-center">
        	<div class="well <?php the_field('bs_pricing_card_price_2_recommended'); ?>">
						<span class="badge"><?php the_field('bs_pricing_card_price_2_recommended'); ?></span>
						<?php the_field('bs_pricing_card_price_2'); ?>
        	</div>
        </div>
        <div class="col-sm-3 text-center">
        	<div class="well <?php the_field('bs_pricing_card_price_3_recommended'); ?>">
						<span class="badge"><?php the_field('bs_pricing_card_price_3_recommended'); ?></span>
						<?php the_field('bs_pricing_card_price_3'); ?>
        	</div>
        </div>
        <div class="col-sm-3 text-center">
        	<div class="well <?php the_field('bs_pricing_card_price_4_recommended'); ?>">
						<span class="badge">Recommended</span>
						<?php the_field('bs_pricing_card_price_4'); ?>
        	</div>
        </div>
			</div>
  		<!-- info -->
			<div class="row">        
				<div class="col-sm-10 col-sm-offset-1 text-center white-text">
        	<h3>Early Bird Promotion</h3>
        	<p>Save an Extra 25%! Use promo code “MP2016” for a limited time only</p>
        </div>
			</div>  	
  	</div>
  </section>
  
  <section id="submit_form" class="pT pB"> 
   	<div class="container"> 
      <div class="row">
      	<div class="col-sm-10 col-sm-offset-1">
      		
      		<h2>Submit Your Brand</h2>
      		<div class="form-Box mB">
						<div class="row">
							<div class="col-sm-4 form-group">
								<label class="sr-only" for="">First Name</label>
								<input type="text" class="form-control" id="" placeholder="First Name">
							</div>
							<div class="col-sm-4 form-group">
								<label class="sr-only" for="">Last Name</label>
								<input type="text" class="form-control" id="" placeholder="Last Name">
							</div>
							<div class="col-sm-4 form-group">
								<label class="sr-only" for="">Email Address</label>
								<input type="email" class="form-control" id="" placeholder="Email Address">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-4 form-group">
								<label class="sr-only" for="">Phone Number</label>
								<input type="text" class="form-control" id="" placeholder="Phone Number">
							</div>
							<div class="col-sm-4 form-group">
								<label class="sr-only" for="">Brand Name</label>
								<input type="text" class="form-control" id="" placeholder="Brand Name">
							</div>
							<div class="col-sm-4 form-group">
								<label class="sr-only" for="">Job Title</label>
								<input type="email" class="form-control" id="" placeholder="Job Title">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 form-group">
								<label class="sr-only" for="">Website URL</label>
								<input type="text" class="form-control" id="" placeholder="Website URL">
							</div>
						</div>
					</div><!-- /.form-box -->
					
					<h2>Category</h2>
					<div class="form-Box mB">
						
					</div>
					
					<h2>Details</h2>
					<div class="form-Box mB">
						<div class="row">
							<div class="col-sm-12 form-group">
								<label class="sr-only" for="">Details</label>
								<textarea class="form-control" rows="1" id="" maxlength="140" placeholder="Social or Ecologial Impact (e.g. For every item that you purchase, we donate one to a person in need.)"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label class="sr-only" for="">Pricing Plan</label>
								<input type="text" class="form-control" id="" placeholder="Last Name">
							</div>
							<div class="col-sm-6 form-group">
								<label class="sr-only" for="">Promo Code</label>
								<input type="text" class="form-control" id="" placeholder="Promo Code">
							</div>
						</div>
					</div><!-- /.form-box -->
					
					<h2 class="sr-only">Proceed Payment</h2>
						<div class="row">
							<div class="col-sm-6 saveTxt">
								<p>You’re saving an additional 25% ($18.74)</p>
							</div>
							<div class="col-sm-6 text-right">
								<button type="submit" class="btn btn-default btn-submit">PROCEED TO PAYMENT</button>
							</div>
						</div>
						
						<hr>
						
					<h2>Payment Info</h2>
					<p>Every submission is reviewed by a member of our team. Your card will not be charged until your listing is approved.</p>
					<div class="form-Box mB">
						<div class="row">
							<div class="col-sm-6 form-group">
								<label class="sr-only" for="">Pricing Plan</label>
								<input type="text" class="form-control" id="" placeholder="Last Name">
							</div>
							<div class="col-sm-6 form-group">
								<label class="sr-only" for="">Promo Code</label>
								<input type="text" class="form-control" id="" placeholder="Promo Code">
							</div>
						</div>
					</div><!-- /.form-box -->
					
					<h2 class="sr-only">Submit</h2>
						<div class="row">
							<div class="col-sm-6 saveTxt">
								<p>You’re saving an additional 25% ($18.74)</p>
							</div>
							<div class="col-sm-6 text-right">
								<button type="submit" class="btn btn-default btn-submit">PROCEED TO PAYMENT</button>
							</div>
						</div>
					
      	</div>
      </div>
    </div>
  </section>
     
</div>
