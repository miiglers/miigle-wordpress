<?php
/**
 * Template Name: About
 */
?>

<div id="template-about">
  
  <section id="splash" class="text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
        
          <?php echo the_field('ta_hero_text'); ?>
        
        </div>
      </div>
    </div>
  </section>
  
  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          
          <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile; ?>
          
        </div>
      </div>
    </div>
  </section>
  
  <section id="team" class="text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">

          <?php echo the_field('ta_team_header'); ?>

          <?php echo the_field('ta_team_members'); ?>

        </div>
      </div>
    </div>
  </section>
  
  <section id="video" class="text-center">
    <div class="container">
      
      <?php echo the_field('ta_video_text'); ?>

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
  
</div>
