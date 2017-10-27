<?php

	if( ! defined( 'ABSPATH' ) ) exit; // exit if accessed directly

	// Social media name array
	$social_media_array = array('Facebook','Twitter','Instagram','Pinterest','Dribbble','Behance','GooglePlus','LinkedIn','Tumblr','Youtube','Snapchat','StumbleUpon','Etsy','Vimeo','BlogLovin');
	
	// Social media font icon array
	$social_icon_array = array('facebook','twitter','instagram','pinterest','dribbble','behance','google-plus','linkedin','tumblr','youtube','snapchat-ghost','stumbleupon','etsy','vimeo','heart');
	
	$social_media_count = count($social_media_array);
	
	// loop through and output those which aren't empty
	for($i=0;$i<$social_media_count;$i++){
		if(get_theme_mod('grace_social_' . $social_media_array[$i]) != ""){ ?>
			<li>
				<a href="<?php echo esc_url(get_theme_mod('grace_social_' . $social_media_array[$i])); ?>" target="_blank">
					<i class="fa fa-<?php echo esc_attr($social_icon_array[$i]); ?>"></i>
				</a>
			</li>
		<?php }
	}

?>