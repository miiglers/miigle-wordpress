<?php
defined('ABSPATH') or die("Cheating........Uh!!");
?>
<div id="fb-root"></div>

<div class="metabox-holder columns-2" id="post-body">
	<form action="options.php" method="post">
		<?php settings_fields('the_champ_general_options'); ?>
		<div class="the_champ_left_column">
			<div class="stuffbox">
				<h3><label><?php _e('General Options', 'Super-Socializer');?></label></h3>
				<div class="inside">
				<table width="100%" border="0" cellspacing="0" cellpadding="0" class="form-table editcomment menu_content_table">
					<tr>
						<th>
						<img id="the_champ_footer_script_help" class="the_champ_help_bubble" src="<?php echo plugins_url('../images/info.png', __FILE__) ?>" />
						<label for="the_champ_footer_script"><?php _e("Include Javascript in website footer", 'Super-Socializer'); ?></label>
						</th>
						<td>
						<input id="the_champ_footer_script" name="the_champ_general[footer_script]" type="checkbox" <?php echo isset($theChampGeneralOptions['footer_script']) ? 'checked = "checked"' : '';?> value="1" />
						</td>
					</tr>
					
					<tr class="the_champ_help_content" id="the_champ_footer_script_help_cont">
						<td colspan="2">
						<div>
						<?php _e('If enabled (recommended), Javascript files will be included in the footer of your website.', 'Super-Socializer') ?>
						</div>
						</td>
					</tr>

					<tr>
						<th>
						<img id="the_champ_combined_script_help" class="the_champ_help_bubble" src="<?php echo plugins_url('../images/info.png', __FILE__) ?>" />
						<label for="the_champ_combined_script"><?php _e("Load all Javascript files in single file", 'Super-Socializer'); ?></label>
						</th>
						<td>
						<input id="the_champ_combined_script" name="the_champ_general[combined_script]" type="checkbox" <?php echo isset($theChampGeneralOptions['combined_script']) ? 'checked = "checked"' : '';?> value="1" />
						</td>
					</tr>
					
					<tr class="the_champ_help_content" id="the_champ_combined_script_help_cont">
						<td colspan="2">
						<div>
						<?php _e('Loads Javascript in single request.', 'Super-Socializer') ?>
						</div>
						</td>
					</tr>

					<tr>
						<th>
						<img id="the_champ_delete_options_help" class="the_champ_help_bubble" src="<?php echo plugins_url('../images/info.png', __FILE__) ?>" />
						<label for="the_champ_delete_options"><?php _e("Delete all the options on plugin deletion", 'Super-Socializer'); ?></label>
						</th>
						<td>
						<input id="the_champ_delete_options" name="the_champ_general[delete_options]" type="checkbox" <?php echo isset($theChampGeneralOptions['delete_options']) ? 'checked = "checked"' : '';?> value="1" />
						</td>
					</tr>
					
					<tr class="the_champ_help_content" id="the_champ_delete_options_help_cont">
						<td colspan="2">
						<div>
						<?php _e('If enabled, plugin options will get deleted when plugin is deleted/uninstalled and you will need to reconfigure the options when you install the plugin next time.', 'Super-Socializer') ?>
						</div>
						</td>
					</tr>

					<tr>
						<th>
						<img id="the_champ_custom_css_help" class="the_champ_help_bubble" src="<?php echo plugins_url('../images/info.png', __FILE__) ?>" />
						<label for="the_champ_custom_css"><?php _e("Custom CSS", 'Super-Socializer' ); ?></label>
						</th>
						<td>
						<textarea rows="7" cols="63" id="the_champ_custom_css" name="the_champ_general[custom_css]"><?php echo isset( $theChampGeneralOptions['custom_css'] ) ? $theChampGeneralOptions['custom_css'] : '' ?></textarea>
						</td>
					</tr>
					
					<tr class="the_champ_help_content" id="the_champ_custom_css_help_cont">
						<td colspan="2">
						<div>
						<?php _e('You can specify any additional CSS rules (without &lt;style&gt; tag)', 'Super-Socializer' ) ?>
						</div>
						</td>
					</tr>
				</table>
				
				<div class="the_champ_clear"></div>
				<p class="submit">
					<input id="the_champ_enable_fblike" style="margin-left:8px" type="submit" name="save" class="button button-primary" value="<?php _e("Save Changes", 'Super-Socializer'); ?>" />
				</p>

				</div>
			</div>

			</div>
			<?php include 'help.php'; ?>
	</form>
</div>