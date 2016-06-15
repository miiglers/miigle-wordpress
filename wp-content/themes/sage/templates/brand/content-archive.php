<div class="templates brand" id="content-archive">
  <?php while (have_posts()) : the_post(); ?>
    <div class="card">
      <div class="row">
        <div class="col-md-4 text-center">
          <a href="<?php the_permalink(); ?>">
            <img src="<?php the_post_thumbnail_url(); ?>" class="logo img-responsive" />
          </a>
          <!--
          <div class="prod-meta">
            <a href="#" class="btn btn-profile trend">Rising Star</a>
          </div>-->
        </div>
        <div class="col-md-8">
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <p><?php the_excerpt(); ?></p>
          <!--<p><a href="http://productname.com">productname.com</a></p> -->
        </div>
      </div>
    </div>
  <?php endwhile; ?>
</div>