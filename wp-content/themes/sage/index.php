<div id="blog">
  
  <section id="splash">
    <div class="container text-center">
    
      <?php the_field('index_hero_text', get_option('page_for_posts')); ?>
  
    </div>
  </section>
  
  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
      
        <?php if (!have_posts()) : ?>
          <div class="alert alert-warning">
            <?php _e('Sorry, no results were found.', 'sage'); ?>
          </div>
          <?php get_search_form(); ?>
        <?php endif; ?>


        <?php while (have_posts()) : the_post(); ?>
          <?php get_template_part('templates/content', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
        <?php endwhile; ?>

        <?php the_posts_navigation(); ?>
      
      </div>
    </div>
  </div>

  <section id="video" class="text-center page-video">
    <div class="container">
      
      <h2>Together, we can change the world.</h2>
      <a href="#" data-toggle="modal" data-target="#videoModal">
        <img class="alignnone wp-image-48" src="http://plus.miigle.com/wp-content/uploads/2016/04/play.png" alt="play" width="100" height="100" />
      </a>

    </div>
  </section>
  
  <div class="modal fade page-video" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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