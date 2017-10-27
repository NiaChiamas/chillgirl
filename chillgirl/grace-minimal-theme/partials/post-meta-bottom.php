<?php

	if( ! defined( 'ABSPATH' ) ) exit; // exit if accessed directly

	// set show meta bottom default
	$show_post_meta_bottom = true;
	
	// set show meta tags default
	$show_post_meta_tags = true;
	
	// set show meta share default
	$show_post_meta_share = true;
	

	// check whole meta bottom hidden
	if(class_exists('acf') && get_field('hide_post_meta_bottom') != "" || get_theme_mod('grace_post_meta_override') != ""){
	
		$show_post_meta_bottom = false;
		
	} else {
	
		// check only tags hidden
		if(class_exists('acf') && get_field('hide_post_meta_tags') != "" || get_theme_mod('grace_post_tags_override') != ""){
			$show_post_meta_tags = false;
		}
		
		// check only share hidden
		if(class_exists('acf') && get_field('hide_post_meta_share') != "" || get_theme_mod('grace_post_share_override') != ""){
			$show_post_meta_share = false;
		}
	
	}

?>

<?php if($show_post_meta_bottom == true){ ?>

	<!-- blog post meta -->
	<section class="single-post-meta clearfix">
		
		<!-- post tags -->
		<?php if($show_post_meta_tags == true){ ?>
			<div class="post-tags font-montserrat-reg clearfix">
				<?php the_tags( '','' ); ?>
			</div>
		<?php } ?>
		
		<!-- post share -->
		<?php if($show_post_meta_share == true){ ?>
			<div class="post-share clearfix">

				<?php if(get_theme_mod('grace_share_Facebook') == ""){ ?>
					<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" rel="nofollow" class="social-item hov-bk" target="_blank"><span class="fa fa-facebook"></span></a>
				<?php } ?>

				<?php if(get_theme_mod('grace_share_Twitter') == ""){ ?>
					<a href="https://twitter.com/share?url=<?php the_permalink(); ?>" rel="nofollow" class="social-item hov-bk" target="_blank"><span class="fa fa-twitter"></span></a>
				<?php } ?>

				<?php if(get_theme_mod('grace_share_Pinterest') == ""){ ?>
					<?php $pinterest_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full-size' ); ?>
					<a href="https://pinterest.com/pin/create/bookmarklet/?media=<?php echo esc_attr($pinterest_image[0]); ?>&url=<?php the_permalink(); ?>" rel="nofollow" class="social-item hov-bk" target="_blank"><span class="fa fa-pinterest"></span></a>
				<?php } ?>
				
				<?php if(get_theme_mod('grace_share_GooglePlus') == ""){ ?>
					<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" rel="nofollow" class="social-item hov-bk" target="_blank"><span class="fa fa-google-plus"></span></a>
				<?php } ?>
				
			</div>
			
		<?php } ?>
	</section>

<?php } ?>