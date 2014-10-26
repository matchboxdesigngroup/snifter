<?php
/**
 * Snifter debug/development.
 *
 * @package     WordPress
 * @subpackage  Snifter
 * @since       Snifter 1.0.0
 */

global  $sn_utilities;

/**
 * Enables Jetpack devleopment mode.
 *
 * @todo  Add localhost check.
 */
if ( $sn_utilities->is_localhost() ) {
	add_filter( 'jetpack_development_mode', '__return_true' );
} // if()


if ( ! function_exists( 'pp' ) ) {
	/**
	 * Pretty Print Debug Function
	 *
	 * <code>
	 * pp( $something_to_pretty_print );
	 * </code>
	 *
	 * @todo  Add localhost check.
	 *
	 * @param mixed   $value Any value.
	 *
	 * @return Void
	 */
	function pp( $value ) {
		global $sn_utilities;

		$is_localhost = $sn_utilities->is_localhost();
		if ( ! $is_localhost ) return;
		echo '<pre>';
		if ( gettype( $value ) === 'boolean' ) {
			var_dump( $value );
		} else {
			print_r( $value );
		} // if/else()
		echo '</pre>';
	} // pp()
} // if()