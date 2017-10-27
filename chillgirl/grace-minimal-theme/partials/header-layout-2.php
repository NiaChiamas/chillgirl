<?php if( ! defined( 'ABSPATH' ) ) exit; // exit if accessed directly ?>

<!-- header middle -->
<div id="header-middle" class="header-style-2">
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
			
			<nav id="header-nav">
				<?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'container' => false, 'menu_id' => 'nav-ul', 'menu_class' => 'menu font-montserrat-reg clearfix') ); ?>
			</nav>

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