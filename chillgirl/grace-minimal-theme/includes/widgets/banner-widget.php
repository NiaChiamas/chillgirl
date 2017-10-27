<?php
add_action('widgets_init', 'grace_banner_widget');
function grace_banner_widget()
{
    return register_widget('grace_banner_widget');
}

/**
 * Adds widget for banner image.
 */
class grace_banner_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'grace_banner_widget', //ID
            esc_html__('Grace Banner Widget', 'grace-minimal-theme'), // Name
            array('description' => esc_html__('Custom widget to display a banner image.', 'grace-minimal-theme')) // Args
        );
    }

    public function widget($args, $instance)
    {
		$title = empty($instance['title']) ? '' : $instance['title'];
		$image = empty($instance['image']) ? '' : $instance['image'];
		
		echo $args['before_widget'];
		
		if(!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
			
		if($image != ""){
			?>
			<img src="<?php echo esc_attr($image); ?>" alt="Banner Image" class="image">
			<?php
		}

		echo $args['after_widget'];
		
    }

    public function form($instance)
    {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'image' => '' ) );
	
        if (isset($instance['title'])) {
            $title = $instance['title'];
        }
		
		$image = '';
        if(isset($instance['image']))
        {
            $image = $instance['image'];
        }
		
        ?>
        
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'grace-minimal-theme'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('image')); ?>">Image URL:</label><br />
			<input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('image')); ?>" id="<?php echo esc_attr($this->get_field_id('image')); ?>" value="<?php echo esc_attr($instance['image']); ?>" />
		</p>
		
		
		
    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['image'] = $new_instance['image'];
        return $instance;
    }

}

?>