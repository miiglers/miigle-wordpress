<?php

use Miigle\Models\User;
use Miigle\Models\Product;
use Miigle\Models\Brand;

$categories = Product\get_categories();
$is_products = (isset($_GET['products']) || is_post_type_archive('mgl_product'));
$is_brands = (isset($_GET['brands']) || is_post_type_archive('mgl_brand'));

?>

<div id="archive-mgl_brand">

  <section id="brand_detail"> 
   	<div class="container"> 
      <div class="row mB"> 
        <!-- brand detail title section-->
				<div class="col-sm-12 text-center">
        	<h1><?php the_title(); ?></h1>
        	<p>57 brands</p>
        </div>				
			</div>
			
				<?php if($is_brands): ?>BRANDS
            <?php require_once(locate_template('templates/brand/content-archive.php')); ?>
          <?php else: ?>PRODUCT
            <?php require_once(locate_template('templates/product/content-archive.php')); ?>
          <?php endif; ?>
		
		</div>
  </section>
  
</div>