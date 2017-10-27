<!-- footer -->
<footer id="site-footer">

	<!-- footer Instagram feed -->
	<?php $instagram_feed = get_theme_mod('grace_footer_instagram'); ?>
	<?php if($instagram_feed != "" && !is_page_template('templates/versions.php')){ ?>
		<div id="footer-instagram">
			<div class="container">
				<?php echo do_shortcode($instagram_feed);?>
			</div>
		</div>
	<?php } ?>

	<!-- footer bottom -->
	<?php if(get_theme_mod('grace_hide_footer_bottom') == ""){ ?>
		<div id="footer-bottom">
			<div class="container">
				<div id="footer-bottom-inner" class="clearfix">
				
					<?php if(get_theme_mod('grace_hide_footer_social') == ""){ ?>
						<!-- footer social icons -->
						<ul class="footer-social">
							<?php get_template_part('partials/social-icons'); ?>
						</ul>
					<?php } ?>
					
					<?php if(get_theme_mod('grace_hide_scrolltop') == ""){ ?>
						<!-- scroll to top -->
						<div id="scroll-top" <?php if(get_theme_mod('grace_rounded_scrolltop') !=""){ echo 'class="rounded"'; } ?>>
							<span class="fa fa-angle-up"></span>
						</div>
					<?php } ?>
					
					<!-- copyright text -->
					<p id="footer-copyright" class="font-montserrat-reg"><?php echo get_theme_mod('grace_footer_text', '&copy; 2017 Lucid Themes'); ?></p>
				
				</div>
			</div>
		</div>
	<?php } ?>

</footer>

<?php wp_footer(); ?>
</body>
</html>