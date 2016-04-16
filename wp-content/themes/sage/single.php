<div id="blog-single">
  
  <section id="splash">
    <div class="container text-center">
    
      <h1><?php the_title(); ?></h1>
  
    </div>
  </section>

  <div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">

        <?php get_template_part('templates/content-single', get_post_type()); ?>

      </div>
    </div>
  </div>

</div>