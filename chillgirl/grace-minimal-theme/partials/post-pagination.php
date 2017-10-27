<!-- post pagination -->
<?php

	$defaults = array(
		'before'           => '<section class="post-pagination"><div id="post-nav-main" class="clearfix">',
		'after'            => '</div></section>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'next',
		'separator'        => ' ',
		'nextpagelink'     => '<span id="post-nav-next" class="post-nav-item hov-bk"><span class="font-montserrat-reg">'. esc_html(get_theme_mod('grace_page_pagination_next', 'Next Page')) . '<i class="fa fa-angle-right"></i></span></span>',
		'previouspagelink' => '<span id="post-nav-prev" class="post-nav-item hov-bk"><span class="font-montserrat-reg"><i class="fa fa-angle-left"></i>'. esc_html(get_theme_mod('grace_page_pagination_previous', 'Prev Page')) . '</span></span>',
		'pagelink'         => '%',
		'echo'             => 1
	);

	wp_link_pages( $defaults );

?>