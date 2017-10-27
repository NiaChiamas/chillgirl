<?php
/**===================================== **
 * This is the main framework functions.
 * These are also theme specific functions.
 *====================================== **/
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
 
require(get_template_directory() . '/includes/tgmp/class-tgm-plugin-activation.php');

add_action( 'tgmpa_register', 'grace_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
**/
function grace_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
		
		array(
			'name'      => esc_html__( 'Advanced Custom Fields Pro', 'grace-minimal-theme' ),
			'slug'      => 'advanced-custom-fields-pro',
			'source'    => get_template_directory() . '/includes/acf/advanced-custom-fields-pro.zip',
 			'required'  => true,
 		),
		
		array(
			'name'      => esc_html__( 'Contact Form 7', 'grace-minimal-theme' ),
			'slug'      => 'contact-form-7',
 			'required'  => false,
 		),

		array(
			'name'      => esc_html__( 'Instagram Feed', 'grace-minimal-theme' ),
			'slug'      => 'instagram-feed',
 			'required'  => false,
 		),

    );
	
	$config = array(
 		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
 		'default_path' => '',                      // Default absolute path to bundled plugins.
 		'menu'         => 'tgmpa-install-plugins', // Menu slug.
 		'parent_slug'  => 'themes.php',            // Parent menu slug.
 		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
 		'has_notices'  => true,                    // Show admin notices or not.
 		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
 		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
 		'is_automatic' => true,                    // Automatically activate plugins after installation or not.
 		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'grace-minimal-theme' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'grace-minimal-theme' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'grace-minimal-theme' ),
			'updating'                        => esc_html__( 'Updating Plugin: %s', 'grace-minimal-theme' ),
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'grace-minimal-theme' ),
			'notice_can_install_required'     => _n_noop('This theme requires the following plugin: %1$s.','This theme requires the following plugins: %1$s.', 'grace-minimal-theme'),
			'notice_can_install_recommended'  => _n_noop('This theme recommends the following plugin: %1$s.','This theme recommends the following plugins: %1$s.', 'grace-minimal-theme'),
			'notice_ask_to_update'            => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.','The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'grace-minimal-theme'),
			'notice_ask_to_update_maybe'      => _n_noop('There is an update available for: %1$s.','There are updates available for the following plugins: %1$s.', 'grace-minimal-theme'),
			'notice_can_activate_required'    => _n_noop('The following required plugin is currently inactive: %1$s.','The following required plugins are currently inactive: %1$s.', 'grace-minimal-theme'),
			'notice_can_activate_recommended' => _n_noop('The following recommended plugin is currently inactive: %1$s.','The following recommended plugins are currently inactive: %1$s.', 'grace-minimal-theme'),
			'install_link'                    => _n_noop('Begin installing plugin','Begin installing plugins', 'grace-minimal-theme'),
			'update_link'                     => _n_noop('Begin updating plugin','Begin updating plugins', 'grace-minimal-theme'),
			'activate_link'                   => _n_noop('Begin activating plugin','Begin activating plugins', 'grace-minimal-theme'),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'grace-minimal-theme' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'grace-minimal-theme' ),
			'activated_successfully'          => esc_html__( 'The following plugin was activated successfully:', 'grace-minimal-theme' ),
			'plugin_already_active'           => esc_html__( 'No action taken. Plugin %1$s was already active.', 'grace-minimal-theme' ),
			'plugin_needs_higher_version'     => esc_html__( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'grace-minimal-theme' ),
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %1$s', 'grace-minimal-theme' ),
			'dismiss'                         => esc_html__( 'Dismiss this notice', 'grace-minimal-theme' ),
			'notice_cannot_install_activate'  => esc_html__( 'There are one or more required or recommended plugins to install, update or activate.', 'grace-minimal-theme' ),
			'contact_admin'                   => esc_html__( 'Please contact the administrator of this site for help.', 'grace-minimal-theme' ),
			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
 	);

    tgmpa( $plugins, $config );
}