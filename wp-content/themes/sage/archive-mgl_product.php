<?php

use Miigle\Models\User;
use Miigle\Models\Product;

$mgl_current_user = User\current();

?>

<div id="archive-mgl_product">

  <section id="splash">
    <div class="container text-center">
    
      <h1>Introducing <span class="text-white">M+</span> Products</h1>
      <div class="txt-wrap">
        <p>Share and discover the best products from socially and environmentally responsible brands worldwide.</p>
      </div>

      <?= do_shortcode('[mc4wp_form]'); ?>
  
    </div>
  </section>
  
  <?php require_once(locate_template('templates/content-archive.php')); ?>
  
</div>