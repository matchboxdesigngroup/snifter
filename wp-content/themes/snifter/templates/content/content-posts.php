<?php
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post()
		get_template_part( 'templates/partials/page-header' );
		if ( get_post_type() == 'post' ) {
			get_template_part( 'templates/content/content', get_post_format() );
		} else {
			get_template_part( 'templates/content/content', get_post_type() );
		} // if/else()
	} // while()
	get_template_part( 'templates/partials/page-navigation' );
} else {
	get_template_part( 'templates/content/content-none' );
} // if/else()