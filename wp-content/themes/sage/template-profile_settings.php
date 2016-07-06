<?php
/**
 * Template Name: Profile Settings
 */

use Miigle\Models\User;
use Miigle\Models\Brand;
 
$mgl_user = User\current();

$categories = get_terms(array(
    'taxonomy' => 'mgl_product_category',
    'hide_empty' => false,
));

$brands = Brand\get_posts();
?>

<div id="template-profile_settings">
  
  <section id="product_post">
    <div class="container-fluid">
      <div class="row">
        
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 main">
          
          <h1>Settings</h1> 

          <div class="well">
          
  					<form id="profile-settings" class="form-horizontal" method="put" action="mgl/v1/user">
  						
  						<input type="hidden" name="author" value="<?= $mgl_user['ID'] ?>">

              <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?= $mgl_user['first_name'] ?>">
                </div>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?= $mgl_user['last_name'] ?>">
                </div>
              </div>
              
              <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $mgl_user['email'] ?>">
                </div>
              </div>
              
              <div class="form-group">
                <label for="_mgl_user_username" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10 ">
                  <input type="text" class="form-control" id="_mgl_user_username" name="_mgl_user_username" placeholder="Username" value="<?= $mgl_user['username'] ?>">
                </div>
              </div>
              
              <div class="form-group">
                <label for="_mgl_user_title" class="col-sm-2 control-label">Job title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="_mgl_user_title" name="_mgl_user_title" placeholder="Job title and company" value="<?= $mgl_user['_mgl_user_title'] ?>">
                </div>
              </div>
              
              <div class="form-group">
                <label for="_mgl_user_company" class="col-sm-2 control-label">Company</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="_mgl_user_company" name="_mgl_user_company" placeholder="Company" value="<?= $mgl_user['_mgl_user_company'] ?>">
                </div>
              </div>
              
              <div class="form-group">
                <label for="_mgl_user_website" class="col-sm-2 control-label">Website</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="_mgl_user_website" name="_mgl_user_website" placeholder="Website"" value="<?= $mgl_user['_mgl_user_website'] ?>">
                </div>
              </div>
              
              <div class="form-group">
                <label for="_mgl_user_facebook" class="col-sm-2 control-label">Facebook</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="_mgl_user_facebook" name="_mgl_user_facebook" placeholder="Facebook URL" value="<?= $mgl_user['_mgl_user_facebook'] ?>">
                </div>
              </div>
              
              <div class="form-group">
                <label for="_mgl_user_twitter" class="col-sm-2 control-label">Twitter</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="_mgl_user_twitter" name="_mgl_user_twitter" placeholder="Twitter URL" value="<?= $mgl_user['_mgl_user_twitter'] ?>">
                </div>
              </div>
              
              <div class="form-group" style="margin-top:50px;">
                <div class="clearfix"></div>
                <button type="submit" class="btn btn-primary pull-right submit">
                  <i class="fa fa-refresh fa-spin hidden"></i>
                  Save
                </button>
              </div>
                
            </form>

          </div>

          <div class="well">
          
            <h2>Invite someone</h2>
            <p>You have 5 invites left. Choose wisely.</p>
            
            <?= do_shortcode('[contact-form-7 title="Invite"]') ?>

          </div>
					
        </div>
      </div>
    </div>
  </section>
  
   
</div>
