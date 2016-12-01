<?php
/**
 * Template Name: Homepage
 */
?>

<div id="homepage">
	<?php $banner = get_field('hp_banner_image'); ?>
  <section id="splash" style="background-image:url('<?php echo $banner['url']; ?>');">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12 text-center">
        	<?php the_field('hp_banner_heading'); ?>
        </div>
      </div>
    </div>
  </section>
  
  <section id="cta-bar">
    <div class="container">
      <div class="row flexRow">
        <div class="col-sm-6 text-right">    
      		<?php the_field('hp_banner_cta_bar'); ?>
      	</div>
      	<div class="col-sm-6">
					<a class="btn btn-lg btn-transparent" href="#contact">Request Access</a>
					<button class="btn btn-lg btn-default btn-badge" style="margin-bottom: 0;" data-toggle="modal" data-target="#accessModal">Access Private Beta <i class="fa fa-long-arrow-right" aria-hidden="true"></i><span class="badge">*Passcode required</span></button>
				</div>
			</div>
    </div>
  </section>
  
  <section id="brands">
    <div class="container">
			<div class="row">
        <div class="col-sm-12">
      		<?php the_field('hp_featured_brands_section_content'); ?>
      	</div>
      </div>
      <div class="row">
        <div class="col-sm-12 featured_brand">
      		<!-- Featured Brand List -->					
					<div class="scroll_pane horizontal-only">
						<div class="scroll_cards">
							<?php if( have_rows('hp_featured_brand_list') ):
							while( have_rows('hp_featured_brand_list') ): the_row();
							// vars
							$logo = get_sub_field('hp_brand_logo');
							$info = get_sub_field('hp_brand_info');
							?>
							<div class="brand">
								<img class="brand_logo" alt="Toms" src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>">
								<?php echo $info; ?>
							</div>	
							<?php endwhile;
							endif;
							?>
						</div>
					</div>
      		<!-- //Featured Brand List// -->
				</div>
			</div>
    </div>
  </section>
  
  <section id="video" class="text-center page-video">
    <div class="container">
			<div class="row">
        <div class="col-sm-12">
					<?php the_field('hp_video_section_content'); ?>
				</div>
			</div>
    </div>
  </section>

  <section id="contact">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2 text-center">
          <?php the_field('hp_application_form_section_content'); ?>
        </div>
      </div>
    </div>
  </section>
  
  <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header hidden-lg hidden-md">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <iframe src="https://player.vimeo.com/video/77944311" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="accessModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-body">

          <h3>Enter your access code</h3>

          <form>
            <div class="form-group">
              <input type="text" name="code" id="accessCode">
              <span class="help-block hidden">Incorrect access code</span>
            </div>
              <button type="submit" class="btn btn-primary pull-right">Submit</button>
              <div class="clearfix"></div>
          </form>

        </div>
      </div>
    </div>
  </div>

</div>