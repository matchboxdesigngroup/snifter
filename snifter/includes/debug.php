<?php
/**
 * Snifter debug/development.
 *
 * @package     WordPress
 * @subpackage  Snifter
 * @since       Snifter 1.0.0
 */



/**
 * Enables Jetpack devleopment mode.
 *
 * @todo  Add localhost check.
 */
function sn_enable_jetpack_development_mode( $enabled ) {
	global  $sn_utilities;

	if ( $sn_utilities->is_localhost() ) {
		return true;
	} // if()

	return $enabled;
} // sn_enable_jetpack_development_mode()
add_filter( 'jetpack_development_mode', 'sn_enable_jetpack_development_mode' );



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