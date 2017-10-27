<?php
add_action('widgets_init', 'grace_instagram_widget');
function grace_instagram_widget()
{
    return register_widget('grace_instagram_widget');
}

/**
 * Adds widget for Instagram feed.
 */
class grace_instagram_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'grace_instagram_widget', //ID
            esc_html__('Grace Instagram Widget', 'grace-minimal-theme'), // Name
            array('description' => esc_html__('Custom widget to display an Instagram feed in a sidebar. Place a shortcode for your plugin of choice in the text field. Use of the Instagram feed plugin recommended with the theme is advised.', 'grace-minimal-theme'),) // Args
        );
    }

    public function widget($args, $instance)
    {
		$instagram_feed = "";
	
		$title = empty($instance['title']) ? '' : $instance['title'];
		$instagram_feed = !empty($instance['instagram_feed']) ? $instance['instagram_feed'] : '';
		
		echo $args['before_widget'];
		
		if(!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
			
		if(!empty($instagram_feed)){
			echo do_shortcode($instagram_feed);
		}

		echo $args['after_widget'];
		
    }

    public function form($instance)
    {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'instagram_feed' => '' ) );
	
		$instagram_feed = "";
	
        if (isset($instance['title']) && isset($instance['instagram_feed'])) {
            $title = $instance['title'];
            $instagram_feed = $instance['instagram_feed'];
        } else {
            $title = esc_html__('Instagram', 'grace-minimal-theme');
        }
        ?>
        
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'grace-minimal-theme'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
		
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('instagram_feed')); ?>"><?php esc_html_e('Instagram feed shortcode:', 'grace-minimal-theme'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram_feed')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram_feed')); ?>" type="text" value="<?php echo esc_attr($instagram_feed); ?>">
        </p>
		
    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['instagram_feed'] = $new_instance['instagram_feed'];
        return $instance;
    }

}

?>