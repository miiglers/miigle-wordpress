<div id="front-page">

  <section id="splash" class="text-center">
    <div class="container">

      <?php echo the_field('fp_hero_text'); ?>

    </div>
  </section>
  
  <section id="brands" class="text-center">
    <div class="container">

      <p>Featured Brands</p>
      
      <?php echo the_field('fp_featured_brands'); ?>

    </div>
  </section>
  
  <section id="how" class="text-center">
    <div class="container">

      <?php echo the_field('fp_how_it_works'); ?>

    </div>
  </section>
  
  <section id="quote" class="text-center">
    <div class="container">

      <p><?php echo the_field('fp_quote'); ?></p>

    </div>
  </section>
  
  <section id="story">
    <div class="container">

      <h2>Our Story</h2>
      
      <div class="row">
        <div class="col-md-6">
          <?php echo the_field('fp_our_story_left'); ?>
        </div>
        <div class="col-md-6">
          <?php echo the_field('fp_our_story_right'); ?>       
        </div>
      </div>

    </div>
  </section>
  
  <section id="video" class="text-center">
    <div class="container">

      <?php echo get_post_meta(get_the_ID(), 'fp_video_text', true); ?>

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

</div>
