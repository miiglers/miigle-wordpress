<?php
/**
 * Template Name: Login
 */
?>

<?php if(is_user_logged_in()): ?>
	<script>
		window.location = "/wp-admin";
	</script>
<?php endif; ?>

<div id="template-login">
  
  <section id="signup">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
         <div> 
          <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile; ?>
					
					<?php //wp_login_form(); ?>
					
         </div>
        
        	<!--<section id="social-login">
						<div class="row">
							<div class="divider-new">
								<p class="o-r">OR</p>
							</div>
							<div class="col-md-6">
								<button href="https://twitter.com/miiglers" class="btn tw-bg social-icon rectangle">
								<i class="fa fa-twitter"> </i> <span class="tx">Log In Using Twitter</span></button>
							</div>
							<div class="col-md-6">
								<button href="https://www.facebook.com/miiglers/" class="btn fb-bg social-icon rectangle">
								<i class="fa fa-facebook"> </i> <span class="tx">Log In Using Facebook</span></button>
							</div>
						</div>
					</div>
				</section>-->
        	
        </div>
      </div>
    </div>
  </section>
  
   
</div>
