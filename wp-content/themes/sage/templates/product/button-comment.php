<?php

  use Miigle\Models\Product;

  $comments = Product\get_comments_count(get_the_ID());
  $label_class = '';

  if($comments) {
    $label_class = 'text-info';
  }

?>

<span class="<?= $label_class ?>"><i class="fa fa-commenting-o"></i> <?= $comments ?></span> 