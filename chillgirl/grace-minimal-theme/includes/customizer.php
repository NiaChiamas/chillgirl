<?php

/* ----- THEME OPTIONS PANEL ----- */

	$wp_customize->add_panel( 'option_panel', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => 'Theme Options',
		'description'    => 'Edit options for this theme',
	));

	
	
/* ----- LAYOUT SECTION ----- */

	/* --- Section header --- */
	$wp_customize->add_section( 'option_layout_section' , array(
		'title'      => esc_html__( 'Layout', 'grace-minimal-theme' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'description'    => '',
		'panel'  => 'option_panel',
	));
	
	/* -- Blog post layout width -- */
	$wp_customize->add_setting(
		'grace_theme_layout',
		array(
			'default' => 'full',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	 
	$wp_customize->add_control(
		'grace_theme_layout',
		array(
			'type' => 'select',
			'label' => esc_html__('Layout style', 'grace-minimal-theme'),
			'description' => 'Choose the style of layout you want, boxed or full width.',
			'section' => 'option_layout_section',
			'choices' => array(
				'full' => 'Full Width',
				'boxed' => 'Boxed',
			),
		)
	);

	
	
/* ----- HEADER SECTION ----- */

	/* --- Section header --- */
	$wp_customize->add_section( 'option_header_section' , array(
		'title'      => esc_html__( 'Header', 'grace-minimal-theme' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'description'    => '',
		'panel'  => 'option_panel',
	));
	
	
	/* -- header layout options -- */
	
		/* -- Header style -- */
		$wp_customize->add_setting(
			'grace_header_style',
			array(
				'default' => 'style1',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'grace_sanitize_radio'
			)
		);
		 
		$wp_customize->add_control(
			'grace_header_style',
			array(
				'type' => 'radio',
				'label' => esc_html__('Header Style', 'grace-minimal-theme'),
				'section' => 'option_header_section',
				'description' => 'Select the style of header to use.',
				'choices' => array(
					'style1' => 'Style One',
					'style2' => 'Style Two',
				),
			)
		);
	
		/* -- Fixed header -- */
		$wp_customize->add_setting(
			'grace_header_fixed',
			array(
				'default' => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'grace_sanitize_checkbox'
			)
		);
		
		$wp_customize->add_control(
			'grace_header_fixed',
			array(
				'label' => esc_html__('Fixed header', 'grace-minimal-theme'),
				'type' => 'checkbox',
				'section' => 'option_header_section',
				'settings' => 'grace_header_fixed',
				'description' => 'Tick if you want the whole header to be fixed on scroll',
			)
			
		);
		
		/* -- Fixed navigation bar -- */
		$wp_customize->add_setting(
			'grace_navigation_fixed',
			array(
				'default' => 'true',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'grace_sanitize_checkbox'
			)
		);
		
		$wp_customize->add_control(
			'grace_navigation_fixed',
			array(
				'label' => esc_html__('Fixed navigation bar', 'grace-minimal-theme'),
				'type' => 'checkbox',
				'section' => 'option_header_section',
				'settings' => 'grace_navigation_fixed',
				'description' => 'Tick if you want just the navigation bar to be fixed when you scroll past it. Only applies if using header style 1.',
			)
			
		);
		
		/* -- Show header top -- */
		$wp_customize->add_setting(
			'grace_show_header_top',
			array(
				'default' => 'true',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'grace_sanitize_checkbox'
			)
		);
		
		$wp_customize->add_control(
			'grace_show_header_top',
			array(
				'label' => esc_html__('Header top bar', 'grace-minimal-theme'),
				'type' => 'checkbox',
				'section' => 'option_header_section',
				'settings' => 'grace_show_header_top',
				'description' => 'Tick if you want to show the top bar section of the header with the search and social icons.',
			)
			
		);
		
		/* -- Hide header top social icons -- */
		$wp_customize->add_setting(
			'grace_hide_header_top_social',
			array(
				'default' => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'grace_sanitize_checkbox'
			)
		);
		
		$wp_customize->add_control(
			'grace_hide_header_top_social',
			array(
				'label' => esc_html__('Hide Header Top Social Icons', 'grace-minimal-theme'),
				'type' => 'checkbox',
				'section' => 'option_header_section',
				'settings' => 'grace_hide_header_top_social',
				'description' => 'Tick if you want to hide the social icons in the header top section.',
			)
			
		);
		
		/* -- Hide header top search -- */
		$wp_customize->add_setting(
			'grace_hide_header_top_search',
			array(
				'default' => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'grace_sanitize_checkbox'
			)
		);
		
		$wp_customize->add_control(
			'grace_hide_header_top_search',
			array(
				'label' => esc_html__('Hide Header Top Search Form', 'grace-minimal-theme'),
				'type' => 'checkbox',
				'section' => 'option_header_section',
				'settings' => 'grace_hide_header_top_search',
				'description' => 'Tick if you want to hide the search form in the header top section.',
			)
			
		);
	
	
	/* --- Site logo --- */
	
		/* -- Upload logo -- */
		$wp_customize->add_setting(
			'grace_logo_upload',
			array(
				'default' => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,
			'grace_logo_upload',
				array(
					'label' => esc_html__('Upload a site logo', 'grace-minimal-theme'),
					'section' => 'option_header_section',
					'settings' => 'grace_logo_upload',
				)
			)
		);
		
		/* -- Logo position (left,centre,right) -- */
		$wp_customize->add_setting(
			'grace_logo_position',
			array(
				'default' => 'center',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		 
		$wp_customize->add_control(
			'grace_logo_position',
			array(
				'type' => 'select',
				'label' => esc_html__('Logo position', 'grace-minimal-theme'),
				'section' => 'option_header_section',
				'settings' => 'grace_logo_position',
				'description' => 'Choose which position you would like the logo to appear in. This option only applies to header style 1 and the desktop view.',
				'choices' => array(
					'left' => 'Left',
					'center' => 'Centre',
					'right' => 'Right',
				),
			)
		);
		
		/* -- Logo width - header style 1 -- */
		$wp_customize->add_setting(
			'grace_logo_width_style_1',
			array(
				'default' => '150',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'absint'
			)
		);
		
		$wp_customize->add_control(
			'grace_logo_width_style_1',
			array(
				'type' => 'number',
				'label' => esc_html__('Logo width - style one', 'grace-minimal-theme'),
				'section' => 'option_header_section',
				'settings' => 'grace_logo_width_style_1',
				'description' => 'Width of desktop logo. Height will scale automatically. Applies to header style one.',
			)
		);
		
		/* -- Logo width - header style 2 -- */
		$wp_customize->add_setting(
			'grace_logo_width_style_2',
			array(
				'default' => '130',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'absint'
			)
		);
		
		$wp_customize->add_control(
			'grace_logo_width_style_2',
			array(
				'type' => 'number',
				'label' => esc_html__('Logo width - style two', 'grace-minimal-theme'),
				'section' => 'option_header_section',
				'settings' => 'grace_logo_width_style_2',
				'description' => 'Width of desktop logo. Height will scale automatically. Applies to header style two.',
			)
		);
		
		/* -- Logo margin top -- */
		$wp_customize->add_setting(
			'grace_logo_margin_top',
			array(
				'default' => '50',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'absint'
			)
		);
		
		$wp_customize->add_control(
			'grace_logo_margin_top',
			array(
				'type' => 'number',
				'label' => esc_html__('Logo margin top (pixels)', 'grace-minimal-theme'),
				'section' => 'option_header_section',
				'settings' => 'grace_logo_margin_top',
				'description' => 'Amount of margin from the top the logo is',
			)
		);
		
		/* -- Logo margin bottom -- */
		$wp_customize->add_setting(
			'grace_logo_margin_bottom',
			array(
				'default' => '50',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'absint'
			)
		);
		
		$wp_customize->add_control(
			'grace_logo_margin_bottom',
			array(
				'type' => 'number',
				'label' => esc_html__('Logo margin bottom (pixels)', 'grace-minimal-theme'),
				'section' => 'option_header_section',
				'settings' => 'grace_logo_margin_bottom',
				'description' => 'Amount of margin the logo has on the bottom',
			)
		);
		
		/* -- Mobile logo width -- */
		$wp_customize->add_setting(
			'grace_mobile_logo_width',
			array(
				'default' => '115',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'absint'
			)
		);
		
		$wp_customize->add_control(
			'grace_mobile_logo_width',
			array(
				'type' => 'number',
				'label' => esc_html__('Mobile logo width (pixels)', 'grace-minimal-theme'),
				'section' => 'option_header_section',
				'settings' => 'grace_mobile_logo_width',
				'description' => 'Width of mobile/tablet logo. Height will adjust automatically',
			)
		);
		
		/* -- Header style 2 nav margin top -- */
		$wp_customize->add_setting(
			'grace_header_2_nav_margin',
			array(
				'default' => '40',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'absint'
			)
		);
		
		$wp_customize->add_control(
			'grace_header_2_nav_margin',
			array(
				'type' => 'number',
				'label' => esc_html__('Header 2 nav margin top (pixels)', 'grace-minimal-theme'),
				'section' => 'option_header_section',
				'settings' => 'grace_header_2_nav_margin',
				'description' => 'Amount of margin above the header right nav section . Only applies if using header style 2.',
			)
		);
		
		/* -- Header style 2 bottom padding -- */
		$wp_customize->add_setting(
			'grace_header_2_padding_bottom',
			array(
				'default' => '15',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'absint'
			)
		);
		
		$wp_customize->add_control(
			'grace_header_2_padding_bottom',
			array(
				'type' => 'number',
				'label' => esc_html__('Header 2 bottom padding (pixels)', 'grace-minimal-theme'),
				'section' => 'option_header_section',
				'settings' => 'grace_header_2_padding_bottom',
				'description' => 'Amount of padding on the bottom of the header section. Only applies if using header style 2.',
			)
		);
		


/* ----- FOOTER SECTION ----- */

	/* --- Section header --- */
	$wp_customize->add_section( 'option_footer_section' , array(
		'title'      => esc_html__( 'Footer', 'grace-minimal-theme' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'description'    => '',
		'panel'  => 'option_panel',
	));

	/* -- Instagram feed -- */
	$wp_customize->add_setting(
		'grace_footer_instagram',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'grace_footer_instagram',
		array(
			'type' => 'text',
			'label' => esc_html__('Footer Instagram Feed', 'grace-minimal-theme'),
			'section' => 'option_footer_section',
			'settings' => 'grace_footer_instagram',
			'description'    => 'Enter a shortcode for the Instagram feed if you wish to display it. Leave blank if you do not want to display the feed.',
		)
	);
	
	/* -- Hide footer social icons -- */
	$wp_customize->add_setting(
		'grace_hide_footer_social',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'grace_hide_footer_social',
		array(
			'label' => esc_html__('Hide Social Icons', 'grace-minimal-theme'),
			'type' => 'checkbox',
			'section' => 'option_footer_section',
			'settings' => 'grace_hide_footer_social',
			'description' => 'Tick if you want to hide the social icons in the footer.',
		)
		
	);
	
	/* -- Hide footer bottom section -- */
	$wp_customize->add_setting(
		'grace_hide_footer_bottom',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'grace_hide_footer_bottom',
		array(
			'label' => esc_html__('Hide Footer Bottom', 'grace-minimal-theme'),
			'type' => 'checkbox',
			'section' => 'option_footer_section',
			'settings' => 'grace_hide_footer_bottom',
			'description' => 'Tick if you want to hide the footer bottom section including the copyright and scroll top button.',
		)
		
	);
	
	/* -- Hide Scroll top button -- */
	$wp_customize->add_setting(
		'grace_hide_scrolltop',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'grace_hide_scrolltop',
		array(
			'label' => esc_html__('Hide Scroll Top Button', 'grace-minimal-theme'),
			'type' => 'checkbox',
			'section' => 'option_footer_section',
			'settings' => 'grace_hide_scrolltop',
			'description' => 'Tick if you want to hide the scroll to the top button.',
		)
		
	);
	
	/* -- Rounded Scroll top button -- */
	$wp_customize->add_setting(
		'grace_rounded_scrolltop',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'grace_rounded_scrolltop',
		array(
			'label' => esc_html__('Rounded Scroll Top Button', 'grace-minimal-theme'),
			'type' => 'checkbox',
			'section' => 'option_footer_section',
			'settings' => 'grace_rounded_scrolltop',
			'description' => 'Tick if you want to the scroll to button to be rounded.',
		)
		
	);

	/* -- Copyright text -- */
	$wp_customize->add_setting(
		'grace_footer_text',
		array(
			'default' => '© 2017 Lucid Themes',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_copyright'
		)
	);

	$wp_customize->add_control(
		'grace_footer_text',
		array(
			'type' => 'textarea',
			'label' => esc_html__('Footer Copyright Text', 'grace-minimal-theme'),
			'section' => 'option_footer_section',
			'settings' => 'grace_footer_text',
		)
	);	
	
	
	
/* -- COLOURS STYLING SECTION -- */

	/* --- Section header --- */
	$wp_customize->add_section( 'colour_styling_section' , array(
		'title'      => esc_html__( 'Colors', 'grace-minimal-theme' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'description'    => '',
		'panel'  => 'option_panel',
	));

	
	
	/* -- Boxed page background colour -- */
	$wp_customize->add_setting(
		'boxed_page_background_colour',
		array(
			'default' => '#f5f5f5',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'boxed_page_background_colour',
			array(
				'label'      => esc_html__( 'Boxed page Background', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'boxed_page_background_colour',
				'description'    => 'Change the background color of pages when using the boxed layout.',
			)
		)
	);
	
	/* -- Main content background colour -- */
	$wp_customize->add_setting(
		'main_content_background_colour',
		array(
			'default' => '#ffffff',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'main_content_background_colour',
			array(
				'label'      => esc_html__( 'Main content Background', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'main_content_background_colour',
				'description'    => 'Change the background color of the main content section of pages. Also used for background color when not using boxed layout.',
			)
		)
	);
	
	/* -- Header background colour -- */
	$wp_customize->add_setting(
		'header_background_colour',
		array(
			'default' => '#ffffff',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'header_background_colour',
			array(
				'label'      => esc_html__( 'Header Background', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'header_background_colour',
				'description'    => 'Change the background color of the header.',
			)
		)
	);
	
	/* -- Header top bar colour -- */
	$wp_customize->add_setting(
		'header_top_colour',
		array(
			'default' => '#f5f5f5',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'header_top_colour',
			array(
				'label'      => esc_html__( 'Header Top', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'header_top_colour',
				'description'    => 'Change the background color of the top bar of the header.',
			)
		)
	);
	
	/* -- Header top content colour -- */
	$wp_customize->add_setting(
		'header_top_content_colour',
		array(
			'default' => '#757575',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'header_top_content_colour',
			array(
				'label'      => esc_html__( 'Header Top Content Color', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'header_top_content_colour',
				'description'    => 'Change the text color of the content within header top.',
			)
		)
	);
	
	/* -- Header top social hover colour -- */
	$wp_customize->add_setting(
		'header_top_social_hover',
		array(
			'default' => '#111111',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'header_top_social_hover',
			array(
				'label'      => esc_html__( 'Header Social Icons Hover', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'header_top_social_hover',
				'description'    => 'Change the hover color of the social icons within header top.',
			)
		)
	);
	
	/* -- Header navigation background color -- */
	$wp_customize->add_setting(
		'navigation_background_colour',
		array(
			'default' => '#ffffff',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'navigation_background_colour',
			array(
				'label'      => esc_html__( 'Navigation Background', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'navigation_background_colour',
				'description'    => 'Change the background color of the navigation bar',
			)
		)
	);
	
	/* -- Header navigation border -- */
	$wp_customize->add_setting(
		'navigation_border_colour',
		array(
			'default' => '#eaeaea',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'navigation_border_colour',
			array(
				'label'      => esc_html__( 'Navigation Border', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'navigation_border_colour',
				'description'    => 'Change the border color of the navigation bar',
			)
		)
	);
	
	/* -- Header navigation link -- */
	$wp_customize->add_setting(
		'navigation_link_colour',
		array(
			'default' => '#757575',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'navigation_link_colour',
			array(
				'label'      => esc_html__( 'Navigation Links', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'navigation_link_colour',
				'description'    => 'Change the color of the links in the header navigation.',
			)
		)
	);
	
	/* -- Header navigation link hover -- */
	$wp_customize->add_setting(
		'navigation_link_hover_colour',
		array(
			'default' => '#111111',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'navigation_link_hover_colour',
			array(
				'label'      => esc_html__( 'Navigation Link Hover', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'navigation_link_hover_colour',
				'description'    => 'Change the hover color of the links in the header navigation.',
			)
		)
	);
	
	/* -- Header navigation link drop down background -- */
	$wp_customize->add_setting(
		'navigation_link_drop_background_colour',
		array(
			'default' => '#ffffff',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'navigation_link_drop_background_colour',
			array(
				'label'      => esc_html__( 'Navigation Link Sub menu Background', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'navigation_link_drop_background_colour',
				'description'    => 'Change the background color of the sub menu drop down.',
			)
		)
	);
	
	/* -- Header navigation link drop down border -- */
	$wp_customize->add_setting(
		'navigation_link_drop_border_colour',
		array(
			'default' => '#f5f5f5',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'navigation_link_drop_border_colour',
			array(
				'label'      => esc_html__( 'Navigation Link Sub menu Border', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'navigation_link_drop_border_colour',
				'description'    => 'Change the color of the border on the sub menu drop down.',
			)
		)
	);
	
	/* -- Header navigation link drop down hover -- */
	$wp_customize->add_setting(
		'navigation_link_drop_hover_colour',
		array(
			'default' => '#f5f5f5',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'navigation_link_drop_hover_colour',
			array(
				'label'      => esc_html__( 'Navigation Link Sub menu Hover', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'navigation_link_drop_hover_colour',
				'description'    => 'Change the background color of the sub menu drop down on hover.',
			)
		)
	);
	
	/* -- Mobile burger menu icon -- */
	$wp_customize->add_setting(
		'mobile_burger_icon_colour',
		array(
			'default' => '#757575',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'mobile_burger_icon_colour',
			array(
				'label'      => esc_html__( 'Mobile Burger Menu Icon', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'mobile_burger_icon_colour',
				'description'    => 'Change the color of the burger menu icon used on mobile/tablet.',
			)
		)
	);
	
	/* -- Mobile nav drop down arrow color -- */
	$wp_customize->add_setting(
		'mobile_drop_arrow_colour',
		array(
			'default' => '#757575',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'mobile_drop_arrow_colour',
			array(
				'label'      => esc_html__( 'Mobile Sub Menu Arrows', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'mobile_drop_arrow_colour',
				'description'    => 'Change the color of drop down arrows used for sub menus on mobile/tablet.',
			)
		)
	);
	
	/* -- Mobile header nav color -- */
	$wp_customize->add_setting(
		'mobile_header_nav_colour',
		array(
			'default' => '#ffffff',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'mobile_header_nav_colour',
			array(
				'label'      => esc_html__( 'Mobile Header Nav', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'mobile_header_nav_colour',
				'description'    => 'Change the background color of the header nav on mobile/tablet.',
			)
		)
	);
	
	/* -- Mobile header nav border color -- */
	$wp_customize->add_setting(
		'mobile_header_nav_border_colour',
		array(
			'default' => '#e6e6e6',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'mobile_header_nav_border_colour',
			array(
				'label'      => esc_html__( 'Mobile Header Nav Border', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'mobile_header_nav_border_colour',
				'description'    => 'Change the border color of the header nav on mobile/tablet.',
			)
		)
	);
	
	/* -- Footer social item color -- */
	$wp_customize->add_setting(
		'footer_social_color',
		array(
			'default' => '#757575',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'footer_social_color',
			array(
				'label'      => esc_html__( 'Footer Social Icon Color', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'footer_social_color',
				'description'    => 'Change the color of the footer social items.',
			)
		)
	);
	
	/* -- Footer social hover item color -- */
	$wp_customize->add_setting(
		'footer_social_hover_color',
		array(
			'default' => '#111111',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'footer_social_hover_color',
			array(
				'label'      => esc_html__( 'Footer Social Icon Hover Color', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'footer_social_hover_color',
				'description'    => 'Change the hover color of the footer social items.',
			)
		)
	);
	
	/* -- Footer bottom background color -- */
	$wp_customize->add_setting(
		'footer_bottom_background_color',
		array(
			'default' => '#eaeaea',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'footer_bottom_background_color',
			array(
				'label'      => esc_html__( 'Footer Bottom Background', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'footer_bottom_background_color',
				'description'    => 'Change the background color of the footer bottom section.',
			)
		)
	);
	
	/* -- Footer copyright text color -- */
	$wp_customize->add_setting(
		'footer_copyright_color',
		array(
			'default' => '#757575',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'footer_copyright_color',
			array(
				'label'      => esc_html__( 'Footer Copyright Text Color', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'footer_copyright_color',
				'description'    => 'Change the color of the footer copyright text.',
			)
		)
	);
	
	/* -- Scroll top button background -- */
	$wp_customize->add_setting(
		'scrolltop_background_color',
		array(
			'default' => '#C7C7C7',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'scrolltop_background_color',
			array(
				'label'      => esc_html__( 'Scroll Top Button Background', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'scrolltop_background_color',
				'description'    => 'Change the background color of the scroll top button.',
			)
		)
	);
	
	/* -- Scroll top button background hover -- */
	$wp_customize->add_setting(
		'scrolltop_background_color_hover',
		array(
			'default' => '#111111',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'scrolltop_background_color_hover',
			array(
				'label'      => esc_html__( 'Scroll Top Button Background Hover', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'scrolltop_background_color_hover',
				'description'    => 'Change the background color of the scroll top button on hover.',
			)
		)
	);
	
	/* -- Scroll top button icon color -- */
	$wp_customize->add_setting(
		'scrolltop_icon_color',
		array(
			'default' => '#ffffff',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'scrolltop_icon_color',
			array(
				'label'      => esc_html__( 'Scroll Top Button Icon', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'scrolltop_icon_color',
				'description'    => 'Change the color of the icon in the scroll top button.',
			)
		)
	);
	
	/* -- Scroll top button icon color hover -- */
	$wp_customize->add_setting(
		'scrolltop_icon_color_hover',
		array(
			'default' => '#ffffff',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'scrolltop_icon_color_hover',
			array(
				'label'      => esc_html__( 'Scroll Top Button Icon Hover', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'scrolltop_icon_color_hover',
				'description'    => 'Change the color of the icon in the scroll top button on hover.',
			)
		)
	);
	
	/* -- page header background -- */
	$wp_customize->add_setting(
		'page_header_background_color',
		array(
			'default' => '#ffffff',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'page_header_background_color',
			array(
				'label'      => esc_html__( 'Page Header Background', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'page_header_background_color',
				'description'    => 'Change the background color of page headers, if they are shown.',
			)
		)
	);
	
	/* -- Featured section heading color -- */
	$wp_customize->add_setting(
		'featured_section_heading_color',
		array(
			'default' => '#111111',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'featured_section_heading_color',
			array(
				'label'      => esc_html__( 'Featured heading', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'featured_section_heading_color',
				'description'    => 'Change the color of the heading for the featured slide show or banner.',
			)
		)
	);
	
	/* -- Featured section text color -- */
	$wp_customize->add_setting(
		'featured_section_text_color',
		array(
			'default' => '#757575',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'featured_section_text_color',
			array(
				'label'      => esc_html__( 'Featured text content', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'featured_section_text_color',
				'description'    => 'Change the color of the text content for the featured slide show or banner.',
			)
		)
	);
	
	/* -- Featured section category color -- */
	$wp_customize->add_setting(
		'featured_section_category_color',
		array(
			'default' => '#757575',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'featured_section_category_color',
			array(
				'label'      => esc_html__( 'Featured categories', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'featured_section_category_color',
				'description'    => 'Change the color of the categories in the featured slide show or banner.',
			)
		)
	);
	
	/* -- Slideshow navigation color -- */
	$wp_customize->add_setting(
		'slideshow_navigation_color',
		array(
			'default' => '#757575',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'slideshow_navigation_color',
			array(
				'label'      => esc_html__( 'Slideshow Navigation', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'slideshow_navigation_color',
				'description'    => 'Change the color of the next and previous navigation icons in slideshows.',
			)
		)
	);
	
	/* -- Slideshow dots color -- */
	$wp_customize->add_setting(
		'slideshow_dots_color',
		array(
			'default' => '#757575',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'slideshow_dots_color',
			array(
				'label'      => esc_html__( 'Slideshow Dots', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'slideshow_dots_color',
				'description'    => 'Change the color of the dots navigation in slideshows.',
			)
		)
	);
	
	/* -- Widget social icon color -- */
	$wp_customize->add_setting(
		'grace_widget_social_icon_color',
		array(
			'default' => '#757575',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'grace_widget_social_icon_color',
			array(
				'label'      => esc_html__( 'Widget Social Icon Color', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'grace_widget_social_icon_color',
				'description'    => 'Change the color of the social icon in widgets',
			)
		)
	);
	
	/* -- Widget social icon hover color -- */
	$wp_customize->add_setting(
		'grace_widget_social_icon_hover_color',
		array(
			'default' => '#111111',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'grace_widget_social_icon_hover_color',
			array(
				'label'      => esc_html__( 'Widget Social Icon Hover Color', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'grace_widget_social_icon_hover_color',
				'description'    => 'Change the hover color of the social icon in widgets',
			)
		)
	);
	
	/* -- Form input border color -- */
	$wp_customize->add_setting(
		'grace_form_input_border_color',
		array(
			'default' => '#e6e6e6',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'grace_form_input_border_color',
			array(
				'label'      => esc_html__( 'Form input border Color', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'grace_form_input_border_color',
				'description'    => 'Change the border color of form inputs.',
			)
		)
	);
	
	/* -- Form input hover border color -- */
	$wp_customize->add_setting(
		'grace_form_input_hover_border_color',
		array(
			'default' => '#111111',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'grace_form_input_hover_border_color',
			array(
				'label'      => esc_html__( 'Form input hover border Color', 'grace-minimal-theme' ),
				'section'    => 'colour_styling_section',
				'settings'   => 'grace_form_input_hover_border_color',
				'description'    => 'Change the hover border color of form inputs.',
			)
		)
	);
	

	
/* -- BUTTON STYLING SECTION -- */

	/* --- Section header --- */
	$wp_customize->add_section( 'button_styling_section' , array(
		'title'      => esc_html__( 'Buttons', 'grace-minimal-theme' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'description'    => '',
		'panel'  => 'option_panel',
	));
	
	
	$buttons_array = array(
		array( 'name' => 'Primary', 'background' => '#eaeaea', 'border' => '#eaeaea', 'color' => '#757575', 'hover_background' => '#757575', 'hover_border' => '#757575', 'hover_color' => '#f5f5f5'),
		array( 'name' => 'Newsletter', 'background' => '#e8e8e8', 'border' => '#e8e8e8', 'color' => '#757575', 'hover_background' => '#757575', 'hover_border' => '#757575', 'hover_color' => '#f5f5f5'),
		array( 'name' => 'Slideshow', 'background' => '#e8e8e8', 'border' => '#e8e8e8', 'color' => '#757575', 'hover_background' => '#757575', 'hover_border' => '#757575', 'hover_color' => '#f5f5f5'),
	);
	
	foreach($buttons_array as $button){
	
		/* -- Button background color -- */
		$wp_customize->add_setting(
			$button['name'] . '_button_background',
			array(
				'default' => $button['background'],
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color'
			)
		);

		$button_background_label = $button['name'] . ' Button Background';
		
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
			$button['name'] . '_button_background',
				array(
					'label'      => $button_background_label,
					'section'    => 'button_styling_section',
					'settings'   => $button['name'] . '_button_background',
					'description'    => 'Change the background color of the ' . $button['name'] . ' button.',
				)
			)
		);
		
		/* -- Button border color -- */
		$wp_customize->add_setting(
			$button['name'] . '_button_border',
			array(
				'default' => $button['border'],
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color'
			)
		);

		$button_border_label = $button['name'] . ' Button Border';
		
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
			$button['name'] . '_button_border',
				array(
					'label'      => $button_border_label,
					'section'    => 'button_styling_section',
					'settings'   => $button['name'] . '_button_border',
					'description'    => 'Change the border color of the ' . $button['name'] . ' button.',
				)
			)
		);
		
		/* -- Button text color -- */
		$wp_customize->add_setting(
			$button['name'] . '_button_color',
			array(
				'default' => $button['color'],
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color'
			)
		);

		$button_color_label = $button['name'] . ' Button Color';
		
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
			$button['name'] . '_button_color',
				array(
					'label'      => $button_color_label,
					'section'    => 'button_styling_section',
					'settings'   => $button['name'] . '_button_color',
					'description'    => 'Change the text color of the ' . $button['name'] . ' button.',
				)
			)
		);
		
		/* -- Button hover background -- */
		$wp_customize->add_setting(
			$button['name'] . '_button_hover_background',
			array(
				'default' => $button['hover_background'],
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color'
			)
		);

		$button_hover_background_label = $button['name'] . ' Button Hover Background';
		
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
			$button['name'] . '_button_hover_background',
				array(
					'label'      => $button_hover_background_label,
					'section'    => 'button_styling_section',
					'settings'   => $button['name'] . '_button_hover_background',
					'description'    => 'Change the hover background color of the ' . $button['name'] . ' button.',
				)
			)
		);
		
		/* -- Button hover border -- */
		$wp_customize->add_setting(
			$button['name'] . '_button_hover_border',
			array(
				'default' => $button['hover_border'],
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color'
			)
		);

		$button_hover_border_label = $button['name'] . ' Button Hover Border';
		
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
			$button['name'] . '_button_hover_border',
				array(
					'label'      => $button_hover_border_label,
					'section'    => 'button_styling_section',
					'settings'   => $button['name'] . '_button_hover_border',
					'description'    => 'Change the hover border color of the ' . $button['name'] . ' button.',
				)
			)
		);
		
		/* -- Button hover text color -- */
		$wp_customize->add_setting(
			$button['name'] . '_button_hover_color',
			array(
				'default' => $button['hover_color'],
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color'
			)
		);

		$button_hover_color_label = $button['name'] . ' Button Hover Color';
		
		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
			$button['name'] . '_button_hover_color',
				array(
					'label'      => $button_hover_color_label,
					'section'    => 'button_styling_section',
					'settings'   => $button['name'] . '_button_hover_color',
					'description'    => 'Change the hover text color of the ' . $button['name'] . ' button.',
				)
			)
		);
	
	}
	
	/* -- blog post read more button text -- */
	$wp_customize->add_setting(
		'grace_post_read_text',
		array(
			'default' => 'Read more',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'grace_post_read_text',
		array(
			'type' => 'text',
			'label' => esc_html__('Post Read More Text', 'grace-minimal-theme'),
			'section' => 'button_styling_section',
			'settings' => 'grace_post_read_text',
			'description'    => 'Text used for the blog post read more button.'
		)
	);
	
	/* -- blog posts navigation next -- */
	$wp_customize->add_setting(
		'grace_posts_navigation_next',
		array(
			'default' => 'Older',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'grace_posts_navigation_next',
		array(
			'type' => 'text',
			'label' => esc_html__('Posts Navigation Next', 'grace-minimal-theme'),
			'section' => 'button_styling_section',
			'settings' => 'grace_posts_navigation_next',
			'description'    => 'Text used for the blog posts navigation next button.'
		)
	);
	
	/* -- blog posts navigation previous -- */
	$wp_customize->add_setting(
		'grace_posts_navigation_previous',
		array(
			'default' => 'Newer',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'grace_posts_navigation_previous',
		array(
			'type' => 'text',
			'label' => esc_html__('Posts Navigation Previous', 'grace-minimal-theme'),
			'section' => 'button_styling_section',
			'settings' => 'grace_posts_navigation_previous',
			'description'    => 'Text used for the blog posts navigation previous button.'
		)
	);
	
	/* -- single post navigation next -- */
	$wp_customize->add_setting(
		'grace_single_post_next',
		array(
			'default' => 'Next Post',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'grace_single_post_next',
		array(
			'type' => 'text',
			'label' => esc_html__('Single Post Next', 'grace-minimal-theme'),
			'section' => 'button_styling_section',
			'settings' => 'grace_single_post_next',
			'description'    => 'Text used for the single post navigation next button.'
		)
	);
	
	/* -- single post navigation previous -- */
	$wp_customize->add_setting(
		'grace_single_post_previous',
		array(
			'default' => 'Prev Post',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'grace_single_post_previous',
		array(
			'type' => 'text',
			'label' => esc_html__('Single Post Previous', 'grace-minimal-theme'),
			'section' => 'button_styling_section',
			'settings' => 'grace_single_post_previous',
			'description'    => 'Text used for the single post navigation previous button.'
		)
	);
	
	/* -- post/page pagination next -- */
	$wp_customize->add_setting(
		'grace_page_pagination_next',
		array(
			'default' => 'Next Page',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'grace_page_pagination_next',
		array(
			'type' => 'text',
			'label' => esc_html__('Page Pagination Next', 'grace-minimal-theme'),
			'section' => 'button_styling_section',
			'settings' => 'grace_page_pagination_next',
			'description'    => 'Text used for the page pagination next button.'
		)
	);
	
	/* -- post/page pagination previous -- */
	$wp_customize->add_setting(
		'grace_page_pagination_previous',
		array(
			'default' => 'Prev Page',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'grace_page_pagination_previous',
		array(
			'type' => 'text',
			'label' => esc_html__('Page Pagination Previous', 'grace-minimal-theme'),
			'section' => 'button_styling_section',
			'settings' => 'grace_page_pagination_previous',
			'description'    => 'Text used for the page pagination previous button.'
		)
	);
	
	/* -- comment submit button text -- */
	$wp_customize->add_setting(
		'grace_comment_submit_text',
		array(
			'default' => 'Post Comment',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'grace_comment_submit_text',
		array(
			'type' => 'text',
			'label' => esc_html__('Comment Submit Text', 'grace-minimal-theme'),
			'section' => 'button_styling_section',
			'settings' => 'grace_comment_submit_text',
			'description'    => 'Text used for the comment submit button.'
		)
	);
	

	
/* ----- SOCIAL MEDIA SECTION ----- */

	/* --- Section header --- */
	$wp_customize->add_section( 'social_media_section' , array(
		'title'      => esc_html__( 'Social Media', 'grace-minimal-theme' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'description'    => '',
		'panel'  => 'option_panel',
	));
	
	
	/* -- Social icons -- */

	$social_media_array = array('Facebook','Twitter','Instagram','Pinterest','Dribbble','Behance','GooglePlus','LinkedIn','Tumblr','Youtube','Snapchat','StumbleUpon','Etsy','Vimeo','BlogLovin');

	foreach($social_media_array as $social_item){
	
		$wp_customize->add_setting(
			'grace_social_' . $social_item,
			array(
				'default' => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$social_item_label = $social_item . ' link';
		
		$wp_customize->add_control(
			'grace_social_' . $social_item,
			array(
				'type' => 'text',
				'label' => $social_item_label,
				'section' => 'social_media_section',
				'settings' => 'grace_social_' . $social_item,
			)
		);
		
	}



/* ----- POST SHARE ICONS SECTION ----- */

	/* --- Section header --- */
	$wp_customize->add_section( 'post_share_section' , array(
		'title'      => esc_html__( 'Post Share Icons', 'grace-minimal-theme' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'description'    => '',
		'panel'  => 'option_panel',
	));
	
	
	/* -- Post share icons -- */

	$post_share_array = array('Facebook','Twitter','Pinterest','GooglePlus');

	foreach($post_share_array as $share_item){
	
		$wp_customize->add_setting(
			'grace_share_' . $share_item,
			array(
				'default' => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'grace_sanitize_checkbox'
			)
		);

		$hide_share_item_label = 'Hide ' . $share_item . ' share icon';
		
		$wp_customize->add_control(
			'grace_share_' . $share_item,
			array(
				'type' => 'checkbox',
				'label' => $hide_share_item_label,
				'section' => 'post_share_section',
				'settings' => 'grace_share_' . $share_item,
			)
		);
		
	}



/* -- POST OVERRIDE SECTION -- */

	/* --- Section header --- */
	$wp_customize->add_section( 'blog_post_override_section' , array(
		'title'      => esc_html__( 'Post Layout Override', 'grace-minimal-theme' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'description'    => '',
		'panel'  => 'option_panel',
	));
	
	/* -- Post layout override -- */
	$wp_customize->add_setting(
		'grace_post_layout_override',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'grace_post_layout_override',
		array(
			'label' => esc_html__('Post Layout Override', 'grace-minimal-theme'),
			'type' => 'checkbox',
			'section' => 'blog_post_override_section',
			'settings' => 'grace_post_layout_override',
			'description' => 'Tick if you want to override the layout of all blog and recipe posts using the drop downs below.',
		)
		
	);
	
	/* -- Post layout width -- */
	$wp_customize->add_setting(
		'grace_post_override_layout_width',
		array(
			'default' => 'post',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	 
	$wp_customize->add_control(
		'grace_post_override_layout_width',
		array(
			'type' => 'select',
			'label' => esc_html__('Post Layout Width', 'grace-minimal-theme'),
			'description' => 'Only applies if layout override tick box is clicked',
			'section' => 'blog_post_override_section',
			'choices' => array(
				'post-width' => 'Post Width',
				'full-width' => 'Full Width',
			),
		)
	);
	
	/* -- Post layout sidebar override -- */
	$wp_customize->add_setting(
		'grace_post_override_sidebar',
		array(
			'default' => 'right',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	 
	$wp_customize->add_control(
		'grace_post_override_sidebar',
		array(
			'type' => 'select',
			'label' => esc_html__('Post Sidebar Position', 'grace-minimal-theme'),
			'description' => 'Only applies if layout override tick box is clicked',
			'section' => 'blog_post_override_section',
			'choices' => array(
				'right' => 'Right Side',
				'left' => 'Left Side',
				'no-sidebar' => 'No Sidebar',
			),
		)
	);
	
	/* -- Post title position override -- */
	$wp_customize->add_setting(
		'grace_post_title_position',
		array(
			'default' => 'below',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	 
	$wp_customize->add_control(
		'grace_post_title_position',
		array(
			'type' => 'select',
			'label' => esc_html__('Post Title Position', 'grace-minimal-theme'),
			'description' => 'Only applies if layout override tick box is clicked',
			'section' => 'blog_post_override_section',
			'choices' => array(
				'above' => 'Above',
				'below' => 'Below',
			),
		)
	);
	
	/* -- Post title alignment override -- */
	$wp_customize->add_setting(
		'grace_post_title_alignment',
		array(
			'default' => 'left',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	 
	$wp_customize->add_control(
		'grace_post_title_alignment',
		array(
			'type' => 'select',
			'label' => esc_html__('Post Title Alignment', 'grace-minimal-theme'),
			'description' => 'Only applies if layout override tick box is clicked',
			'section' => 'blog_post_override_section',
			'choices' => array(
				'left' => 'Left',
				'center' => 'Center',
				'right' => 'Right',
			),
		)
	);
	
	/* -- Post title override -- */
	$wp_customize->add_setting(
		'grace_post_title_override',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'grace_post_title_override',
		array(
			'label' => esc_html__('Hide Post Title Section', 'grace-minimal-theme'),
			'type' => 'checkbox',
			'section' => 'blog_post_override_section',
			'settings' => 'grace_post_title_override',
			'description' => 'Tick if you would like to hide the title section on every post. This overrides the option set on all posts.',
		)
		
	);
	
	/* -- Post title category override -- */
	$wp_customize->add_setting(
		'grace_post_title_category_override',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'grace_post_title_category_override',
		array(
			'label' => esc_html__('Hide Post Title Category', 'grace-minimal-theme'),
			'type' => 'checkbox',
			'section' => 'blog_post_override_section',
			'settings' => 'grace_post_title_category_override',
			'description' => 'Tick if you would like to hide the category within the title section on every post. This overrides the option set on all posts.',
		)
		
	);
	
	/* -- Post title author override -- */
	$wp_customize->add_setting(
		'grace_post_title_author_override',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'grace_post_title_author_override',
		array(
			'label' => esc_html__('Hide Post Date Author', 'grace-minimal-theme'),
			'type' => 'checkbox',
			'section' => 'blog_post_override_section',
			'settings' => 'grace_post_title_author_override',
			'description' => 'Tick if you would like to hide the author within the title section on every post. This overrides the option set on all posts.',
		)
		
	);
	
	/* -- Post title date override -- */
	$wp_customize->add_setting(
		'grace_post_title_date_override',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'grace_post_title_date_override',
		array(
			'label' => esc_html__('Hide Post Title Date', 'grace-minimal-theme'),
			'type' => 'checkbox',
			'section' => 'blog_post_override_section',
			'settings' => 'grace_post_title_date_override',
			'description' => 'Tick if you would like to hide the date within the title section on every post. This overrides the option set on all posts.',
		)
		
	);
	
	/* -- Post meta override -- */
	$wp_customize->add_setting(
		'grace_post_meta_override',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'grace_post_meta_override',
		array(
			'label' => esc_html__('Hide Post Meta', 'grace-minimal-theme'),
			'type' => 'checkbox',
			'section' => 'blog_post_override_section',
			'settings' => 'grace_post_meta_override',
			'description' => 'Tick if you would like to hide the meta bottom section every post. This overrides the option set on all posts.',
		)
		
	);
	
	/* -- Post tags override -- */
	$wp_customize->add_setting(
		'grace_post_tags_override',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'grace_post_tags_override',
		array(
			'label' => esc_html__('Hide Post Tags', 'grace-minimal-theme'),
			'type' => 'checkbox',
			'section' => 'blog_post_override_section',
			'settings' => 'grace_post_tags_override',
			'description' => 'Tick if you would like to hide the tags on every post. This overrides the option set on all posts.',
		)
		
	);
	
	/* -- Post share override -- */
	$wp_customize->add_setting(
		'grace_post_share_override',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'grace_post_share_override',
		array(
			'label' => esc_html__('Hide Post Share', 'grace-minimal-theme'),
			'type' => 'checkbox',
			'section' => 'blog_post_override_section',
			'settings' => 'grace_post_share_override',
			'description' => 'Tick if you would like to hide the share section on every post. This overrides the option set on all posts.',
		)
		
	);
	
	/* -- Post author override -- */
	$wp_customize->add_setting(
		'grace_post_author_override',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'grace_post_author_override',
		array(
			'label' => esc_html__('Hide Post Author', 'grace-minimal-theme'),
			'type' => 'checkbox',
			'section' => 'blog_post_override_section',
			'settings' => 'grace_post_author_override',
			'description' => 'Tick if you would like to hide the author section on every post. This overrides the option set on all posts.',
		)
		
	);
	
	/* -- Post comments override -- */
	$wp_customize->add_setting(
		'grace_post_comments_override',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'grace_post_comments_override',
		array(
			'label' => esc_html__('Hide Post Comments', 'grace-minimal-theme'),
			'type' => 'checkbox',
			'section' => 'blog_post_override_section',
			'settings' => 'grace_post_comments_override',
			'description' => 'Tick if you would like to hide the comment section on every post. This overrides the option set on all posts.',
		)
		
	);
	
	/* -- Post navigation override -- */
	$wp_customize->add_setting(
		'grace_post_navigation_override',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'grace_post_navigation_override',
		array(
			'label' => esc_html__('Hide Post Navigation', 'grace-minimal-theme'),
			'type' => 'checkbox',
			'section' => 'blog_post_override_section',
			'settings' => 'grace_post_navigation_override',
			'description' => 'Tick if you would like to hide the navigation section on every post. This overrides the option set on all posts.',
		)
		
	);
	

	
/* -- BLOG PAGES SECTION -- */

	$blog_pages_array = array('archive','search');
	
	foreach($blog_pages_array as $blog_page){

		$blog_page_title = ucfirst($blog_page) . ' Page';
	
		/* --- Section header --- */
		$wp_customize->add_section( $blog_page . '_pages_section' , array(
			'title'      => $blog_page_title,
			'priority'       => 10,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'description'    => '',
			'panel'  => 'option_panel',
		));
	
		/* -- Show page header -- */
		$wp_customize->add_setting(
			$blog_page . '_header_show',
			array(
				'default' => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'grace_sanitize_checkbox'
			)
		);
		
		$page_header_show_label = 'Show ' . $blog_page . ' Page Header';
		
		$wp_customize->add_control(
			$blog_page . '_header_show',
			array(
				'label' => $page_header_show_label,
				'type' => 'checkbox',
				'section' => $blog_page . '_pages_section',
				'settings' => $blog_page . '_header_show',
				'description' => 'Tick if you want to show a page header on the ' . $blog_page . ' page.',
			)
			
		);
		
		/* -- Page header width select -- */
		$wp_customize->add_setting(
			$blog_page . '_header_width',
			array(
				'default' => 'narrow',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		
		$page_header_width_label = $blog_page . ' Page Header Width';
		 
		$wp_customize->add_control(
			$blog_page . '_header_width',
			array(
				'type' => 'select',
				'label' => $page_header_width_label,
				'section' => $blog_page . '_pages_section',
				'settings' => $blog_page . '_header_width',
				'description' => 'Choose the width style of page header that you want.',
				'choices' => array(
					'narrow' => esc_html__('Narrow', 'grace-minimal-theme'),
					'wide' => esc_html__('Wide', 'grace-minimal-theme'),
				),
			)
		);
		
		/* -- Page header height -- */
		$wp_customize->add_setting(
			$blog_page . '_header_height',
			array(
				'default' => '200',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'absint'
			)
		);
		
		$page_header_height_label = $blog_page . ' Page Header Height (pixels)';
		
		$wp_customize->add_control(
			$blog_page . '_header_height',
			array(
				'type' => 'number',
				'label' => $page_header_height_label,
				'section' => $blog_page . '_pages_section',
				'settings' => $blog_page . '_header_height',
				'description' => 'Enter a height for the page header.',
			)
		);
	
		/* -- page header image -- */
		$wp_customize->add_setting(
			$blog_page . '_image_upload',
			array(
				'default' => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'esc_url_raw'
			)
		);
		
		$page_header_image_label = $blog_page . ' page header image';
		
		$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,
			$blog_page . '_image_upload',
				array(
					'label' => $page_header_image_label,
					'section' => $blog_page . '_pages_section',
					'settings' => $blog_page . '_image_upload',
				)
			)
		);

		/* -- page header title -- */
		$wp_customize->add_setting(
			$blog_page . '_page_header_title',
			array(
				'default' => $blog_page,
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$page_header_title_label = $blog_page . ' page header title';
		
		$wp_customize->add_control(
			$blog_page . '_page_header_title',
			array(
				'type' => 'text',
				'label' => $page_header_title_label,
				'section' => $blog_page . '_pages_section',
				'settings' => $blog_page . '_page_header_title',
			)
		);
		

		/* -- page header content text color -- */
		$wp_customize->add_setting(
			$blog_page . '_page_header_content_color',
			array(
				'default' => '#111111',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color'
			)
		);

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
			$blog_page . '_page_header_content_color',
				array(
					'label'      => esc_html__( 'Header content text color', 'grace-minimal-theme' ),
					'section'    => $blog_page . '_pages_section',
					'settings'   => $blog_page . '_page_header_content_color',
					'description'    => 'Change the text color of the content area.',
				)
			)
		);

		/* -- page header content background -- */
		$wp_customize->add_setting(
			$blog_page . '_page_header_background',
			array(
				'default' => '',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'grace_sanitize_checkbox'
			)
		);
		
		$wp_customize->add_control(
			$blog_page . '_page_header_background',
			array(
				'label' => esc_html__('Header content background', 'grace-minimal-theme'),
				'type' => 'checkbox',
				'section' => $blog_page . '_pages_section',
				'settings' => $blog_page . '_page_header_background',
				'description' => 'Tick if you want a background color & opacity to your header content.',
			)
			
		);
		
		/* -- page header content background color -- */
		$wp_customize->add_setting(
			$blog_page . '_page_header_background_color',
			array(
				'default' => '#ffffff',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_hex_color'
			)
		);

		$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
			$blog_page . '_page_header_background_color',
				array(
					'label'      => esc_html__( 'Header content background color', 'grace-minimal-theme' ),
					'section'    => $blog_page . '_pages_section',
					'settings'   => $blog_page . '_page_header_background_color',
					'description'    => 'Change the background color of the content area. Only applies if header content background tick box is checked.',
				)
			)
		);
		
		/* -- page header content background opacity -- */
		$wp_customize->add_setting(
			$blog_page . '_page_header_background_opacity',
			array(
				'default' => '0.8',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);
		
		$wp_customize->add_control(
			$blog_page . '_page_header_background_opacity',
			array(
				'type' => 'number',
				'input_attrs' => array(
					'min' => 0,
					'max' => 1,
					'step' => 0.1,
				),
				'label' => esc_html__('Header content background opacity', 'grace-minimal-theme'),
				'section' => $blog_page . '_pages_section',
				'settings' => $blog_page . '_page_header_background_opacity',
				'description' => 'Change the background opacity of the content area. Only applies if header content background tick box is checked.',
			)
		);
		
		/* -- Page header content max width -- */
		$wp_customize->add_setting(
			$blog_page . '_page_header_content_max_width',
			array(
				'default' => '700',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'absint'
			)
		);
		
		$wp_customize->add_control(
			$blog_page . '_page_header_content_max_width',
			array(
				'type' => 'number',
				'label' => esc_html__('Header content max width', 'grace-minimal-theme'),
				'section' => $blog_page . '_pages_section',
				'settings' => $blog_page . '_page_header_content_max_width',
				'description' => 'Change the max width of the content area. Only applies if header content background tick box is checked.',
			)
		);
		
		/* -- Page sidebar option -- */
		$wp_customize->add_setting(
			$blog_page . '_sidebar_position',
			array(
				'default' => 'right',
				'capability' => 'edit_theme_options',
				'sanitize_callback' => 'sanitize_text_field'
			)
		);

		$wp_customize->add_control(
			$blog_page . '_sidebar_position',
			array(
				'type' => 'select',
				'label' => esc_html__('Sidebar Position', 'grace-minimal-theme'),
				'section' => $blog_page . '_pages_section',
				'settings' => $blog_page . '_sidebar_position',
				'description' => 'Choose the position of the sidebar',
				'choices' => array(
					'right' => esc_html__('Right', 'grace-minimal-theme'),
					'left' => esc_html__('Left', 'grace-minimal-theme'),
					'no-sidebar' => esc_html__('No Sidebar', 'grace-minimal-theme'),
				),
			)
		);

	}
	
	

/* -- 404 PAGE SECTION -- */

	/* --- Section header --- */
	$wp_customize->add_section( '404_page_section' , array(
		'title'      => esc_html__( '404 page', 'grace-minimal-theme' ),
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'description'    => '',
		'panel'  => 'option_panel',
	));
	
	/* -- Show 404 page header -- */
	$wp_customize->add_setting(
		'page_404_header_show',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'page_404_header_show',
		array(
			'label' => esc_html__('Show Page Header', 'grace-minimal-theme'),
			'type' => 'checkbox',
			'section' => '404_page_section',
			'settings' => 'page_404_header_show',
			'description' => 'Tick if you want to show a page header on the 404 page.',
		)
		
	);
	
	/* -- Page header width select -- */
	$wp_customize->add_setting(
		'page_404_header_width',
		array(
			'default' => 'narrow',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	 
	$wp_customize->add_control(
		'page_404_header_width',
		array(
			'type' => 'select',
			'label' => esc_html__('Page Header Width', 'grace-minimal-theme'),
			'section' => '404_page_section',
			'settings' => 'page_404_header_width',
			'description' => 'Choose the width style of page header that you want.',
			'choices' => array(
				'narrow' => 'Narrow',
				'wide' => 'Wide',
			),
		)
	);
	
	/* -- Page header height -- */
	$wp_customize->add_setting(
		'404_page_header_height',
		array(
			'default' => '250',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint'
		)
	);
	
	$wp_customize->add_control(
		'404_page_header_height',
		array(
			'type' => 'number',
			'label' => esc_html__('Page Header Height (pixels)', 'grace-minimal-theme'),
			'section' => '404_page_section',
			'settings' => '404_page_header_height',
			'description' => 'Enter a height for the page header.',
		)
	);
	
	/* -- 404 page header image -- */
	$wp_customize->add_setting(
		'404_image_upload',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		)
	);
	
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,
		'404_image_upload',
			array(
				'label' => esc_html__('Header image', 'grace-minimal-theme'),
				'section' => '404_page_section',
				'settings' => '404_image_upload',
			)
		)
	);

	/* -- 404 page header image heading -- */
	$wp_customize->add_setting(
		'404_page_image_heading',
		array(
			'default' => 'Page not found',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'404_page_image_heading',
		array(
			'type' => 'text',
			'label' => esc_html__('Header image heading', 'grace-minimal-theme'),
			'section' => '404_page_section',
			'settings' => '404_page_image_heading',
		)
	);
		
	/* -- 404 page header image sub heading -- */
	$wp_customize->add_setting(
		'404_page_image_sub_heading',
		array(
			'default' => '404 Page',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'404_page_image_sub_heading',
		array(
			'type' => 'text',
			'label' => esc_html__('Header image sub heading', 'grace-minimal-theme'),
			'section' => '404_page_section',
			'settings' => '404_page_image_sub_heading',
		)
	);
	
	/* -- 404 page header content text color -- */
	$wp_customize->add_setting(
		'404_page_header_content_color',
		array(
			'default' => '#111111',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'404_page_header_content_color',
			array(
				'label'      => esc_html__( 'Header content text color', 'grace-minimal-theme' ),
				'section'    => '404_page_section',
				'settings'   => '404_page_header_content_color',
				'description'    => 'Change the text color of the content area.',
			)
		)
	);
	
	/* -- 404 page header content background -- */
	$wp_customize->add_setting(
		'404_page_header_background',
		array(
			'default' => '',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'grace_sanitize_checkbox'
		)
	);
	
	$wp_customize->add_control(
		'404_page_header_background',
		array(
			'label' => esc_html__('Header content background', 'grace-minimal-theme'),
			'type' => 'checkbox',
			'section' => '404_page_section',
			'settings' => '404_page_header_background',
			'description' => 'Tick if you want a background color & opacity to your header content.',
		)
		
	);
	
	/* -- 404 page header content background color -- */
	$wp_customize->add_setting(
		'404_page_header_background_color',
		array(
			'default' => '#ffffff',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_hex_color'
		)
	);

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,
		'404_page_header_background_color',
			array(
				'label'      => esc_html__( 'Header content background color', 'grace-minimal-theme' ),
				'section'    => '404_page_section',
				'settings'   => '404_page_header_background_color',
				'description'    => 'Change the background color of the content area. Only applies if header content background tick box is checked.',
			)
		)
	);
	
	/* -- 404 page header content background opacity -- */
	$wp_customize->add_setting(
		'404_page_header_background_opacity',
		array(
			'default' => '0.8',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(
		'404_page_header_background_opacity',
		array(
			'type' => 'number',
			'input_attrs' => array(
				'min' => 0,
				'max' => 1,
				'step' => 0.1,
			),
			'label' => esc_html__('Header content background opacity', 'grace-minimal-theme'),
			'section' => '404_page_section',
			'settings' => '404_page_header_background_opacity',
			'description' => 'Change the background opacity of the content area. Only applies if header content background tick box is checked.',
		)
	);
	
	/* -- 404 page header content max width -- */
	$wp_customize->add_setting(
		'404_page_header_content_max_width',
		array(
			'default' => '700',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint'
		)
	);
	
	$wp_customize->add_control(
		'404_page_header_content_max_width',
		array(
			'type' => 'number',
			'label' => esc_html__('Header content max width', 'grace-minimal-theme'),
			'section' => '404_page_section',
			'settings' => '404_page_header_content_max_width',
			'description' => 'Change the max width of the content area. Only applies if header content background tick box is checked.',
		)
	);
	
	/* -- 404 page heading -- */
	$wp_customize->add_setting(
		'404_page_heading',
		array(
			'default' => '404 - Page not found',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'404_page_heading',
		array(
			'type' => 'text',
			'label' => esc_html__('Page heading', 'grace-minimal-theme'),
			'section' => '404_page_section',
			'settings' => '404_page_heading',
		)
	);
	
	/* -- 404 page text -- */
	$wp_customize->add_setting(
		'404_page_text',
		array(
			'default' => 'Sorry but we cannot find the page you were looking for.',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'404_page_text',
		array(
			'type' => 'textarea',
			'label' => esc_html__('Page text content', 'grace-minimal-theme'),
			'section' => '404_page_section',
			'settings' => '404_page_text',
		)
	);