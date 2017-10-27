<?php
add_action('widgets_init', 'grace_about_widget');
function grace_about_widget()
{
    return register_widget('grace_about_widget');
}

/**
 * Adds about widget.
 */
class grace_about_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'grace_about_widget', //ID
            esc_html__('Grace About Widget', 'grace-minimal-theme'), // Name
            array('description' => esc_html__('Custom widget to tell people a little bit about yourself. All fields in the widget are optional.', 'grace-minimal-theme'),) // Args
        );
    }

    public function widget($args, $instance)
    {
		$image = empty($instance['image']) ? '' : $instance['image'];
        $widget_heading = !empty($instance['widget_heading']) ? $instance['widget_heading'] : '';
        $heading = !empty($instance['heading']) ? $instance['heading'] : '';
		$text_content = ! empty( $instance['text_content'] ) ? $instance['text_content'] : '';
		$hide_social = isset( $instance['hide_social'] ) ? $instance['hide_social'] : false;
		$center_widget = isset( $instance['center_widget'] ) ? $instance['center_widget'] : false;
		
		
        echo $args['before_widget'];

		?>
		
		<?php if(!empty($widget_heading)){ ?>
			<h3 class="font-montserrat-reg"><?php echo esc_attr($widget_heading); ?></h3>
		<?php } ?>
		
		<?php if($image != ""){ ?>
			<img src="<?php echo esc_attr($image); ?>" alt="About Me" class="image <?php if($center_widget != ""){ ?>about-widget-center<?php } ?>">
		<?php } ?>
		
		<?php if(!empty($heading)){ ?>
			<h4 class="font-montserrat-reg <?php if($center_widget != ""){ ?>about-widget-center<?php } ?>"><?php echo esc_attr($heading); ?></h4>
		<?php } ?>
		
		<?php if(!empty($text_content)){ ?>
			<div class="page-content <?php if($center_widget != ""){ ?>about-widget-center<?php } ?>">
				<?php echo apply_filters('the_content', $text_content); ?>
			</div>
		<?php } ?>
		
		<?php if($hide_social == ""){ ?>
			<ul class="widget-social-icons <?php if($center_widget != ""){ ?>about-widget-center<?php } ?>">
				<?php get_template_part('partials/social-icons'); ?>
			</ul>
		<?php } ?>

        <?php
        echo $args['after_widget'];
    }

    public function form($instance)
    {
	
		$instance = wp_parse_args( (array) $instance, array( 'widget_heading' => '', 'heading' => '', 'text_content' => '', 'hide_social' => '', 'center_widget' => '', 'image' => '' ) );

        $widget_heading = $instance['widget_heading'];
		
        $heading = $instance['heading'];
        $text_content = $instance['text_content'];
		
		$hide_social = isset( $instance['hide_social'] ) ? (bool) $instance['hide_social'] : false;
		
		$center_widget = isset( $instance['center_widget'] ) ? (bool) $instance['center_widget'] : false;
		
		$image = '';
        if(isset($instance['image']))
        {
            $image = $instance['image'];
        }
		
        ?>
		
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('widget_heading')); ?>"><?php esc_html_e('Widget Heading:', 'grace-minimal-theme'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('widget_heading')); ?>" name="<?php echo esc_attr($this->get_field_name('widget_heading')); ?>" type="text" value="<?php echo esc_attr($widget_heading); ?>"/>
        </p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('image')); ?>">Image URL:</label><br />
			<input type="text" class="widefat" name="<?php echo esc_attr($this->get_field_name('image')); ?>" id="<?php echo esc_attr($this->get_field_id('image')); ?>" value="<?php echo esc_attr($instance['image']); ?>" />
		</p>
		
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('heading')); ?>"><?php esc_html_e('Heading:', 'grace-minimal-theme'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('heading')); ?>" name="<?php echo esc_attr($this->get_field_name('heading')); ?>" type="text" value="<?php echo esc_attr($heading); ?>"/>
        </p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('text_content')); ?>"><?php esc_html_e('Text content:', 'grace-minimal-theme'); ?></label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id('text_content')); ?>" name="<?php echo esc_attr($this->get_field_name('text_content')); ?>"><?php echo esc_textarea( $instance['text_content'] ); ?></textarea>
		</p>

		<p>
			<input class="checkbox" type="checkbox"<?php checked($hide_social); ?> id="<?php echo esc_attr($this->get_field_id('hide_social')); ?>" name="<?php echo esc_attr($this->get_field_name('hide_social')); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id('hide_social')); ?>"><?php esc_html_e('Hide Social Icons', 'grace-minimal-theme'); ?></label>
		</p>
		
		<p>
			<input class="checkbox" type="checkbox"<?php checked($center_widget); ?> id="<?php echo esc_attr($this->get_field_id('center_widget')); ?>" name="<?php echo esc_attr($this->get_field_name('center_widget')); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id('center_widget')); ?>"><?php esc_html_e('Widget Centred', 'grace-minimal-theme'); ?></label>
		</p>
		
    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
		$instance['image'] = $new_instance['image'];
        $instance['widget_heading'] = (!empty($new_instance['widget_heading'])) ? strip_tags($new_instance['widget_heading']) : '';
        $instance['heading'] = (!empty($new_instance['heading'])) ? strip_tags($new_instance['heading']) : '';
        $instance['text_content'] = (!empty($new_instance['text_content'])) ? strip_tags($new_instance['text_content']) : '';
		$instance['hide_social'] = isset( $new_instance['hide_social'] ) ? (bool) $new_instance['hide_social'] : false;
		$instance['center_widget'] = isset( $new_instance['center_widget'] ) ? (bool) $new_instance['center_widget'] : false;
        return $instance;
    }

}

?>