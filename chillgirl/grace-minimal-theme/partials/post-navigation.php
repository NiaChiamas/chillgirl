<?php 
	
	if( ! defined( 'ABSPATH' ) ) exit; // exit if accessed directly
	
	// set show post navigation default
	$show_post_navigation = true;
	
	// check navigation is hidden
	if(class_exists('acf') && get_field('hide_post_navigation') != "" || get_theme_mod('grace_post_navigation_override') != ""){
		
		// set post navigation false
		$show_post_navigation = false;
	
	}
	
	
	// check post navigation is shown
	if($show_post_navigation == true){
	
		// Get previous post
		$prev_post = get_previous_post(); 
		
		// Get next post
		$next_post = get_next_post();
		
		// prev post link text
		$previous_link_text = get_theme_mod('grace_single_post_previous', 'Prev Post');
	
		// next post link text
		$next_link_text = get_theme_mod('grace_single_post_next', 'Next Post');

	}
	
?>

<?php if($show_post_navigation == true){ ?>

	<?php if(!empty($prev_post) || !empty($next_post)) { ?>
	
		<!-- post navigation -->
		<section class="post-navigation">
			<div id="post-nav-main" class="clearfix">
			
				<?php if(!empty($prev_post)) { ?>
					<a href="<?php echo get_the_permalink($prev_post->ID); ?>" id="post-nav-prev" class="post-nav-item hov-bk">
						<span class="font-montserrat-reg"><i class="fa fa-angle-left"></i><?php echo esc_html($previous_link_text); ?></span>
					</a>
				<?php } ?>
				
				<?php if(!empty($next_post)) { ?>
					<a href="<?php echo get_the_permalink($next_post->ID); ?>" id="post-nav-next" class="post-nav-item hov-bk">
						<span class="font-montserrat-reg"><?php echo esc_html($next_link_text); ?><i class="fa fa-angle-right"></i></span>
					</a>
				<?php } ?>
				
			</div>
		</section>
		
	<?php } ?>
	
<?php } ?>