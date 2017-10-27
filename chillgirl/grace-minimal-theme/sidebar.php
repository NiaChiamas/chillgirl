<?php

	// check acf installed
	if(class_exists('acf')){
	
		// define page id variable
		$page_id = "";
	
		// check if is home page
		if(isset($home_page_id)){

			// get page id from home page id variable
			$page_id = $home_page_id;
			
		// check if is page for posts
		} else if(get_option( 'page_for_posts' )){ 
		
			// set from post for posts to true, used for pagination option
			$from_page_for_posts = true;
		
			// page id is the id of the page for posts
			$page_id = get_option( 'page_for_posts' );
		
		// else get default page ID
		} else {
		
			$page_id = get_the_ID();
		
		}
		
		// get selected sidebar
		$sidebar_selection = get_field('sidebar_select', $page_id);
		
		if($sidebar_selection != ""){
		
			// select the default sidebar
			dynamic_sidebar($sidebar_selection);

		} else {
			
			// select the default sidebar
			dynamic_sidebar('default_sidebar');
			
		}
	
	// acf not installed
	} else {
	
		// show default sidebar
		dynamic_sidebar('default_sidebar');
	
	}
	
	wp_reset_postdata();

?>