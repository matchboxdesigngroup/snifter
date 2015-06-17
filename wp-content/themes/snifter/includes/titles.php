<?php
function sn_titles( $display = true ) {
	$taxonomy_post_format_titles = sn_taxonomy_post_format_titles( false );
	$archive_titles              = sn_archive_titles( false );
} // sn_titles()

function sn_taxonomy_post_format_titles( $display = true ) {
	$title = '';

	if ( is_tax( 'post_format', 'post-format-aside' ) ) {
		$title = __( 'Asides', 'twentyfourteen' );
	} elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
		$title = __( 'Images', 'twentyfourteen' );
	} elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
		$title = __( 'Videos', 'twentyfourteen' );
	} elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
		$title = __( 'Audio', 'twentyfourteen' );
	} elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
		$title = __( 'Quotes', 'twentyfourteen' );
	} elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
		$title = __( 'Links', 'twentyfourteen' );
	} elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
		$title = __( 'Galleries', 'twentyfourteen' );
	} else {
		$title = __( 'Archives', 'twentyfourteen' );
	} // if/elseif/else()

	// Display title
	if ( $display and $title != '' ) {
		echo esc_attr( $title );
		return null;
	} // if()

	return $title;
} // sn_taxonomy_post_format_titles()

function sn_archive_titles( $display = true ) {
	$title = '';

	if ( is_day() ) {
		printf( __( 'Daily Archives: %s', 'twentyfourteen' ), get_the_date() );
	} elseif ( is_month() ) {
		printf( __( 'Monthly Archives: %s', 'twentyfourteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyfourteen' ) ) );
	} elseif ( is_year() ) {
		printf( __( 'Yearly Archives: %s', 'twentyfourteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentyfourteen' ) ) );
	} else {
		$title = __( 'Archives', 'twentyfourteen' );
	} // if/else/elseif()

	// Display title
	if ( $display and $title != '' ) {
		echo esc_attr( $title );
		return null;
	} // if()

	return $title;
} // sn_archive_titles()