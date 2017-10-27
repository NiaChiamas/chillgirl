<?php

	if( ! defined( 'ABSPATH' ) ) exit; // exit if accessed directly

	/*
	* This file is used to handle the output of the blog post items on every page that posts are outputted onto including the home page, page for posts, category pages,
	* archive pages, tag pages, and the search page. ** Changes to this file could result in posts not displaying correctly **
	*/

	// Posts per page
	$posts_per_page = get_option( 'posts_per_page' );
	
	// Pagination option
	$pagination_page = true;
	
	
	// check if home page blog is not defined
	if(!isset($home_page_blog)){
		$home_page_blog = "";
	}
	
	// check if home page id is not defined
	if(!isset($home_page_id)){
		$home_page_id = "";
	}
	

	/*
	* Getting the id of the page to use in functions. On the home page the id has been passed through to this file.
	*/
	
	// check if home_page_blog variable has been passed through
	if( $home_page_blog == true ) {
	
		// home page id
		$page_id = $home_page_id;
		
	// check if is page for posts
	} else if('page' == get_option( 'page_for_posts' ) && !is_category() && !is_tag() ){
	
		// posts page id
		$page_id = get_option('page_for_posts');
		
	// check if is category page or tag page
	} else if( is_category() || is_tag() ){
	
		// get term id for category or tag
		$queried_object = get_queried_object(); 
		$taxonomy = $queried_object->taxonomy;
		$term_id = $queried_object->term_id;  
		
		// set page id to the term
		$page_id = $taxonomy . '_' . $term_id;
	
	// else use the default options, for pages like search
	} else {

		// use default options
		$default_options = true;
		
	}
	

	/*
	* Handling the retrieval of the posts that need to be displayed on the page.
	*/
	
	// array to hold post content
	$blog_post_array = array();
	
	// add blog posts to array
	function grace_add_blog_post($blog_post_id, $category_select, $selected_excerpt){
		
		global $blog_post_array;
		
		$post_author_id = get_post_field( 'post_author', $blog_post_id );
		
		$blog_list_array = array(
			'blog_post_id' => $blog_post_id,
			'blog_post_title' => get_the_title($blog_post_id),
			'blog_post_date' => get_the_date(get_option('date_format'), $blog_post_id),
			'blog_post_link' => get_the_permalink($blog_post_id),
			'blog_post_image' => wp_get_attachment_url(get_post_thumbnail_id($blog_post_id)),
			'blog_post_image_alt' => get_post_meta(get_post_thumbnail_id($blog_post_id) , '_wp_attachment_image_alt', true),
			'blog_post_author' => get_the_author_meta('nickname', $post_author_id),
			'blog_post_excerpt' => get_the_excerpt($blog_post_id),
			'blog_post_category' => wp_get_post_categories($blog_post_id),
		);
		
		if($category_select == false){
		
			// selected posts excerpt has not been passed through
			if($selected_excerpt == ""){
			
				$blog_list_array = array_merge($blog_list_array, array('blog_post_excerpt' => get_the_excerpt($blog_post_id)) );
			
			// selected posts excerpt passed through
			} else {
				
				$blog_list_array = array_merge($blog_list_array, array('blog_post_excerpt' => $selected_excerpt ));
				
			}
		
		} else {

			$post_object = get_post($blog_post_id);
			$category_item_excerpt = $post_object->post_content;
			$blog_list_array = array_merge($blog_list_array, array('blog_post_excerpt' => $category_item_excerpt) );
		}
		
		$blog_post_array[] = $blog_list_array;
		
	}
	
	
	/*
	* Function to check if page pagination is needed for posts.
	*/
	
	function grace_blog_post_paged(){
	
		// some pages need 'paged' var and some need 'page'. Home and page for posts need 'page' and the rest 'paged'
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		
		//if ('page' == get_option('show_on_front') && 'page' != get_option('page_for_posts') && $from_page_for_posts == false) {
		if ('page' == get_option('show_on_front') && 'page' != get_option('page_for_posts')) {
			if(is_front_page()){
				$paged = (get_query_var('page')) ? get_query_var('page') : 1;
			}
		}
		
		return $paged;
		
	}
	
	
	// check for home page and selected category of posts
	if(class_exists('acf') && $home_page_blog == true && get_field('select_category', $page_id) != ""){
		
		// get selected posts
		$selected_category = get_field('selected_category', $page_id);
		
		// check selected posts isn't empty
		if($selected_category != ""){
		
			//create empty array for selected categories
			$selected_cat_array = array ();
		
			// loop through categories and add to array
			foreach($selected_category as $category){
				$selected_cat_array[] = $category->term_id;
			}
			
			$paged = grace_blog_post_paged();
		
			// Category choice array arguments 
			$category_args = array(
				'posts_per_page' => $posts_per_page,
				'post_type' => 'post',
				'orderby' => 'date',
				'order' => 'DESC',
				'paged' => $paged,
				'tax_query' => array(
					array(
						'taxonomy' => 'category',
						'field' => 'term_id',
						'terms' => $selected_cat_array
					)
				)
			);
			
			$wp_query = new WP_Query($category_args);
		
			// loop to get posts and add them to the blog posts array
			while ( have_posts()) : the_post();
				grace_add_blog_post($post->ID, false, "");
			endwhile;
			
		}
	
	// check for home page and selected posts wanted
	} else if(class_exists('acf') && $home_page_blog == true && get_field('select_posts', $page_id) != ""){
		
		// get selected posts
		$selected_posts = get_field('selected_posts', $page_id);
		
		// check selected posts isn't empty
		if($selected_posts != ""){	
			foreach($selected_posts as $selected_post){
				grace_add_blog_post($selected_post->ID, false, $selected_post->post_content);
			}
			
			// pagination not wanted
			$pagination_page = false;
			
		}
	
	// check for using home page template
	} else if(class_exists('acf') && $home_page_blog == true && get_field('select_posts', $page_id) == ""  && get_field('select_category', $page_id) == ""){
	
		$paged = grace_blog_post_paged();
		
		// custom query to get blog posts
		$args = array( 'post_type' => 'post', 'posts_per_page' => $posts_per_page, 'paged' => $paged );
		$wp_query = new WP_Query($args);
		
		// loop to get posts and add them to the blog posts array
		while ( have_posts()) : the_post();
			grace_add_blog_post($post->ID, false, "");
		endwhile;
		
	// get post content for everything else
	} else {
	
		// check if blog posts exist
		if(have_posts()){ 
	
			while(have_posts()) : the_post();
				
				$post_author_id = get_post_field( 'post_author', $post->ID );

				$blog_list_array = array(
					'blog_post_id' => $post->ID,
					'blog_post_title' => get_the_title($post->ID),
					'blog_post_date' => get_the_date(get_option('date_format'), $post->ID),
					'blog_post_comments' => get_comments_number($post->ID),
					'blog_post_link' => get_the_permalink($post->ID),
					'blog_post_image' => wp_get_attachment_url(get_post_thumbnail_id($post->ID)),
					'blog_post_image_alt' => get_post_meta(get_post_thumbnail_id($post->ID) , '_wp_attachment_image_alt', true),
					'blog_post_author' => get_the_author_meta('nickname', $post_author_id),
					'blog_post_category' => wp_get_post_categories($post->ID),
					'blog_post_excerpt' => get_the_excerpt($post->ID),
				);
				
				$blog_post_array[] = $blog_list_array;
				
				
			endwhile;
		
		}
		
	}


	/*
	* Set post template layout
	*/
	
	// check acf is installed
	if(class_exists('acf')){
	
		// get layout style
		$blog_layout_style = get_field('list_layout_style', $page_id);
		
		// if style is empty
		if($blog_layout_style == ""){
		
			$blog_layout_style = "Default";
			
		}
		
		// empty masonry class
		$grid_masonry_class = "";
		
		// if layout includes grid variation
		if($blog_layout_style == "Grid" || $blog_layout_style == "Wide then grid"){
		
			// get grid col number
			$grid_col_number = get_field('grid_layout_number', $page_id);
			
			// grid only layout
			if($blog_layout_style == "Grid"){
				
				$grid_layout_masonry = get_field('grid_layout_masonry', $page_id);
				
				if($grid_layout_masonry != ""){
					
					$grid_masonry_class = "post-list-grid-masonry";
					
				}
				
			} else {
				
				$grid_layout_masonry = "";
			
			}
		
		}
		
		
		// blog item content position
		$post_content_position = get_field('post_content_position', $page_id);
		
		if($post_content_position == ""){
			$post_content_position = "left";
		}
		
		// check if using wide then small - this has option for two different text positions
		if($blog_layout_style == "Wide then small"){
			
			// small item content position
			$small_item_text_position = get_field('small_item_text_position', $page_id);
		
			if($small_item_text_position == ""){
				$small_item_text_position = "left";
			}
		
		} else {
			$small_item_text_position = $post_content_position;
		}
		
	} else {
		
		// set defaults when acf not installed
		
		$blog_layout_style = "Default";
		$grid_masonry_class = "";
		$post_content_position = "left";
		$small_item_text_position = "left";
	
	}
	
	
	/*
	* Set information to show/hide
	*/
	
	// default show title
	$post_show_title = true;
	
	// default show category
	$post_show_category = true;
	
	// default show date
	$post_show_date = true;
	
	// default show author
	$post_show_author = true;
	
	// default show image
	$post_show_image = true;
	
	// default show excerpt
	$post_show_excerpt = true;
	
	// default show link button
	$post_show_button = true;
	
	
	// check acf installed
	if(class_exists('acf')){
	
		// hidden post information
		$hide_post_information = get_field('hide_post_information', $page_id);
		
		if($hide_post_information != ""){
		
			// hide title
			if(in_array("hide-title", $hide_post_information)) {
				
				$post_show_title = false;
			
			}
			
			// hide category
			if(in_array("hide-category", $hide_post_information)) {
				
				$post_show_category = false;
			
			}
			
			// hide date
			if(in_array("hide-date", $hide_post_information)) {
				
				$post_show_date = false;
			
			}
			
			// hide author
			if(in_array("hide-author", $hide_post_information)) {
				
				$post_show_author = false;
			
			}
			
			// hide image
			if(in_array("hide-image", $hide_post_information)) {
				
				$post_show_image = false;
			
			}
			
			// hide excerpt
			if(in_array("hide-excerpt", $hide_post_information)) {
				
				$post_show_excerpt = false;
			
			}
			
			// hide link button
			if(in_array("hide-button", $hide_post_information)) {
				
				$post_show_button = false;
			
			}
		
		}
	
	}
	
	
	/*
	* Output blog posts
	*/
	
	if(!empty($blog_post_array)){

		$i = 1;
	
		echo '<ul class="blog-post-list post-list row '. $grid_masonry_class .'">';
		
		foreach($blog_post_array as $blog_item){
		
		
			$blog_layout_template = "";
			
			$blog_post_col = "";
			
			
			// blog layout style is a combination of two
			if($blog_layout_style == "Wide then small" || $blog_layout_style == "Wide then grid"){
			
				// check if first blog post and if on first page of pagination
				if($i == 1 && !is_paged()){
				
					$blog_layout_template = 1;
					$blog_post_col = 12;
					$excerpt_length = 55;
				
				// is not first post or is not first page of pagination
				} else {
				
					// remaining items to be grid style
					if($blog_layout_style == "Wide then grid"){
					
						$blog_layout_template = 1;
						$blog_post_col = $grid_col_number;
						$excerpt_length = 30;
						//$hidden_bottom = true;
					
					// remaining items to be small style
					} else if($blog_layout_style == "Wide then small"){
					
						$blog_layout_template = 2;
						$blog_post_col = 12;
						$excerpt_length = 40;
						
					}
				
				}
			
			// blog layout style is only one
			} else {
			
				// check for wide or grid layout or if default is wanted
				if($blog_layout_style == "Wide" || $blog_layout_style == "Grid" || $blog_layout_style == "Default"){
				
					$blog_layout_template = 1;
					
					// if it's wide
					if($blog_layout_style == "Wide" || $blog_layout_style == "Default"){
					
						$blog_post_col = 12;
						$excerpt_length = 55;
						
					// else it's grid
					} else {
					
						$blog_post_col = $grid_col_number;
						$excerpt_length = 20;
						//$hidden_bottom = true;
						
					}
					
				// check for small
				} else if($blog_layout_style == "Small"){
				
					$blog_layout_template = 2;
					$blog_post_col = 12;
					$excerpt_length = 55;
				
				}
			
			}
				

			// posts using template 1
			if($blog_layout_template == 1){
				
				?>
				
					<!-- Wide post item -->
					<li class="col-xlarge-<?php echo esc_attr($blog_post_col); ?>">
					
						<div id="post-<?php echo esc_attr($blog_item['blog_post_id']); ?>" <?php post_class('post-list-item wide-post-list-item blog-list-item post-item-'. $post_content_position, $blog_item['blog_post_id']); ?>>                            

							<?php if($post_show_image == true){ ?>
								<a href="<?php echo esc_url($blog_item['blog_post_link']); ?>">
									<?php if($blog_item['blog_post_image'] != ""){ ?>
										<img src="<?php echo esc_url($blog_item['blog_post_image']); ?>" alt="<?php echo esc_attr($blog_item['blog_post_image_alt']); ?>" class="image">
									<?php } ?>
								</a>
							<?php } ?>
							
							<?php if($post_show_category == true){ ?>
								<!-- blog item categories -->
								<?php if($blog_item['blog_post_category'] != ""){ ?>
									<ul class="post-categories clearfix">
										<?php foreach($blog_item['blog_post_category'] as $post_category){ ?>
											<li class="blog-item-cat font-opensans-reg"><a href="<?php echo get_category_link($post_category); ?>"><?php echo get_cat_name($post_category); ?></a></li>
										<?php } ?>
									</ul>
								<?php } ?>
							<?php } ?>
							
							<?php if($post_show_title == true){ ?>
								<h3 class="font-montserrat-reg">
									<a href="<?php echo esc_url($blog_item['blog_post_link']); ?>">
										<?php echo esc_attr($blog_item['blog_post_title']); ?>
									</a>
								</h3>
							<?php } ?>
							
							<?php if($post_show_date !== false && $post_show_author !== false){ ?>
								<div class="post-list-item-meta font-opensans-reg clearfix">
			
									<?php if($post_show_date == true){?>
										<span><?php echo esc_attr($blog_item['blog_post_date']); ?></span>
									<?php } ?>
									
									<?php if($post_show_author == true){?>
										<span><?php echo esc_attr($blog_item['blog_post_author']); ?></span>
									<?php } ?>

								</div>
							<?php } ?>

							<?php if($post_show_excerpt == true){ ?>
								<div class="page-content">
									<?php echo apply_filters('the_content', grace_trim_excerpt($blog_item['blog_post_excerpt'], $excerpt_length)); ?>
								</div>
							<?php } ?>
							
							<?php if($post_show_button == true){ ?>
								<a href="<?php echo esc_url($blog_item['blog_post_link']); ?>" class="primary-button font-montserrat-reg hov-bk"><?php echo esc_html(get_theme_mod('grace_post_read_text', 'Read more')); ?></a>
							<?php } ?>
								
						</div>
						
					</li>
				
				<?php
				
			// posts using template 2
			} elseif($blog_layout_template == 2){
				
				?>
				
					<!-- Small post item  -->
					<li class="col-xlarge-<?php echo esc_attr($blog_post_col); ?>">
						<div id="post-<?php echo esc_attr($blog_item['blog_post_id']); ?>" <?php post_class('post-list-item wide-post-list-item blog-list-item post-item-'. $small_item_text_position, $blog_item['blog_post_id']); ?>> 
						
							<div class="row">
							
								<div class="col-xlarge-5">
									<?php if($post_show_image == true){ ?>
										<a href="<?php echo esc_url($blog_item['blog_post_link']); ?>">
											<?php if($blog_item['blog_post_image'] != ""){ ?>
												<img src="<?php echo esc_url($blog_item['blog_post_image']); ?>" alt="<?php echo esc_attr($blog_item['blog_post_image_alt']); ?>" class="image">
											<?php } ?>
										</a>
									<?php } ?>
								</div>
								
								<div class="col-xlarge-7">
								
									<?php if($post_show_category == true){ ?>
										<!-- blog item categories -->
										<?php if($blog_item['blog_post_category'] != ""){ ?>
											<ul class="post-categories clearfix">
												<?php foreach($blog_item['blog_post_category'] as $post_category){ ?>
													<li class="blog-item-cat font-opensans-reg"><a href="<?php echo get_category_link($post_category); ?>"><?php echo get_cat_name($post_category); ?></a></li>
												<?php } ?>
											</ul>
										<?php } ?>
									<?php } ?>
								
									<?php if($post_show_title == true){ ?>
										<h3 class="font-montserrat-reg">
											<a href="<?php echo esc_url($blog_item['blog_post_link']); ?>">
												<?php echo esc_attr($blog_item['blog_post_title']); ?>
											</a>
										</h3>
									<?php } ?>
									
									<?php if($post_show_date !== false && $post_show_author !== false){ ?>
										<div class="post-list-item-meta font-opensans-reg clearfix">
					
											<?php if($post_show_date == true){?>
												<span><?php echo esc_attr($blog_item['blog_post_date']); ?></span>
											<?php } ?>
											
											<?php if($post_show_author == true){?>
												<span><?php echo esc_attr($blog_item['blog_post_author']); ?></span>
											<?php } ?>

										</div>
									<?php } ?>
								
									<?php if($post_show_excerpt == true){ ?>
										<div class="page-content">
											<?php echo apply_filters('the_content', grace_trim_excerpt($blog_item['blog_post_excerpt'], $excerpt_length)); ?>
										</div>
									<?php } ?>
									
									<?php if($post_show_button == true){ ?>
										<a href="<?php echo esc_url($blog_item['blog_post_link']); ?>" class="primary-button font-montserrat-reg hov-bk"><?php echo esc_html(get_theme_mod('grace_post_read_text', 'Read more')); ?></a>
									<?php } ?>
									
								</div>
							
							</div>
						
						</div>
					</li>
				
				<?php
				
			}
			
			/* Clearfix under each grid row to keep them properly formatted */
			
			if($blog_layout_style == "Wide then grid" || $blog_layout_style == "Grid"){
			
				if($i >0){
					
					if($grid_col_number == 6){
						$col_clearfix_no = 2;
					} else if($grid_col_number == 4){
						$col_clearfix_no = 3;
					} else if($grid_col_number == 3){
						$col_clearfix_no = 4;
					}
			
					// wide then grid layout
					if($blog_layout_style == "Wide then grid"){
				
						// not paged
						if(!is_paged()){
						
							// first item
							if($i == 1){
								
								echo '<li class="clearfix"></li>';
								
							// other items
							} else {

								if((($i - 1) % $col_clearfix_no) == 0){
									echo '<li class="clearfix"></li>';
								}
							
							}
						
						// paged
						} else {
						
							if(($i % $col_clearfix_no) == 0){
								echo '<li class="clearfix"></li>';
							}
								
						}
						
					// only grid item layout
					} else if($blog_layout_style == "Grid"){
						
						if(($i % $col_clearfix_no) == 0){
							echo '<li class="clearfix"></li>';
						}
					
					}

				}
			
			}

			$i++; 
		
		}

		echo '</ul>';
	
	} else {
		
		?>
		
		<p id="no-blog-posts" class="font-montserrat-reg"><?php echo esc_html('No posts to show', 'grace-minimal-theme'); ?></p>
		
		<?php
	
	}
	
?>

<!-- Blog posts navigation -->
<?php if($pagination_page == true){ ?>
	<div class="post-list-pagination">
		<?php grace_custom_post_pagination(); ?>
	</div>
<?php } ?>