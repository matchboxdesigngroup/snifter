<?php
/**
 * Register sidebars and widgets
 *
 * @link https://codex.wordpress.org/WordPress_Widgets
 *
 * @package      WordPress
 * @subpackage   Snifter
 */

/**
 * Initializes all widgets and sidebars.
 *
 * @see http://codex.wordpress.org/Function_Reference/register_sidebar
 * @see https://codex.wordpress.org/Function_Reference/register_widget
 *
 * @return  Void
 */
function sn_widgets_init() {
	// Register Sidebars
	sn_register_sidebars();

	// Add Widgets
	sn_add_widgets();
} // sn_widgets_init()
add_action( 'widgets_init', 'sn_widgets_init' );



/**
 * Handles registering sidebar positions.
 *
 * @return  void
 */
function sn_register_sidebars() {
	// Primary Sidebar
	register_sidebar(
		array(
			'name'          => __( 'Primary', 'snifter' ),
			'id'            => 'sidebar-primary',
			'before_widget' => '<section class="widget primary-sidebar %1$s %2$s"><div class="widget-inner">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);
} // sn_register_sidebars()



/**
 * Handles adding widgets
 *
 * @return  void
 */
function sn_add_widgets() {
	$widgets   = array();

	// Example Stub Widget
	$widgets[] = array(
		'class' => 'SN_Stub_Widget',
		'file'  => 'class-sn-stub-widget',
	);

	// Include widgets
	foreach ( $widgets as $widget ) {
		$file  = ( isset( $widget['file'] ) ) ? $widget['file'] : false;
		$class = ( isset( $widget['class'] ) ) ? $widget['class'] : false;

		// We forgot something...
		if ( ! $file or ! $class or $file == '' or $class == '' ) {
			continue;
		} // if()

		$has_php = ( strpos( $file, '.php' ) !== false );
		$file    = ( $has_php ) ? $file : "{$file}.php";
		require_once locate_template( "classes/widgets/{$file}" );
		register_widget( $class );
	} // foreach()
} // sn_add_widgets()