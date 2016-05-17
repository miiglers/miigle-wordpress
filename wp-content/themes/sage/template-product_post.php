<?php
/**
 * Template Name: Product Post
 */
?>

<div id="template-product_post">
  
  <section id="product_post">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" id="profile-sidebar">
        	<div class="profile-thumb text-center">
        		<img src="<?php echo get_template_directory_uri(); ?>/assets/images/profile-thumb.png" /></div>
        	<div class="profile-fullname text-center white-text">
        		Full name</div>
        	<div class="profile-id text-center white-text">
        		#1</div>
        	<div class="profile-username text-center white-text">
        		@miigle_username</div>
        	<div class="profile-website text-center">
        		<a href="#" target="_blank">website.com</a></div>
        	<div class="profile-social text-center">
        		<a href="#" target="_blank">Twitter</a>&nbsp;|&nbsp;<a href="#" target="_blank">Facebook</a></div>
        	<div class="profile-btn text-center">
        		<a href="#" class="btn btn-profile">Go to your profile</a></div>
        	<div class="spacer-profile"></div>
        	<div class="profile-footer text-center">
        		<a href="#" target="_blank">Log out</a>&nbsp;|&nbsp;
        		<a href="#" target="_blank">Blog</a>&nbsp;|&nbsp;
        		<a href="#" target="_blank">Contact</a>
        	</div>
        </div>
        
        <div class="col-sm-7 col-sm-offset-4 col-md-6 col-md-offset-4 main"> 
          <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </section>
  
   
</div>
