<?php
/**
 * Template Name: Login
 */
?>

<?php if(is_user_logged_in()): ?>
	<script>
		window.location = "<?= home_url() ?>/profile-product";
	</script>
<?php endif; ?>

<div id="template-login">
  
  <section id="signup">
    <div class="container text-center">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">

          <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-circle.svg" class="img-responsive">

          <div> 
            <?php while (have_posts()) : the_post(); ?>
              <?php the_content(); ?>
            <?php endwhile; ?>

            <?php //wp_login_form(); ?>

          </div>
        	
        </div>
      </div>
    </div>
  </section>
  
   
</div>
