<?php

$queried_object = get_queried_object();
$page_term = 0;

$post_type = 'products';

if($is_brands) {
  $post_type = 'brands';
}

if(isset($queried_object->term_id)) {
  $page_term = $queried_object->term_id;
}

?>

<div id="sidebar-categories" class="templates product" data-spy="affix" data-offset-top="420" data-offset-bottom="350">

  <h4>Categories</h4>
  <ul class="list-unstyled collapsible">
    <li>
      <a href="<?= home_url() ?>/<?= $post_type ?>">All</a>
    </li>
    <?php 
      foreach($categories as $category): 
        $children = get_term_children($category->term_id, $category->taxonomy);
        $active = ($category->term_id == $page_term);
        $active_parent = in_array($page_term, $children);
    ?>
      <?php if(!$category->parent): ?>
        <li class="<?php if($active): ?>active<?php endif; ?> <?php if($active_parent): ?>active-parent<?php endif; ?>">
          <a href="<?= home_url() ?>/category/<?= $category->slug ?>?<?= $post_type ?>">
            <?= $category->name ?>
            <?php if($children): ?>
              <i class="fa fa-chevron-right right"></i>
              <i class="fa fa-chevron-down down"></i>
            <?php endif; ?>
          </a>
          <?php if($children): ?>
            <ul class="list-unstyled">
              <?php 
                foreach($children as $child): 
                  $child_cat = get_term($child);
              ?>
                <li <?php if($child_cat->term_id == $page_term): ?>class="active"<?php endif; ?>>
                  <a href="<?= home_url() ?>/category/<?= $child_cat->slug ?>?<?= $post_type ?>">
                    <?= $child_cat->name ?>                      
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </li>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>
  
  <?php if($is_brands): ?> 
    <h4>Directory</h4>   
    <ul class="list-unstyled collapsible">
      <li><a href="<?= home_url() ?>/products">All Products</a></li>
    </ul>
  <?php else: ?>
    <!--<ul class="list-unstyled collapsible">
      <li><a href="<?= home_url() ?>/brands">All Brands</a></li>
    </ul>-->
  <?php endif; ?>

</div>