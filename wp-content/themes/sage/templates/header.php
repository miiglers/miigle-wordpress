<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <?php if(is_user_logged_in() && !is_front_page()): ?>
        <a class="navbar-brand logged-in" href="<?= home_url() ?>">
          <img alt="Miigle" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-circle.svg">
        </a>
      <?php else: ?>
        <a class="navbar-brand" href="<?= home_url() ?>">
          <img alt="Miigle" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg">
        </a>
      <?php endif; ?>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
      <!--<?php if(!is_front_page()): ?>
        <form class="navbar-form navbar-center" role="search">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
        </form>
      <?php endif; ?>-->
      
      <ul class="nav navbar-nav navbar-right">
        <?php if(!is_user_logged_in()): ?>
          <li><a href="<?= home_url() ?>/about">About</a></li>
          <li><a href="<?= home_url() ?>/how-it-works">How it Works</a></li>
        <?php endif; ?>
        <?php if(is_front_page()): ?>
          <li><a href="#story" class="btn btn-primary navbar-btn">Read Our Story</a></li>
        <?php endif; ?>
        <?php if(is_user_logged_in() && !is_front_page()): ?>          
          <li><a href="<?= home_url() ?>/product-post" class="btn btn-default navbar-btn">Post</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-user"></i>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?= home_url() ?>/profile-product">Profile</a></li>
              <li><a href="<?= home_url() ?>/profile-settings">Settings</a></li>
              <?php if(current_user_can('manage_options')): ?>
                <li role="separator" class="divider"></li>
                <li><a href="<?= admin_url() ?>">Admin</a></li>
              <?php endif; ?>
              <li role="separator" class="divider"></li>
              <li><a href="<?= wp_logout_url(home_url()) ?>">Logout</a></li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if(!is_user_logged_in() && !is_front_page()): ?>
          <li><a href="<?= home_url() ?>/login" class="btn btn-default navbar-btn">Login</a></li>
          <li><a href="<?= home_url() ?>/login" class="btn btn-primary navbar-btn">Signup</a></li>
        <?php endif; ?>
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>