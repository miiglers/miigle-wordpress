<?php

use Miigle\Models\Product;

$sort = 'new';

if(isset($_GET['sort']) && $_GET['sort'] == 'popular') {
  $sort = 'popular';
}

?>

<div class="templates product" id="content-archive">

<div class="container main">
  
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
    
      <h1>
        This Week
        <small class="pull-right">
          <?php if($sort == 'popular'): ?>
            Popular
            |
            <a href="?sort=new">Newest</a>
          <?php else: ?>
            <a href="?sort=popular">Popular</a>
            |
            Newest
          <?php endif; ?>
        </small>
      </h1>
    
    </div>
  </div>
  
  <div class="row">

    <div class="col-md-2 left">
      
      <?php require_once(locate_template('templates/product/sidebar-categories.php')); ?>

    </div>

    <div class="col-md-8 middle">
      <div class="row">          
        <div class="col-md-12">
          
          
          <div class="row">
            
            <?php while (have_posts()) : the_post(); ?>
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
                    <p>
                      <?php foreach(Product\get_categories(get_the_ID()) as $cat): ?>
                        <?= $cat->name ?>
                      <?php endforeach; ?>
                    </p>
                    <div class="pull-right">
                      <?php require(locate_template('templates/product/button-upvote.php')); ?>
                      <?php require(locate_template('templates/product/button-comment.php')); ?>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            <?php endwhile; ?>
            
          </div>
          
        </div>          
      </div>    
    </div>

    <div class="col-md-2 right">
      <div class="well">
        
        <h4>All for 1, 1 for all.</h4>
        <p>See what products your friends are loving!</p>
      
      </div>
    </div>

  </div>
</div>

</div>