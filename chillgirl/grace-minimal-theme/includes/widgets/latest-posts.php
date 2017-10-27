<?php
add_action('widgets_init', 'grace_latest_posts_widget');
function grace_latest_posts_widget()
{
    return register_widget('grace_latest_posts_widget');
}

/**
 * Adds widget for recent Post in footer.
 */
class grace_latest_posts_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'grace_latest_posts_widget', //ID
            esc_html__('Grace Latest Posts Widget', 'grace-minimal-theme'), // Name
            array('description' => esc_html__('Custom widget to display latest posts with an image. Two different styles of layout and category select.', 'grace-minimal-theme'),) // Args
        );
    }

    public function widget($args, $instance)
    {
		$title = empty($instance['title']) ? '' : $instance['title'];
        $number_of_posts = !empty($instance['number_of_posts']) ? apply_filters('widget_title', $instance['number_of_posts']) : 5;
		$widget_post_style = empty($instance['widget_post_style']) ? '' : $instance['widget_post_style'];
		$latest_post_category = empty($instance['latest_post_category']) ? '' : $instance['latest_post_category'];
		
		$hide_title = isset( $instance['hide_title'] ) ? $instance['hide_title'] : false;
		$hide_date = isset( $instance['hide_date'] ) ? $instance['hide_date'] : false;
		
        echo $args['before_widget'];
        if (!empty($title)){
			echo $args['before_title'] . $title . $args['after_title'];
		}
		
		$category = "";
		
		if($latest_post_category != "all_categories"){
			$category = $latest_post_category;
		}

		$latest_blog_posts = get_posts(array( 'posts_per_page' => $number_of_posts, 'post_type' => 'post', 'category_name' => $category)); 
		
		?>
		
		<?php if(!empty($latest_blog_posts)){ ?>
		
			<ul class="recent_posts_list">
			
				<?php foreach($latest_blog_posts as $latest_blog_post){ ?>
			
					<li <?php if($widget_post_style == "widget_posts_wide"){ ?> class="grace_latest_posts_wide" <?php } ?>>
					
						<a href="<?php echo get_permalink($latest_blog_post->ID); ?>">
						
							<?php if($widget_post_style == "widget_posts_wide"){ ?>
							
								<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($latest_blog_post->ID)); ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id($latest_blog_post->ID) , '_wp_attachment_image_alt', true); ?>" class="image" />
								
								<?php if($hide_title == ""){ ?>
									<h4 class="font-montserrat-reg"><?php echo esc_attr($latest_blog_post->post_title); ?></h4>
								<?php } ?>
								
								<?php if($hide_date == ""){ ?>
									<p class="font-opensans-reg"><?php echo esc_attr(get_the_date(get_option('date_format'), $latest_blog_post->ID)); ?></p>
								<?php } ?>
								
							<?php } else { ?>
							
								<div class="row">
									<div class="col-xlarge-5 col-medium-4 col-small-5">
										<img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($latest_blog_post->ID)); ?>" alt="<?php echo get_post_meta(get_post_thumbnail_id($latest_blog_post->ID) , '_wp_attachment_image_alt', true); ?>" class="image" />
									</div>
									<div class="col-xlarge-7 col-medium-8 col-small-7 grace_latest_post_col_right">
									
										<?php if($hide_title == ""){ ?>
											<h4 class="font-montserrat-reg"><?php echo esc_attr($latest_blog_post->post_title); ?></h4>
										<?php } ?>
										
										<?php if($hide_date == ""){ ?>
											<p class="font-opensans-reg"><?php echo esc_attr(get_the_date(get_option('date_format'), $latest_blog_post->ID)); ?></p>
										<?php } ?>
										
									</div>
								</div>
								
							<?php } ?>
						</a>
						
					</li>
				
				<?php } ?>
			
			</ul>
			
		<?php } ?>
		
        <?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {
	
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'number_of_posts' => '', 'widget_post_style' => '', 'hide_title' => '', 'hide_date' => '') );
	
        if (isset($instance['title']) && isset($instance['number_of_posts'])) {
            $title = $instance['title'];
            $number_of_posts = $instance['number_of_posts'];
        } else {
            $title = esc_html__('Latest Posts', 'grace-minimal-theme');
            $number_of_posts = 3;
        }
		
		$hide_title = isset( $instance['hide_title'] ) ? (bool) $instance['hide_title'] : false;
		$hide_date = isset( $instance['hide_date'] ) ? (bool) $instance['hide_date'] : false;
		
		$widget_post_style = $instance['widget_post_style'];
		
        ?>
		
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'grace-minimal-theme'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
        </p>
		
		<p>
			<?php $terms = get_terms( array('taxonomy' => 'category')); ?>
			<label for="<?php echo esc_attr( $this->get_field_id( 'latest_post_category' ) ); ?>"><?php esc_html_e('Select Category:', 'grace-minimal-theme'); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'latest_post_category' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'latest_post_category' ) ); ?>" class="widefat">
				<option value="all_categories" <?php selected( $instance['latest_post_category'], 'all_categories' ); ?>><?php esc_html_e('All Categories', 'grace-minimal-theme'); ?></option>
				<?php foreach($terms as $term){ ?>
					<option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $instance['latest_post_category'], $term->slug ); ?>><?php echo esc_html( $term->name ); ?></option>
				<?php } ?>
			</select>
		</p>
		
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'widget_post_style' ) ); ?>"><?php esc_html_e('Widget Layout:', 'grace-minimal-theme'); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name( 'widget_post_style' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'widget_post_style' ) ); ?>" class="widefat">
				<option value="widget_posts_small" <?php selected( $instance['widget_post_style'], 'widget_posts_small' ); ?>><?php esc_html_e('Small', 'grace-minimal-theme'); ?></option>
				<option value="widget_posts_wide" <?php selected( $instance['widget_post_style'], 'widget_posts_wide' ); ?>><?php esc_html_e('Wide', 'grace-minimal-theme'); ?></option>
			</select>
		</p>
		
        <p>
            <label
                for="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>"><?php esc_html_e('Number of posts to show:', 'grace-minimal-theme'); ?></label>
            <input size="3" maxlength="2" id="<?php echo esc_attr($this->get_field_id('number_of_posts')); ?>" name="<?php echo esc_attr($this->get_field_name('number_of_posts')); ?>" type="text" value="<?php echo esc_attr($number_of_posts); ?>"/>
        </p>
		
		<p>
			<input class="checkbox" type="checkbox"<?php checked($hide_title); ?> id="<?php echo esc_attr($this->get_field_id('hide_title')); ?>" name="<?php echo esc_attr($this->get_field_name('hide_title')); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id('hide_title')); ?>"><?php esc_html_e('Hide Post Title', 'grace-minimal-theme'); ?></label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox"<?php checked($hide_date); ?> id="<?php echo esc_attr($this->get_field_id('hide_date')); ?>" name="<?php echo esc_attr($this->get_field_name('hide_date')); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id('hide_date')); ?>"><?php esc_html_e('Hide Post Date', 'grace-minimal-theme'); ?></label>
		</p>
		
    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['number_of_posts'] = (!empty($new_instance['number_of_posts'])) ? strip_tags($new_instance['number_of_posts']) : '';
		$instance['widget_post_style'] = $new_instance['widget_post_style'];
		$instance['latest_post_category'] = $new_instance['latest_post_category'];
		
		$instance['hide_title'] = isset( $new_instance['hide_title'] ) ? (bool) $new_instance['hide_title'] : false;
		$instance['hide_date'] = isset( $new_instance['hide_date'] ) ? (bool) $new_instance['hide_date'] : false;

        return $instance;
    }

}

?>