<?php
/**
 * Template Name: Product Post
 */

use Miigle\Models\User;
use Miigle\Models\Brand;
 
$mgl_user = User\current();

$categories = get_terms(array(
    'taxonomy' => 'mgl_product_category',
    'hide_empty' => false,
));

$brands = Brand\get_posts();
?>

<div id="template-product_post">
  
  <section id="product_post">
    <div class="container-fluid">
      <div class="row">
        
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-md-6 main"> 
          
					<?php if(current_user_can('subscriber-approved')): ?>
					
						<p class="grey-text">Here's your opportunity to shine. Make it count!</p>

						<h4>Tell us about the product</h4>
						
						Need help? <a href="#">Watch this video on how to post help</a>
						
						<form id="product" method="post" action="mgl/v1/product">
						
							<input type="hidden" name="author" value="<?= $mgl_user['ID'] ?>">
							<input type="hidden" name="status" value="pending">
						
							<div class="form-group" style="margin-top:68px;">
								<div class="row">
									<div class="col-xs-6">
										<input type="text" name="title" class="form-control" placeholder="Product Name" required>
									</div>
									<div class="col-xs-6">
										<select name="mgl_product_category" class="form-control" placeholder="Category" required>
											<?php foreach($categories as $category): ?>
												<option value="<?= $category->term_id ?>"><?= $category->name ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-xs-6">
										<select name="_mgl_product_brand_id" class="form-control" placeholder="Brand">
											<?php while($brands->have_posts()): $brands->the_post(); ?>
												<option value="<?= get_the_ID() ?>"><?php the_title(); ?></option>
											<?php endwhile; ?>
										</select>
									</div>
									<div class="col-xs-6">
										<input type="text" name="_mgl_product_url" class="form-control" placeholder="Product url">
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
