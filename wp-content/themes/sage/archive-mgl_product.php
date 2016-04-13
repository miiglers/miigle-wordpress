<div id="archive-mgl_product">

  <section id="splash">
    <div class="container text-center">
    
      <h1>Introducing M+ Products.</h1>
      <p>Find the best products from environmentally and socially responsible brands around the world.</p>
  
    </div>
  </section>
  
  <div class="container">
    <div class="row">

      <div class="col-md-2">
        
        <h4>Categories</h4>
        <ul>
          <li>Fashion</li>
          <li>Home Goods</li>
          <li>Personal Care</li>
        </ul>
        
        <h4>Directory</h4>
        <ul>
          <li>All Brands</li>
        </ul>

      </div>

      <div class="col-md-8">
        <div class="row">          
          <div class="col-md-12">
            
            This Week
            <span class="pull-right">
              <a href="#">Popular</a>
              |
              <a href="#">Newest</a>
            </span>
            
            <div class="row">
              
              <?php while (have_posts()) : the_post(); ?>
                <style type="text/css">
                  a#product-<?php the_ID(); ?> {
                    background-image: url('<?php the_post_thumbnail_url(); ?>');
                  }
                </style>
                <div class="col-md-6">
                  <div class="thumbnail">
                    <a class="product-thumb" id="product-<?php the_ID(); ?>" href="#">&nbsp;</a>
                    <div class="caption">
                      <h3><?php the_title(); ?></h3>
                      <p><?php the_content(); ?></p>
                      <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
            
          </div>          
        </div>    
      </div>

      <div class="col-md-2">
        <div class="well">
          
          <h4>All for 1, 1 for all.</h4>
          <p>See what products your friends are loving!</p>
        
        </div>
      </div>

    </div>
  </div>
  
</div>