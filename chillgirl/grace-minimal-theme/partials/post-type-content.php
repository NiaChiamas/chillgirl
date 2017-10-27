<?php if( ! defined( 'ABSPATH' ) ) exit; // exit if accessed directly ?>

<?php if(class_exists('acf')){ ?>

	<?php $blog_post_type = get_field('post_type'); ?>

	<!-- blog post type - Image -->
	<?php if($blog_post_type == "Image" || $blog_post_type == ""){ ?>
	
		<?php if($blog_post_type == "Image"){ ?>
	
			<?php
		
				// get post's featured image
				$post_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full-size' );
				
				// get image position wanted
				$image_position = get_field('image_position');
				
				// check image position isn't empty
				if($image_position == ""){
					$image_position = "alignleft";
				}
			
			?>
			
			<?php if($post_image != ""){ ?>
				<div class="post-type-image clearfix">
					<img src="<?php echo esc_attr($post_image[0]); ?>" alt="Blog post" class="single-image image <?php echo esc_attr($image_position); ?>" />
				</div>
			<?php } ?>
		
		<?php } else { ?>
			
			<div class="post-type-image clearfix">
				<?php the_post_thumbnail( "full", array('class' => 'single-image image aligncenter')); ?>
			</div>
		
		<?php } ?>
		
	<?php } ?>

	<!-- blog post type - Slideshow -->
	<?php if($blog_post_type == "Slideshow"){ ?>
		<div id="post-slideshow-outer" class="carousel-outer">

			<!-- Previous slide button -->
			<?php if(get_field('show_slideshow_navigation') != ""){ ?>
				<span class="slideshow-btn previous-slide-btn fa fa-angle-left"></span>
			<?php } ?>
		
			<?php $post_slides = get_field('post_slideshow'); ?>
		
			<!-- post slideshow -->
			<?php if($post_slides != ""){ ?>
			
				<?php 

					// get height of slideshow
					$slideshow_height = get_field('slideshow_height');
					
					// define autoplay variable
					$autoplay_speed = "";

					// check for slideshow autoplay
					if(get_field('slideshow_autoplay') != ""){
					
						// autoplay wanted
						$slideshow_autoplay = "true";
						
						// check autoplay speed is set and is numeric
						if(get_field('autoplay_speed') != "" && is_numeric(get_field('autoplay_speed'))){
							$autoplay_speed = get_field('autoplay_speed');
						} else {
							// otherwise set default speed
							$autoplay_speed = 5000;
						}
						
					} else {
					
						// autoplay not wanted
						$slideshow_autoplay = false;
						
					}
					
					// check for slideshow animations
					if(get_field('slideshow_animations') != "" ){
					
						$animation_in = get_field('slideshow_animation_in'); 
						$animation_out = get_field('slideshow_animation_out');
						
					} else {
					
						$animation_in = "";
						$animation_out = "";
						
					}

				?>

				<div id="post-slideshow" class="carousel <?php if(get_field('show_slideshow_dots') == ""){ ?>hidden-dots<?php } ?>" style="height:<?php echo esc_attr($slideshow_height); ?>px;" data-autoplay="<?php echo esc_attr($slideshow_autoplay); ?>" data-autoplay-speed="<?php echo esc_attr($autoplay_speed); ?>" data-animation-in="<?php echo esc_attr($animation_in); ?>" data-animation-out="<?php echo esc_attr($animation_out); ?>">
					<?php foreach($post_slides as $post_slide) { ?>
						<div class="post-slide" style="height:<?php echo esc_attr($slideshow_height); ?>px;">
							<img src="<?php echo esc_url($post_slide['url']); ?>" class="image" alt="<?php echo esc_attr($post_slide['alt']); ?>" />
						</div>
					<?php } ?>
				</div>
				
			<?php } ?>
			
			<!-- Next slide button -->
			<?php if(get_field('show_slideshow_navigation') != ""){ ?>
				<span class="slideshow-btn next-slide-btn fa fa-angle-right"></span>
			<?php } ?>
		
		</div>
	<?php } ?>

	<!-- blog post type - Video -->
	<?php if($blog_post_type == "Video"){ ?>
		
		<?php
			$video_height = "";
		
			if(get_field('video_height') != ""){
				$video_height = get_field('video_height');
			} else {
				$video_height = 450;
			}
		?>
	
		<div id="post-video" style="height:<?php echo esc_attr($video_height); ?>px;">
			<?php if(get_field('post_video') !=""){ echo get_field('post_video'); } ?>
		</div>
		
	<?php } ?>

<?php } else { ?>

	<div class="post-type-image clearfix">
		<?php the_post_thumbnail( "full", array('class' => 'single-image image aligncenter')); ?>
	</div>

<?php } ?>