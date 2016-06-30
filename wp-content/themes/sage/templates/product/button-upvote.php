<?php

  use Miigle\Models\User;
  use Miigle\Models\Product;

  $upvoted = User\has_upvoted_product($mgl_current_user['ID'], $product_id);
  $label_class = '';
  $i_class = 'fa-star-o';
  $endpoint = 'upvote';

  if($upvoted) {
    $label_class = 'text-danger';
    $i_class = 'fa-star';
    $endpoint = 'downvote';
  }
  
?>

<form class="upvote" id="product-upvote" method="post" action="mgl/v1/product/<?= $endpoint ?>">
  <input type="hidden" name="product_id" value="<?= $product_id; ?>"> 
  <span class="btn-upvote <?= $label_class ?>" 
  data-upvoted="<?= intval($upvoted) ?>">								
    <i class="fa <?= $i_class ?>"></i> 
    <span id="upvotes"><?= Product\get_upvotes($product_id) ?></span>
  </span>
</form>