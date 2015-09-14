<?php
add_action( 'after_setup_theme', function() {
	// Includes
	$directories['includes'] = array(
		'widgets',
	);

	// Base classes
	$directories['classes']  = array();

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
			$template = get_stylesheet_directory() . "/{$directory}/{$file}";

			// Make sure the file exists.
			if ( false === file_exists( $template ) ) {
				continue;
			} // if()

			require_once $template;
		} // foreach()
	} // foreach()
}, 42 );