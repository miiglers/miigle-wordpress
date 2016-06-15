<?php

use Miigle\Models\User;
use Miigle\Models\Product;

$mgl_current_user = User\current();

?>

<div id="archive-mgl_product">

  <section id="splash">
    <div class="container text-center">
    
      <h1>M+ Brands</h1>
  
    </div>
  </section>
  
  <?php require_once(locate_template('templates/content-archive.php')); ?>
  
</div>