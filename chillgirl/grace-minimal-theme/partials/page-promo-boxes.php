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
	* Get promo boxes
	*/

	$promo_boxes = get_field('promo_boxes', $page_id);
	
?>

<?php if($promo_boxes != ""){ ?>

	<!-- promo box section -->
	<section class="promo-box-section">
		<div class="container">

			<?php 
			
				// get row limit selected
				$promo_col_width = get_field('promo_box_row_amount', $page_id); 
				
				// check row limit isn't empty and is a number
				if($promo_col_width != "" && is_numeric($promo_col_width)){
					
					// set col class on tablet if 4 row chosen
					if($promo_col_width == 3){
						$promo_tablet_col_width = 6;
					// else tablet row amount is same as desktop
					} else {
						$promo_tablet_col_width = $promo_col_width;
					}
				
				// else set default of 4
				} else {
					$promo_col_width = 4;
				}

			?>
		
			<ul class="row">

				<?php $i = 0; ?>
			
				<?php foreach($promo_boxes as $promo_box) { ?>
				
					<?php 
					
						// define window open variable
						$window_open = "";
					
						// check for promo box link
						if($promo_box['promo_box_link'] != ""){
						
							// check for external or internal site link
							if($promo_box['external_link'] != ""){
								$promo_box_link = $promo_box['external_link'];
							} else if($promo_box['link'] != ""){
								$promo_box_link = $promo_box['link'];
							}
							
							// check for open in new window option
							if($promo_box['open_new_window'] != ""){ 
								$window_open = "_blank"; 
							} else {
								$window_open = "_self"; 
							}
							
							// set promo box to a tag
							$promo_box_open = '<a href="' . $promo_box_link . '" class="promo-box-item" target="' . $window_open . '">';
							$promo_box_close = "</a>";
							
						// link not wanted
						} else {
							
							// set promo box to div instead of a tag
							$promo_box_open = '<div class="promo-box-item">';
							$promo_box_close = "</div>";

						}
						
						
						// check content area is wanted
						if($promo_box['show_content_area'] != ""){
						
							// inside max width check
							$inside_max_width = $promo_box['content_area_width'];
							
							if($inside_max_width != ""){
								$inside_max_width = 'max-width:'. $promo_box['content_area_width'] .'%;';
							} else {
								$inside_max_width = 'max-width:80%;';
							}
							
							// heading text color
							$heading_text_color = $promo_box['heading_text_color'];
							
							if($heading_text_color == ""){
								$heading_text_color = '#111111;';
							}
							
							// text content color
							$text_content_color = $promo_box['text_content_color'];
							
							if($text_content_color == ""){
								$text_content_color = '#757575;';
							}

							// promo box inside style
							$promo_inside_style = 'background-color:rgba(' . grace_hex_convert($promo_box['heading_background_color']) . ',' . esc_attr($promo_box['heading_background_opacity']) . ');' . $inside_max_width;
							
							// content area position check
							$content_area_position = $promo_box['content_area_position'];
							
							if($content_area_position != ""){
								$inside_position = "promo-inside-". $promo_box['content_area_position'];
							} else {
								$inside_position = "promo-inside-center";
							}
							
						}
						
					?>

					<li class="col-xlarge-<?php echo esc_attr($promo_col_width); ?> col-medium-<?php echo esc_attr($promo_tablet_col_width); ?>">
					
						<?php echo wp_kses($promo_box_open, array( 'div' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'class' => array(), 'target' => array() ), )); ?>
						
							<?php if($promo_box['hide_hover_overlay'] == ""){ ?>
								<div class="promo-box-hover"></div>
							<?php } ?>
						
							<img src="<?php echo esc_url($promo_box['image']['url']); ?>" alt="<?php echo esc_attr($promo_box['image']['alt']); ?>" class="image" />
							
							<?php if($promo_box['show_content_area'] != ""){ ?>
							
								<?php if($promo_box['image_overlay_color'] != ""){ ?>
									<div class="promo-item-overlay" style="background-color:<?php echo esc_attr($promo_box['image_overlay_color']); ?>;opacity:<?php echo esc_attr($promo_box['image_overlay_opacity']); ?>"></div>
								<?php } ?>
								
								<div class="promo-item-inside font-opensans-reg <?php echo esc_attr($inside_position); ?> <?php if($promo_box['text_content'] != ""){ echo "promo-item-padding"; } ?>" <?php if($promo_box['text_content'] != ""){ echo 'style="' . esc_attr($promo_inside_style) . '"'; } ?>>
									<?php if($promo_box['heading'] != ""){ ?>
										<h3 <?php if($promo_box['text_content'] == ""){ echo 'style="' . esc_attr($promo_inside_style) . "color:" . esc_attr($heading_text_color) . '"' . ' class="promo-item-padding"'; } ?> style="color:<?php echo esc_attr($heading_text_color); ?>"><?php echo esc_html($promo_box['heading']); ?></h3>
									<?php } ?>
									<?php if($promo_box['text_content'] != ""){ ?>
										<p <?php if($promo_box['heading'] != ""){ echo 'class="promo-item-margin"'; } ?> style="color:<?php echo esc_attr($text_content_color); ?>"><?php echo esc_html($promo_box['text_content']); ?></p>
									<?php } ?>
								</div>
							
							<?php } ?>
								
						<?php echo wp_kses($promo_box_close, array( 'div' => array( 'class' => array() ), 'a' => array( 'href' => array(), 'class' => array() ), )); ?>
						
					</li>
					
					<?php

						if($i > 1){
							
							switch($promo_col_width) {
								case 12:
									$col_clearfix_no = 1;
									break;
								case 6:
									$col_clearfix_no = 2;
									break;
								case 4:
									$col_clearfix_no = 3;
									break;
								case 3:
									$col_clearfix_no = 4;
									break;
							}

							if(( ($i + 1) % $col_clearfix_no) == 0){
								echo '<li class="clearfix"></li>';
							}
						
						}

						$i++; 
					
					?>
				
				<?php } ?>
			
			</ul>
			
		</div>
	</section>

<?php } ?>