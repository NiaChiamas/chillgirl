<?php if(get_theme_mod('grace_post_comments_override') == ""){ ?>

	<!-- post comments -->
	<section class="post-comments-section">
		<?php comments_template('', true); ?>
	</section>
	
<?php } ?>