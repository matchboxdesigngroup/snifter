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
	'utils',
	'init',
	'config',
	'titles',
	'cleanup',
	'wp-images',
	'rewrites',
	'scripts',
	'filter-actions',
	'shortcodes',
);



// Base classes
$directories['classes']  = array(
	'class-sn-utilities',
	'class-sn-images',
	'class-sn-type-base',
	'class-sn-theme-wrapper',
	'class-sn-wp-admin',
	'class-sn-walker-comments',
	'class-sn-nav-walker',
	'class-sn-sidebar',
);

// Require all the things!!!
foreach ( $directories as $directory => $files ) {
	if ( empty( $files ) ) continue;

	foreach ( $files as $file ) {
		$has_php  = ( strpos( $file, '.php' ) !== false );
		$file     = ( $has_php ) ? $file : "{$file}.php";
		$template = get_template_directory() . "/{$directory}/{$file}";

		// Make sure the file exists.
		if ( false === file_exists( $template ) ) {
			continue;
		} // if()

		require_once $template;
	} // foreach()
} // foreach()