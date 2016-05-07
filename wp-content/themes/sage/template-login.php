<?php
/**
 * Template Name: Login
 */
?>

<div id="template-login">
  
  <section id="signup">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
         <div class="text-center"> 
          <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile; ?>
          <!-- Forgot PW function -->
          <p class="small text-left">Forgot your password?</p>
         </div>
        
        	<section id="social-login">
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
				</section>
        	
        </div>
      </div>
    </div>
  </section>
  
   
</div>
