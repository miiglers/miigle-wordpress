<?php

use Miigle\Models\User;
use Miigle\Models\Product;

?>

<div class="templates product" id="content-archive">
  <div class="row">
    <?php 
      $i=1; 
      while (have_posts()): 
        the_post(); 
        $mgl_user = User\get($post->post_author);
    ?>
      <div class="col-md-4 product-card">
        <div class="thumbnail">
          <a class="product-thumb" id="product-<?php the_ID(); ?>" href="<?php the_permalink(); ?>">
            <img src="<?= Product\get_thumbnail(get_the_ID()) ?>">
          </a>
          <div class="caption">
            <h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
              <div class="col-md-12">
                <div class="media">
                  <div class="media-left">
                    <a href="<?= home_url() ?>/profile-product?user_id=<?= $mgl_user['ID'] ?>">
                      <img src="<?= $mgl_user['avatar'] ?>" class="media-object">
                    </a>
                  </div>
                  <div class="media-body">
                    <h4>
                      <a href="<?= home_url() ?>/profile-product?user_id=<?= $mgl_user['ID'] ?>">
                        <?= $mgl_user['full_name'] ?>
                      </a>
                    </h4>
                    <?php foreach(Product\get_categories(get_the_ID()) as $category): ?>
                      <?php if(!$category->parent): ?>
                        <?= $category->name ?>
                      <?php endif; ?>
                    <?php endforeach; ?>
                  </div>
                </div><!-- .media -->
              </div>
            </div><!-- .row.author -->
          </div>
        </div>
      </div>
      <?php if(($i % 3) == 0): ?>
        </div>
        <div class="row">
      <?php endif; ?>
    <?php $i++; endwhile; ?>
  </div>
</div>