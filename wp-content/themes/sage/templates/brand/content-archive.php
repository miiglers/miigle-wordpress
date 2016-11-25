<div class="templates brand" id="content-archive">
  <?php while (have_posts()) : the_post(); ?>
    <!-- brand -->
			<div class="row flexRow borderB">        
				<div class="col-sm-9 text-sm-center">
        	<h3><?php the_title(); ?> <span class="badge"><img src="<?= get_template_directory_uri() ?>/assets/images/pl-badge.png" alt="badge"></span></h3>
        	<p>Made in USA. Uses 100% organic cotton sourced responsibly.</p>
        </div>	
        <div class="col-sm-3 text-center">
        	<a href="#" class="btn btn-default btn-cta">VISIT WEBSITE</a>
        </div>
			</div>
  <?php endwhile; ?>
</div>