<?php
/**
 * Template Name: Product Post
 */
?>

<div id="template-product_post">
  
  <section id="product_post">
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
  
   
</div>
