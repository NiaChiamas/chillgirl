<?php

	if( ! defined( 'ABSPATH' ) ) exit; // exit if accessed directly

	// set show newsletter default
	$show_newsletter_section = false;

	// check acf exists
	if(class_exists('acf')){

		// check newsletter show
		$newsletter_section_show = get_field('newsletter_section_show');
		
		// newsletter shown
		if($newsletter_section_show != ""){
			
			// set show newsletter to true
			$show_newsletter_section = true;
			
			// get newsletter shortcode
			$newsletter_shortcode = get_field('newsletter_shortcode');
		
		}
	
	}

?>

<?php if($show_newsletter_section == true){ ?>

	<!-- newsletter -->
	<section class="newsletter-section single-post-newsletter">
		<div class="page-newsletter clearfix">
		
			<?php echo do_shortcode($newsletter_shortcode); ?>
			
		</div>
	</section>
	
<?php } ?>