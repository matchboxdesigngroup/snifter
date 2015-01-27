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

$libs = array(
	'titles',
	'cleanup',
	'gallery',
	'rewrites',
	'relative-urls',
	'widgets',
	'scripts',
	'actions',
	'filters',
	'custom',
	'debug',
	'shortcodes',
);

// Includes
$directories['includes'] = array(
	'debug',
	'utils',
	'init',
	'config',
	'titles',
	'cleanup',
	'wp-images',
	'rewrites',
	'widgets',
	'scripts',
	'filter-actions',
	'shortcodes',
);



// Base classes
$directories['classes']  = array(
	'class-sn-utilities',
	'class-sn-form-fields',
	'class-sn-meta-helper',
	'class-sn-images',
	'class-sn-type-base',
	'class-sn-theme-wrapper',
	'class-sn-wp-admin',
	'class-sn-walker-comments',
	'class-sn-nav-walker',
	'class-sn-sidebar',
	'class-sn-settings',
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