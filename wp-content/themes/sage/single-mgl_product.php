<?php
/**
 * Template Name: Product Page
 */
 
use Miigle\Models\Product;
use Miigle\Models\Brand;
use Miigle\Models\User;
use Miigle\Helpers;
global $post;

$gallery = Product\get_image_gallery($post->ID);
$brand = Product\get_brand($post->ID);
if($brand) {
  $brand_url = Helpers\format_url(Brand\get_url($brand->ID));
  $brand_title = $brand->post_title;
  $badges = Brand\get_badges($brand->ID);
}
else {
  $brand_url = Helpers\format_url(Product\get_brand_url($post->ID));
  $brand_title = $brand_url;
}
$mgl_current_user = User\current();
$product_author = User\get($post->post_author);
$product_id = $post->ID;
//var_dump($product_author);

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
  								<a href="#" <?php if($k == 0): ?>class="active"<?php endif; ?> data-img="<?= $v['image'] ?>">
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
                <div class="row">
                  <div class="col-md-6">
                    <div class="media">
                      <div class="media-left">
                        <a href="<?= home_url() ?>/profile-product?user_id=<?= $product_author['ID'] ?>">
                          <img class="media-object" src="<?= $product_author['avatar'] ?>">
                        </a>
                      </div>
                      <div class="media-body">                    
                        <h5 class="media-heading">
                          <a href="<?= home_url() ?>/profile-product?user_id=<?= $product_author['ID'] ?>">
                            <?= $product_author['full_name'] ?>
                          </a>
                        </h5>
                        <?php foreach(Product\get_categories(get_the_ID()) as $category): ?>
                          <?php if(!$category->parent): ?>
                            <a href="<?= home_url() ?>/category/<?= $category->slug ?>">
                              <?= $category->name ?>
                            </a>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="social-wrap">
    								  <?= do_shortcode('[TheChamp-Sharing]'); ?>
                    </div>
                  </div>
                </div><!-- .row -->
                <?php if(Product\get_author_comment(get_the_ID())): ?>
                  <div class="row">
                    <div class="col-md-12">
                      <blockquote>
                        <i class="fa fa-quote-left"></i>                      
                        <?= Product\get_author_comment(get_the_ID()) ?>
                        <i class="fa fa-quote-right"></i>
                      </blockquote>
                    </div>
                  </div>
                <?php endif; ?>
							</div><!-- .share-action -->
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="prod-info">
						<h1><?php the_title(); ?></h1>
						<p class="brand-name">From: <a target="_blank" href="<?= $brand_url ?>"><?= $brand_title ?></a></p>
						<?php the_content(); ?>
					</div>
					<div class="prod-meta">
						<?php require_once(locate_template('templates/product/button-upvote.php')); ?>
						<?php require_once(locate_template('templates/product/button-comment.php')); ?>
					</div>
					<hr>
					<div class="prod-action">
						<div class="btn-group pull-right">
              <a href="#" class="btn btn-default btn-price">
                <?= Product\get_price(get_the_ID()) ?>
              </a>
							<a href="<?= Product\get_url(get_the_ID()) ?>" class="btn btn-primary" target="_blank">
                Buy it <i class="fa fa-arrow-right" aria-hidden="true"></i>
              </a>
						</div>
					</div>
				</div>      	      	      	
    	</div>
    </div>
  </section>
  
  <?php if($brand): ?>

    <section id="about-brand">
    	 <div class="container">      
        <div class="row title">
        	<div class="col-md-12">
        		<h2>About <a href="<?= Brand\get_url($brand->ID) ?>"><?= $brand->post_title ?></a></h2>
        	</div>
        </div>
        <div class="row brand-entry">
        	<div class="col-md-6">
        		<div class="our-story-img">
        			<img src="<?= wp_get_attachment_image_src(get_post_thumbnail_id($brand->ID), 'full')[0] ?>" class="img-responsive"/>
        		</div>
            <?php if($badges): ?>
          		<div class="community-badges">
          			<h3>Community Badges:</h3>
                  <?php foreach($badges as $badge): ?>
          				<div class="badges">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/badges-<?= $badge->slug ?>.png" class="oval img-responsive"/>
                    <span class="txt"><?= $badge->name ?></span>
                  </div>
          				<?php endforeach; ?>
              </div>
            <?php endif; ?>
        	</div>
        	<div class="col-md-6">
        		<div class="our-story">
        			<?= apply_filters('the_content', $brand->post_content) ?>
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
              <a target="_blank" href="<?= Helpers\format_url(Brand\get_url($brand->ID)) ?>" class="btn btn-lg btn-cta">Visit <?= $brand->post_title ?></a>
  					</div>
        	</div>
        </div>	
      </div>
    </section> 

  <?php endif; ?>
	
	<section id="discussion">
		<div class="container text-center">      
      <div class="row">
      	<div class="col-lg-10 col-lg-offset-1">

          <?php if($post->comment_count || current_user_can('subscriber-approved')): ?>
        		<h2>Discussion</h2>
        		<hr>
          <?php endif; ?>
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
