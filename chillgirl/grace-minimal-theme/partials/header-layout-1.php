<?php if( ! defined( 'ABSPATH' ) ) exit; // exit if accessed directly ?>

<?php

	// define navigation fixed class
	$navigation_fixed_class = "";

	// check for fixed header
	$header_fixed_check = get_theme_mod('grace_header_fixed', false); 
	
	// fixed header not wanted
	if($header_fixed_check == ""){

		// check for fixed navigation bar
		$navigation_fixed_check = get_theme_mod('grace_navigation_fixed', true); 
		
		// fixed navigation bar wanted
		if($navigation_fixed_check != ""){
			$navigation_fixed_class = "nav-fixed";
		}
		
	}

?>

<!-- header middle -->
<div id="header-middle">
	<div class="container">
	
		<div class="medium-header-container clearfix">
		
			<?php 
				// check if logo has been uploaded
				if(get_theme_mod('grace_logo_upload') != ""){
					$site_logo = get_theme_mod('grace_logo_upload');
				// else use theme default
				} else {
					$site_logo = get_template_directory_uri() . '/assets/img/grace_logo.png';
				}
			?>
			
			<!-- Site logo -->
			<a href="<?php echo esc_url(home_url('/')); ?>" id="site-logo">
				<img src="<?php echo esc_url($site_logo); ?>" alt="Site Logo">
			</a>

			<!-- Mobile burger icon -->
			<div id="mobile-nav-button">
				<div id="mobile-nav-icon">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
			
		</div>

	</div>
</div>

<!-- header navigation -->
<div id="header-navigation" class="<?php echo esc_attr($navigation_fixed_class); ?>">
	<div class="container">
		
		<nav id="header-nav">
			<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container' => false, 'menu_id' => 'nav-ul', 'menu_class' => 'menu font-montserrat-reg clearfix') ); ?>
		</nav>
	
	</div>
</div>