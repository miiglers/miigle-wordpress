<?php

  use Miigle\Models\Product;

  $comments = Product\get_comments_count(get_the_ID());
  $label_class = '';

  if($comments) {
    $label_class = 'text-info';
  }

?>

<a href="<?php the_permalink(); ?>#discussion" id="button-comment" class="templates product <?= $label_class ?>">
  <i class="fa fa-commenting-o"></i> <?= $comments ?>
</a>