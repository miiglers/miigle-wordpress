<?php

  use Miigle\Models\Product;

  $comments = Product\get_comments_count(get_the_ID());
  $label_class = 'label-default';

  if($comments) {
    $label_class = 'label-pink';
  }

?>

<span class="label label-btn <?= $label_class ?>"><i class="fa fa-commenting-o"></i> <?= $comments ?></span>