<?php
/**
 * Template Name: Brand Directory
 */
 
$user = wp_get_current_user();
?>

<div id="template-brand_directory">
  
  <section id="brand_directory">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar hidden-xs" id="profile-sidebar">
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
        
        <div class="col-sm-9 col-sm-offset-2 col-md-10 col-md-offset−1 main"> 
        	  <section id="splash" class="text-center">
							<h1>Introducing <span>M+</span> Products.</h1>
							<p class="lead">The way to find the best products from environmentally and socially responsible brands worldwide.</p>
							<form class="form-inline">
								<div class="form-group">
									<label for="email" class="sr-only">Enter your email</label>
									<input type="text" class="form-control" id="email" placeholder="Enter your email...">
									<p class="small">Receive them in your inbox weekly.</p>
								</div>
								<button type="submit" class="btn btn-default">Yes, please</button>
							</form>
							
						</section>  
						<section id="featured">
							<div class="container">
								<div class="row">
									
									<div class="col-md-8 col-md-offset-1">
										<h2>Featured Brands</h2>
										<div class="tab pull-right">
											<a href="#" class="active">All</a>&nbsp;|&nbsp;
											<a href="#" class="">By category</a>&nbsp;|&nbsp;
											<a href="#" class="">By popularity</a>
										</div>
											<div class="clearfix"></div>
										<!-- Featured Brand Item -->
										<div class="card">
											<div class="row">
												<div class="col-md-4 text-center">
													<img src="<?php echo get_template_directory_uri(); ?>/assets/images/toms-logo.jpg" class="logo img-responsive" />
													<div class="prod-meta">
														<a href="#" class="btn btn-profile trend"><strong>#1</strong> in Fashion</a>
													</div>
												</div>
												<div class="col-md-8">
													<h3>Brand name <span class="pull-right">Sponsored</span></h3>
													<p>Discover great products from people just like you who care about our planet Discover great products from people.</p>
													<p><a href="http://productname.com">productname.com</a></p>	
												</div>
											</div>
											
												<hr>
												
												<h3>Top products</h3>
											<div class="row">
												<div class="col-md-4">
													<img src="<?php echo get_template_directory_uri(); ?>/assets/images/brand-thumb2.jpg" class="thumb img-responsive" />
													<div class="prod-meta">
														<a href="#" class="btn btn-profile upvotes"><i class="fa fa-star-o" aria-hidden="true"></i> 3,003</a>
														<a href="#" class="btn btn-profile disable"><i class="fa fa-commenting-o" aria-hidden="true"></i> </a>
													</div>
												</div>
												<div class="col-md-4">
													<img src="<?php echo get_template_directory_uri(); ?>/assets/images/brand-thumb3.jpg" class="thumb img-responsive" />
													<div class="prod-meta">
														<a href="#" class="btn btn-profile upvotes"><i class="fa fa-star-o" aria-hidden="true"></i> 3,003</a>
														<a href="#" class="btn btn-profile comment"><i class="fa fa-commenting-o" aria-hidden="true"></i> 9</a>
													</div>
												</div>
												<div class="col-md-4">
													<img src="<?php echo get_template_directory_uri(); ?>/assets/images/brand-thumb1.jpg" class="thumb img-responsive" />
													<div class="prod-meta">
														<a href="#" class="btn btn-profile upvotes"><i class="fa fa-star-o" aria-hidden="true"></i> 3,003</a>
														<a href="#" class="btn btn-profile comment"><i class="fa fa-commenting-o" aria-hidden="true"></i> 9</a>
													</div>
												</div>
											</div>
										</div>
										
										<!-- Featured Brand Item -->
										<div class="card">
											<div class="row">
												<div class="col-md-4 text-center">
													<img src="<?php echo get_template_directory_uri(); ?>/assets/images/buccellati-logo.jpg" class="logo img-responsive" />
													<div class="prod-meta">
														<a href="#" class="btn btn-profile trend">Rising Star</a>
													</div>
												</div>
												<div class="col-md-8">
													<h3>Brand name <span class="pull-right">Sponsored</span></h3>
													<p>Discover great products from people just like you who care about our planet Discover great products from people.</p>
													<p><a href="http://productname.com">productname.com</a></p>	
												</div>
											</div>
											
												<hr>
												
												<h3>Top products</h3>
											<div class="row">
												<div class="col-md-4">
													<img src="<?php echo get_template_directory_uri(); ?>/assets/images/brand-thumb4.jpg" class="thumb img-responsive" />
													<div class="prod-meta">
														<a href="#" class="btn btn-profile upvotes"><i class="fa fa-star-o" aria-hidden="true"></i> 3,003</a>
														<a href="#" class="btn btn-profile comment"><i class="fa fa-commenting-o" aria-hidden="true"></i> 9</a>
													</div>
												</div>
												<div class="col-md-4">
													<img src="<?php echo get_template_directory_uri(); ?>/assets/images/brand-thumb5.jpg" class="thumb img-responsive" />
													<div class="prod-meta">
														<a href="#" class="btn btn-profile upvotes"><i class="fa fa-star-o" aria-hidden="true"></i> 3,003</a>
														<a href="#" class="btn btn-profile comment"><i class="fa fa-commenting-o" aria-hidden="true"></i> 9</a>
													</div>
												</div>
												<div class="col-md-4">
													<img src="<?php echo get_template_directory_uri(); ?>/assets/images/brand-thumb6.jpg" class="thumb img-responsive" />
													<div class="prod-meta">
														<a href="#" class="btn btn-profile upvotes"><i class="fa fa-star-o" aria-hidden="true"></i> 3,003</a>
														<a href="#" class="btn btn-profile comment"><i class="fa fa-commenting-o" aria-hidden="true"></i> 9</a>
													</div>
												</div>
											</div>
										</div>
										
										<!-- Brand Item -->
										<div class="card">
											<div class="row">
												<div class="col-md-4 text-center">
													<img src="<?php echo get_template_directory_uri(); ?>/assets/images/buccellati-logo.jpg" class="logo img-responsive" />
													<!--
													<div class="prod-meta">
														<a href="#" class="btn btn-profile trend">Rising Star</a>
													</div>-->
												</div>
												<div class="col-md-8">
													<h3>Brand name</h3>
													<p>Discover great products from people just like you who care about our planet Discover great products from people.</p>
													<p><a href="http://productname.com">productname.com</a></p>	
												</div>
											</div>
										</div>
										
										<!-- Brand Item -->
										<div class="card">
											<div class="row">
												<div class="col-md-4 text-center">
													<img src="<?php echo get_template_directory_uri(); ?>/assets/images/buccellati-logo.jpg" class="logo img-responsive" />
													<!--
													<div class="prod-meta">
														<a href="#" class="btn btn-profile trend">Rising Star</a>
													</div>-->
												</div>
												<div class="col-md-8">
													<h3>Brand name</h3>
													<p>Discover great products from people just like you who care about our planet Discover great products from people.</p>
													<p><a href="http://productname.com">productname.com</a></p>	
												</div>
											</div>
										</div>
										
										<!-- Brand Item -->
										<div class="card">
											<div class="row">
												<div class="col-md-4 text-center">
													<img src="<?php echo get_template_directory_uri(); ?>/assets/images/buccellati-logo.jpg" class="logo img-responsive" />
													<!--
													<div class="prod-meta">
														<a href="#" class="btn btn-profile trend">Rising Star</a>
													</div>-->
												</div>
												<div class="col-md-8">
													<h3>Brand name</h3>
													<p>Discover great products from people just like you who care about our planet Discover great products from people.</p>
													<p><a href="http://productname.com">productname.com</a></p>	
												</div>
											</div>
										</div>
										
										<!-- Brand Item -->
										<div class="card">
											<div class="row">
												<div class="col-md-4 text-center">
													<img src="<?php echo get_template_directory_uri(); ?>/assets/images/buccellati-logo.jpg" class="logo img-responsive" />
													<!--
													<div class="prod-meta">
														<a href="#" class="btn btn-profile trend">Rising Star</a>
													</div>-->
												</div>
												<div class="col-md-8">
													<h3>Brand name</h3>
													<p>Discover great products from people just like you who care about our planet Discover great products from people.</p>
													<p><a href="http://productname.com">productname.com</a></p>	
												</div>
											</div>
										</div>
										
										<!-- Show more -->
										<div class="row">
											<div class="col-md-12 text-center showmore">
												<a href="#" class="btn btn-showmore">Show more</a>
											</div>
										</div>
																		
								</div>
									<div class="col-md-2">
									<h4>Directory</h4>
									<hr>
									<ul class="directory-list">
										<li><a href="#" class="">All brands</a></li>
										<li><a href="#" class="">Fashion</a></li>
										<li><a href="#" class="">Home goods</a></li>
										<li><a href="#" class="">Personal care</a></li>
									</ul>
								</div>
								
							</div>
						</section>	
        </div>
      
      </div>
    </div>
  </section>
  
   
</div>
