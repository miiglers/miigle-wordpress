<footer id="footer">
  <div class="links">
    <div class="container">
      <div class="row">

        <div class="col-md-3">
          <a href="<?= home_url() ?>">
            <img class="img-responsive" alt="Miigle" src="<?php echo get_template_directory_uri(); ?>/assets/images/logo-white.svg">
          </a>
        </div>
        
        <div class="col-md-3">
          <h4>Company</h4>
          <ul class="list-unstyled">
            <?php if(is_user_logged_in()): ?>
              <li><a href="<?= home_url() ?>/about">About</a></li>
              <li><a href="<?= home_url() ?>/how-it-works">How it works</a></li>
              <li><a href="<?= home_url() ?>/blog">Blog</a></li>
            <?php endif; ?>
            <?php if(is_user_logged_in()): ?>
              <li><a href="<?= home_url() ?>/contact">Contact</a></li>
            <?php endif; ?>
          </ul>
        </div>

        <div class="col-md-3">
          <h4>Legal</h4>
          <ul class="list-unstyled">
            <li><a href="<?= home_url() ?>/privacy">Privacy Policy</a></li>
            <li><a href="<?= home_url() ?>/terms">Terms of Use</a></li>
          </ul>
        </div>

        <div class="col-md-3">
          <h4>Social</h4>
          <ul class="list-unstyled">
            <li><a href="https://www.facebook.com/miiglers/">Facebook</a></li>
            <li><a href="https://twitter.com/miiglers">Twitter</a></li>
            <li><a href="https://instagram.com/miiglers">Instagram</a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>
  
  <div class="copyright text-center">
    &copy; 2016 MIIGLE
  </div>
</footer>
<script type="text/javascript">
  /* <![CDATA[ */
  var wpHomeUrl = '<?= home_url() ?>';
  /* ]]> */
</script>