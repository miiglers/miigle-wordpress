<?php

  use Miigle\Models\Product;

  $comments = Product\get_comments_count(get_the_ID());
  $label_class = '';

?>

<a href="<?php the_permalink(); ?>#discussion" id="button-comment" class="templates product btn-comment">
  <i class="fa fa-commenting-o"></i> <?= $comments ?>
</a>