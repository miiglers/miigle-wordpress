<?php
/**
 * Template Name: Profile - Product
 */

use Miigle\Models\Product;
use Miigle\Models\User;
use Miigle\Helpers;

$mgl_current_user = User\current();
$is_owner = false;

if(isset($_GET['user_id'])) {
  $profile_user = User\get($_GET['user_id']);
}
else {
  $profile_user = $mgl_current_user;
}

if($profile_user['ID'] == $mgl_current_user['ID']){
  $is_owner = true;
}

$submitted_products = Product\get_user_products($profile_user['ID'], $is_owner);

if(isset($_GET['upvoted'])) {
  $upvoted_class = 'active';
  $submitted_class = '';
  $products = Product\get_user_products_upvoted($profile_user['ID'], $is_owner);
}
else {
  $upvoted_class = '';
  $submitted_class = 'active';
  $products = $submitted_products;
}

wp_reset_postdata();

?>

<div id="template-profile_product">
  
  <section id="hero">
  	<div class="container-fluid">
  		<div class="row">
        <div class="col-md-10 col-md-offset-1 hero"> 
          <div class="profile-thumb text-center">
        		<!--<a href="#" class="btn btn-follow float-right">Follow</a>-->
        		<img src="<?= $profile_user['avatar'] ?>" class="img-responsive" />
        	</div>
        	<div class="profile-fullname text-center white-text">
        		<?= $profile_user['first_name'] ?>
						<?= $profile_user['last_name'] ?>
				  </div>
        	<div class="profile-title text-center white-text">
        		<?= $profile_user['_mgl_user_title'] ?>
						<?php if( $profile_user['_mgl_user_company']): ?>
        			@ <?= $profile_user['_mgl_user_company'] ?>
						<?php endif; ?>
					</div>
        	<div class="profile-social text-center white-text">
        		<a href="#">@<?= $profile_user['username'] ?></a>
						&nbsp;|&nbsp;
						<?php if( $profile_user['_mgl_user_website']): ?>
        			<a href="<?= Helpers\format_url($profile_user['_mgl_user_website']) ?>" target="_blank">Website</a>
						<?php endif; ?>
						<?php if( $profile_user['_mgl_user_facebook']): ?>
        			&nbsp;|&nbsp;<a href="<?= Helpers\format_url($profile_user['_mgl_user_facebook']) ?>" target="_blank">Facebook</a>
						<?php endif; ?>
						<?php if( $profile_user['_mgl_user_twitter']): ?>
        			&nbsp;|&nbsp;<a href="<?= Helpers\format_url($profile_user['_mgl_user_twitter']) ?>" target="_blank">Twitter</a>
						<?php endif; ?>
        	</div>
        	<div class="profile-btn text-center">
        		<a href="?upvoted&user_id=<?= $profile_user['ID'] ?>" class="btn btn-profile upvotes <?= $upvoted_class ?>">
							<i class="fa fa-caret-up" aria-hidden="true"></i> 
							<?= User\get_product_upvotes_count($profile_user['ID']) ?> 
							- Upvotes
						</a>
        		<a href="?submitted&user_id=<?= $profile_user['ID'] ?>" class="btn btn-profile submitted <?= $submitted_class ?>">
							<i class="fa fa-external-link" aria-hidden="true"></i>  
							<?= count($submitted_products) ?>
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
        <div class="col-md-8 col-md-offset-2 main"> 
        	
        	<!-- Card Item -->
        	<div class="row">
            <div class="grid">

              <div class="col-md-4 grid-sizer product-card"></div>
						
              <?php if($is_owner): ?>
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
              <?php endif; ?>
  						
  						<?php 
  							$i = 2;
  							foreach($products as $product):
                  $product_id = $product->ID;
  						?>
  						
  							<div class="col-md-4 grid-item product-card">
                  <div class="grid-item-content">
                    <div class="thumbnail">
                      <a class="product-thumb" id="product-<?= $product->ID ?>" href="<?= get_permalink($product->ID) ?>">
                        <img src="<?= Product\get_thumbnail($product->ID) ?>">
                      </a>
                      <div class="caption">
                        <h3 class="title">
                          <a href="<?= get_permalink($product->ID) ?>">
                            <?php if(get_post_status($product->ID) == 'pending'): ?>
                              <?= Product\get_url($product->ID) ?>  
                            <?php else: ?>
                              <?= get_the_title($product->ID) ?>  
                            <?php endif; ?>        
                          </a>
                        </h3>
                        <div class="dotdotdot-wrap desc">
                          <div class="dotdotdot">
                            <?php if(get_post_status($product->ID) == 'pending'): ?>
                              <em class="text-muted">Pending Approval</em>
                            <?php else: ?>
                              <?= apply_filters('the_content', $product->post_content) ?>
                            <?php endif; ?>
                          </div>
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
