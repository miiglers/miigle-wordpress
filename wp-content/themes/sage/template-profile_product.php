<?php
/**
 * Template Name: Profile - Product
 */
 
$current_user = mgl_get_current_user();
?>

<div id="template-profile_product">
  
  <section id="hero">
  	<div class="container-fluid">
  		<div class="row">
        <div class="col-md-10 col-md-offset-1 hero"> 
          <div class="profile-thumb text-center">
        		<!--<a href="#" class="btn btn-follow float-right">Follow</a>-->
        		<img src="<?= $current_user['avatar'] ?>" class="img-responsive" />
        	</div>
        	<div class="profile-fullname text-center white-text">
        		<?= $current_user['first_name'] ?>
						<?= $current_user['last_name'] ?>
				  </div>
        	<!--<div class="profile-title text-center white-text">
        		Title</div>-->
        	<div class="profile-social text-center white-text">
        		<a href="#">@<?= $current_user['username'] ?></a>&nbsp;|&nbsp;
        		<a href="<?= $current_user['website'] ?>" target="_blank"><?= $current_user['website'] ?></a>&nbsp;|&nbsp;
        		<a href="#" target="_blank">Twitter</a>&nbsp;|&nbsp;
        		<a href="#" target="_blank">Facebook</a>&nbsp;|&nbsp;
        	</div>
        	<div class="profile-btn text-center">
        		<a href="#" class="btn btn-profile upvotes"><i class="fa fa-star-o" aria-hidden="true"></i> 95 - Upvotes</a>
        		<a href="#" class="btn btn-profile submitted"><i class="fa fa-external-link" aria-hidden="true"></i> 4 - Submitted</a>
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
						
        		<div class="col-sm-4">
        			<div class="card-item">
        				<div class="profile-thumb text-center">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/images/product-thumb1.png" class="img-responsive" />
								</div>
								<div class="profile-fullname">
									Product name</div>
								<div class="profile-brand">
									Brand</div>
								<div class="profile-description">
									<p>Discover great products from people just like you who care...</p></div>
								<div class="profile-website">
        					<a href="productname.com">productname.com</a></div>
        				<div class="profile-meta">
        					<a href="#" class="btn btn-profile trend">Trending in fashion</a>
        					<a href="#" class="btn btn-profile upvotes"><i class="fa fa-star-o" aria-hidden="true"></i> 95</a>
        					<a href="#" class="btn btn-profile comment"><i class="fa fa-commenting-o" aria-hidden="true"></i> 4</a>
        				</div>
        				<div class="profile-follower">
        					<img src="<?php echo get_template_directory_uri(); ?>/assets/images/profile-thumb.png" />
        					<span class="user-name">James Tanner</span>
        					<span class="user-cat">Fashion</span>
        				</div>
        			</div>
        		</div>
						
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
