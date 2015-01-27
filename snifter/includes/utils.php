<?php
/**
 * Utility functions
 *
 * @package      WordPress
 * @subpackage   Snifter
 */

/**
 * Adds one function to multiple filters.
 *
 * <code>
 * <?php
 * $flters = array(
 *  'filter_1',
 *  'filter_2',
 * );
 * add_filters( $filters, 'function_name' ); ?>
 * </code>
 *
 * @param  array   $tags      The filters to add.
 * @param  string  $function  The function name to add
 *
 * @return Void
 */
function add_filters( $tags, $function ) {
	foreach ( $tags as $tag ) {
		add_filter( $tag, $function );
	} // foreach()
} // add_filters()



/**
 * Checks to see if an element is empty.
 *
 * <code>
 * is_element_empty( '&lt;p&gt;test&lt;/p&gt;' ); // false
 * </code>
 *
 * @param   string   $element  The element to check against.
 *
 * @return  boolean            If the element is empty.
 */
function is_element_empty( $element ) {
	$element = trim( $element );
	return empty( $element ) ? false : true;
} // is_element_empty()
