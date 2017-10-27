<?php get_header(); ?>
<?php the_post(); ?>

<div id="main-content">
	
	<?php get_template_part('partials/top-page-header'); ?>
	
	<!-- page content -->
	<div class="page-section">
		<div class="container">
		
			<?php 
				
				// default show page title
				$show_page_title = true;
				
				// check hidden title
				if(class_exists('acf')){ 
					if(get_field('hide_page_title')){
						$show_page_title = false;
					}
				}
				
				
				// set sidebar check to false
				$sidebar_check = false;
				
				// define side position variable
				$side_position = "";
				
				// check for sidebar
				if(class_exists('acf')){
					$page_sidebar = get_field('sidebar_option');
				} else {
					$page_sidebar = "right";
				}

				// check sidebar option isn't empty
				if($page_sidebar != ""){
				
					// if sidebar is wanted
					if($page_sidebar != "no sidebar"){
					
						$sidebar_check = true;
						$page_col_class = "col-xlarge-8 col-medium-8";
						
						// set position of sidebar
						if($page_sidebar == "left"){
							$side_position = "left";
						}
						
						if($page_sidebar == "right"){
							$side_position = "right";
						}
					
					// sidebar isn't wanted
					} else {
					
						$page_col_class = "col-xlarge-12 col-medium-12";
						
					}
				
				} else {
					
					$page_col_class = "col-xlarge-12 col-medium-12";
					
				}
			
			?>
			
			<?php if(class_exists('acf') && get_field('post_type_width') == "Full width"){ ?>
				<?php get_template_part('partials/post-type-content'); ?>
			<?php } ?>

			<div class="row">
				
				<!-- page content -->
				<div class="<?php echo esc_attr($page_col_class); ?> <?php if($sidebar_check == true && $side_position == "left"){ echo "xlarge-pull-right medium-pull-right"; } ?>">
				
					<?php if(class_exists('acf') && get_field('post_type_width') == "Post width"){ ?>
						<?php get_template_part('partials/post-type-content'); ?>
					<?php } ?>

					<?php if($show_page_title == true){ ?>
						<h1 class="font-montserrat-reg page-heading"><?php echo get_the_title(); ?></h1>
					<?php } ?>
				
					<!-- main text content -->
					<div class="page-content clearfix">
						<?php echo apply_filters('the_content', $post->post_content); ?>
					</div>
					
					<?php get_template_part('partials/post-pagination'); ?>
					
					<!-- page comments -->
					<div class="post-comments-area font-reg">
						<?php comments_template('', true); ?>
					</div>
					
				</div>
				
				<!-- sidebar -->
				<?php if($sidebar_check == true) { ?>
					<div class="col-xlarge-4 col-medium-4 post-sidebar <?php echo esc_attr($side_position); ?>-sidebar">
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			
			</div>
		
		</div>
	</div>
	
</div>
	
<?php get_footer(); ?>