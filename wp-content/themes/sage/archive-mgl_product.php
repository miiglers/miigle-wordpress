<?php

use Miigle\Models\User;
use Miigle\Models\Product;

$mgl_current_user = User\current();

?>

<div id="archive-mgl_product">

  <section id="splash">
    <div class="container text-center">

      <?= apply_filters('the_content', mgl_get_option('_mgl_archive-product-content')) ?>
  
    </div>
  </section>

  <section id="brands" class="text-center">
    <div class="container">
      
      <?= apply_filters('the_content', mgl_get_option('_mgl_archive-product-featured')) ?>

    </div>
  </section>
  
  <?php require_once(locate_template('templates/content-archive.php')); ?>
  
</div>