<?php 

	if( ! defined( 'ABSPATH' ) ) exit; // exit if accessed directly

	/*
	* Get page ID
	*/
	
	if( isset($home_page_blog) && $home_page_blog == true ) {
	
		// home page id
		$page_id = $home_page_id;
	
	}
	
	
	/* 
	* Slideshow defaults
	*/
	
	// default height
	$slideshow_height = 500;
	
	// default width
	$slideshow_wide = true;
	
	// default content
	$slideshow_content = false;
	
	// default slide centered
	$slideshow_slide_centered = false;
	
	// default mutli slide
	$slideshow_multi_slide = false;
	
	// default data attributes
	$slideshow_data_attrs = "";
	
	// default display class
	$slide_display_class = "";

	// default navigation
	$slideshow_navigation = true;
	
	// default dots
	$slideshow_dots = "";
	
	
	/*
	* Slideshow height
	*/
	
	// get featured height
	$featured_section_height = get_field('featured_section_height', $page_id);
	
	// check height has value set
	if($featured_section_height != ""){
	
		// set banner height
		$slideshow_height = $featured_section_height;
	
	}
	
	
	/*
	* Get slides
	*/
	
	// type of slideshow wanted
	$slideshow_type = get_field('featured_slideshow_type', $page_id);
	
	// custom slideshow
	if($slideshow_type == "custom"){
	
		$slideshow_items = get_field('featured_slideshow', $page_id);
	
	// post category slideshow
	} elseif($slideshow_type == "post" || $slideshow_type == "category"){
		
		// maximum number of slides to show
		$slideshow_category_max = get_field('slideshow_maximum', $page_id);
		
		if($slideshow_category_max == ""){
			$slideshow_category_max = 5;
		}
		
		// category selected
		if($slideshow_type == "category"){
			
			$slideshow_category = get_field('slideshow_category', $page_id);
			
			// get posts arguments
			$featured_args = array(
				'posts_per_page' => $slideshow_category_max,
				'category'    	 => $slideshow_category,
				'post_type'      => 'post',
				'post_status'    => 'publish'
			);
			
		} else {
		
			// get posts arguments
			$featured_args = array(
				'posts_per_page' => $slideshow_category_max,
				'post_type'      => 'post',
				'post_status'    => 'publish'
			);
			
		}

		// get posts from category
		$slideshow_items = get_posts($featured_args);

	}
	
	
	/*
	* Set slide content
	*/
	
	// array to hold slide content
	$slide_item_array = array();
	
	// function to add content to slide array
	function grace_featured_slide($slide_id = "", $slide_element = "", $slide_image = "", $slide_show_content = "", $slide_category = "", $slide_heading = "", $slide_content = "", $slide_url = "", $slide_url_target = "", $slide_button = "", $slide_button_text = "", $slide_heading_styles = "", $slide_content_position = "", $slide_content_alignment = "", $slide_content_styles = "", $slide_link_style = ""){
	
		global $slide_item_array;
		
		$slide_list_array = array(
			'slide_id' => $slide_id,
			'slide_element' => $slide_element,
			'slide_image' => $slide_image,
			'slide_show_content' => $slide_show_content,
			'slide_category' => $slide_category,
			'slide_heading' => $slide_heading,
			'slide_content' => $slide_content,
			'slide_url' => $slide_url,
			'slide_url_target' => $slide_url_target,
			'slide_button' => $slide_button,
			'slide_button_text' => $slide_button_text,
			'slide_heading_styles' => $slide_heading_styles,
			'slide_content_position' => $slide_content_position,
			'slide_content_alignment' => $slide_content_alignment,
			'slide_content_styles' => $slide_content_styles,
			'slide_link_style' => $slide_link_style,
		);
		
		$slide_item_array[] = $slide_list_array;
	
	}
	
	// custom slideshow
	if($slideshow_type == "custom"){
	
		// loop slides
		foreach($slideshow_items as $slide_item){

			// default variables
			$custom_slide_element = $custom_slide_image = $custom_slide_category = $custom_slide_heading = $custom_slide_content = $custom_slide_url = $custom_slide_url_target = $custom_slide_button = $custom_slide_button_text = $custom_slide_heading_styles = $custom_slide_content_position = $custom_slide_content_alignment = $custom_slide_content_styles = $custom_slide_link_style = "";
			
			// default slide element
			$custom_slide_element = "div";
			
		
			// slide image
			$custom_slide_image = $slide_item['image']['url'];
			
			// check slide content
			if($slide_item["show_featured_content"] != ""){
			
				// show slide content
				$custom_slide_show_content = true;
			
				// slide heading
				$custom_slide_heading = $slide_item["heading"];
				
				// slide content
				$custom_slide_content = $slide_item["content"];
				
				// slide hover state
				$custom_slide_hover_hide = false;
				
				
				// slide url
				if($slide_item["show_content_link"] != ""){
				
					// get url
					if($slide_item["link_external"] == ""){
					
						// site url
						$custom_slide_url = $slide_item["link_url"];
						
					} else {
					
						// external url
						$custom_slide_url = $slide_item["link_external"];
					
					}
					
					// check whole slide link
					if($slide_item["whole_slide_link"] != ""){
						
						$custom_slide_element = "a";
						
					}
					
					// check show button
					if($slide_item["show_content_button"] != ""){
					
						// post slide button
						$custom_slide_button = true;
						
						// post slide button text
						if($slide_item["slide_button_text"] != ""){
							
							// custom text
							$custom_slide_button_text = $slide_item["slide_button_text"];
							
						} else {
						
							// default text
							$custom_slide_button_text = get_theme_mod('grace_post_read_text', 'Read more');
						
						}
					
					}
					
					// check open new window
					if($slide_item["link_new_window"] != ""){
					
						$custom_slide_url_target = "_blank";
					
					}
				
				}
				
				
				// check custom font styling
				if($slide_item["custom_font_styling"] != ""){
				
					$custom_slide_heading_styles .= "font-size:" . $slide_item["heading_font_size"] . "px;" . "line-height:" . $slide_item["heading_line_height"] . "px;";
				
				}
				
				// get slide content position
				if($slide_item["content_position"] != ""){
				
					$custom_slide_content_position = $slide_item["content_position"];
				
				}
				
				// get slide content alignment
				if($slide_item["content_alignment"] != ""){
				
					$custom_slide_content_alignment = $slide_item["content_alignment"];
				
				}
				
				// get slide content max width
				if($slide_item["content_width"] != ""){
				
					$custom_slide_content_styles .= "max-width:" . $slide_item["content_width"] . "%;";
				
				} else {
				
					$custom_slide_content_styles .= "max-width:80%;";
				
				}
				
				// check slide content background
				if($slide_item["content_background"] != ""){
				
					$custom_slide_content_styles .= 'background-color:rgba(' . grace_hex_convert($slide_item["content_background_color"]) . ',' . $slide_item["content_background_opacity"] . ');padding:' . $slide_item["content_background_padding"] . 'px;';
				
				}
				
			} else {
			
				// hide slide content
				$custom_slide_show_content = false;
			
			}
			
			// pass to function
			grace_featured_slide("", $custom_slide_element, $custom_slide_image, $custom_slide_show_content, $custom_slide_category, $custom_slide_heading, $custom_slide_content, $custom_slide_url, $custom_slide_url_target, $custom_slide_button, $custom_slide_button_text, $custom_slide_heading_styles, $custom_slide_content_position, $custom_slide_content_alignment, $custom_slide_content_styles, $custom_slide_link_style);
		
		}
	
	// post slideshow
	} elseif($slideshow_type == "post" || $slideshow_type == "category"){
	
		// loop slides
		foreach($slideshow_items as $slide_item){
		
			// default variables
			$post_slide_element = $post_slide_image = $post_slide_category = $post_slide_heading = $post_slide_content = $post_slide_url = $post_slide_url_target = $post_slide_button = $post_slide_button_text = $post_slide_heading_styles = $post_slide_content_position = $post_slide_content_alignment = $post_slide_content_styles = $post_slide_link_style = "";
		
			// default slide element
			$post_slide_element = "div";
			
		
			// post ID
			$post_slide_id = $slide_item->ID;
			
			// post image
			$post_slide_image = wp_get_attachment_url(get_post_thumbnail_id($post_slide_id));
			
			// check slide content
			if(get_field('category_show_content', $page_id) != ""){
			
				// show slide content
				$post_slide_show_content = true;
				
				// slide hover state
				$post_slide_hover_hide = false;
				
			
				// post categories
				$post_slide_category = wp_get_post_categories($post_slide_id);
			
			
				// post title
				$post_slide_heading = get_the_title($post_slide_id);
				
				
				// post excerpt length
				$post_excerpt_length = get_field('category_post_excerpt_length', $page_id);
				
				if($post_excerpt_length == ""){
				
					$post_excerpt_length = 30;
					
				}
				
				// post excerpt
				$post_slide_content = grace_trim_excerpt($slide_item->post_content, $post_excerpt_length);
				
				
				// post url
				if(get_field('category_show_post_link', $page_id) != ""){
				
					// get url
					$post_slide_url = get_the_permalink($post_slide_id);
					
					// check whole slide link
					if(get_field('category_whole_slide_link', $page_id) != ""){
						
						$post_slide_element = "a";
						
					}
					
					// check show button
					if(get_field('category_show_content_button', $page_id) != ""){
					
						// post slide button
						$post_slide_button = true;
						
						// post slide button text
						$post_slide_button_text = get_theme_mod('grace_post_read_text', 'Read more');
					
					}
					
					// check open new window
					if(get_field('category_link_new_window', $page_id) != ""){
					
						$post_slide_url_target = "_blank";
					
					}
				
				}
				
				
				// check custom font styling
				if(get_field('category_custom_font_styling', $page_id) != ""){
				
					$post_slide_heading_styles .= "font-size:" . get_field('category_heading_font_size', $page_id) . "px;" . "line-height:" . get_field('category_heading_line_height', $page_id) . "px;";
				
				}
				
				// get slide content position
				if(get_field('category_content_position', $page_id) != ""){
				
					$post_slide_content_position = get_field('category_content_position', $page_id);
				
				}
				
				// get slide content alignment
				if(get_field('category_content_alignment', $page_id) != ""){
				
					$post_slide_content_alignment = get_field('category_content_alignment', $page_id);
				
				}
				
				// get slide content max width
				if(get_field('category_content_width', $page_id) != ""){
				
					$post_slide_content_styles .= "max-width:" . get_field('category_content_width', $page_id) . "%;";
				
				} else {
				
					$post_slide_content_styles .= "max-width:80%;";
				
				}
				
				// check slide content background
				if(get_field('category_content_background', $page_id) != ""){
				
					$post_slide_content_styles .= 'background-color:rgba(' . grace_hex_convert(get_field('category_content_background_color', $page_id)) . ',' . get_field('category_content_background_opacity', $page_id) . ');padding:' . get_field('category_content_background_padding', $page_id) . 'px;';
				
				}
				
			} else {
			
				// hide slide content
				$post_slide_show_content = false;
			
			}
			
			// pass to function
			grace_featured_slide($post_slide_id, $post_slide_element, $post_slide_image, $post_slide_show_content, $post_slide_category, $post_slide_heading, $post_slide_content, $post_slide_url, $post_slide_url_target, $post_slide_button, $post_slide_button_text, $post_slide_heading_styles, $post_slide_content_position, $post_slide_content_alignment, $post_slide_content_styles, $post_slide_link_style);
		
		}
	
	}
	
	
	/*
	* Slideshow owl carousel options
	* - Slide centred
	* - Multi slide
	* - Autoplay
	* - Margin
	* - Animations
	*/
	
	// check slide center
	$slide_centred = get_field('featured_slide_centred', $page_id);
	
	// check multi slide
	$multi_slide = get_field('featured_multi_slide', $page_id);
	
	
	// slide center checked
	if($slide_centred != "" && $multi_slide == ""){
	
		$slideshow_slide_centered = true;
		
	// multi slide checked
	} elseif($slide_centred == "" && $multi_slide != ""){
	
		$slideshow_multi_slide = true;
	}
	
	/* Slide centred */
	
	if($slideshow_slide_centered == true){
	
		// set multi slide data attr
		$slideshow_data_attrs .= 'data-slide-center="true" ';
		
		// add to display class
		$slide_display_class .= "featured-center-slide";
		
		// check center narrow slide
		if(get_field('featured_centered_slide_narrow', $page_id) != ""){
		
			$slide_display_class .= " featured-center-narrow";
		
		}

	}
	
	/* Multi slide */
	
	if($slideshow_multi_slide == true){
	
		// set multi slide data attr
		$slideshow_data_attrs .= 'data-multi-slide="true" ';
	
		// check multi slide number
		if(get_field('featured_multi_slide_no', $page_id) != ""){
		
			// add data attributes
			$slideshow_data_attrs .= 'data-multi-slide-no="'. get_field('featured_multi_slide_no', $page_id) .'" ';
			
			// add display classes
			$slide_display_class = "featured-multi-slide" . " multi-slide-" . get_field('featured_multi_slide_no', $page_id);
		
		// number not set
		} else {
		
			$slideshow_data_attrs .= 'data-multi-slide-no="3" ';
		
		}
		
	}
	
	/* Autoplay */
	
	if(get_field('featured_slideshow_autoplay', $page_id) != ""){
	
		// set autoplay true
		$slideshow_data_attrs .= 'data-autoplay="true";';
	
		// check autoplay speed
		if(get_field('featured_autoplay_speed', $page_id) != ""){
		
			$slideshow_data_attrs .= 'data-autoplay-speed="'. get_field('featured_autoplay_speed', $page_id) .'" ';
		
		// number not set
		} else {
		
			$slideshow_data_attrs .= 'data-autoplay-speed="5000" ';
		
		}
	
	}
	
	/* Margin */
	
	// check slide margin number
	if(get_field('featured_slideshow_margin', $page_id) != ""){
	
		$slideshow_data_attrs .= 'data-slide-margin="'. get_field('featured_slideshow_margin', $page_id) .'" ';
	
	// number not set
	} else {
	
		$slideshow_data_attrs .= 'data-slide-margin="15" ';
	
	}
	
	/* Animation */
	
	// check slideshow animations
	if(get_field('featured_animations', $page_id) != ""){
	
		// check animation in
		if(get_field('featured_animation_in', $page_id) != ""){
		
			$slideshow_data_attrs .= 'data-animation-in="'. get_field('featured_animation_in', $page_id) .'" ';
		
		}
		
		// check animation out
		if(get_field('featured_animation_out', $page_id) != ""){
		
			$slideshow_data_attrs .= 'data-animation-out="'. get_field('featured_animation_out', $page_id) .'" ';
		
		}
	
	}
	
	
	/*
	* Slidshow hidden options
	*/
	
	// check hidden navigation
	if(get_field('hide_slideshow_navigation', $page_id) != ""){
	
		$slideshow_navigation = false;
	
	}
	
	// check hidden dots
	if(get_field('hide_slideshow_dots', $page_id) != ""){
	
		$slideshow_dots = "hidden-dots";
	
	}

