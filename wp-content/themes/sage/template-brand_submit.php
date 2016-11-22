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
			<div class="row borderB companyLogo"> 
				<div class="col-sm-10 col-sm-offset-1 text-center white-text">
        	<?php the_field('bs_supported_company_content'); ?>
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
      		<div class="form-Box mB msT">
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
					<div class="form-Tag mB msT">
						<div class="row">
							<div class="col-sm-12 text-sm-center">
								
								<div class="tag-group">
									<input type="radio" name="mgl_product_category[]" id="category-14" value="14">
									<label class="category" for="category-14">Accessories</label>
								</div>
								<div class="tag-group">
									<input type="radio" name="mgl_product_category[]" id="category-11" value="11">
									<label class="category" for="category-11">Beauty</label>
								</div>
								<div class="tag-group">
									<input type="radio" name="mgl_product_category[]" id="category-8" value="8">
									<label class="category" for="category-8">Clothing</label>
								</div>
								<div class="tag-group">
									<input type="radio" name="mgl_product_category[]" id="category-60" value="60">
									<label class="category" for="category-60">Food</label>
								</div>
								<div class="tag-group">
									<input type="radio" name="mgl_product_category[]" id="category-17" value="17">
									<label class="category" for="category-17">Gifts</label>
								</div>
								<div class="tag-group">
									<input type="radio" name="mgl_product_category[]" id="category-41" value="41">
									<label class="category" for="category-41">Health</label>
								</div>
								<div class="tag-group">
									<input type="radio" name="mgl_product_category[]" id="category-9" value="9">
									<label class="category" for="category-9">Home</label>
								</div>
								<div class="tag-group">
									<input type="radio" name="mgl_product_category[]" id="category-18" value="18">
									<label class="category" for="category-18">Jewelry</label>
								</div>
								<div class="tag-group">
									<input type="radio" name="mgl_product_category[]" id="category-10" value="10">
									<label class="category" for="category-10">Kids</label>
								</div>
								<div class="tag-group">
									<input type="radio" name="mgl_product_category[]" id="category-27" value="27">
									<label class="category" for="category-27">Pets</label>
								</div>
								<div class="tag-group">
									<input type="radio" name="mgl_product_category[]" id="category-24" value="24">
									<label class="category" for="category-24">Shoes</label>
								</div>
							
							</div>
						</div>	
					</div>
					
					<h2>Details</h2>
					<div class="form-Box mB msT">
						<div class="row">
							<div class="col-sm-12 form-group">
								<label class="sr-only" for="">Details</label>
								<textarea class="form-control" rows="3" id="" maxlength="140" placeholder="Social or Ecologial Impact (e.g. For every item that you purchase, we donate one to a person in need.)"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 form-group">
								<label class="sr-only" for="">Pricing Plan</label>
								<select class="form-control" id="" >
									<option>Please Select Pricing Plan</option>
									<option>1Month - $49.99</option>
									<option>31Month - $99.99</option>
									<option>6Month - $224.99</option>
									<option>12Month - $466.99</option>
								</select>
							</div>
							<div class="col-sm-6 form-group">
								<label class="sr-only" for="">Promo Code</label>
								<input type="text" class="form-control" id="" placeholder="Promo Code">
							</div>
						</div>
					</div><!-- /.form-box -->
					
					<h2 class="sr-only">Proceed Payment</h2>
						<div class="row">
							<div class="col-sm-6 saveTxt text-sm-center">
								<p>You’re saving an additional 25% ($18.74)</p>
							</div>
							<div class="col-sm-6 text-right text-sm-center">
								<button type="submit" class="btn btn-default btn-submit">PROCEED TO PAYMENT</button>
							</div>
						</div>
				
				</div>
			</div>
			
			<!-- 
				After "Proceed to Payment" submitted below form will sohwup
			-->
			<div class="row">
      	<div class="col-sm-10 col-sm-offset-1 text-sm-center">		
					<h2>Payment Info</h2>
					<p>Every submission is reviewed by a member of our team. Your card will not be charged until your listing is approved.</p>
					<div class="form-Box mB msT">
						<div class="row">
							<div class="col-sm-7 form-group">
								<label class="sr-only" for="">Cardholder Full Name</label>
								<input type="text" class="form-control" id="" placeholder="Cardholder Full Name">
							</div>
							<div class="col-sm-5 form-group">
								<label class="sr-only" for="">Credit Card</label>
								<select class="form-control" id="" >
									<option>Please Select Credit Card Type</option>
									<option>Mastercard</option>
									<option>Visa</option>
									<option>AmericanExpress</option>
									<option>PayPal</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-7 form-group">
								<label class="sr-only" for="">Credit Card Number</label>
								<input type="text" class="form-control" id="" placeholder="Credit Card Number">
							</div>
							<div class="col-sm-5 form-group">
								<label class="sr-only" for="">CVC Code (3 or 4 digit)</label>
								<input type="text" class="form-control" id="" placeholder="CVC Code (3 or 4 digit)">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-7 form-group">
								<label class="sr-only" for="">Address with House Number</label>
								<input type="text" class="form-control" id="" placeholder="Address with House Number">
							</div>
							<div class="col-sm-5 form-group">
								<label class="sr-only" for="">City</label>
								<input type="text" class="form-control" id="" placeholder="City">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-7 form-group">
								<label class="sr-only" for="">State</label>
								<input type="text" class="form-control" id="" placeholder="State">
							</div>
							<div class="col-sm-5 form-group">
								<label class="sr-only" for="">Country</label>
								<input type="text" class="form-control" id="" placeholder="Country">
							</div>
						</div>
					</div><!-- /.form-box -->
					
					<h2 class="sr-only">Submit</h2>
						<div class="row">
							<div class="col-sm-6 saveTxt text-sm-center">
								<p>You’re saving an additional 25% ($18.74)<br>
								<small>By clicking “Pay” you accept our <a href="#">Payment Terms</a></small></p>
							</div>
							<div class="col-sm-6 text-right text-sm-center">
								<p class="payment_price">$31.25</p>
								<button type="submit" class="btn btn-default btn-submit">PAY NOW</button>
							</div>
						</div>
					
      	</div>
      </div>
    </div>
  </section>
     
</div>
