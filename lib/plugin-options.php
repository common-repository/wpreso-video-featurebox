<?php
/*********************************
  Options page for WPreso Video FeatureBox
*********************************/

add_action('admin_init', 'wpreso_vfb_options_init' );
add_action('admin_menu', 'wpreso_vfb_options_add_page');

// Init plugin options to white list our options
function wpreso_vfb_options_init(){
	register_setting( 'wpreso_vfb_options_options', 'wpreso_video_featurebox', 'wpreso_vfb_options_validate' );
	$wpreso_vfb_default_values = array("title"=>"","cat"=>"","num"=>5,"off"=>"","ran"=>"false","exi"=>"","ani"=>"true","ans"=>5);
	add_option('wpreso_video_featurebox', $wpreso_vfb_default_values, '', 'yes');
}

// Add menu page
function wpreso_vfb_options_add_page() {
	add_options_page(__("WPreso Video FeatureBox Options", 'wpreso-video-featurebox'), __("WPreso Video FeatureBox", 'wpreso-video-featurebox'), 'manage_options', 'wpreso_vfb_options', 'wpreso_vfb_options_do_page');
	
	add_submenu_page(__FILE__, 'Test Sublevel', 'Test Sublevel', 8, 'sub-page', 'mt_sublevel_page');
}

