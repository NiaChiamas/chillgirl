<?php get_header(); ?>
<?php the_post(); ?>

<div id="main-content">

	<?php get_template_part('partials/top-page-header'); ?>
	
	<!-- page content -->
	<section class="single-post-main page-section">
		<div class="container">
		
			<?php 
			
				// default sidebar
				$post_sidebar_check = true;
				
				// define sidebar position
				$post_sidebar_position = "right";
				
				// default post wide
				$post_full_width = false;
				
				// default post layout class
				$post_layout_col_class = "col-xlarge-8 col-medium-8";
				
				// default post title section
				$post_title_section = true;
				
				// default post title position
				$post_title_position = "below";
				
				// default post title alignment
				$post_title_alignment = "left";
				
				// default post title category
				$post_title_category = true;
				
				// default post title author
				$post_title_author = true;
				
				// default post title date
				$post_title_date = true;
				
			
				// check post layout override options
				if(get_theme_mod('grace_post_layout_override') == ""){
				
					// check acf installed
					if(class_exists('acf')){
					
						// get sidebar position
						$post_sidebar_option = get_field('sidebar_option');

						// check sidebar wanted
						if($post_sidebar_option != "no-sidebar"){
						
							// set sidebar position
							$post_sidebar_position = $post_sidebar_option;
						
							// post layout class
							$blog_col_class = "col-xlarge-8 col-medium-8";
						
						} else {
						
							// set sidebar to false
							$post_sidebar_check = false;
							
							// post layout class
							$post_layout_col_class = "col-xlarge-12 col-medium-12";
						
						}
						
						// check post full width
						if(get_field('post_type_width') == "full-width"){
						
							// set full width
							$post_full_width = true;
						
						}
						
						// check hidden post title section
						if(get_field('post_hide_title') == ""){
						
							// check title position above
							if(get_field('post_title_position') == "above"){
							
								// set title position above
								$post_title_position = "above";
							
							}
							
							// check title alignment
							if(get_field('post_title_alignment') != "left"){
							
								// set title position above
								$post_title_alignment = get_field('post_title_alignment');
							
							}
							
							// check post title category hidden
							if(get_field('post_hide_title_category') != ""){
							
								// set post title author false
								$post_title_category = false;
							
							}
							
							// check post title author hidden
							if(get_field('post_hide_title_author') != ""){
							
								// set post title author false
								$post_title_author = false;
							
							}
							
							// check post title date hidden
							if(get_field('post_hide_title_date') != ""){
							
								// set post title date false
								$post_title_date = false;
							
							}
							
						}  else {
						
							// set post title false
							$post_title_section = false;
						
						}

					}
				
				} else {
				
					// get override layout width
					$post_override_sidebar = get_theme_mod('grace_post_override_sidebar');
					
					// check sidebar wanted
					if($post_override_sidebar != "no-sidebar"){
					
						// set sidebar position
						$post_sidebar_position = $post_override_sidebar;
					
						// post layout class
						$blog_col_class = "col-xlarge-8 col-medium-8";
					
					} else {
					
						// set sidebar to false
						$post_sidebar_check = false;
						
						// post layout class
						$post_layout_col_class = "col-xlarge-12 col-medium-12";
					
					}

					// check full width override
					if(get_theme_mod('grace_post_override_layout_width') == "full-width"){
					
						// set full width
						$post_full_width = true;
						
					}
					
					// check hidden post title section
					if(get_theme_mod('grace_post_title_override') == ""){
						
						// check title position override
						if(get_theme_mod('grace_post_title_position') == "above"){
						
							// set title position above
							$post_title_position = "above";
							
						}
						
						// check title alignment above
						if(get_theme_mod('grace_post_title_alignment') != "left"){
						
							// set title position above
							$post_title_alignment = get_theme_mod('grace_post_title_alignment');
						
						}
						
						// check title category override
						if(get_theme_mod('grace_post_title_category_override') != ""){
						
							// set post title author false
							$post_title_category = false;
						
						}
						
						// check title author override
						if(get_theme_mod('grace_post_title_author_override') != ""){
						
							// set post title author false
							$post_title_author = false;
						
						}
						
						// check title date override
						if(get_theme_mod('grace_post_title_date_override') != ""){
						
							// set post title date false
							$post_title_date = false;
						
						}
					
					} else {
					
						// set post title false
						$post_title_section = false;
					
					}
				
				}
			
			
				/*
				* Single post title output
				*/
			
				function grace_single_post_title(){
					
					// access default variables
					global $post_title_alignment, $post_title_category, $post_title_author, $post_title_date;
					
					// define title output variable
					$post_title_output = "";
					
					$post_title_output .= '<div class="single-post-title single-post-title-'. $post_title_alignment .' clearfix">';
					
						// post title category
						if($post_title_category == true){
					
							$post_categories = get_the_category();
						
							$post_title_output .= '<ul class="post-categories clearfix">';
								foreach($post_categories as $post_category){
									$post_title_output .= '<li class="blog-item-cat font-opensans-reg"><a href="'. get_term_link($post_category->term_id) .'">'. $post_category->name .'</a></li>';
								}
							$post_title_output .= '</ul>';
						
						}
						
						// post title
						$post_title_output .= '<h1 class="font-montserrat-reg">'. get_the_title() .'</h1>';
					
						$post_title_output .= '<div class="single-post-top-meta font-opensans-reg clearfix">';
						
						// check hidden title date
						if($post_title_date == true){
						
							$post_title_output .= '<span>'. get_the_date(get_option('date_format')) .'</span>';
						
						}
						
						// check hidden title author
						if($post_title_author == true){
						
							$post_title_output .= '<span>'. get_the_author() .'</span>';
						
						}
	
						$post_title_output .= '</div>';
					
					$post_title_output .= '</div>';
					
					// output post title variable
					return $post_title_output;

				}

			?>

			<?php 
				
				// check post type full width true				
				if($post_full_width == true){
				
					// title position above
					if($post_title_section == true && $post_title_position == "above"){
						echo grace_single_post_title();
					}
				
					// output post type
					get_template_part('partials/post-type-content');

				}
				
			?>
			
			<div class="row">
			
				<div class="<?php echo esc_attr($post_layout_col_class); ?> <?php if($post_sidebar_check == true && $post_sidebar_position == "left"){ echo "xlarge-pull-right medium-pull-right"; } ?>">

					<!-- blog post main content -->
					<article id="post-<?php the_ID(); ?>" <?php post_class("blog-post-content"); ?>>
						
						<?php 
							
							// check post type full width false
							if($post_full_width == false){
							
								// title position above
								if($post_title_section == true && $post_title_position == "above"){
									echo grace_single_post_title();
								}
							
								// output post type
								get_template_part('partials/post-type-content');
								
								// title position below
								if($post_title_section == true && $post_title_position == "below"){
									echo grace_single_post_title();
								}
							
							}
							
							if($post_full_width == true && $post_title_position == "below"){
								echo grace_single_post_title();
							}
							
						?>
						
						<!-- blog post text content -->
						<div class="page-content clearfix">
							<?php the_content(); ?>
						</div>

						<?php get_template_part('partials/post-pagination'); ?>
						
						<?php get_template_part('partials/post-meta-bottom'); ?>

					</article>
					
					<?php get_template_part('partials/post-newsletter'); ?>
					
					<?php get_template_part('partials/post-author'); ?>
					
					<?php get_template_part('partials/post-related-posts'); ?>

					<?php get_template_part('partials/post-comments'); ?>
					
					<?php get_template_part('partials/post-navigation'); ?>
					
				</div>
				
				<?php if($post_sidebar_check == true) { ?>
					<!-- sidebar -->
					<div class="col-xlarge-4 col-medium-4 post-sidebar <?php echo esc_attr($post_sidebar_position); ?>-sidebar">
						<?php get_sidebar(); ?>
					</div>
				<?php } ?>
			
			</div>
			
		</div>
	</section>

</div>

<?php get_footer(); ?>