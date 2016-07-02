<?php
/**
 * Template Name: How it Works
 */
?>

<div id="template-how-it-works">
  
  <section id="splash" class="text-center page-splash">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
        
          <h1>“Never doubt that a small group of thoughful, committed citizens can change the world.” </h1>
          <p class="text-navy">- Margaret Mead</p>
          
        </div>
      </div>
    </div>
  </section>
  
  <section id="content">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
          
          <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile; ?>
          
        </div>
      </div>
    </div>
  </section>

  <section id="steps">
    <div class="container">

      <div class="row step">
        <div class="col-md-4">

          <div class="step-circle text-danger">
            <div>
              Step 1
            </div>
          </div>
          
          <h3 class="text-danger">Create Your Profile</h3>

          <p>
            Joining Miigle takes only a few seconds. Start by clicking on the <strong class="text-danger">“Join Miigle Free”</strong> button on the 
            navigation bar then selecting between the Facebook or Twitter social login buttons. You’ll then 
            receive an email notification with an embedded link. Click on that link to verify your account 
            and complete your profile. 
          </p>
          
        </div>
        <div class="col-md-8">          
          <img class="img-responsive" alt="Miigle" src="<?php echo get_template_directory_uri(); ?>/assets/images/screenshot-placeholder.png">          
        </div>        
      </div><!-- .row.step -->

      <div class="row step">
        <div class="col-md-8">          
          <img class="img-responsive" alt="Miigle" src="<?php echo get_template_directory_uri(); ?>/assets/images/screenshot-placeholder.png">          
        </div> 
        <div class="col-md-4">

          <div class="step-circle text-primary">
            <div>
              Step 2
            </div>
          </div>
          
          <h3 class="text-primary">Post A Product</h3>

          <p>
            When you post products on Miigle, you’re helping those brands get global visibility and earn 
            support. Log into your account, click on the <strong class="text-primary">“Post”</strong> button on the navigation bar and request 
            to be invited to post. We do this to help ensure that people are posting products that are 
            thoughtful and provide value to the community. Once approved, you’ll be able to freely post 
            products on Miigle.
          </p>
          
        </div>               
      </div><!-- .row.step -->

      <div class="row step">        
        <div class="col-md-4">

          <div class="step-circle text-info">
            <div>
              Step 3
            </div>
          </div>
          
          <h3 class="text-info">Support A Product</h3>

          <p>
            See a great product or brand on Miigle that you had no idea existed? Well, that’s the point! 
            We also make it easy for you to show your support in <strong class="text-info">four simple ways.</strong>
          </p>
          
        </div>    
        <div class="col-md-8">          
          <img class="img-responsive" alt="Miigle" src="<?php echo get_template_directory_uri(); ?>/assets/images/screenshot-placeholder.png">          
        </div>

        <div class="col-sm-5 support">
          <h4 class="text-info"><i class="fa fa-star"></i> &nbsp;Upvote</h4>
          Upvoting is like giving your seal of approval on a product. The more upvotes a product has, the 
          more chances it has to be prominently featured on the site and our email newsletter. 
        </div>   

        <div class="col-sm-5 col-sm-offset-1 support">
          <h4 class="text-info"><i class="fa fa-commenting-o"></i> &nbsp;Comment</h4>
          Commenting is the best way to share your thoughts with the Brand as well as other members of 
          the community. We respect any opinions but we do ask that you keep them civil.
        </div> 

        <div class="col-sm-5 support">
          <h4 class="text-info"><i class="fa fa-tag"></i> &nbsp;Buy</h4>
          Buying a product is the greatest endorsement you can give a brand. It helps them keep the lights 
          on at their factories, pay their employees, and produce more amazing products to benefit us all. 
        </div> 

        <div class="col-sm-5 col-sm-offset-1 support">
          <h4 class="text-info"><i class="fa fa-share-alt"></i> &nbsp;Share</h4>
          Sharing your activities on Miigle on Facebook and Twitter spreads awareness amongst your friends 
          and family. Most of these brands are still in very early stages so every share matters! 
        </div>   
      </div><!-- .row.step -->

      <div class="row text-center join">
        <h5>Well, that’s it! Now you’re ready to use Miigle+ Products like an expert.</h5>
        <p>
          If you have any questions or suggestions, please don’t hesitate to contact us. We look forward 
          to checking out your posts! Happy Miiglin’! ;)
        </p>
        <div class="clearfix"></div>
        <a class="btn btn-primary" href="login">
          Ready to join Miigle+
        </a>
      </div>

    </div>
  </section>

  <section id="video" class="text-center page-video">
    <div class="container">
      
      <h2>Together, we can change the world.</h2>
      <a href="#" data-toggle="modal" data-target="#videoModal">
        <img class="alignnone wp-image-48" src="http://plus.miigle.com/wp-content/uploads/2016/04/play.png" alt="play" width="100" height="100" />
      </a>

    </div>
  </section>
  
  <div class="modal fade page-video" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header hidden-lg hidden-md">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <iframe src="https://player.vimeo.com/video/77944311" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
  
</div>
