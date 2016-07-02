<?php

use Miigle\Models\User;
use Miigle\Models\Product;

$mgl_current_user = User\current();

?>

<div id="archive-mgl_product">

  <section id="splash">
    <div class="container text-center">
    
      <h1>Introducing <span class="text-white">M+</span> Products</h1>
      <p>Share and discover the best products from socially and environmentally responsible brands worldwide.</p>

      <div class="row">
        <form class="">
          <div class="col-md-4 col-md-offset-3">
            <div class="form-group">
              <label for="email" class="sr-only">Enter your email</label>
              <input type="text" class="form-control" id="email" placeholder="Enter your email...">
              <p class="small">Receive them in your inbox weekly.</p>
            </div>
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-default btn-block">Yes, please</button>
          </div>
        </form>
      </div>
  
    </div>
  </section>
  
  <?php require_once(locate_template('templates/content-archive.php')); ?>
  
</div>