<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>"/>
		<!-- responsive meta tag -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
		<?php wp_head(); ?>
	</head>

	<body <?php body_class(); ?>>
	
		<?php

			// define fixed header class
			$fixed_header_class = "";
		
			// check for fixed header
			$header_fixed_check = get_theme_mod('grace_header_fixed', false); 
			
			// fixed header wanted
			if($header_fixed_check != ""){
			
				$fixed_header_class = "fixed-header";
				
			}
			
		?>
		
		<header id="site-header" class="<?php echo esc_attr($fixed_header_class); ?> <?php if(get_theme_mod('grace_show_header_top', true) == ""){ ?>partial-header<?php } ?>">
			
			<div id="site-header-inner">

				<!-- header top -->
				<?php if(get_theme_mod('grace_show_header_top', true)!= "" && !is_page_template('templates/versions.php')){ ?>
					<div id="header-top">
						<div class="container clearfix">
						
							<?php if(get_theme_mod('grace_hide_header_top_search') == ""){ ?>
								<form id="header-search" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
									<button type="submit" id="submit-button">
										<i class="fa fa-search"></i>
									</button>
									<input type="text" placeholder="<?php echo esc_html__('Type to Search...', 'grace-minimal-theme'); ?>" class="font-montserrat-reg" name="s" id="s" />
								</form>
							<?php } ?>
							
							<?php if(get_theme_mod('grace_hide_header_top_social') == ""){ ?>
								<ul class="header-social">
									<?php get_template_part('partials/social-icons'); ?>
								</ul>
							<?php } ?>
							
						</div>
					</div>
				<?php } ?>
				
				<?php 
		
					// header style 1
					if(get_theme_mod('grace_header_style') == "style1" ){
			
						get_template_part('partials/header-layout-1');
			
					// header style 2
					} elseif(get_theme_mod('grace_header_style') == "style2" ){
						
						get_template_part('partials/header-layout-2');
						
					// default style 1
					} else {
					
						get_template_part('partials/header-layout-1');
					
					}

				?>
		
			</div>
		</header>