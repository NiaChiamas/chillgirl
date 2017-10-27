<?php
add_action('widgets_init', 'grace_social_widget');
function grace_social_widget()
{
    return register_widget('grace_social_widget');
}

/**
 * Adds widget for social icons.
 */
class grace_social_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'grace_social_widget', //ID
            esc_html__('Grace Social Widget', 'grace-minimal-theme'), // Name
            array('description' => esc_html__('Custom widget to display your social media links with icons for each.', 'grace-minimal-theme')) // Args
        );
    }

    public function widget($args, $instance)
    {
        $title = empty($instance['title']) ? '' : $instance['title'];
		
		echo $args['before_widget'];
		
		if(!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
			
		?>
			<ul class="widget-social-icons">
				<?php get_template_part('partials/social-icons'); ?>
			</ul>
		<?php

		echo $args['after_widget'];
		
    }

    public function form($instance)
    {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
	
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
			$title = "";
		}
		
        ?>
        
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'grace-minimal-theme'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
		
    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }

}

?>