// Draw the menu page itself
function wpreso_vfb_options_do_page() {
	?>
	<div class="wrap">
		<h2><?php _e("WPreso Video FeatureBox Settings", 'wpreso-video-featurebox');?></h2>
        <form method="post" action="options.php">
			<?php settings_fields('wpreso_vfb_options_options'); ?>
			<?php $wpreso_vfb_options = get_option('wpreso_video_featurebox'); ?>
			<table class="form-table">
				<tr valign="top"><th scope="row"><label for="wpvctit"><?php _e("Default title",'wpreso-video-featurebox');?></label></th>
					<td><input type="text" name="wpreso_video_featurebox[title]" id="wpvctit" value="<?php echo $wpreso_vfb_options['title']; ?>" /></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="wpvfbcat"><?php _e("Default category(ies) by comma separated ids", 'wpreso-video-featurebox');?></label></th>
					<td><input type="text" name="wpreso_video_featurebox[cat]" id="wpvfbcat" value="<?php echo $wpreso_vfb_options['cat']; ?>" /> (<?php _e("Add a minus sign (-) in front of the id to exclude the category - No spaces", 'wpreso-video-featurebox');?>)</td>
				</tr>
				<tr valign="top"><th scope="row"><label for="wpvfbnum"><?php _e("Default number of posts", 'wpreso-video-featurebox');?></label></th>
					<td><input type="text" size="2" name="wpreso_video_featurebox[num]" id="wpvfbnum" value="<?php echo $wpreso_vfb_options['num']; ?>" /></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="wpvfboff"><?php _e("Default post offset", 'wpreso-video-featurebox');?></label></th>
					<td><input type="text" size="2" name="wpreso_video_featurebox[off]" id="wpvfboff" value="<?php echo $wpreso_vfb_options['off']; ?>" /></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="wpvfbran"><?php _e("Enable random posts",'wpreso-video-featurebox');?></label></th>
					<td><input type="checkbox" name="wpreso_video_featurebox[ran]" id="wpvfbran" value="true" <?php checked('true', $wpreso_vfb_options['ran']); ?> /></td>
				</tr>
				<tr valign="top"><th scope="row"><label for="wpvfbexi"><?php _e("Explude posts from Video FeatureBox by comma separated ids", 'wpreso-video-featurebox');?></label></th>
					<td><input type="text" name="wpreso_video_featurebox[exi]" id="wpvfbexi" value="<?php echo $wpreso_vfb_options['exi']; ?>" /> (<?php _e("No spaces", 'wpreso-video-featurebox');?>)</td>
				</tr>
				<tr valign="top"><th scope="row"><label for="wpvfbani"><?php _e("Enable slide animation on Video FeatureBox",'wpreso-video-featurebox');?></label></th>
					<td><input type="checkbox" name="wpreso_video_featurebox[ani]" id="wpvfbani" value="true" <?php checked('true', $wpreso_vfb_options['ani']); ?> /></td>
				</tr>
				</tr>
				<tr valign="top"><th scope="row"><label for="wpvfbans"><?php _e("Default delay in seconds", 'wpreso-video-featurebox');?></label></th>
					<td><input type="text" size="2" name="wpreso_video_featurebox[ans]" id="wpvfbans" value="<?php echo $wpreso_vfb_options['ans']; ?>" /></td>
				</tr>
			</table>
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
		<div style="margin:10px 0; border-bottom:0px solid #ccc; border-top:1px solid #ccc; padding:5px 10px;">
        	<h2><?php _e("Help", 'wpreso-video-featurebox');?></h2>
            <p>
        		<?php _e("You can override the default functions in the shortcode like this", 'wpreso-video-featurebox');?>:<br/>
                <code>[wpvfb title="Featured Videos" cat="-1,2,3" num="20" off="" ran="true" exi="12,47,53" ani="true" ans="5"]</code>
            </p>
            <p>
            	<?php _e("You can override the default functions in the template function like this", 'wpreso-video-featurebox');?>:<br/>
                <code>&lt;?php echo wpreso_videofeaturebox($title="Featured Videos" $cat="-1,2,3", $num="20", $off="", $ran="true", $exi="12,47,53", $ani="true", $ans="5"); ?></code>
            </p>
            <p>
            	<?php _e("For more help on setting up WPreso Video FeatureBox, please visit", 'wpreso-video-featurebox');?> <a href="http://www.wpreso.com/plugins/wpreso-video-featurebox"><?php _e("WPreso Video FeatureBox", 'wpreso-video-featurebox');?></a>
            </p>
        </div>
		<div style="margin:10px 0; border-bottom:0px solid #ccc; border-top:1px solid #ccc; padding:5px 10px;">
        	<h2><?php _e("Credits", 'wpreso-video-featurebox');?></h2>
            <ul>
                <li><a href="http://www.wordpress.org">WordPress</a> <?php _e("for their software, which is awesome", 'wpreso-video-featurebox');?>.</li>
            	<li><a href="http://www.viper007bond.com/wordpress-plugins/vipers-video-quicktags/">Viper's Video Quicktags</a> <?php _e("for a superb and easy to use video plugin", 'wpreso-video-featurebox');?>.</li>
                <li><a href="http://www.gimiti.com/kltan/wordpress/?p=32">jFlow</a> <?php _e("for a sweet javascript content slider", 'wpreso-video-featurebox');?>.</li>
                <li><a href="http://planetozh.com/blog/2009/05/handling-plugins-options-in-wordpress-28-with-register_setting/?cp=all">Ozh</a> <?php _e("for a great tutorial on option pages", 'wpreso-video-featurebox');?>.</li>
                <li><a href="http://www.smashingmagazine.com/2009/02/02/mastering-wordpress-shortcodes/">Smashing Magazine</a> <?php _e("for a smashing tutorial on shortcodes", 'wpreso-video-featurebox');?>.</li>
                <li><a href="http://www.youtube.com">Youtube</a>, <a href="http://video.google.com/">Google Video</a>, <a href="http://www.blip.tv/">Blip.tv</a>, <a href="http://www.vimeo.com/">Vimeo</a>, <a href="http://www.dailymotion.com/">Dailymotion</a>, <a href="http://www.metacafe.com/">Metacafe</a>, <a href="http://www.viddler.com/">Viddler</a> and <a href="http://vids.myspace.com">Myspace</a> <?php _e("for making it simple to extract video image information", 'wpreso-video-featurebox');?>.</li>
            </ul>
        </div>
	</div>
	<?php	
}

// Sanitize and validate input. Accepts an array, return a sanitized array.
function wpreso_vfb_options_validate($input) {
	$input['title'] =  wp_filter_nohtml_kses($input['title']);
	$input['cat'] =  ( preg_match('/^(-)?\d+(,(-)?\d+)*$/', trim($input['cat'])) ? trim($input['cat']) : '');
	$input['num'] =  ( intval($input['num']) == 0 ? '' : intval($input['num']) );
	$input['off'] =  ( intval($input['off']) == 0 ? '' : intval($input['off']) );
	$input['ran'] = ( $input['ran'] == 'true' ? 'true' : 'false' );
	$input['exi'] =  ( preg_match('/^\d+(,\d+)*$/', trim($input['exi'])) ? trim($input['exi']) : '');
	$input['ani'] = ( $input['ani'] == 'true' ? 'true' : 'false' );
	$input['ans'] =  ( intval($input['ans']) == 0 ? '' : intval($input['ans']) );
	
	return $input;
}


?>