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

	<section id="splash" class="text-center page-splash">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
        
          <h1>Post a product</h1>
        	
        </div>
      </div>
    </div>
  </section>
  
  <section id="product_post">
    <div class="container-fluid">
      <div class="row">
        
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-md-6 main"> 
          
					<?php if(current_user_can('subscriber-approved')): ?>
						
            <div id="product-form-wrap" class="well">

              <div id="progress-wrap">
                <div class="row">
                  <div class="col-md-10">

                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                        <span class="sr-only">60% Complete</span>
                      </div>
                    </div>

                  </div>
                  <div class="col-md-2">
                    <span id="percent-complete">25% Complete</span>
                  </div>
                </div>
              </div>

  						<form id="product" class="text-center form-horizontal" method="post" action="mgl/v1/product">
  						
  							<input type="hidden" name="author" value="<?= $mgl_user['ID'] ?>">
  							<input type="hidden" name="status" value="pending">

  							<div class="tab-content">

  						    <div role="tabpanel" class="tab-pane fade in active" id="category">
  						    	
  						    	<h2>Select a category</h2>
  									<p class="text-muted">Help us filter the type of products that are shared on Miigle.</p>

  									<div class="category-list">
                      <div class="row">
    										<?php foreach($categories as $category): ?>
                          <?php if(!$category->parent): ?>
                            <div class="col-md-3">
                              <input type="radio" name="mgl_product_category" id="category-<?= $category->term_id ?>" value="<?= $category->term_id ?>">
                              <label class="category" for="category-<?= $category->term_id ?>">
                                <div>          												
          												<i class="fa fa-bell"></i>
          												<p><?= $category->name ?></p>
                                </div>
                              </label>
                            </div>
                          <?php endif; ?>
    										<?php endforeach; ?>
                      </div>
  									</div>

  									<div class="form-group submit-group">
  										<a class="btn btn-primary pull-right" href="#sub-category" aria-controls="sub-category" role="tab" data-toggle="tab">
                        Next
                      </a>
  									</div>
                    <div class="clearfix"></div>

  						    </div>

  						    <div role="tabpanel" class="tab-pane fade" id="sub-category">
  						    	
                    <h2>Select the gender audience</h2>
                    <p class="text-muted">Part of getting a product known is by first knowing your audience.</p>

                    <div class="category-list">
                      <div class="row">
                        <?php foreach($categories as $category): ?>
                          <?php if($category->parent): ?>
                            <div class="col-md-3">
                              <input type="radio" name="mgl_product_category" id="category-<?= $category->term_id ?>" value="<?= $category->term_id ?>">
                              <label class="category" for="category-<?= $category->term_id ?>">
                                <div>                                 
                                  <i class="fa fa-bell"></i>
                                  <p><?= $category->name ?></p>
                                </div>
                              </label>
                            </div>
                          <?php endif; ?>
                        <?php endforeach; ?>
                      </div>
                    </div>

                    <div class="form-group submit-group">
                      <a class="btn btn-default pull-left" href="#category" aria-controls="category" role="tab" data-toggle="tab">
                        Back
                      </a>
                      <a class="btn btn-primary pull-right" href="#details" aria-controls="details" role="tab" data-toggle="tab">
                        Next
                      </a>
                    </div>
                    <div class="clearfix"></div>

  						    </div>

  						    <div role="tabpanel" class="tab-pane fade" id="details">

                    <h2>Product information</h2>

                    <div class="form-group">
                      <label for="_mgl_product_url" class="col-sm-2 control-label">Product URL</label>
                      <div class="col-sm-10">
                        <input type="text" name="_mgl_product_url" class="form-control" placeholder="Eg: http://www.toms.com/women/cool-shoes" required>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="content" class="col-sm-2 control-label">Comment (optional)</label>
                      <div class="col-sm-10">
                        <textarea rows="5" name="content" class="form-control" placeholder="Why are you sharing this product?"></textarea>
                      </div>
                    </div>

  									<div class="form-group submit-group">
                      <a class="btn btn-default pull-left" href="#sub-category" aria-controls="sub-category" role="tab" data-toggle="tab">
                        Back
                      </a>
                      <button type="submit" class="btn btn-primary pull-right submit">
                        <i class="fa fa-refresh fa-spin hidden"></i>
                        Submit
                      </button>
                    </div>
                    <div class="clearfix"></div>

  						    </div>

  						  </div>
  						
  						</form>
            </div>

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
