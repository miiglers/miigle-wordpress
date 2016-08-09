<?php 

//require_once locate_template('archive-mgl_product.php');
?>

<div id="front-page">

  <section id="splash" class="text-center">
    <div class="container">

      <?php the_field('fp_hero_text'); ?>

    </div>
  </section>
  
  <section id="brands" class="text-center">
    <div class="container">

      <p>Featured Brands</p>
      
      <?php the_field('fp_featured_brands'); ?>

    </div>
  </section>
  
  <section id="how" class="text-center">
    <div class="container">

      <?php the_field('fp_how_it_works'); ?>

    </div>
  </section>
  
  <section id="quote" class="text-center">
    <div class="container">

      <p><?php the_field('fp_quote'); ?></p>

    </div>
  </section>
  
  <section id="story">
    <div class="container">

      <h2>Our Story</h2>
      
      <div class="row">
        <div class="col-md-6">
          <?php the_field('fp_our_story_left'); ?>
        </div>
        <div class="col-md-6">
          <?php the_field('fp_our_story_right'); ?>       
        </div>
      </div>

    </div>
  </section>
  
  <section id="video" class="text-center">
    <div class="container">

      <?php the_field('fp_video_text'); ?>

    </div>
  </section>
  
  <section id="contact">
    <div class="container">

      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="text-center">
            <?php the_field('fp_contact_text'); ?>
          </div>
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