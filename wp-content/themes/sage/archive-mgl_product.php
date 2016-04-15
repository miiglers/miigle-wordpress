<div id="archive-mgl_product">

  <section id="splash">
    <div class="container text-center">
    
      <h1>Introducing M+ Products.</h1>
      <p>Find the best products from environmentally and socially responsible brands around the world.</p>
  
    </div>
  </section>
  
  <div class="container main">
    
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
      
        <h1>
          This Week
          <small class="pull-right">
            <a href="#">Popular</a>
            |
            Newest
          </small>
        </h1>
      
      </div>
    </div>
    
    <div class="row">

      <div class="col-md-2 left">
        
        <h4>Categories</h4>
        <ul class="list-unstyled">
          <li><a href="#">Fashion</a></li>
          <li><a href="#">Home Goods</a></li>
          <li><a href="#">Personal Care</a></li>
        </ul>
        
        <h4>Directory</h4>
        <ul class="list-unstyled">
          <li><a href="#">All Brands</a></li>
        </ul>

      </div>

      <div class="col-md-8 middle">
        <div class="row">          
          <div class="col-md-12">
            
            
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
                      <p><?php the_excerpt(); ?></p>
                      <p><a href="#">productname.com</a></p>
                      <p>
                        <span class="label label-danger pull-right"><i class="fa fa-commenting-o"></i> 95</span>
                        <span class="label label-pink pull-right"><i class="fa fa-star-o"></i> 4</span>
                      </p>
                      <div class="clearfix"></div>
                    </div>
                  </div>
                </div>
              <?php endwhile; ?>
            </div>
            
          </div>          
        </div>    
      </div>

      <div class="col-md-2 right">
        <div class="well">
          
          <h4>All for 1, 1 for all.</h4>
          <p>See what products your friends are loving!</p>
        
        </div>
      </div>

    </div>
  </div>
  
</div>