<?php
/**
 * Template Name: Profile - Product
 */

use Miigle\Models\Product;
use Miigle\Models\User;
 
$mgl_user = User\current();
$products = Product\get_user_products($mgl_user['ID']);
wp_reset_postdata();
?>

<div id="template-profile_product">
  
  <section id="hero">
  	<div class="container-fluid">
  		<div class="row">
        <div class="col-md-10 col-md-offset-1 hero"> 
          <div class="profile-thumb text-center">
        		<!--<a href="#" class="btn btn-follow float-right">Follow</a>-->
        		<img src="<?= $mgl_user['avatar'] ?>" class="img-responsive" />
        	</div>
        	<div class="profile-fullname text-center white-text">
        		<?= $mgl_user['first_name'] ?>
						<?= $mgl_user['last_name'] ?>
				  </div>
        	<div class="profile-title text-center white-text">
        		<?= $mgl_user['_mgl_user_title'] ?>
						<?php if( $mgl_user['_mgl_user_company']): ?>
        			@ <?= $mgl_user['_mgl_user_company'] ?>
						<?php endif; ?>
					</div>
        	<div class="profile-social text-center white-text">
        		<a href="#">@<?= $mgl_user['username'] ?></a>
						&nbsp;|&nbsp;
						<?php if( $mgl_user['_mgl_user_website']): ?>
        			<a href="<?= $mgl_user['website'] ?>" target="_blank">Website</a>
						<?php endif; ?>
						<?php if( $mgl_user['_mgl_user_facebook']): ?>
        			&nbsp;|&nbsp;<a href="<?= $mgl_user['_mgl_user_facebook'] ?>" target="_blank">Facebook</a>
						<?php endif; ?>
						<?php if( $mgl_user['_mgl_user_twitter']): ?>
        			&nbsp;|&nbsp;<a href="<?= $mgl_user['_mgl_user_twitter'] ?>" target="_blank">Twitter</a>
						<?php endif; ?>
        	</div>
        	<div class="profile-btn text-center">
        		<a href="#" class="btn btn-profile upvotes">
							<i class="fa fa-star-o" aria-hidden="true"></i> 
							<?= User\get_upvoted_products_count($mgl_user['ID']) ?> 
							- Upvotes
						</a>
        		<a href="#" class="btn btn-profile submitted">
							<i class="fa fa-external-link" aria-hidden="true"></i>  
							<?= count($products) ?>
							- Submitted
						</a>
        		<!--<a href="#" class="btn btn-profile following"><i class="fa fa-users" aria-hidden="true"></i> 4 - Following</a>
        		<a href="#" class="btn btn-profile followers"><i class="fa fa-user-plus" aria-hidden="true"></i> 4 - Followers</a>-->
        	</div>
        </div>
      </div>
  	</div>
  </section>
  
  <section id="profile_product">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1 main"> 
        	
        	<!-- Card Item -->
        	<div class="row">
						
						<div class="col-sm-4 plus-wrap">
							<a href="<?= home_url() ?>/product-post">
								<div class="card-item plus text-center">
									<div class="plus-wrap">
										<span class="plus"></span>
									</div>
									<p>Post a product</p>
								</div>
							</a>
						</div>
						
						<?php 
							$i = 2;
							foreach($products as $product):
						?>
						
							<div class="col-sm-4">
								<div class="card-item">
									<div class="profile-thumb text-center">
										<img src="<?= wp_get_attachment_image_src(get_post_thumbnail_id($product->ID), 'full')[0] ?>" class="img-responsive" />
									</div>
									<div class="profile-fullname">
										<a href="<?= get_permalink($product->ID) ?>"><?= $product->post_title ?></a>
									</div>
									<div class="profile-brand">
										<?= Product\get_brand_title($product->ID) ?>
									</div>
									<div class="profile-description">
										<?= wp_trim_words($product->post_content) ?>
									</div>
									<div class="profile-website">
										<a href="<?= Product\get_url($product->ID) ?>"><?= Product\get_url($product->ID) ?></a>
									</div>
									<div class="profile-meta">
										<!--<a href="#" class="btn btn-profile trend">Trending in fashion</a>-->
										<a href="#" class="btn btn-profile upvotes"><i class="fa fa-star-o" aria-hidden="true"></i> <?= Product\get_upvotes($product->ID) ?></a>
										<a href="#" class="btn btn-profile comment"><i class="fa fa-commenting-o" aria-hidden="true"></i> <?= Product\get_comments_count($product->ID) ?></a>
									</div>
									<!--<div class="profile-follower">
										<img src="<?php //echo get_template_directory_uri(); ?>/assets/images/profile-thumb.png" />
										<span class="user-name">James Tanner</span>
										<span class="user-cat">Fashion</span>
									</div>-->
								</div>
							</div>
							
							<?php if(($i % 3) == 0): ?>
								</div>
								<div class="row">
							<?php endif; ?>
						
						<?php $i++; endforeach; ?>
						
        	</div>
        	<!--./ Card Item -->
        	
        	<!-- Show more 
        	<div class="row">
        		<div class="col-md-12 text-center showmore">
        			<a href="#" class="btn btn-showmore">Show more</a>
        		</div>
        	</div>-->
        	
        </div>
      </div>
    </div>
  </section>
  
   
</div>
