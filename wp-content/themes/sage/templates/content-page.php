<div class="templates" id="content-page">
  <div class="container">
    <div class="row">
      <div class="col-md-10 col-lg-8 col-md-offset-1 col-lg-offset-2">
        <?php the_content(); ?>
        <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
      </div>
    </div>
  </div>
</div>