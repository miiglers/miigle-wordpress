<?php
/**
 * Template Name: Profile - Product
 */

use Miigle\Models\Product;
use Miigle\Models\User;

if(isset($_GET['user_id'])) {
  $mgl_current_user = User\get($_GET['user_id']);
}
else {
  $mgl_current_user = User\current();
}

$products = Product\get_user_products($mgl_current_user['ID']);
wp_reset_postdata();

?>

<div id="template-profile_product">
  
  <section id="hero">
  	<div class="container-fluid">
  		<div class="row">
        <div class="col-md-10 col-md-offset-1 hero"> 
          <div class="profile-thumb text-center">
        		<!--<a href="#" class="btn btn-follow float-right">Follow</a>-->
        		<img src="<?= $mgl_current_user['avatar'] ?>" class="img-responsive" />
        	</div>
        	<div class="profile-fullname text-center white-text">
        		<?= $mgl_current_user['first_name'] ?>
						<?= $mgl_current_user['last_name'] ?>
				  </div>
        	<div class="profile-title text-center white-text">
        		<?= $mgl_current_user['_mgl_user_title'] ?>
						<?php if( $mgl_current_user['_mgl_user_company']): ?>
        			@ <?= $mgl_current_user['_mgl_user_company'] ?>
						<?php endif; ?>
					</div>
        	<div class="profile-social text-center white-text">
        		<a href="#">@<?= $mgl_current_user['username'] ?></a>
						&nbsp;|&nbsp;
						<?php if( $mgl_current_user['_mgl_user_website']): ?>
        			<a href="<?= $mgl_current_user['website'] ?>" target="_blank">Website</a>
						<?php endif; ?>
						<?php if( $mgl_current_user['_mgl_user_facebook']): ?>
        			&nbsp;|&nbsp;<a href="<?= $mgl_current_user['_mgl_user_facebook'] ?>" target="_blank">Facebook</a>
						<?php endif; ?>
						<?php if( $mgl_current_user['_mgl_user_twitter']): ?>
        			&nbsp;|&nbsp;<a href="<?= $mgl_current_user['_mgl_user_twitter'] ?>" target="_blank">Twitter</a>
						<?php endif; ?>
        	</div>
        	<div class="profile-btn text-center">
        		<a href="#" class="btn btn-profile upvotes">
							<i class="fa fa-star-o" aria-hidden="true"></i> 
							<?= User\get_product_upvotes_count($mgl_current_user['ID']) ?> 
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
            <div class="grid">

              <div class="col-md-4 grid-sizer product-card"></div>
						
  						<div class="col-md-4 grid-item plus-wrap product-card">
                <div class="grid-item-content">
    							<a href="<?= home_url() ?>/product-post">
    								<div class="card-item plus text-center">
    									<div class="plus-wrap">
    										<span class="plus"></span>
    									</div>
    									<p>Post a product</p>
    								</div>
    							</a>
                </div>
  						</div>
  						
  						<?php 
  							$i = 2;
  							foreach($products as $product):
  						?>
  						
  							<div class="col-md-4 grid-item product-card">
                  <div class="grid-item-content">
                    <div class="thumbnail">
                      <a class="product-thumb" id="product-<?= $product->ID ?>" href="<?= get_permalink($product->ID) ?>">
                        <img src="<?= Product\get_thumbnail($product->ID) ?>">
                      </a>
                      <div class="caption">
                        <h3><a href="<?= get_permalink($product->ID) ?>"><?= get_the_title($product->ID) ?></a></h3>
                        <div class="text-two-lines desc">
                          <?= apply_filters('the_content', $product->post_content) ?>
                          <div class="clearfix"></div>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <div>
                              <?php require(locate_template('templates/product/button-upvote.php')); ?>
                              <?php require(locate_template('templates/product/button-comment.php')); ?>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
  						
  						<?php $i++; endforeach; ?>
						
            </div>
        	</div>
        	
        </div>
      </div>
    </div>
  </section>
  
   
</div>
