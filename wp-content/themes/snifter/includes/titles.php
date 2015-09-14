<?php
/**
 * Page titles
 *
 * @package      WordPress
 * @subpackage   MDG_Base
 */

/**
 * Handles selecting the correct page title to display.
 *
 * @param   boolean  $echo  If the title should be output to screen, default true.
 *
 * @return  string          The page title.
 */
function sn_title( $echo = true ) {
	$title = '';
	if ( is_home() ) {
		if ( get_option( 'page_for_posts', true ) ) {
			$title = get_the_title( get_option( 'page_for_posts', true ) );
		} else {
			$title = __( 'Latest Posts', 'roots' );
		} // if/else()
	} elseif ( is_archive() ) {
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		if ( $term ) {
			$title = $term->name;
		} elseif ( is_post_type_archive() ) {
			$title = get_queried_object()->labels->name;
		} elseif ( is_day() ) {
			$title = sprintf( __( '%s', 'roots' ), get_the_date() );
		} elseif ( is_month() ) {
			$title = sprintf( __( '%s', 'roots' ), get_the_date( 'F Y' ) );
		} elseif ( is_year() ) {
			$title = sprintf( __( '%s', 'roots' ), get_the_date( 'Y' ) );
		} elseif ( is_author() ) {
			$author = get_queried_object();
			$title  = sprintf( __( '%s', 'roots' ), $author->display_name );
		} else {
			$title = single_cat_title( '', false );
		}
	} elseif ( is_search() ) {
		$title = __( 'Portfolio Search Results', 'roots' );
	} elseif ( is_404() ) {
		$title = __( 'Not Found', 'roots' );
	} else {
		$title = get_the_title();
	} // if/elseif/else

	// Echo out the tile if needed.
	if ( $echo ) {
		echo esc_attr( $title );
	} // if()

	return $title;
} // sn_title()