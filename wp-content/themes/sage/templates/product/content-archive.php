<?php

use Miigle\Models\User;
use Miigle\Models\Product;

?>

<div class="templates product" id="content-archive">
  <div class="row">
    <?php $i=1; while (have_posts()) : the_post(); ?>
      <style type="text/css">
        a#product-<?php the_ID(); ?> {
          background-image: url('<?= Product\get_thumbnail(get_the_ID()) ?>');
        }
      </style>
      <div class="col-md-6">
        <div class="thumbnail">
          <a class="product-thumb" id="product-<?php the_ID(); ?>" href="<?php the_permalink(); ?>">&nbsp;</a>
          <div class="caption">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="text-two-lines desc">
              <?php the_excerpt(); ?>
              <div class="clearfix"></div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div>
                  <?php require(locate_template('templates/product/button-upvote.php')); ?>
                  <?php require(locate_template('templates/product/button-comment.php')); ?>
                </div>
              </div>
            </div>
            <div class="row author">
              <div class="col-md-3 col-lg-2">
                <img src="<?= User\get_avatar($post->post_author) ?>" class="img-responsive">
              </div>
              <div class="col-md-9 col-lg-10">
                <h4><?= User\get($post->post_author)['full_name'] ?></h4>
                <?php foreach(Product\get_categories(get_the_ID()) as $cat): ?>
                  <?= $cat->name ?>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php if(($i % 2) == 0): ?>
        </div>
        <div class="row">
      <?php endif; ?>
    <?php $i++; endwhile; ?>
  </div>
</div>