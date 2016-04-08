<div id="front-page">

  <section id="splash" class="text-center">
    <div class="container">

      <?php echo wpautop(get_post_meta(get_the_ID(), 'fp_hero_text', true)); ?>

    </div>
  </section>
  
  <section id="brands" class="text-center">
    <div class="container">

      <p>Featured Brands</p>
      
      <?php echo get_post_meta(get_the_ID(), 'fp_featured_brands', true); ?>

    </div>
  </section>
  
  <section id="how" class="text-center">
    <div class="container">

      <?php echo wpautop(get_post_meta(get_the_ID(), 'fp_how_it_works', true)); ?>

    </div>
  </section>
  
  <section id="quote" class="text-center">
    <div class="container">

      <p><?php echo get_post_meta(get_the_ID(), 'fp_quote', true); ?></p>

    </div>
  </section>
  
  <section id="story">
    <div class="container">

      <h2>Our Story</h2>
      
      <div class="row">
        <div class="col-md-6">
          <?php echo get_post_meta(get_the_ID(), 'fp_our_story_left', true); ?>
        </div>
        <div class="col-md-6">
          <?php echo wpautop(get_post_meta(get_the_ID(), 'fp_our_story_right', true)); ?>       
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
            <?php echo get_post_meta(get_the_ID(), 'fp_contact_text', true); ?>
          </div>
          
          <?php echo do_shortcode('[contact-form-7 id="28" title="Contact form 1"]'); ?>
        </div>
      </div>

    </div>
  </section>

</div>
