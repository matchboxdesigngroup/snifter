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
$directories['includes'] = array(
	'debug',
	'titles',
);
$directories['classes']  = array(
	'class-sn-theme-wrapper',
	'class-sn-form-fields',
);

// Require all the things!!!
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