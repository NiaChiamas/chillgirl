<?php

	/* -- Customizer - Theme Options -- */
	function grace_customizer($wp_customize)
	{
		require(get_template_directory() . '/includes/customizer.php');
	}
	add_action('customize_register', 'grace_customizer');
	

	// grace customizer css
	function grace_customizer_css(){
	
		// define customizer css variable
		$customizer_css = "";
		
		
		/* -- general css -- */
		
		$boxed_page_background_color = get_theme_mod('boxed_page_background_colour', 'f5f5f5');
		$main_content_background_colour = get_theme_mod('main_content_background_colour', 'ffffff');
		
		$customizer_css .= "
			body.boxed{background-color:{$boxed_page_background_color};}
			#main-content{background-color:{$main_content_background_colour}!important;}
		";
		
		
		/* -- logo customizer css -- */
		
		$logo_position = get_theme_mod('grace_logo_position', 'center');
		$grace_logo_width_style_1 = get_theme_mod('grace_logo_width_style_1', '150');
		$grace_logo_width_style_2 = get_theme_mod('grace_logo_width_style_2', '130');
		$grace_logo_margin_top = get_theme_mod('grace_logo_margin_top', '50');
		$grace_logo_margin_bottom = get_theme_mod('grace_logo_margin_bottom', '50');
		$grace_mobile_logo_width = get_theme_mod('grace_mobile_logo_width', '115');
		
		if($logo_position != "center"){
			$margin_pos = "margin-" . $logo_position . ":0;";
			$customizer_css .= "@media (min-width:991px){ #site-logo{" . $margin_pos . ";} }";
		}

		$customizer_css .= "
			
			@media (min-width:991px){
				#site-logo{padding-top:{$grace_logo_margin_top}px;padding-bottom:{$grace_logo_margin_bottom}px;}
				#site-logo, #site-logo img{max-width:{$grace_logo_width_style_1}px;}
				
				.header-style-2 #site-logo, .header-style-2 #site-logo img{max-width:{$grace_logo_width_style_2}px;}
			}
			
			@media (max-width: 991px) {
				#site-logo, #site-logo img{max-width:{$grace_mobile_logo_width}px!important;}
			}
		";
		
		
		/* -- header customizer css -- */
	
		$header_background_colour = get_theme_mod('header_background_colour', 'ffffff');
		$header_top_colour = get_theme_mod('header_top_colour', 'f5f5f5');
		$header_top_content_colour = get_theme_mod('header_top_content_colour', '757575');
		$header_top_social_hover = get_theme_mod('header_top_social_hover', '111111');
		
		$navigation_background_colour = get_theme_mod('navigation_background_colour', 'ffffff');
		$navigation_border_colour = get_theme_mod('navigation_border_colour', 'eaeaea');

		$navigation_link_colour = get_theme_mod('navigation_link_colour', '757575');
		$navigation_link_hover_colour = get_theme_mod('navigation_link_hover_colour', '111111');
		$navigation_link_drop_background_colour = get_theme_mod('navigation_link_drop_background_colour', 'ffffff');
		$navigation_link_drop_border_colour = get_theme_mod('navigation_link_drop_border_colour', 'f5f5f5');
		$navigation_link_drop_hover_colour = get_theme_mod('navigation_link_drop_hover_colour', 'f5f5f5');
		
		$grace_header_2_nav_margin = get_theme_mod('grace_header_2_nav_margin', '40');
		$grace_header_2_padding_bottom = get_theme_mod('grace_header_2_padding_bottom', '15');
		
		$mobile_burger_icon_colour = get_theme_mod('mobile_burger_icon_colour', '757575');
		$mobile_drop_arrow_colour = get_theme_mod('mobile_drop_arrow_colour', '757575');
		$mobile_header_nav_colour = get_theme_mod('mobile_header_nav_colour', 'ffffff');
		$mobile_header_nav_border_colour = get_theme_mod('mobile_header_nav_border_colour', 'f5f5f5');
	
		$customizer_css .= "
		
			#site-header-inner{background-color:{$header_background_colour}!important;}
			
			#header-top{background-color:{$header_top_colour}!important;}
			#header-search .fa,#header-search input[type=text],#header-search input[type=text]::-webkit-input-placeholder,.header-social li a{color:{$header_top_content_colour};}
			.header-social li a:hover{color:{$header_top_social_hover};}
			
			#header-navigation{background-color:{$navigation_background_colour}!important;}
			#header-navigation #header-nav{border-color:{$navigation_border_colour};}
		
			.menu .menu-item > a,.menu .sub-menu li a,.menu > li:after{color:{$navigation_link_colour}!important;}
			.menu > li > a:hover, .submenu-active, #header-nav .menu-item > a.active,.menu .menu-item > a:hover, .menu .page_item > a:hover{color:{$navigation_link_hover_colour}!important;}
			.menu .sub-menu{background-color:{$navigation_link_drop_background_colour};border-color:{$navigation_link_drop_border_colour};}
			.menu .sub-menu li a:hover{background-color:{$navigation_link_drop_hover_colour};}
		
			.header-style-2 #header-nav{margin-top:{$grace_header_2_nav_margin}px;}
			.header-style-2 .medium-header-container{padding-bottom:{$grace_header_2_padding_bottom}px;}
			
			@media (max-width: 991px) {
				#mobile-nav-icon span{background-color:{$mobile_burger_icon_colour}!important;}
				.menu-item-has-children .sub-drop-icon, .page_item_has_children .sub-drop-icon{color:{$mobile_drop_arrow_colour}!important;}
				
				#header-nav{background-color:{$mobile_header_nav_colour}!important;}
				#header-nav.menu-active,#header-nav .menu-item > a, #header-nav .page_item > a{border-color:{$mobile_header_nav_border_colour}!important;}
			}
		
		";


		/* -- footer customizer css -- */
		
		$footer_social_color = get_theme_mod('footer_social_color', '757575');
		$footer_social_hover_color = get_theme_mod('footer_social_hover_color', '111111');
		$footer_bottom_background_color = get_theme_mod('footer_bottom_background_color', 'eaeaea');
		$footer_copyright_color = get_theme_mod('footer_copyright_color', '757575');
		$scrolltop_background_color = get_theme_mod('scrolltop_background_color', 'C7C7C7');
		$scrolltop_background_color_hover = get_theme_mod('scrolltop_background_color_hover', '111111');
		$scrolltop_icon_color = get_theme_mod('scrolltop_icon_color', 'ffffff');
		$scrolltop_icon_color_hover = get_theme_mod('scrolltop_icon_color_hover', 'ffffff');
		
		$customizer_css .= "
			.footer-social li a{color:{$footer_social_color};}
			.footer-social li a:hover{color:{$footer_social_hover_color};}
			#footer-bottom{background-color:{$footer_bottom_background_color};}
			#footer-copyright{color:{$footer_copyright_color};}
			#scroll-top{background-color:{$scrolltop_background_color};}
			#scroll-top:hover{background-color:{$scrolltop_background_color_hover};}
			#scroll-top span{color:{$scrolltop_icon_color};}
			#scroll-top:hover span{color:{$scrolltop_icon_color_hover};}
		";

		
		/* -- buttons customizer css -- */

		$Primary_button_background = get_theme_mod('Primary_button_background', 'eaeaea');
		$Primary_button_border = get_theme_mod('Primary_button_border', 'eaeaea');
		$Primary_button_color = get_theme_mod('Primary_button_color', '757575');
		$Primary_button_hover_background = get_theme_mod('Primary_button_hover_background', '757575');
		$Primary_button_hover_border = get_theme_mod('Primary_button_hover_border', '757575');
		$Primary_button_hover_color = get_theme_mod('Primary_button_hover_color', 'f5f5f5');
		
		$Newsletter_button_background = get_theme_mod('Newsletter_button_background', 'e8e8e8');
		$Newsletter_button_border = get_theme_mod('Newsletter_button_border', 'e8e8e8');
		$Newsletter_button_color = get_theme_mod('Newsletter_button_color', '757575');
		$Newsletter_button_hover_background = get_theme_mod('Newsletter_button_hover_background', '757575');
		$Newsletter_button_hover_border = get_theme_mod('Newsletter_button_hover_border', '757575');
		$Newsletter_button_hover_color = get_theme_mod('Newsletter_button_hover_color', 'f5f5f5');
		
		$Slideshow_button_background = get_theme_mod('Slideshow_button_background', 'e8e8e8');
		$Slideshow_button_border = get_theme_mod('Slideshow_button_border', 'e8e8e8');
		$Slideshow_button_color = get_theme_mod('Slideshow_button_color', '757575');
		$Slideshow_button_hover_background = get_theme_mod('Slideshow_button_hover_background', '757575');
		$Slideshow_button_hover_border = get_theme_mod('Slideshow_button_hover_border', '757575');
		$Slideshow_button_hover_color = get_theme_mod('Slideshow_button_hover_color', 'f5f5f5');
		
		$customizer_css .= "
			.primary-button,.search-widget #searchsubmit, .sidebar-widget input[type=submit], .comment-respond .submit,.sidebar-widget .tagcloud a,.post-password-form input[type=submit]{background-color:{$Primary_button_background};border-color:{$Primary_button_border}!important;color:{$Primary_button_color}!important;}
			.primary-button:hover,.search-widget #searchsubmit:hover, .sidebar-widget input[type=submit]:hover, .comment-respond .submit:hover,.sidebar-widget .tagcloud a:hover,.post-password-form input[type=submit]:hover{background-color:{$Primary_button_hover_background};border-color:{$Primary_button_hover_border}!important;color:{$Primary_button_hover_color}!important;}
			.widget_calendar .calendar_wrap #today,.post-tags a:hover{background-color:{$Primary_button_hover_background};}
		
			.page-newsletter input[type=submit]{background-color:{$Newsletter_button_background}!important;border-color:{$Newsletter_button_border}!important;color:{$Newsletter_button_color}!important;}
			.page-newsletter input[type=submit]:hover{background-color:{$Newsletter_button_hover_background}!important;border-color:{$Newsletter_button_hover_border}!important;color:{$Newsletter_button_hover_color}!important;}
			
			.featured-content-area .primary-button{background-color:{$Slideshow_button_background}!important;border-color:{$Slideshow_button_border}!important;color:{$Slideshow_button_color}!important;}
			.featured-content-area .primary-button:hover{background-color:{$Slideshow_button_hover_background}!important;border-color:{$Slideshow_button_hover_border}!important;color:{$Slideshow_button_hover_color}!important;}
		";
		
		
		/* -- slideshow customizer css -- */

		$featured_section_heading_color = get_theme_mod('featured_section_heading_color', '111111');
		$featured_section_text_color = get_theme_mod('featured_section_text_color', '757575');
		$featured_section_category_color = get_theme_mod('featured_section_category_color', '757575');
	
		$customizer_css .= "
			.featured-content-area h2,.featured-content-area h2 a{color:{$featured_section_heading_color};}
			.featured-content-area p{color:{$featured_section_text_color};}
			.featured-content-area .post-categories li,.featured-content-area .post-categories li a,a.featured-slide .post-categories li{color:{$featured_section_category_color};}
		";
		
		
		/* -- slideshow customizer css -- */

		$slideshow_navigation_color = get_theme_mod('slideshow_navigation_color', '757575');
		$slideshow_dots_color = get_theme_mod('slideshow_dots_color', '757575');
	
		$customizer_css .= "
			.slideshow-btn{color:{$slideshow_navigation_color};}
			.carousel .owl-dot,.carousel .owl-dot.active{background-color:{$slideshow_dots_color};}
		";
		
		
		/* -- widget customizer css -- */
		
		$grace_widget_social_icon_color = get_theme_mod('grace_widget_social_icon_color', '757575');
		$grace_widget_social_icon_hover_color = get_theme_mod('grace_widget_social_icon_hover_color', '111111');

		$customizer_css .= "
			.widget-social-icons li a{color:{$grace_widget_social_icon_color};}
			.widget-social-icons li a:hover{color:{$grace_widget_social_icon_hover_color};}
		";
		
		
		/* -- form input customizer css -- */
		
		$grace_form_input_border_color = get_theme_mod('grace_form_input_border_color', 'e6e6e6');
		$grace_form_input_hover_border_color = get_theme_mod('grace_form_input_hover_border_color', '111111');
		
		$customizer_css .= "
			.input-field, .input-textarea{border-color:{$grace_form_input_border_color};}
			.input-field:focus, .input-textarea:focus, .input-field:hover, .input-textarea:hover{border-color:{$grace_form_input_hover_border_color};}
		";
		
	
		// add customizer css using wp inline style
		wp_add_inline_style('grace_main_style', $customizer_css);
	
	}
	add_action('wp_enqueue_scripts', 'grace_customizer_css');