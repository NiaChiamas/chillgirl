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
	* Output newsletter section
	*/
	
	$newsletter_section_show = get_field('newsletter_section_show', $page_id);
	
	// check newsletter shown
	if($newsletter_section_show != ""){
		
		// get newsletter shortcode
		$newsletter_shortcode = get_field('newsletter_shortcode', $page_id);
	
	}
	
?>

<?php if($newsletter_section_show != "" && $newsletter_shortcode != ""){ ?>

	<section class="newsletter-section">
		<div class="container">
			
			<div class="page-newsletter clearfix">
				
				<?php echo do_shortcode($newsletter_shortcode); ?>
			
			</div>
			
		</div>
	</section>

<?php } ?>