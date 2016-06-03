<?php
/**
 * Template Name: Product Post
 */
 
$mgl_user = mgl_get_current_user();
?>

<div id="template-product_post">
  
  <section id="product_post">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar hidden-xs" id="profile-sidebar">
        	<div class="profile-thumb text-center">
        		<img src="<?= $mgl_user['avatar'] ?>" /></div>
        	<div class="profile-fullname text-center white-text">
        		<?= $mgl_user['first_name'] ?>
						<?= $mgl_user['last_name'] ?>
					</div>
        	<div class="profile-id text-center white-text">
        		#1</div>
        	<div class="profile-username text-center white-text">
        		@<?= $mgl_user['username'] ?>
					</div>
        	<div class="profile-website text-center">
        		<a href="<?= $mgl_user['website'] ?>" target="_blank"><?= $mgl_user['website'] ?></a>
					</div>
        	<!--<div class="profile-social text-center">
        		<a href="#" target="_blank">Twitter</a>&nbsp;|&nbsp;<a href="#" target="_blank">Facebook</a>
					</div>-->
        	<div class="profile-btn text-center">
        		<a href="<?= home_url() ?>/profile-product" class="btn btn-profile">Go to your profile</a>
					</div>
        	<!--<div class="spacer-profile"></div>
        	<div class="profile-footer text-center">
        		<a href="#" target="_blank">Log out</a>&nbsp;|&nbsp;
        		<a href="#" target="_blank">Blog</a>&nbsp;|&nbsp;
        		<a href="#" target="_blank">Contact</a>
        	</div>-->
        </div>
        
        <div class="col-sm-7 col-sm-offset-1 col-md-6 main"> 
          
					<?php if(current_user_can('subscriber-approved')): ?>
					
						<p class="grey-text">Here's your opportunity to shine. Make it count!</p>

						<h4>Tell us about the product</h4>
						
						Need help? <a href="#">Watch this video on how to post help</a>
						
						<form id="product" method="post" action="wp/v2/mgl_product">
						
							<input type="hidden" name="author" value="<?= $mgl_user['ID'] ?>">
							<input type="hidden" name="status" value="pending">
						
							<div class="form-group" style="margin-top:68px;">
								<div class="row">
									<div class="col-xs-6">
										<input type="text" name="title" class="form-control" placeholder="Product Name" required>
									</div>
									<div class="col-xs-6">
										<input type="text" name="mgl_product_category[]" class="form-control" placeholder="Category" required>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-xs-6">
										<input type="text" name="brand" class="form-control" placeholder="Brand">
									</div>
									<div class="col-xs-6">
										<input type="text" name="url" class="form-control" placeholder="Product url">
									</div>
								</div>
							</div>

							<div class="form-group">
								<textarea rows="5" name="content" class="form-control" placeholder="Enter a brief description (120 character limit)" required></textarea>
							</div>

							<div class="form-group" style="margin-top:80px;">
								<button type="submit" class="btn btn-default submit">
									<i class="fa fa-refresh fa-spin hidden"></i>
									Submit
								</button>
							</div>
						
						</form>

					<?php else: ?>
					
						Posting and commenting on Miigle+ is limited to a growing number of trustworthy people to maintain a healthy volume of submissions and thoughtful dialogue.
						
						<h5>Request an invite</h5>
						
						<form id="request-invite" method="post" action="wp/v2/mgl_role_request">
							
							<input type="hidden" name="author" value="<?= $mgl_user['ID'] ?>">
							<input type="hidden" name="title" value="<?= $mgl_user['email'] ?>">
							<input type="hidden" name="status" value="pending">
							
							<div class="form-group">								
								<textarea rows="3" name="content" class="form-control" placeholder="Tell us a bit about yourself" required></textarea>
							</div>
							
							<div class="form-group">								
								<button type="submit" class="btn btn-default submit">
									<i class="fa fa-refresh fa-spin hidden"></i>
									Submit
								</button>
							</div>
							
						</form>

					<?php endif; ?>
					
        </div>
      </div>
    </div>
  </section>
  
   
</div>
