<?php

  use Miigle\Models\User;
  use Miigle\Models\Product;

  $upvoted = User\has_upvoted_product($mgl_current_user['ID'], get_the_ID());
  $label_class = 'label-default';
  $i_class = 'fa-star-o';

  if($upvoted) {
    $label_class = 'label-danger';
    $i_class = 'fa-star';
  }
  
?>

<form class="upvote" id="product-upvote" method="post" action="mgl/v1/product/<?php if($upvoted): ?>down<?php else: ?>up<?php endif; ?>vote">
  <input type="hidden" name="product_id" value="<?php the_ID(); ?>"> 
  <span class="label label-btn btn-upvote <?= $label_class ?>" 
  data-upvoted="<?php if($upvoted): ?>1<?php else: ?>0<?php endif; ?>">								
    <i class="fa <?= $i_class ?>"></i> 
    <span id="upvotes"><?= Product\get_upvotes(get_the_ID()) ?></span>
  </span>
</form>