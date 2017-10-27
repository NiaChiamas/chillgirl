<?php
add_action('widgets_init', 'grace_promo_widget');
function grace_promo_widget()
{
    return register_widget('grace_promo_widget');
}

/**
 * Adds widget for promo boxes.
 */
class grace_promo_widget extends WP_Widget
{
    function __construct()
    {
        parent::__construct(
            'grace_promo_widget', //ID
            esc_html__('Grace Promo Box Widget', 'grace-minimal-theme'), // Name
            array('description' => esc_html__('Custom widget to display a promo box.', 'grace-minimal-theme')) // Args
        );
    }

    public function widget($args, $instance)
    {
		$title = empty($instance['title']) ? '' : $instance['title'];
		$image = empty($instance['image']) ? '' : $instance['image'];
		$heading = !empty($instance['heading']) ? $instance['heading'] : '';
		$promo_link = !empty($instance['promo_link']) ? $instance['promo_link'] : '';
		$link_new_tab = isset( $instance['link_new_tab'] ) ? $instance['link_new_tab'] : false;
		
		echo $args['before_widget'];
		
		if(!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
		
		?>
		
		<a <?php if(!empty($promo_link)){ echo 'href="'. esc_url($promo_link) . '"'; if($link_new_tab != ""){ echo 'target="_blank"'; } } ?> class="widget-promo-item">
		
			<?php if($image != ""){ ?>
				<img src="<?php echo esc_attr($image); ?>" alt="Promo Item" class="image">
			<?php } ?>
			
			<?php if(!empty($heading)){ ?>
				<div class="promo-item-inside">
					<h4 class="font-montserrat-reg"><?php echo esc_attr($heading); ?></h4>
				</div>
			<?php } ?>
		
		</a>

		<?php
		
		echo $args['after_widget'];
		
    }

    public function form($instance)
    {
	
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'image' => '', 'heading' => '', 'promo_link' => '', 'link_new_tab' => '' ) );
	
        if (isset($instance['title'])) {
            $title = $instance['title'];
        }
		
		$image = '';
        if(isset($instance['image']))
        {
            $image = $instance['image'];
        }
		
		if (isset($instance['heading'])) {
            $heading = $instance['heading'];
        }
		
		if (isset($instance['promo_link'])) {
            $promo_link = $instance['promo_link'];
        }
		
		$link_new_tab = isset( $instance['link_new_tab'] ) ? (bool) $instance['link_new_tab'] : false;

        ?>
        
		<p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'grace-minimal-theme'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
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
            <label for="<?php echo esc_attr($this->get_field_id('promo_link')); ?>"><?php esc_html_e('Link:', 'grace-minimal-theme'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('promo_link')); ?>" name="<?php echo esc_attr($this->get_field_name('promo_link')); ?>" type="text" value="<?php echo esc_attr($promo_link); ?>"/>
        </p>
		
		<p>
			<input class="checkbox" type="checkbox"<?php checked($link_new_tab); ?> id="<?php echo esc_attr($this->get_field_id('link_new_tab')); ?>" name="<?php echo esc_attr($this->get_field_name('link_new_tab')); ?>" />
			<label for="<?php echo esc_attr($this->get_field_id('link_new_tab')); ?>"><?php esc_html_e('Open in new tab', 'grace-minimal-theme'); ?></label>
		</p>
		
    <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		$instance['image'] = $new_instance['image'];
		$instance['heading'] = (!empty($new_instance['heading'])) ? strip_tags($new_instance['heading']) : '';
		$instance['promo_link'] = (!empty($new_instance['promo_link'])) ? strip_tags($new_instance['promo_link']) : '';
		$instance['link_new_tab'] = isset( $new_instance['link_new_tab'] ) ? (bool) $new_instance['link_new_tab'] : false;
        return $instance;
    }

}

?>