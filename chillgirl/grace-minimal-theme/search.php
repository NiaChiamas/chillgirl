<?php get_header(); ?>

<div id="main-content">
	
	<?php if(get_theme_mod('search_header_show') != ""){ ?>

		<?php
		
			$page_header_class = "";
		
			// check for narrow style page header
			if(get_theme_mod('search_header_width') == "wide"){
				$page_header_class = "wide-header";
			}
			
			// get height of page header
			if(get_theme_mod('search_header_height') != ""){
			
				// height set within customizer
				$page_header_height = get_theme_mod('search_header_height');
				
			} else {
			
				// default height of 250
				$page_header_height = 250;
				
			}
			
			// content text color
			$page_header_text_color = get_theme_mod('search_page_header_content_color');
			
			// content background color
			if(get_theme_mod('search_page_header_background') != ""){
				
				// background style class
				$content_background_class = "page-head-inside-background";
				
				// styling to add for background color + opacity
				$content_background_style = 'background-color:rgba(' . grace_hex_convert(get_theme_mod('search_page_header_background_color')) . ',' . get_theme_mod('search_page_header_background_opacity') . ');max-width:'. get_theme_mod('404_page_header_content_max_width') . 'px';

			} else {
			
				// content not wanted but define variables
				$content_background_class = "";
				$content_background_style = "";
				
			}
			
		?>
	
		<section class="page-header <?php echo esc_attr($page_header_class); ?>">
			<div class="container">
			
				<!-- page header inner -->
				<div class="section-inner no-border" style="min-height:<?php echo esc_attr($page_header_height); ?>px;background-image:url('<?php echo esc_url(get_theme_mod('search_image_upload')); ?>');color:<?php echo esc_attr($page_header_text_color); ?>;">
					<div class="page-head-inside <?php echo esc_attr($content_background_class); ?>" style="<?php echo esc_attr($content_background_style); ?>">
						<h1 class="font-montserrat-reg"><?php echo esc_html($_GET['s']); ?></h1>
						<?php if(get_theme_mod('search_page_header_title') != ""){ ?>
							<p class="font-opensans-reg"><?php echo esc_html(get_theme_mod('search_page_header_title', 'Search results')); ?></p>
						<?php } ?>
					</div>
				</div>
				
			</div>
		</section>

	<?php } ?>
	
	<?php 
		
		// set sidebar check to false
		$sidebar_check = false;
		
		// define side position variable
		$side_position = "";
		
		
		// get sidebar option from customizer
		$page_sidebar = get_theme_mod('search_sidebar_position');
		
		// check sidebar option isn't empty
		if($page_sidebar != ""){
		
			// if sidebar is wanted
			if($page_sidebar != "no-sidebar"){
			
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
			
			$sidebar_check = true;
			$side_position = "right";
			$page_col_class = "col-xlarge-8 col-medium-8";
			
		}
	
	?>
	
	<!-- page content -->
	<div class="page-section">
		<div class="container">
		
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