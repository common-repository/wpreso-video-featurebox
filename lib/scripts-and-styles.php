<?php
/*********************************
  Styles and Javascript files for WP Video FeatureBox
*********************************/

add_action('wp_print_styles', 'add_jfb_style');

function add_jfb_style() {
	$baseUrl = WP_PLUGIN_URL . "/wpreso-video-featurebox/etc/css/";
	$baseDir = WP_PLUGIN_DIR . '/wpreso-video-featurebox/etc/css/';
	if ($handle = opendir($baseDir)) {
		while (false !== ($file = readdir($handle))) {
			if(end(explode(".",$file))=='css') {
				wp_register_style(current(explode(".",$file)), $baseUrl.$file);
				wp_enqueue_style( current(explode(".",$file)));
			}
		}
	}
}

// load jquery
wp_enqueue_script('jquery');

// load jFlow script
// is loaded directly in the output function, since it depends on whether animation is used as it needs to load different scripts. jFlow 1.2.1 for animation and jFlow 1.2 without animation
?>