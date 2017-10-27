<?php

	if( ! defined( 'ABSPATH' ) ) exit; // exit if accessed directly

	/*
	* Get page ID
	*/
	
	if( isset($home_page_blog) && $home_page_blog == true ) {
	
		// home page id
		$page_id = $home_page_id;
	
	} elseif(is_page_template('templates/recipes-page.php')) {
	
		// recipes index id
		$page_id = get_the_ID();
	
	}
	
	
	/*
	* Output featured section
	*/
	
	// check for section shown
	$featured_section_show = get_field('featured_section_show', $page_id);
	
	// show featured section
	if($featured_section_show != ""){
		
		// default featured type
		$featured_section_type = "slideshow";
		
		// check banner featured type
		if(get_field('featured_section_type', $page_id) != "slideshow"){
		
			$featured_section_type = "banner";
		
		}
		
		// set default featured with
		$featured_class_width = "featured-full";
		
		// check for selected width
		$featured_section_width = get_field('featured_section_width', $page_id);
		
		// check if width is not full
		if($featured_section_width != "full"){
			$featured_class_width = "featured-narrow";
		}
	
	}
	
?>

<?php if($featured_section_show != ""){ ?>

	<section class="featured-section <?php echo esc_attr($featured_class_width); ?>">
	
		<?php 
		
			// slideshow type
			if($featured_section_type == "slideshow"){
		
				include_once(get_template_directory() . '/partials/page-featured-slideshow.php');
				
			// banner type
			} elseif($featured_section_type == "banner"){

				include_once(get_template_directory() . '/partials/page-featured-banner.php');
			
			}
		
		?>

	</section>

<?php } ?>