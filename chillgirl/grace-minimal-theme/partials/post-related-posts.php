<?php if( ! defined( 'ABSPATH' ) ) exit; // exit if accessed directly ?>

<?php if(class_exists('acf') && get_field('related_show') != ""){ ?>

	<!-- related posts -->
	<section id="post-related-posts">
		
		<?php if(get_field('related_posts_heading') != ""){ ?>
			<div class="related-posts-heading">
				<h3 class="font-montserrat-reg"><?php echo get_field('related_posts_heading'); ?></h3>
			</div>
		<?php } ?>
		
		<?php $related_posts = get_field('related_posts'); ?>
		<?php if($related_posts != ""){ ?>
		
			<?php 
			
				// get related post row count
				$related_post_row = get_field('related_post_row');
				
				// if row count is empty or not set
				if($related_post_row == ""){
					$related_post_row = 4;
				}
				
				// define counter to us in post output loop
				$i = 1;
			
			?>
		
			<ul class="row">
				<?php foreach($related_posts as $related_post){ ?>
				
					<li class="col-xlarge-<?php echo esc_attr($related_post_row); ?> col-medium-6">
						<div class="post-list-item wide-post-list-item">
							<a href="<?php echo get_permalink($related_post->ID); ?>">
								<?php $post_image = wp_get_attachment_url(get_post_thumbnail_id($related_post->ID)); ?>
								<?php $post_image_alt = get_post_meta(get_post_thumbnail_id($related_post->ID) , '_wp_attachment_image_alt', true); ?>
								<img src="<?php echo esc_url($post_image); ?>" alt="<?php echo esc_attr($post_image_alt); ?>" class="image">
							</a>
							<h3 class="font-montserrat-reg"><a href="<?php echo get_permalink($related_post->ID); ?>"><?php echo get_the_title($related_post->ID); ?></a></h3>
							<div class="post-list-item-meta font-opensans-reg">
								<span><?php echo get_the_time('F j, Y', $related_post->ID); ?></span>
							</div>
						</div>
					</li>
					
					<?php
					
						// clearfix under each related item
						if($i > 1){
						
							if($related_post_row == 6){
								$col_clearfix_no = 2;
							} else if($related_post_row == 4){
								$col_clearfix_no = 3;
							} else {
								$col_clearfix_no = 1;
							}
						
							if($i % $col_clearfix_no == 0){
								echo '<li class="xlarge-item-clearfix"></li>';
							}
							
							if($i % 2 == 0){
								echo '<li class="medium-item-clearfix"></li>';
							}
							
						}
						
						$i++;
					
					?>
				
				<?php } ?>
			</ul>
		<?php } ?>
		
	</section>
	
<?php } ?>