<?php

	/* -- Theme Setup -- */
	add_action('after_setup_theme', 'grace_theme_setup');
	function grace_theme_setup() {
	
		load_theme_textdomain('grace-minimal-theme', get_template_directory() . '/languages');
		add_theme_support('automatic-feed-links');
		add_theme_support('post-thumbnails');
		add_theme_support('title-tag');
		add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
		
		register_nav_menus(
			array( 'main-menu' => esc_html__( 'Main Menu', 'grace-minimal-theme' )
			)
		);
		
		if ( !isset( $content_width ) ) $content_width = 1140;
		
		// layout style choice
		if(get_theme_mod('grace_theme_layout') == "boxed"){ 
		
			add_filter('body_class', function($classes) {
				return array_merge($classes, array('boxed'));
			});
		
		}
		
	}
	
	
	/* -- Function to get url for theme fonts -- */
	function grace_fonts_url() {
		$font_url = '';
		
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		 */
		if ( 'off' !== _x( 'on', 'Google font: on or off', 'grace-minimal-theme' ) ) {
			$font_url = add_query_arg( 'family', urlencode( 'Montserrat|Open Sans:400,400' ), "//fonts.googleapis.com/css" );
		}
		
		return $font_url;
	}
	
	
	/* -- Enqueue all styles and scripts -- */
	add_action('wp_enqueue_scripts', 'grace_styles_scripts');
	function grace_styles_scripts() {
	
		// Enqueue Theme Style sheet
		wp_enqueue_style('grace_main_style', get_template_directory_uri() .'/assets/css/style.min.css','','1.0.4','all');
		
		// Enqueue Theme JavScript
		wp_enqueue_script('grace_main_js', get_template_directory_uri() .'/assets/js/main.min.js', array( 'jquery' ), '1.0', true);
			
		// Enqueue Theme Fonts
		wp_enqueue_style('grace-fonts', grace_fonts_url(), array(), '1.0');
		
		// Enqueue Comment Reply JS
		if(is_singular() && get_option('thread_comments')){
			wp_enqueue_script( 'comment-reply' ); 
		}

	}
	
	
	/* -- require custom theme widgets -- */
	require(get_template_directory() . '/includes/widgets/latest-posts.php');
	require(get_template_directory() . '/includes/widgets/about-widget.php');
	require(get_template_directory() . '/includes/widgets/instagram-widget.php');
	require(get_template_directory() . '/includes/widgets/banner-widget.php');
	require(get_template_directory() . '/includes/widgets/promo-widget.php');
	require(get_template_directory() . '/includes/widgets/social-widget.php');
	
	
	/* -- Register all sidebars -- */
	function grace_sidebars_init() {

		// Register default sidebar
		register_sidebar( array(
			'name'          => esc_html__( 'Default Sidebar', 'grace-minimal-theme' ),
			'description'   => 'Sidebar to be used by default on all pages, unless another is selected.',
			'id'            => 'default_sidebar',
			'before_widget' => '<div class="sidebar-widget font-opensans-reg %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="font-montserrat-reg">',
			'after_title'   => '</h3>',
		));
	
		// Number of sidebars in the theme
		$sidebar_count = 10;
		$sidebars = array();
		
		for($i=1;$i<=$sidebar_count;$i++)
		{
			$array_data = array( 
				'name' => "Sidebar " . $i, 'id' => "sidebar_" . $i, 'number' => $i,
			);
			
			$sidebars[] = $array_data;
		}
		
		// Registering all the sidebars to the theme
		foreach($sidebars as $sidebar) {
		
			register_sidebar( array(
				'name'          => $sidebar['name'],
				'description'   => 'Custom sidebar number ' . $sidebar['number'],
				'id'            => $sidebar['id'],
				'before_widget' => '<div class="sidebar-widget font-opensans-reg %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="font-montserrat-reg">',
				'after_title'   => '</h3>',
			));
			
		}
		
	}
	add_action( 'widgets_init', 'grace_sidebars_init' );
	
	
	/* -- Trim excerpt -- */
	function grace_trim_excerpt($blog_excerpt, $limit) {
		return wp_trim_words($blog_excerpt, $limit);
	}
	
	/* -- modify excerpt max length -- */
	function custom_excerpt_length($length){ 
		return 999; 
	}
	add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
	

	/* -- Comments - Post Comment Callback -- */
	if(!function_exists('grace_theme_comment')){
	
		function grace_theme_comment($comment, $args, $depth) {
			$GLOBALS['comment'] = $comment;
			extract($args, EXTR_SKIP);

			if ( 'div' == $args['style'] ) {
				$tag = 'div';
				$add_below = 'comment';
			} else {
				$tag = 'li';
				$add_below = 'div-comment';
			}
			?>
			
			<<?php echo wp_kses($tag, array( 'div' => array(), 'li' => array(), )); ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
			
			<?php if ( 'div' != $args['style'] ) : ?>
				<div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
			<?php endif; ?>
			
				<div class="comment-main-content">

					<div class="comment-main-left">
						<div class="comment-author-image">
							<?php echo get_avatar( get_comment_author_email( comment_ID() ) ); ?>
						</div>
					</div>
					
					<div class="comment-main-right">
			
						<?php $comment_author_url = get_comment_author_url(); ?>
				
						<?php if($comment_author_url != ""){ ?>
							<a href="<?php echo esc_url($comment_author_url); ?>" class="comment-author-link" target="_blank">
						<?php } ?>
							<p class="font-montserrat-reg comment-author-name"><?php comment_author(); ?></p>
						<?php if($comment_author_url != ""){ ?>
							</a>
						<?php } ?>

						<p class="font-opensans-reg comment-date"><?php echo get_comment_date(get_option('date_format')); ?> at <?php echo get_comment_time(get_option('time_format')); ?></p>

						<?php if($comment->comment_approved == '0') : ?>
							<p class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.','grace-minimal-theme' ); ?></p>
						<?php endif; ?>
						<div class="beyond_comment_body page-content">
							<?php comment_text(); ?>
						</div>
						
						<div class="reply">
							<?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div>
					
					</div>
					
				</div>
				
			<?php if ( 'div' != $args['style'] ) : ?>
				</div>
			<?php endif; ?>
		<?php
		}
		
		
		// move comment area below other fields
		function grace_comment_area_bottom( $fields ) {

			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;
			return $fields;

		}
		add_filter( 'comment_form_fields', 'grace_comment_area_bottom' );
		
	}
	
	
	// blog posts page pagination
	function grace_custom_post_pagination(){
	
		global $wp_query;
	
		$big = 999999999;
		
		$pagination_args = array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'total' => $wp_query->max_num_pages,
            'current' => max( 1, get_query_var('paged') ),
            'show_all' => False,
            'end_size' => 1,
            'prev_next' => True,
            'prev_text' => '<span id="post-nav-prev" class="post-nav-item font-montserrat-reg"><i class="fa fa-angle-left"></i>'. esc_html(get_theme_mod('grace_posts_navigation_previous', 'Newer')) . '</span>',
            'next_text' => '<span id="post-nav-next" class="post-nav-item font-montserrat-reg">'. esc_html(get_theme_mod('grace_posts_navigation_next', 'Older')) . '<i class="fa fa-angle-right"></i></span>',
            'type' => 'plain',
            'add_args' => false,
            'add_fragment' => '',
        );
		
		$paginate_links = paginate_links($pagination_args);
		
		if ($paginate_links) {
		
			echo '<section class="post-navigation">';
				echo '<div id="post-nav-main" class="clearfix">' . $paginate_links . '</div>';
			echo '</section>';
		
		}
		
	}

	
	// Sanitize check box function
	function grace_sanitize_checkbox( $checked ) {
	  // Boolean check
	  return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}
	
	
	// Sanitize radio button function
	function grace_sanitize_radio( $input, $setting ){
	 
		//input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
		$input = sanitize_key($input);

		//get the list of possible radio box options 
		$choices = $setting->manager->get_control( $setting->id )->choices;
						 
		//return input if valid or return default option
		return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
		 
	}
	
	
	// Sanitize copyright function
	function grace_sanitize_copyright($input){
		return $input;
	}
	
	
	// convert hex to rgb for opacity options
	function grace_hex_convert($hex){
		list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
		return "$r,$g,$b";
	}
	
	
	function grace_acf_update($value){
		if(isset($value) && is_object($value)){
			unset($value->response['advanced-custom-fields-pro/acf.php']);
		}
		return $value;
	}
	add_filter( 'site_transient_update_plugins', 'grace_acf_update' );