<?php 

	if( ! defined( 'ABSPATH' ) ) exit; // exit if accessed directly

	/*
	* Get page ID
	*/
	
	if( isset($home_page_blog) && $home_page_blog == true ) {
	
		// home page id
		$page_id = $home_page_id;
	
	} elseif(is_page_template('templates/recipes-page.php')) {
	
		// recipes index id
		$page_id = get_the_ID();
	
	}
	
	
	/* 
	* Banner defaults
	*/
	
	// default height
	$banner_height = 500;
	
	// default width
	$banner_wide = true;
	
	// default image
	$banner_image = "";
	
	// default content
	$banner_content = false;
	
	// default heading
	$banner_content_heading = "";
	
	// default text content
	$banner_content_text = "";
	
	// default banner url
	$banner_url = "";
	
	// default banner url target
	$banner_url_target = "";
	
	// default banner button
	$banner_button = false;
	
	// default banner button text
	$banner_button_text = get_theme_mod('grace_post_read_text', 'Continue Reading');
	
	// default content position
	$banner_content_position = "featured-pos-center";
	
	// default content alignment
	$banner_content_alignment = "featured-align-center";
	
	// default content styles
	$banner_content_styles = "";
	
	// default heading styles
	$banner_heading_styles = "";
	
	
	/*
	* Banner height
	*/
	
	// get featured height
	$featured_section_height = get_field('featured_section_height', $page_id);
	
	// check height has value set
	if($featured_section_height != ""){
	
		// set banner height
		$banner_height = $featured_section_height;
	
	}
	
	
	/*
	* Get banner content
	*/
	
	// get featured banner
	$featured_banner = get_field('featured_banner', $page_id);
	
	// featured banner set
	if($featured_banner != ""){
		
		foreach($featured_banner as $banner){
		
			// banner image
			$banner_image = $banner["image"]["url"];
			
			// check banner content
			if($banner["show_featured_content"] != ""){
			
				// content true
				$banner_content = true;
				
				// get banner heading
				$banner_content_heading = $banner["heading"];
	
				// get text content
				$banner_content_text = $banner["content"];
				
				// banner url
				if($banner["show_content_link"] != ""){
				
					// get url
					if($banner["link_external"] == ""){
					
						// site url
						$banner_url = $banner["link_url"];
						
					} else {
					
						// external url
						$banner_url = $banner["link_external"];
					
					}
					
					// check show button
					if($banner["show_content_button"] != ""){
					
						// banner button
						$banner_button = true;
						
						// banner button text
						if($banner["banner_button_text"] != ""){
							
							// custom text
							$banner_button_text = $banner["banner_button_text"];
							
						}
					
					}
					
					// check open new window
					if($banner["link_new_window"] != ""){
					
						$banner_url_target = "_blank";
					
					}
				
				}
				
				// check custom font styling
				if($banner["custom_font_styling"] != ""){
				
					$banner_heading_styles .= "font-size:" . $banner["heading_font_size"] . "px;" . "line-height:" . $banner["heading_line_height"] . "px;";
				
				}
				
				// get banner content position
				if($banner["content_position"] != ""){
				
					$banner_content_position = $banner["content_position"];
				
				}
				
				// get banner content alignment
				if($banner["content_alignment"] != ""){
				
					$banner_content_alignment = $banner["content_alignment"];
				
				}
				
				// get banner content max width
				if($banner["content_width"] != ""){
				
					$banner_content_styles .= "max-width:" . $banner["content_width"] . "%;";
				
				} else {
				
					$banner_content_styles .= "max-width:80%;";
				
				}
				
				// check banner content background
				if($banner["content_background"] != ""){
				
					$banner_content_styles .= 'background-color:rgba(' . grace_hex_convert($banner["content_background_color"]) . ',' . $banner["content_background_opacity"] . ');padding:' . $banner["content_background_padding"] . 'px;';
				
				}
			
			}
		
		}
	
	}
	
?>

<?php if($featured_banner != ""){ ?>

	<div class="banner-image" style="height:<?php echo esc_attr($banner_height); ?>px;background-image:url('<?php echo esc_url($banner_image); ?>');">

		<?php if($banner_content == true){ ?>
		
			<div class="container">
		
				<div class="featured-content-area <?php echo esc_attr($banner_content_position); ?> <?php echo esc_attr($banner_content_alignment); ?>" style="<?php echo esc_attr($banner_content_styles); ?>">
					
					<?php if($banner_content_heading != ""){ ?>
					
						<h2 class="font-montserrat-reg" style="<?php echo esc_attr($banner_heading_styles); ?>">
						
							<?php if($banner_url != ""){ ?>
								<a href="<?php echo esc_url($banner_url); ?>" target="<?php echo esc_attr($banner_url_target); ?>">
							<?php } ?>
						
							<?php echo esc_html($banner_content_heading); ?>
							
							<?php if($banner_url != ""){ ?>
								</a>
							<?php } ?>
						
						</h2>
						
					<?php } ?>
					
					<?php if($banner_content_text != ""){ ?>
					
						<p class="font-opensans-reg"><?php echo esc_html($banner_content_text); ?></p>
						
					<?php } ?>
					
					<?php if($banner_url != "" && $banner_button == true){ ?>
						<a href="<?php echo esc_url($banner_url); ?>" class="primary-button slide-button font-montserrat-reg hov-bk" target="<?php echo esc_attr($banner_url_target); ?>">
							<?php echo esc_html($banner_button_text); ?>
						</a>
					<?php } ?>
					
				</div>
			
			</div>
			
		<?php } ?>

	</div>

<?php } ?>