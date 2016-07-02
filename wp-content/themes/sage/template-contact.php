<?php
/**
 * Template Name: Contact
 */
?>

<div id="template-contact">

  <section id="splash" class="text-center page-splash">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
        
          <h1><span class="text-navy">Say</span> Hello.</h1>
          
        </div>
      </div>
    </div>
  </section>

  <?php while (have_posts()) : the_post(); ?>
    <div class="templates" id="content-page">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 col-lg-offset-1">
            <div class="well">
              <?php the_content(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php endwhile; ?>

</div>