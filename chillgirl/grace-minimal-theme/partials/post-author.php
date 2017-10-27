<?php

	if( ! defined( 'ABSPATH' ) ) exit; // exit if accessed directly

	// show author default
	$show_post_author = true;

	// check author section hidden
	if(class_exists('acf') && get_field('author_hide') != "" || get_theme_mod('grace_post_author_override') != ""){
	
		// set author to false
		$show_post_author = false;
	}

?>

<?php if($show_post_author == true){ ?>

	<?php if(get_the_author_meta('description') != ""){ ?>
	
		<!-- post author -->
		<section class="post-author clearfix">
			<div class="author-image">
				<?php echo get_avatar( get_the_author_meta('ID') ); ?>
			</div>
			<div class="post-author-content">
				<h4 class="font-montserrat-reg"><?php echo get_the_author(); ?></h4>
				<div class="page-content">
					<?php echo apply_filters('the_content', get_the_author_meta('description')); ?>
				</div>
				<ul class="widget-social-icons">
					<?php get_template_part('partials/social-icons'); ?>
				</ul>
			</div>
		</section>
		
	<?php } ?>
	
<?php } ?>