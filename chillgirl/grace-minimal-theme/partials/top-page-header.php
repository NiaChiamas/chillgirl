<?php

	if( ! defined( 'ABSPATH' ) ) exit; // exit if accessed directly

	// check acf plugin is active
	if(class_exists('acf')){

		/* -- Get page id -- */
		if(is_home()){
		
			// posts page id
			$page_id = get_option('page_for_posts');
			setup_postdata(get_page($page_id));
		
		} else if( is_category() || is_tag()){
		
			// get term id for category or tag
			$queried_object = get_queried_object(); 
			$taxonomy = $queried_object->taxonomy;
			$term_id = $queried_object->term_id;  
			
			// set page id to the term
			$page_id = $taxonomy . '_' . $term_id;
		
		} else {
			
			// else get regular page ID
			$page_id = get_the_ID();
			
		}
		
		
		/* -- Get options for the page header -- */
		
		// Check if page header to be hidden
		$show_check = get_field('show_page_header', $page_id);
		
		if($show_check != ""){
		
			// check for custom title on page
			$custom_title = get_field('custom_page_title', $page_id);
			if(!empty($custom_title)) {
				$page_title = $custom_title;
			} else {
				$page_title = "";
			}
			
			// check for page overview text
			$overview_text = get_field('page_overview_text', $page_id);
			if(!empty($overview_text)) {
				$page_overview = $overview_text;
			} else {
				$page_overview = "";
			}

			// header image check
			$header_image = get_field('header_image', $page_id);
			if(!empty($header_image)) {
				$header_image = $header_image['url'];
			} else {
				$header_image = "";
			}
			
			// page header width style
			$header_width = get_field('width', $page_id);
			if($header_width == "Full width"){
				$header_narrow_class = "wide-header";
			} else {
				$header_narrow_class = "";
			}
			
			// page header height
			$header_height = get_field('height', $page_id);
			if($header_height != "" && $header_height >= 50 && is_numeric($header_height)){
				$header_style_height = $header_height;
			} else {
				$header_style_height = 250;
			}
			
			// page header height
			$header_max_width = get_field('content_max_width', $page_id);
			if($header_max_width != "" && $header_max_width >= 50 && is_numeric($header_height)){
				$content_max_width = $header_max_width;
			} else {
				$content_max_width = 700;
			}
			
			// custom background color check
			$background_color = get_field('background_color', $page_id);
			if(!empty($background_color)){
				$background_color = $background_color;
			} else {
				$background_color = get_theme_mod('page_header_background_color', 'eeeeee');
			}
			
			// custom content color check
			$content_color = get_field('content_color', $page_id);
			if(!empty($content_color)){
				$content_color = $content_color;
			} else {
				$content_color = get_theme_mod('page_header_text_color', '111111');
			}
			
			// content background color
			if(get_field('content_background', $page_id) != ""){
				
				// background style class
				$content_background_class = "page-head-inside-background";
				
				// styling to add for background color + opacity
				$content_background_style = 'background-color:rgba(' . grace_hex_convert(get_field('content_background_color', $page_id)) . ',' . get_field('content_background_opacity', $page_id) . ');';

			} else {
			
				// content not wanted but define variables
				$content_background_class = "";
				$content_background_style = "";
				
			}

		}
	
	}

?>

<?php if(class_exists('acf') && $show_check != ""){ ?>

	<section class="page-header <?php echo esc_attr($header_narrow_class); ?>">
		<div class="container">
		
			<!-- page header inner -->
			<div class="section-inner no-border" style="color:<?php echo esc_attr($content_color); ?>;background-color:<?php echo esc_attr($background_color); ?>;<?php if($header_image){ ?>background-image:url('<?php echo esc_url($header_image); ?>');<?php } ?>min-height:<?php echo esc_attr($header_style_height); ?>px;">
				<div class="page-head-inside <?php echo esc_attr($content_background_class); ?>" style="<?php echo esc_attr($content_background_style); ?> max-width:<?php echo esc_attr($content_max_width); ?>px;">
					<h1 class="font-montserrat-reg"><?php echo esc_html($page_title); ?></h1>
					<?php if(!empty($overview_text)) { ?>
						<p class="font-opensans-reg"><?php echo esc_html($page_overview); ?></p>
					<?php } ?>
				</div>
			</div>
			
		</div>
	</section>

<?php } ?>