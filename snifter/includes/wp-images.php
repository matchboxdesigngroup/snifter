<?php
/**
 * Clean up gallery_shortcode.
 *
 * @package      WordPress
 * @subpackage   Snifter
 */


/**
 * Add class="thumbnail img-thumbnail" to attachment items.
 *
 * @param  string  $html  Attachment item HTML with classes added.
 *
 * @return string Attachment link HTML.
 */
function sn_attachment_link_class( $html ) {
	$postid = get_the_ID();
	$html   = str_replace( '<a', '<a class="thumbnail img-thumbnail"', $html );
	return $html;
} // sn_attachment_link_class()
add_filter( 'wp_get_attachment_link', 'sn_attachment_link_class', 10, 1 );