?>

<?php if(!empty($slideshow_items)){ ?>

	<div id="featured-slideshow-outer" class="carousel-outer" style="height:<?php echo esc_attr($slideshow_height); ?>px;">
	
		<?php if($slideshow_navigation == true){ ?>
			<!-- previous slide -->
			<span class="slideshow-btn previous-slide-btn fa fa-angle-left"></span>
		<?php } ?>
		
		<!-- slideshow -->
		<div id="featured-slideshow" class="carousel <?php echo esc_attr($slideshow_dots) . '" ' . $slideshow_data_attrs; ?>>

			<?php foreach($slide_item_array as $slide){ ?>
			
				<<?php echo esc_attr($slide['slide_element']); ?> <?php if($slide['slide_element'] == "a"){ ?>href="<?php echo esc_url($slide['slide_url']); ?>" <?php if($slide['slide_url_target'] != ""){ echo 'target="' . esc_attr($slide['slide_url_target']) . '"'; } ?> <?php } ?> class="featured-slide <?php echo esc_attr($slide_display_class); ?>" style="height:<?php echo esc_attr($slideshow_height); ?>px;background-image:url('<?php echo esc_url($slide['slide_image']); ?>');">
				
					<?php if($slide['slide_show_content'] == true){ ?>
					
						<div class="container">
						
							<div class="featured-content-area <?php echo esc_attr($slide['slide_content_position']); ?> <?php echo esc_attr($slide['slide_content_alignment']); ?>"  style="<?php echo esc_attr($slide['slide_content_styles']); ?>">
						
								<?php if($slide['slide_category'] != ""){ ?>
								
									<ul class="post-categories clearfix">
										<?php foreach($slide['slide_category'] as $post_category){ ?>
											<li class="blog-item-cat font-opensans-reg">
												<?php if($slide['slide_element'] != "a"){ ?><a href="<?php echo get_category_link($post_category); ?>"><?php } ?>
													<?php echo get_cat_name($post_category); ?>
												<?php if($slide['slide_element'] != "a"){ ?></a><?php } ?>
											</li>
										<?php } ?>
									</ul>
								
								<?php } ?>
						
								<?php if($slide['slide_heading'] != ""){ ?>
						
									<h2 class="font-montserrat-reg" style="<?php echo esc_attr($slide['slide_heading_styles']); ?>">
									
										<?php if($slide['slide_element'] != "a" && $slide['slide_url'] != ""){ ?>
											<a href="<?php echo esc_url($slide['slide_url']); ?>" style="<?php echo esc_attr($slide['slide_link_style']); ?>" <?php if($slide['slide_url_target'] != ""){ echo 'target="' . esc_attr($slide['slide_url_target']) . '"'; } ?>>
										<?php } ?>
									
										<?php echo esc_html($slide['slide_heading']); ?>
										
										<?php if($slide['slide_element'] != "a" && $slide['slide_url'] != ""){ ?>
											</a>
										<?php } ?>
									
									</h2>
								
								<?php } ?>
								
								<?php if($slide['slide_content'] != ""){ ?>
								
									<p class="font-opensans-reg"><?php echo esc_html($slide['slide_content']); ?></p>
								
								<?php } ?>
								
								<?php if($slide['slide_url'] != "" && $slide['slide_button'] == true){ ?>
								
									<?php
									
										// default button element
										$button_element = "a";
										
										// check whole slide element
										if($slide['slide_element'] == "a"){
										
											$button_element = "div";
										
										}
									
									?>
								
									<<?php echo esc_attr($button_element); ?> <?php if($button_element == "a"){ ?>href="<?php echo esc_url($slide['slide_url']); ?>"<?php } ?> class="primary-button slide-button font-montserrat-reg hov-bk" <?php if($slide['slide_url_target'] != ""){ echo 'target="' . esc_attr($slide['slide_url_target']) . '"'; } ?>>
										<?php echo esc_html($slide['slide_button_text']); ?>
									</<?php echo esc_attr($button_element); ?>>
									
								<?php } ?>
						
							</div>
						
						</div>
					
					<?php } ?>
					
				</<?php echo esc_attr($slide['slide_element']); ?>>
			
			<?php } ?>
		
		</div>
		
		<?php if($slideshow_navigation == true){ ?>
			<!-- next slide -->
			<span class="slideshow-btn next-slide-btn fa fa-angle-right"></span>
		<?php } ?>
	
	</div>

<?php } ?>