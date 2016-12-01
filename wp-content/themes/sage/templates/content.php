<article <?php post_class(); ?>>
  <header>
    <h2 class="entry-title text-center"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
    <?php if(has_post_thumbnail()): ?>
      <img class="entry-thumb img-responsive" src="<?php the_post_thumbnail_url(); ?>">
    <?php endif; ?>
    <?php the_excerpt(); ?>
    <p class="text-right">
      <a href="<?php the_permalink(); ?>" class="btn btn-default">Read more <i class="fa fa-arrow-right"></i></a>
    </p>
  </div>
</article>
