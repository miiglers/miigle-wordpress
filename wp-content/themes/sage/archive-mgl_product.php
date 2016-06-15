<?php

use Miigle\Models\User;
use Miigle\Models\Product;

$mgl_current_user = User\current();

?>

<div id="archive-mgl_product">

  <section id="splash">
    <div class="container text-center">
    
      <h1>Introducing M+ Products.</h1>
      <p>Find the best products from environmentally and socially responsible brands around the world.</p>
  
    </div>
  </section>
  
  <?php require_once(locate_template('templates/content-archive.php')); ?>
  
</div>