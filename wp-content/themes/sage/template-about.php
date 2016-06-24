<?php
/**
 * Template Name: About
 */
?>

<div id="template-about">
  
  <section id="splash" class="text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
        
          <?= the_field('ta_hero_text'); ?>
        	<!-- 
        	<h2>“If not us, who? If not now, when?” – RFK</h2>
        	<p><a class="btn btn-default" href="#">Why we are building Miigle</a></p>
        	<!-- -->
        	
        </div>
      </div>
    </div>
  </section>
  
  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          
          <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
          <?php endwhile; ?>
          
        </div>
      </div>
    </div>
  </section>
  
  <section id="team" class="text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">

          <?= the_field('ta_team_header'); ?>
          <!-- 
        	<h2>Meet the team building Miigle</h2>
        	<p>Mauris lacinia porta faucibus. Fusce eu est ac eros vulputate mollis in ac felis. Aenean commodo scelerisque mi sed imperdiet. Donec at hendrerit nisi, eget vestibulum nisi. Sed sit amet magna luctus, facilisis erat quis.</p>
					<!-- -->
					
          <?= the_field('ta_team_members'); ?>
          <?php /* 
          <div class="row">
          	
          	<div class="col-sm-4 team">
          		<p><img class="img-responsive" src="https://miigle.com/wp-content/uploads/2016/04/luc.png"></p>
          		<h4>Luc Berlin</h4>
          		<p>Co-Founder &amp; CEO</p>
          		<!--<p><a href="#">@miigle_handle</a></p>-->
          	</div>
          	
          	<div class="col-sm-4 team">
          		<p><img class="img-responsive" src="https://miigle.com/wp-content/uploads/2016/06/team-joshfester.jpg"></p>
          		<h4>Josh Fester</h4>
          		<p>Co-Founder &amp; CTO</p>
          		<!--<p><a href="#">@miigle_handle</a></p>-->
          	</div>
          	
          	<div class="col-sm-4 team">
          		<p><img class="img-responsive" src="https://miigle.com/wp-content/uploads/2016/06/michael.png"></p>
          		<h4>Michael Evans</h4>
          		<p>COO &amp; CFO</p>
          		<!--<p><a href="#">@miigle_handle</a></p>-->
          	</div>
          		<div class="clearfix"></div>
          	
          	<div class="col-sm-4 team">
          		<p><img class="img-responsive" src="https://miigle.com/wp-content/uploads/2016/06/team-wilianiralzabal.png"></p>
          		<h4>Wilian Iralzabal</h4>
          		<p>Product Design</p>
          		<!--<p><a href="#">@miigle_handle</a></p>-->
          	</div>
          	
          	<div class="col-sm-4 team">
          		<p><img class="img-responsive" src="https://miigle.com/wp-content/uploads/2016/06/team-yukirosene.png"></p>
          		<h4>Yuki Rosene</h4>
          		<p>Engineering</p>
          		<!--<p><a href="#">@miigle_handle</a></p>-->
          	</div>
          	
          	<div class="col-sm-4 team">
          		<p><img class="img-responsive" src="https://miigle.com/wp-content/uploads/2016/06/jessee.png"></p>
          		<h4>Jesse Alter</h4>
          		<p>Business</p>
          		<!--<p><a href="#">@miigle_handle</a></p>-->
          	</div>
          		<div class="clearfix"></div>
          	
          	<div class="col-sm-4 team">
          		<p><img class="img-responsive" src="https://miigle.com/wp-content/uploads/2016/06/team-aaronplaat.png"></p>
          		<h4>Aaron Plaat</h4>
          		<p>Marketing</p>
          		<!--<p><a href="#">@miigle_handle</a></p>-->
          	</div>
          	
          	<div class="col-sm-4 team">
          		<p><img class="img-responsive" src="https://miigle.com/wp-content/uploads/2016/06/sarah.png"></p>
          		<h4>Sarah Smith</h4>
          		<p>Operations</p>
          		<!--<p><a href="#">@miigle_handle</a></p>-->
          	</div>
          	
          	<div class="col-sm-4 team">
          		<p><img class="img-responsive" src="https://miigle.com/wp-content/uploads/2016/06/anitha.png"></p>
          		<h4>Anitha Thenappan</h4>
          		<p>Strategy</p>
          		<!--<p><a href="#">@miigle_handle</a></p>-->
          	</div>
          		<div class="clearfix"></div>
          	
          	<div class="col-sm-4 team">
          		<p><img class="img-responsive" src="https://miigle.com/wp-content/uploads/2016/06/team-add.png"></p>
          		<h4>Want to join?</h4>
          		<p>&nbsp;</p>
          		<p><a href="#" class="btn btn-default">Send us note</a></p>
          	</div>
          </div>
					*/ ?>
					
        </div>
      </div>
    </div>
  </section>
  
  <section id="video" class="text-center">
    <div class="container">
      
      <?= the_field('ta_video_text'); ?>

    </div>
  </section>
  
  <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
