<?php /* Template Name: Home Page */ ?>

<?php get_header(); ?>

<div id="main-content">

	<?php

		// define home page id variable
		$home_page_id = "";
	
		// set from page for posts to false
		$from_page_for_posts = false;
		
		// set home page blog variable
		$home_page_blog = true;
		
		
		// check if is home page
		if ( is_page_template("home.php") || is_home() && !get_option( 'page_for_posts' )){

			// check if is home
			if(is_home()){

				// get id of page using the home template
				$home_page = get_pages(array(
					'meta_key' => '_wp_page_template',
					'meta_value' => 'home.php',
					'number' => 1,
					'sort_column' => 'menu_order'
				));

				// the id of the page
				foreach($home_page as $page){
					$home_page_id = $page->ID;
				}
			
			} else {
			
				// else use wp get the id function
				$home_page_id = get_the_ID();
			
			}
			
		// check if is page for posts
		} else if(get_option( 'page_for_posts' )){ 
		
			// set from post for posts to true, used for pagination option
			$from_page_for_posts = true;
		
			// page id is the id of the page for posts
			$home_page_id = get_option( 'page_for_posts' );
		
		}
	
	?>
	
	<?php 
	
		// check acf active
		if(class_exists('acf')){ 
		
			// include featured section
			include_once(get_template_directory() . '/partials/page-featured-section.php');
		
			// include promo boxes - top
			if(get_field('promo_boxes_show', $page_id) != "" && get_field('promo_box_position', $page_id) == "top"){
		
				include_once(get_template_directory() . '/partials/page-promo-boxes.php');
			
			}
			
			// include newsletter
			include_once(get_template_directory() . '/partials/page-newsletter-section.php');
			
		}
		
	?>
		
	<!-- page content -->
	<div class="page-section">
		<div class="container">
			
			<?php 
				
				// set sidebar check to false
				$sidebar_check = false;
				
				// define side position variable
				$side_position = "";
				
				// check for sidebar
				if(class_exists('acf')){
				
					// get sidebar from template
					$page_sidebar = get_field('sidebar_option', $home_page_id);
					
					// check sidebar not set
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
					
					<?php

						// include blog posts content partial ( include used to pass through home_page_blog variable )
						include_once(get_template_directory() . '/partials/posts-page-content.php');

					?>
					
				</div>
				
				<!-- sidebar -->
				<?php if($sidebar_check == true) { ?>
					<div class="col-xlarge-4 col-medium-4 post-sidebar <?php echo esc_attr($side_position); ?>-sidebar">
						<?php include_once(get_template_directory() . '/sidebar.php'); ?>
					</div>
				<?php } ?>
			
			</div>
		
		</div>
	</div>
	
	<?php 
		
		// check acf active
		if(class_exists('acf')){
		
			// include promo boxes - bottom
			if(get_field('promo_boxes_show', $page_id) != "" && get_field('promo_box_position', $page_id) == "bottom"){
		
				include_once(get_template_directory() . '/partials/page-promo-boxes.php');
			
			}
		
		}
	
	?>

</div>

<?php get_footer(); ?>