<?php

$queried_object = get_queried_object();
$page_term = 0;

if(isset($queried_object->term_id)) {
  $page_term = $queried_object->term_id;
}

?>

<div id="sidebar-categories" class="templates product">

  <h4>Categories</h4>
  <ul class="list-unstyled collapsible">
    <li>
      <a href="<?= home_url() ?>/brands">All</a>
    </li>
    <?php 
      foreach($categories as $category): 
        $children = get_term_children($category->term_id, $category->taxonomy);
        $active = ($category->term_id == $page_term);
        $active_parent = in_array($page_term, $children);
    ?>
      <?php if(!$category->parent): ?>
        <li class="<?php if($active): ?>active<?php endif; ?> <?php if($active_parent): ?>active-parent<?php endif; ?>">
          <a href="<?= home_url() ?>/category/<?= $category->slug ?>?brands">
            <?= $category->name ?>            
          </a>
          <?php if($children): ?>
            <ul class="list-unstyled">
              <?php 
                foreach($children as $child): 
                  $child_cat = get_term($child);
              ?>
                <li <?php if($child_cat->term_id == $page_term): ?>class="active"<?php endif; ?>>
                  <a href="<?= home_url() ?>/category/<?= $child_cat->slug ?>?brands">
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

  <h4>Directory</h4>
  <ul class="list-unstyled collapsible">
    <li><a href="<?= home_url() ?>/products">All Products</a></li>
  </ul>

</div>