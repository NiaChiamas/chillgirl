<?php get_header(); ?>

<div id="main-content">
	
	<?php if(get_theme_mod('page_404_header_show') != ""){ ?>

		<?php
		
			$page_header_class = "";
		
			// check for narrow style page header
			if(get_theme_mod('page_404_header_width') == "wide"){
				$page_header_class = "wide-header";
			}
			
			// get height of page header
			if(get_theme_mod('404_page_header_height') != ""){
			
				// height set within customizer
				$page_header_height = get_theme_mod('404_page_header_height');
				
			} else {
			
				// default height of 250
				$page_header_height = 250;
				
			}
			
			// content text color
			$page_header_text_color = get_theme_mod('404_page_header_content_color');
			
			// content background color
			if(get_theme_mod('404_page_header_background') != ""){
				
				// background style class
				$content_background_class = "page-head-inside-background";
				
				// styling to add for background color + opacity
				$content_background_style = 'background-color:rgba(' . grace_hex_convert(get_theme_mod('404_page_header_background_color')) . ',' . get_theme_mod('404_page_header_background_opacity') . ');max-width:'. get_theme_mod('404_page_header_content_max_width') . 'px';

			} else {
			
				// content not wanted but define variables
				$content_background_class = "";
				$content_background_style = "";
				
			}
			
		?>
	
		<section class="page-header <?php echo esc_attr($page_header_class); ?>">
			<div class="container">
			
				<!-- page header inner -->
				<div class="section-inner no-border" style="min-height:<?php echo esc_attr($page_header_height); ?>px;background-image:url('<?php echo esc_url(get_theme_mod('404_image_upload')); ?>');color:<?php echo esc_attr($page_header_text_color); ?>;">
					<div class="page-head-inside <?php echo esc_attr($content_background_class); ?>" style="<?php echo esc_attr($content_background_style); ?>">
						<h1 class="font-montserrat-reg"><?php echo esc_html(get_theme_mod('404_page_image_heading', 'Page not found')); ?></h1>
						<?php if(get_theme_mod('404_page_image_sub_heading') != ""){ ?>
							<p class="font-opensans-reg"><?php echo esc_html(get_theme_mod('404_page_image_sub_heading', '404 Page')); ?></p>
						<?php } ?>
					</div>
				</div>
				
			</div>
		</section>

	<?php } ?>
	
	<section class="not-found-section page-section">
		<div class="container">
		
			<div class="row">
		
				<div class="col-xlarge-1"></div>
		
				<div class="col-xlarge-10">
					<h1 class="font-montserrat-reg page-heading"><?php echo esc_html(get_theme_mod('404_page_heading', '404 - Page not found')); ?></h1>
					<?php if(get_theme_mod('404_page_text') != ""){ ?>
						<div class="page-content">
							<p><?php echo esc_html(get_theme_mod('404_page_text')); ?></p>
						</div>
					<?php } ?>
				</div>
				
				<div class="col-xlarge-1"></div>
			
			</div>
		
		</div>
	</section>

</div>	

<?php get_footer(); ?>