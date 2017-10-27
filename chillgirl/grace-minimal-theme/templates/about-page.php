<?php /* Template Name: About Page */ ?>

<?php get_header(); ?>
<?php the_post(); ?>

<div id="main-content">

	<?php get_template_part('partials/top-page-header'); ?>
	
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
			
			<div class="row">
				
				<!-- page content -->
				<div class="<?php echo esc_attr($page_col_class); ?> <?php if($sidebar_check == true && $side_position == "left"){ echo "xlarge-pull-right medium-pull-right"; } ?>">
					
					<div class="about-page-content">
					
						<?php
						
							// default show page title
							$about_page_title_show = true;
						
							// page title variable
							$about_page_title = "";
						
							// check acf installed
							if(class_exists('acf')){
						
								// check page title not hidden
								if(get_field('about_hide_page_title') == ""){
							
									// check custom page title
									if(get_field('about_custom_title') != ""){
									
										$about_page_title = get_field('about_custom_title');
									
									// default page title
									} else {
									
										$about_page_title = get_the_title();
									
									}
								
								// page title hidden
								} else {
								
									$about_page_title_show = false;
								
								}
							
							// acf not installed
							} else {
							
								$about_page_title = get_the_title();
							
							}
							
						?>
					
						<?php if($about_page_title_show == true){ ?>
							<h1 class="font-montserrat-reg page-heading"><?php echo esc_html($about_page_title); ?></h1>
						<?php } ?>
					
						<div class="page-content">
							<?php the_content(); ?>
						</div>
					
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