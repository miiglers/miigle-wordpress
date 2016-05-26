<?php
/**
 * Template Name: Product Page
 */
 
//$user = wp_get_current_user();
?>

<div id="template-product_page">
  
  <section id="product_page">
    <div class="container">      
      <div class="row">
				<div class="col-md-6 col-md-offset-1">
					<div class="row prod-gallery">
						<div class="col-xs-2"> 
							<div class="previews">
								<a href="#" class="selected" data-full="<?php echo get_template_directory_uri(); ?>/assets/images/prod1.jpg"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/prod1.jpg" class="img-responsive" /></a> 
								<a href="#" class="" data-full="<?php echo get_template_directory_uri(); ?>/assets/images/prod2.jpg"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/prod2.jpg" class="img-responsive" /></a> 
								<a href="#" class="" data-full="<?php echo get_template_directory_uri(); ?>/assets/images/prod3.jpg"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/prod3.jpg" class="img-responsive" /></a> 
								<a href="#" class="" data-full="<?php echo get_template_directory_uri(); ?>/assets/images/prod4.jpg"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/prod4.jpg" class="img-responsive" /></a>
								<!-- MAX IMG 6 -->
							</div>
						</div>
						<div class="col-xs-10">
							<div class="full">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/prod1.jpg" class="img-responsive" />
							</div>
							<div class="share-action">
								<a class="twitter-share-button" href="https://twitter.com/intent/tweet"><i class="fa fa-twitter" aria-hidden="true"></i> Share this</a>
								<a class="facebook-share-button" href=""><i class="fa fa-facebook" aria-hidden="true"></i> Share this</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="prod-info">
						<h1>Product Name</h1>
						<p class="brand-name">From:Brand</p>
						<p>Discover great products from people just like you who care about our planet Discover great products from people. Discover great products from people just like you who care about our planet Discover great products from people. Discover great products from people just like you who care about.</p>
					</div>
					<div class="prod-meta">
						<a href="#" class="btn btn-profile trend"><strong>#1</strong> in Fashion</a>
						<a href="#" class="btn btn-profile upvotes"><i class="fa fa-star-o" aria-hidden="true"></i> 3,003</a>
						<a href="#" class="btn btn-profile comment"><i class="fa fa-commenting-o" aria-hidden="true"></i> 9</a>
					</div>
					<hr>
					<div class="prod-action">
						<div class="row">
							<div class="col-sm-6">
								<a href="#" class="btn btn-getProd">Get this product <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
							</div>
							<div class="col-sm-6">
								<a href="#" class="btn btn-saveProd">Save this product</a>
							</div>
						</div>
					</div>
				</div>      	      	      	
    	</div>
    </div>
  </section>
  
  <section id="about-brand">
  	 <div class="container">      
      <div class="row title">
      	<h2>About the Brand</h2>
      </div>
      <div class="row">
      	<div class="col-md-6">
      		<div class="our-story-img">
      			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/our-story-img.png" class="img-responsive"/>
      		</div>
      		<div class="community-badges">
      			<h3>Community Badges:</h3>
      			<div class="badges"><span class="oval most-liked">&nbsp;</span><span class="txt">Most liked</span></div>
      			<div class="badges"><span class="oval international">&nbsp;</span><span class="txt">International</span></div>
      			<div class="badges"><span class="oval eco-friendly">&nbsp;</span><span class="txt">Eco-friendly</span></div>
      			<div class="badges"><span class="oval cost-supporting">&nbsp;</span><span class="txt">Cost Supporting</span></div>
      		</div>
      	</div>
      	<div class="col-md-6">
      		<div class="our-story">
      			<p>Discover great products from people just like you who care about our planet Discover great products from people. Discover great products from people just like you who care about our planet Discover great products from people. Discover great products from people just like you who care about our planet Discover great products from people. Discover great products from people just like you who care about our planet Discover great products from people.Discover great products from people just like you Discover great products from people Discover great products from people just like you who care about our planet Discover great products from people. Discover great products from people just like you</p> 
						<p>Discover great products from people just like you who care about our planet Discover great products from people. Discover great products from people just like you who care about our planet Discover great products from people. Discover great products from people just like you who care about our planet Discover great products from people. Discover great products from people just like you who care about our planet Discover great products</p>
						<blockquote><p>“There are millions of people working hard every day to make this world a better place and we didn’t want to sit on the sidelines.”</p></blockquote>
      		</div>	
      	</div>
      </div>
    </div>
  </section> 


</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script> 
<script>
  $(document).ready(function(){
    $('.previews a').click(function(){
      var largeImage = $(this).attr('data-full');
      $('.selected').removeClass();
      $(this).addClass('selected');
      $('.full img').hide();
      $('.full img').attr('src', largeImage);
      $('.full img').fadeIn();
    });
  });
  </script>