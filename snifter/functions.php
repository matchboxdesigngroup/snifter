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

$directories = array();

// Includes
$directories['includes'] = array(
	'debug',
	'titles',
);

// Base classes
$directories['classes']  = array(
	'class-sn-theme-wrapper',
	'class-sn-utilities',
	'class-sn-form-fields',
	'class-sn-images',
	'class-sn-meta-helper',
	'class-sn-nav-walker',
	'class-sn-settings',
	'class-sn-sidebar',
	'class-sn-type-base',
	'class-sn-walker-comments',
	'class-sn-wp-admin',
);

// Post Types
$directories['classes/post-types']  = array(
	'class-sn-type-page',
	'class-sn-type-post',
	'class-sn-type-stub',
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