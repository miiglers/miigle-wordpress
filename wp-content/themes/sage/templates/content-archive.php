<?php

use Miigle\Models\Product;
use Miigle\Models\User;

$sort = 'new';
$categories = Product\get_categories();
$is_products = (isset($_GET['products']) || is_post_type_archive('mgl_product'));
$is_brands = (isset($_GET['brands']) || is_post_type_archive('mgl_brand'));

if(isset($_GET['sort']) && $_GET['sort'] == 'popular') {
  $sort = 'popular';
}

?>

<div class="templates" id="content-archive">

<div class="container main">
  
  <div class="row">
    <div class="sort col-md-8 <?php if(is_user_logged_in()): ?>col-md-offset-3<?php else: ?>col-md-offset-2<?php endif; ?>">
    
      <h2 class="pull-left">This Week</h2>
      <span class="pull-right">
        <?php if($sort == 'popular'): ?>
          Popular
          |
          <a href="?sort=new&products">Newest</a>
        <?php else: ?>
          <a href="?sort=popular&products">Popular</a>
          |
          Newest
        <?php endif; ?>
      </span>
    
    </div>
  </div>
  
  <div class="row">

    <div class="col-md-2 left <?php if(is_user_logged_in()): ?>col-md-offset-1<?php endif; ?>">
      
      <?php require_once(locate_template('templates/sidebar-categories.php')); ?>

    </div>

    <div class="col-md-8 middle">
      <div class="row">          
        <div class="col-md-12">
            
          <?php if($is_brands): ?>
            <?php require_once(locate_template('templates/brand/content-archive.php')); ?>
          <?php else: ?>
            <?php require_once(locate_template('templates/product/content-archive.php')); ?>
          <?php endif; ?>
          
        </div>          
      </div>    
    </div>

    <?php if(!is_user_logged_in()): ?>
      <div class="col-md-2 right">
        <div data-spy="affix" data-offset-top="420" data-offset-bottom="420">
          <div class="well">
            
            <h4>All for 1, 1 for all.</h4>
            <p>See what products your friends are loving</p>
            <p><?php echo do_shortcode('[TheChamp-Login]'); ?></p>
          
          </div>
        </div>
      </div>
    <?php endif; ?>

  </div>
</div>

</div>