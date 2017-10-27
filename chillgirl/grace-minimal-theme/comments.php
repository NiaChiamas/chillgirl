<?php
	
	if( ! defined( 'ABSPATH' ) ) exit; // exit if accessed directly

	if ( post_password_required()){ return; }
?>

<?php if(comments_open() || have_comments()){ ?>

	<?php $num_comments = number_format_i18n(get_comments_number()); ?>

	<div class="post-comments-area <?php if(is_page()){ echo "page-comments"; } ?> <?php if($num_comments == 0){ echo "zero-comments"; } ?>">

		<div id="comments" class="comments-area">

			<?php if(have_comments()){ ?>

				<div class="post-comments-heading">
					<h4 class="font-montserrat-reg post-comment-count"><?php esc_html_e( 'Comments', 'grace-minimal-theme' ); ?> <?php if($num_comments >= 1){ echo "(" .esc_attr($num_comments) . ')'; } ?></h4>
				</div>

				<ul class="comment-list">
					<?php
						wp_list_comments( array(
							'style'      	=> 'ol',
							'short_ping' 	=> true,
							'callback'		=> 'grace_theme_comment'
						) );
					?>
				</ul>

				<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' )){ ?>
					<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
						<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'grace-minimal-theme' ); ?></h1>
						<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'grace-minimal-theme')); ?></div>
						<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'grace-minimal-theme' )); ?></div>
					</nav>
				<?php } ?>

				<?php if(!comments_open()){ ?>
					<p class="no-comments font-opensans-reg"><?php esc_html_e( 'Comments are closed.', 'grace-minimal-theme' ); ?></p>
				<?php } ?>
			
			<?php } ?>

			<?php 
			
				$fields =  array(
					'author' => '<div class="row"><div class="col-xlarge-6"><input id="author" name="author" type="text" class="input-field" placeholder="Name (Required)" /></div>',
					'email' => '<div class="col-xlarge-6"><input id="email" name="email" type="text" class="input-field" placeholder="Email (Required)" /></div></div>',
					'url' => '<div class="row"><div class="col-xlarge-12"><input id="url" name="url" type="text" class="input-field" placeholder="Website" /></div></div>',
				);
			
				$args = array(
					'title_reply' => 'Leave a comment',
					'cancel_reply_before' => '',
					'cancel_reply_after' => '',
					'cancel_reply_link' => '<span class="cancel-reply-text">Cancel Reply</span><i class="fa fa-times mobile-reply-cancel" aria-hidden="true"></i>',
					'title_reply_to' => 'Comment Reply',
					'comment_field' =>  '<div class="row"><div class="col-xlarge-12"><textarea id="comment" name="comment" class="input-textarea" placeholder="Comment (Required)"></textarea></div></div>',
					'fields' => apply_filters( 'comment_form_default_fields', $fields ),
					'class_submit' => 'primary-button font-montserrat-reg hov-bk',
					'label_submit' => esc_html(get_theme_mod('grace_comment_submit_text', 'Post Comment')),
				);
			
				comment_form($args); 

			?>

		</div>

	</div>

<?php } ?>