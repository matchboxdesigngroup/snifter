<?php
/**
 * Snifter file include/requires.
 * This file should only be used to include/require other files.
 *
 * @package     WordPress
 * @subpackage  Snifter
 * @since       Snifter 1.0.0
 *
 * @author       Matchbox Design Group <info@matchboxdesigngroup.com>
 */

$directories             = array();

foreach ( $directories as $directory => $files ) {
	if ( empty( $files ) ) continue;

	foreach ( $files as $file ) {
		$has_php  = ( strpos( $file, '.php' ) !== false );
		$file     = ( $has_php ) ? $file : "{$file}.php";
		$template = locate_template( "/{$directory}/{$file}" );

		if ( $template == '' ) continue;

		require_once $template;
	} // foreach()
} // foreach()