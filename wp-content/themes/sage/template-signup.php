<?php
/**
 * Template Name: Sign Up
 */
?>

<div id="template-signup">
  
  <section id="signup">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
         	<div class="text-center"> 
						<?php while (have_posts()) : the_post(); ?>
							<?php the_content(); ?>
						<?php endwhile; ?>
         	</div>
				 
				 	<form id="signup-form" action="wp/v2/users" method="post">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" name="firstName" class="form-control" placeholder="First Name" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input type="text" name="lastName" class="form-control" placeholder="Last Name" required>
								</div>
							</div>
						</div>

						<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="Email" required>
						</div>

						<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Password" required>
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary pull-left">
								<i class="fa fa-refresh fa-spin hidden"></i> &nbsp;
								Create new account
							</button>
						</div>
				 	</form>
        
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
