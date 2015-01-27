<?php
/**
 * Configuration file.
 */

/**
 * Handles setting theme configurations
 * Sets theme features, theme constants, and main/sidebar classes.
 *
 * @package      WordPress
 * @subpackage   Snifter
 */

// Add Theme Support
add_theme_support( 'nice-search' ); // Enable /?s= to /search/ redirect

/**
 * Google Analytics ID (UA-XXXXX-Y).
 *
 * @link https://support.google.com/analytics/answer/1032385?hl=en
 */
define( 'GOOGLE_ANALYTICS_ID', '' );

/**
 * How many words the_excerpt() should contain.
 *
 * @link http://codex.wordpress.org/Function_Reference/the_excerpt
 */
define( 'POST_EXCERPT_LENGTH', 40 );

/**
 * Relative path to wp-content/plugins
 */
define( 'RELATIVE_PLUGIN_PATH',  str_replace( home_url() . '/', '', plugins_url() ) );

/**
 * Relative path to wp-content
 */
define( 'RELATIVE_CONTENT_PATH', str_replace( home_url() . '/', '', content_url() ) );

/**
 * The current theme name
 */
$template_directory = explode( '/themes/', get_template_directory() );
define( 'THEME_NAME', next( $template_directory ) );

/**
 * Relative path to wp-content/themes/{{THEME_NAME}}
 */
define( 'THEME_PATH', RELATIVE_CONTENT_PATH . '/themes/' . THEME_NAME );

/**
 * Selects the column class the .main element.
 * The class is dependent upon if the sidebar is visible or not.
 *
 * <code>
 * <?php echo esc_attr( sn_main_class() ); ?>
 * </code>
 *
 * @return string  The correct column class
 */
function sn_main_class() {
	if ( sn_display_sidebar() and ! is_page_template( 'template-pattern-library.php' ) ) {
		// Classes on pages with the sidebar
		$class = 'has-sidebar';
	} else {
		// Classes on full width pages
		$class = 'no-sidebar';
	} // if/else()

	return $class;
} // sn_main_class()



/**
 * Define which pages shouldn't have the sidebar
 *
 * @see lib/sidebar.php for more details
 *
 * @return boolean If the sidebar should be displayed.
 */
function sn_display_sidebar() {
	$sidebar_config = new SN_Sidebar(
		/**
		 * Conditional tag checks (http://codex.wordpress.org/Conditional_Tags)
		 * Any of these conditional tags that return true won't show the sidebar
		 *
		 * To use a function that accepts arguments, use the following format:
		 *
		 * array('function_name', array('arg1', 'arg2'))
		 *
		 * The second element must be an array even if there's only 1 argument.
		 */
		array(),
		/**
		 * Page template checks (via is_page_template())
		 * Any of these page templates that return true won't show the sidebar
		 */
		array()
	);

	return apply_filters( 'sn_display_sidebar', $sidebar_config->display );
} // sn_display_sidebar()



/**
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 1140px is the default Bootstrap container width.
 */
global $content_width;
if ( ! isset( $content_width ) ) {
	$content_width = 1200;
} // if()