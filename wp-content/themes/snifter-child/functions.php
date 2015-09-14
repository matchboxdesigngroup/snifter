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
			$template = locate_template( "/{$directory}/{$file}" );

			if ( $template == '' ) continue;

			require_once $template;
		} // foreach()
	} // foreach()
}, 42 );