<?php get_header(); ?>

<div id="main-content">
	
	<?php get_template_part('partials/top-page-header'); ?>
	
	<!-- page content -->
	<div class="page-section">
		<div class="container">
		
			<?php 
				
				// get term id for category or tag
				$queried_object = get_queried_object(); 
				$taxonomy = $queried_object->taxonomy;
				$term_id = $queried_object->term_id;  
				
				// set page id to the term
				$page_id = $taxonomy . '_' . $term_id;
				
				
				// set sidebar check to false
				$sidebar_check = false;
				
				// define side position variable
				$side_position = "";
				
				// check for sidebar
				if(class_exists('acf')){
				
					$page_sidebar = get_field('sidebar_option', $page_id);
					
					if($page_sidebar == ""){
						$page_sidebar = "right";
					}
					
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

			<div class="row">
				
				<!-- page content -->
				<div class="<?php echo esc_attr($page_col_class); ?> <?php if($sidebar_check == true && $side_position == "left"){ echo "xlarge-pull-right medium-pull-right"; } ?>">
				
					<?php get_template_part('partials/posts-page-content'); ?>
					
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