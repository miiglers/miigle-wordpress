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
      	<div class="col-md-12">
      		<h2>About the Brand</h2>
      	</div>
      </div>
      <div class="row brand-entry">
      	<div class="col-md-6">
      		<div class="our-story-img">
      			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/our-story-img.png" class="img-responsive"/>
      		</div>
      		<div class="community-badges">
      			<h3>Community Badges:</h3>
      				<div class="badges"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/badges-most-liked.png" class="oval img-responsive"/><span class="txt">Most liked</span></div>
      				<div class="badges"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/badges-international.png" class="oval img-responsive"/><span class="txt">International</span></div>
      				<div class="badges"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/badges-eco-friendly.png" class="oval img-responsive"/><span class="txt">Eco-friendly</span></div>
      				<div class="badges"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/badges-cost-supporting.png" class="oval img-responsive"/><span class="txt">Cost Supporting</span></div>
      		</div>
      	</div>
      	<div class="col-md-6">
      		<div class="our-story">
      			<p>Discover great products from people just like you who care about our planet Discover great products from people. Discover great products from people just like you who care about our planet Discover great products from people. Discover great products from people just like you who care about our planet Discover great products from people. Discover great products from people just like you who care about our planet Discover great products</p>
      			<p>from people.Discover great products from people just like you Discover great products from people Discover great products from people just like you who care about our planet Discover great products from people. Discover great products from people just like you</p> 
						<p>Discover great products from people just like you who care about our planet Discover great products from people. Discover great products from people just like you who care about our planet Discover great products from people. Discover great products from people just like you who care about our planet Discover great products from people. Discover great products from people just like you who care about our planet Discover great products</p>
						<hr>
						<blockquote><p>“There are millions of people working hard every day to make this world a better place and we didn’t want to sit on the sidelines.”</p></blockquote>
      		</div>	
      	</div>
      </div>
      <div class="row brand-video">
      	<div class="col-md-6">
      		<img src="<?php echo get_template_directory_uri(); ?>/assets/images/brand-video1.jpg" class="img-responsive"/>
      	</div>
      	<div class="col-md-6">
      		<img src="<?php echo get_template_directory_uri(); ?>/assets/images/brand-video2.jpg" class="img-responsive"/>
      	</div>
      </div>
      <div class="row brand-location">
      	<div class="col-md-12">
      		<h3>Where it all happens</h3>
      		<div class="map-wrapper">
      			<!-- Google Map embed -->
      			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3168.621187689043!2d-122.08651748469237!3d37.422427679825034!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fba027820e5d9%3A0x60a90600ff6e7e6e!2s1600+Amphitheatre+Pkwy%2C+Mountain+View%2C+CA+94043!5e0!3m2!1sen!2sus!4v1464384842902" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
      		</div>
      	</div>
      </div>
      <div class="row cta-bar">
      	<div class="col-md-12">
      		<div class="cta-bar-bg">
						<p>Lorem ipsum Lorem ipsum Lorem ipsumLorem ipsum</p>
						<a href="#" class="btn btn-cta">Shop brand name</a>
					</div>
      	</div>
      </div>	
    </div>
  </section> 
	
	<section id="discussion">
		<div class="container">      
      <div class="row">
      	<div class="col-md-9">
      		<h2>Discussion</h2>
      		<hr>
      		<!-- Comment Placeholder -->
      		<img src="<?php echo get_template_directory_uri(); ?>/assets/images/dummy-comment.png" class="img-responsive"/>
      		<!--./ Comment Placeholder -->
      	</div>
      	<div class="col-md-3">
      		<div class="widget-spacer"></div>
      		<div class="widget-card">
      			<h4>All for 1, 1 for all</h4>
      			<p>See what products your friends are loving on Miigle+</p>
      			<a class="twitter-share-button" href="https://twitter.com/intent/tweet"><i class="fa fa-twitter" aria-hidden="true"></i> Login using Twitter</a>
      			<a class="facebook-share-button" href=""><i class="fa fa-facebook" aria-hidden="true"></i> Share this</a>
      		</div>
      		<div class="widget-card">
      			<h4>Don’t miss a beat!</h4>
      			<p>Get products like this delivered to your inbox weekly.</p>
      			<input type="text" placeholder="Enter your email">
      			<a href="#" class="btn btn-submit">Keep me in the loop</a>
      		</div>
      		<div class="widget-card">
      			<h4>More from (Brand)</h4>
      			<div class="item">
      				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/brand-thumb1.jpg" class="img-responsive"/>
      				<a href="#" class="btn btn-profile upvotes"><i class="fa fa-star-o" aria-hidden="true"></i> 3,003</a>
      				<a href="#" class="btn btn-profile comment"><i class="fa fa-commenting-o" aria-hidden="true"></i> 9</a>
      			</div>
      			<div class="item">
      				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/brand-thumb2.jpg" class="img-responsive"/>
      				<a href="#" class="btn btn-profile upvotes"><i class="fa fa-star-o" aria-hidden="true"></i> 3,003</a>
      				<a href="#" class="btn btn-profile comment"><i class="fa fa-commenting-o" aria-hidden="true"></i> 9</a>
      			</div>
      			<a href="#" class="btn btn-saveProd">See all</a>
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