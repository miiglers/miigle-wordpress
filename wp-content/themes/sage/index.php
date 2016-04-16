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

</div>