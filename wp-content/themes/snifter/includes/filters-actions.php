<?php
/**
 * Generic filters and actions.
 *
 * Filters and actions that are specific to a CPT should be in that type class
 *
 * @package      WordPress
 * @subpackage   Snifter
 *
 * @author       Matchbox Design Group <info@matchboxdesigngroup.com>
 */



if ( ! function_exists( 'sn_gforms_input_class' ) ) {
/**
 * Filters Gravity Forms CSS classes for a field.
 *
 * @link    http://www.gravityhelp.com/documentation/page/Gform_field_css_class
 *
 * @param   string  $classes  The CSS classes to be filtered, separated by empty spaces (i.e. "gfield custom_class").
 * @param   array   $field    Current field.
 * @param   array   $form     Current form.
 *
 * @return  string            The filtered CSS classes separated by empty spaces (i.e. "gfield custom_class").
 */
function sn_gforms_input_class( $classes, $field, $form ){
	$input_slug = sanitize_title( $field['label'] );
	$classes   .= " gfield-{$input_slug}";

	return $classes;
} // sn_gforms_input_class
add_action( 'gform_field_css_class', 'sn_gforms_input_class', 10, 3 );
} // if()



if ( ! function_exists( 'sn_remove_hicpo_pre_get_posts_filter' ) ) {
/**
 * Handles removing the hicpo_pre_get_posts filter.
 *
 * In the Intuitive Custom Post Order there is a template filter
 * that forces orderby=menu_order and order=ASC on active post types.
 * This causes issues when you do not want the menu_order behavior, such
 * as when you want a random order.
 *
 * @link    https://wordpress.org/plugins/intuitive-custom-post-order/
 *
 * @param   object  $query  The current query to filter.
 *
 * @return  object          The filtered query.
 */
function sn_remove_hicpo_pre_get_posts_filter( $query ) {
	global $wp_filter;

	if ( ! isset( $wp_filter['pre_get_posts'] ) or is_admin() ) {
		return $query;
	} // if()

	$pre_get_posts_filters = $wp_filter['pre_get_posts'];

	foreach ( $pre_get_posts_filters as $filters_key => $filters ) {
		foreach ( $filters as $filter_key => $filter ) {
			$correct_filter = ( strpos( $filter_key, 'hicpo_pre_get_posts' ) !== false );
			$has_function   = isset( $filter['function'] );

			if ( $correct_filter and $has_function ) {
				remove_filter( 'pre_get_posts', $filter['function'], $filters_key );
			} // if()
		} // foreach()
	} // foreach()


	return $query;
} // sn_remove_hicpo_pre_get_posts_filter()
add_filter( 'pre_get_posts', 'sn_remove_hicpo_pre_get_posts_filter', 0 );
} // if()
