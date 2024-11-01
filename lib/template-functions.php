<?php
/*********************************
  Template functions for WPreso Video FeatureBox
*********************************/

function wpreso_videofeaturebox($title="",$cat="",$num="",$off="",$ran="",$exi="",$ani="",$ans="") {
	global $wp_query;
	$options = get_option('wpreso_video_featurebox');
	$title = ( empty($title) ? $options['title'] : $title );
	$cat = ( empty($cat) ? $options['cat'] : $cat );
	$num = ( empty($num) ? $options['num'] : $num );
	$off = ( empty($off) ? $options['off'] : $off );
	$ran = ( empty($ran) ? $options['ran'] : $ran );
	$exi = ( empty($exi) ? $options['exi'] : $exi );
	$ani = ( empty($ani) ? $options['ani'] : $ani );
	$ans = ( empty($ans) ? $options['ans'] : $ans );
	$wpvfbid = md5(uniqid(mt_rand(), true));
	$orderby = (($ran=='true')? 'rand' : 'date' );
	$wpvfbposts = get_posts('numberposts='.$num.'&order=DESC&orderby='.$orderby.'&category='.$cat.'&exclude='.$exi.'&offset='.$off);
	$str .= "\n\n".'<!-- WPreso Video FeatureBox starts here -->'."\n\n";
	$str .= '<div id="wpvfb_'.$wpvfbid.'" class="VideoFeatureBox">'."\n";
	$str .= ((!empty($title)) ? '<h2>'.$title.'</h2>' : '');
	$str .= '<div id="wpvfb_slides_'.$wpvfbid.'" class="wpvfb_slides">'."\n";
	foreach($wpvfbposts as $post) {
		setup_postdata($post);
		$vi = wpreso_get_the_video_image(get_the_content());
		if(!empty($vi)) {
			$ctlr[] = $vi;
			$str .= '<div>'."\n";
			$str .= '<div class="featbox_lft">'."\n";
			$str .= '<h3><a href="'. get_permalink($post->ID) .'" rel="bookmark" title="'. get_the_title($post->ID) .'">'. get_the_title($post->ID) .'</a></h3>'."\n";
			$str .= '<p>'.get_the_excerpt().'</p>'."\n";
			$str .= '</div>'."\n";
			$str .= '<div class="featbox_rgt">'."\n";
			$str .= '<a href="'. get_permalink($post->ID) .'" title="'. get_the_title($post->ID) .'"><img src="'. $vi .'" alt="" /><em></em></a>'."\n";
			$str .= '</div>'."\n";
			$str .= '</div>'."\n";
		}
	}
	$str .= '</div>'."\n";
	$str .= '<div id="ctrlw_'.$wpvfbid.'" class="controlswrap">'."\n";
	$str .= '<span id="prev_'.$wpvfbid.'" class="jFlowPrev jfp_'.$wpvfbid.'">Prev</span>'."\n";
	$str .= '<div class="controllers">'."\n";
	for($i=1; $i<=count($ctlr); $i++) {
		$str .= '<span class="jFlowControl jfc_'.$wpvfbid.'"></span>'."\n";
	}
	$str .= '</div>'."\n";
	$str .= '<span id="next_'.$wpvfbid.'" class="jFlowNext jfn_'.$wpvfbid.'">Next</span>'."\n";
	$str .= '</div>'."\n";
	$str .= '</div>'."\n";
	if($ani=='true'){
		$str .= '<script type="text/javascript" src="' . WP_PLUGIN_URL .  '/wpreso-video-featurebox/etc/js/jquery.flow.1.2.1.min.js"></script>'."\n";
	} else {
		$str .= '<script type="text/javascript" src="' . WP_PLUGIN_URL .  '/wpreso-video-featurebox/etc/js/jquery.flow.1.2.min.js"></script>'."\n";
	}
	$str .= '<script type="text/javascript">'."\n";
	$str .= 'jQuery(document).ready(function(){'."\n";
	$str .= 'jQuery("#wpvfb_'.$wpvfbid.'").jFlow({'."\n";
	$str .= 'slides: "#wpvfb_slides_'.$wpvfbid.'",'."\n";
	$str .= 'controller: ".jfc_'.$wpvfbid.'", // must be class, use . sign'."\n";
	$str .= 'slideWrapper : "#jfsl_'.$wpvfbid.'", // must be id, use # sign'."\n";
	$str .= 'selectedWrapper: "jFlowSelected",  // just pure text, no sign'."\n";
	$str .= 'height: (jQuery("#wpvfb_'.$wpvfbid.'").height()-jQuery("#ctrlw_'.$wpvfbid.'").height())+"px",'."\n";
	$str .= 'duration: 400,'."\n";
	if($ani=='true') {
		$str .= 'interval: '.$ans.'000,'."\n";
	}
	$str .= 'prev: ".jfp_'.$wpvfbid.'", // must be class, use . sign'."\n";
	$str .= 'next: ".jfn_'.$wpvfbid.'" // must be class, use . sign'."\n";
	$str .= '});'."\n";
	$str .= '});'."\n";
	$str .= '</script>'."\n";
	$str .= "\n\n".'<!-- WPreso Video FeatureBox ends here -->'."\n\n";
	return $str;
}
?>