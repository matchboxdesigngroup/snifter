<?php
/**
 * Snifter initial setup and constants
 *
 * @package      WordPress
 * @subpackage   Snifter
 */

/**
 * Sets up the theme.
 *
 * @return  Void
 */
function sn_setup() {
	// Make theme available for translation
	load_theme_textdomain( 'snifter', get_template_directory() . '/lang' );

	// Add post thumbnails (http://codex.wordpress.org/Post_Thumbnails)
	add_theme_support( 'post-thumbnails' );

	// Register Navigation Menus
	sn_register_nav_menus();

	// Tell the TinyMCE editor to use a custom stylesheet
	add_editor_style( '/assets/css/editor-style.css' );
} // sn_setup()
add_action( 'after_setup_theme', 'sn_setup' );



/**
 * Registers the navigation menus.
 *
 * @return  void
 */
function sn_register_nav_menus() {
	// Register wp_nav_menu() menus (http://codex.wordpress.org/Function_Reference/register_nav_menus)
	register_nav_menus(
		array(
			'primary_navigation' => __( 'Primary Navigation', 'snifter' ),
			'footer_navigation'  => __( 'Footer Navigation', 'snifter' ),
			'social_menu'        => __( 'Social Menu', 'snifter' ),
		)
	);
} // sn_register_nav_menus()



// Backwards compatibility for older than PHP 5.3.0
if ( ! defined( '__DIR__' ) ) {
	define( '__DIR__', dirname( __FILE__ ) );
} // if()