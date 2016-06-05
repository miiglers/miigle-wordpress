<?php
/**
 * Template Name: Product Page
 */
 
use Miigle\Models\Product;
use Miigle\Models\Brand;
use Miigle\Models\User;

$gallery = Product\get_image_gallery(get_the_ID());
$brand = Product\get_brand(get_the_ID());
$mgl_user = User\current();
$upvoted = User\has_upvoted_product($mgl_user['ID'], get_the_ID());

wp_reset_postdata();

?>

<div id="template-product_page">
  
  <section id="product_page">
    <div class="container">      
      <div class="row">
				<div class="col-md-6 col-md-offset-1">
					<div class="row prod-gallery">
						<div class="col-xs-2"> 
							<div class="previews">
                <?php foreach($gallery as $k => $v): ?>
								<a href="#" <?php if($k == 0): ?>class="selected"<?php endif; ?> data-full="<?= $v['image'] ?>">
                  <img src="<?= $v['image'] ?>" class="img-responsive" />
                </a> 
								<?php endforeach; ?>
							</div>
						</div>
						<div class="col-xs-10">
							<div class="full">
								<img src="<?= $gallery[0]['image'] ?>" class="img-responsive" />
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
						<h1><?php the_title(); ?></h1>
						<p class="brand-name"><a href="<?= get_permalink($brand->ID) ?>"><?= $brand->post_title ?></a></p>
						<?php the_content(); ?>
					</div>
					<div class="prod-meta">
						<!--<a href="#" class="btn btn-profile trend"><strong>#1</strong> in Fashion</a>-->
						<form class="upvote" id="product-upvote" method="post" action="mgl/v1/product/upvote">
							<input type="hidden" name="product_id" value="<?php the_ID(); ?>"> 
							<span class="label label-danger label-btn btn-upvote" data-upvoted="<?php if($upvoted): ?>1<?php else: ?>0<?php endif; ?>">								
								<i class="fa fa-star<?php if(!$upvoted): ?>-o<?php endif; ?>"></i> 
								<?= Product\get_upvotes(get_the_ID()) ?>
							</span>
						</form>
						<span class="label label-pink label-btn"><i class="fa fa-commenting-o"></i> <?= Product\get_comments_count(get_the_ID()) ?></span>
					</div>
					<hr>
					<div class="prod-action">
						<div class="row">
							<div class="col-sm-6">
								<a href="<?= Product\get_url(get_the_ID()) ?>" class="btn btn-getProd" target="_blank">Get this product <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
							</div>
							<!--<div class="col-sm-6">
								<a href="#" class="btn btn-saveProd">Save this product</a>
							</div>-->
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
      			<img src="<?= wp_get_attachment_image_src(get_post_thumbnail_id($brand->ID), 'full')[0] ?>" class="img-responsive"/>
      		</div>
      		<div class="community-badges">
      			<h3>Community Badges:</h3>
              <?php foreach(Brand\get_badges($brand->ID) as $badge): ?>
      				<div class="badges">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/badges-<?= $badge->slug ?>.png" class="oval img-responsive"/>
                <span class="txt"><?= $badge->name ?></span>
              </div>
      				<?php endforeach; ?>
          </div>
      	</div>
      	<div class="col-md-6">
      		<div class="our-story">
      			<?= $brand->post_content ?>
      		</div>	
      	</div>
      </div>
      <!--<div class="row brand-video">
      	<div class="col-md-6">
      		<img src="<?php //echo get_template_directory_uri(); ?>/assets/images/brand-video1.jpg" class="img-responsive"/>
      	</div>
      	<div class="col-md-6">
      		<img src="<?php //echo get_template_directory_uri(); ?>/assets/images/brand-video2.jpg" class="img-responsive"/>
      	</div>
      </div>-->
      <!--<div class="row brand-location">
      	<div class="col-md-12">
      		<h3>Where it all happens</h3>
      		<div class="map-wrapper">
      			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3168.621187689043!2d-122.08651748469237!3d37.422427679825034!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fba027820e5d9%3A0x60a90600ff6e7e6e!2s1600+Amphitheatre+Pkwy%2C+Mountain+View%2C+CA+94043!5e0!3m2!1sen!2sus!4v1464384842902" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
      		</div>
      	</div>
      </div>-->
      <div class="row cta-bar">
      	<div class="col-md-12">
      		<div class="cta-bar-bg">
						<!--<p>Lorem ipsum Lorem ipsum Lorem ipsumLorem ipsum</p>-->
						<a href="<?= get_permalink($brand->ID) ?>" class="btn btn-cta">Shop brand name</a>
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
      		<?php comments_template('/templates/comments.php'); ?>
      	</div>
        
      	<!--<div class="col-md-3">
          
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
          
      	</div>-->
      </div>
    </div>
	</section>

</div>
