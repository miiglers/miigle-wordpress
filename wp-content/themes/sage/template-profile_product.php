<?php
/**
 * Template Name: Profile - Product
 */

use Miigle\Models\Product;
use Miigle\Models\User;
 
$mgl_user = User\current();
$products = Product\get_user_products($mgl_user['ID']);
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
        	<!--<div class="profile-title text-center white-text">
        		Title</div>-->
        	<div class="profile-social text-center white-text">
        		<a href="#">@<?= $mgl_user['username'] ?></a>
						&nbsp;|&nbsp;
        		<a href="<?= $mgl_user['website'] ?>" target="_blank"><?= $mgl_user['website'] ?></a>
						<!--&nbsp;|&nbsp;
        		<a href="#" target="_blank">Twitter</a>&nbsp;|&nbsp;
        		<a href="#" target="_blank">Facebook</a>&nbsp;|&nbsp;-->
        	</div>
        	<div class="profile-btn text-center">
        		<a href="#" class="btn btn-profile upvotes"><i class="fa fa-star-o" aria-hidden="true"></i> 95 - Upvotes</a>
        		<a href="#" class="btn btn-profile submitted">
							<i class="fa fa-external-link" aria-hidden="true"></i>  
							<?= $products->found_posts ?>
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
						
						<?php 
							$i = 1;
							while($products->have_posts()): 
								$products->the_post(); 
						?>
						
							<div class="col-sm-4">
								<div class="card-item">
									<div class="profile-thumb text-center">
										<img src="<?php the_post_thumbnail_url(); ?>" class="img-responsive" />
									</div>
									<div class="profile-fullname">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</div>
									<div class="profile-brand">
										<?= Product\get_brand_title(get_the_ID()) ?>
									</div>
									<div class="profile-description">
										<?php the_excerpt(); ?>
									</div>
									<div class="profile-website">
										<a href="<?= Product\get_url(get_the_ID()) ?>"><?= Product\get_url(get_the_ID()) ?></a>
									</div>
									<div class="profile-meta">
										<!--<a href="#" class="btn btn-profile trend">Trending in fashion</a>-->
										<a href="#" class="btn btn-profile upvotes"><i class="fa fa-star-o" aria-hidden="true"></i> <?= Product\get_upvotes(get_the_ID()) ?></a>
										<a href="#" class="btn btn-profile comment"><i class="fa fa-commenting-o" aria-hidden="true"></i> <?= Product\get_comments_count(get_the_ID()) ?></a>
									</div>
									<!--<div class="profile-follower">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/profile-thumb.png" />
										<span class="user-name">James Tanner</span>
										<span class="user-cat">Fashion</span>
									</div>-->
								</div>
							</div>
							
							<?php if(($i % 3) == 0): ?>
								</div>
								<div class="row">
							<?php endif; ?>
						
						<?php $i++; endwhile; ?>
						
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
