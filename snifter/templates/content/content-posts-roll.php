<section id="primary" class="content-area">
	<div id="content" class="site-content" role="main">
		<?php if ( have_posts() ) { ?>
			<?php while ( have_posts() ) { ?>
				<?php the_post() ?>
				<?php get_template_part( 'templates/partials/page-header' ); ?>
				<?php get_template_part( 'templates/content/content', get_post_format() ); ?>
			<?php } // while() ?>
			<?php get_template_part( 'templates/partials/page-navigation' ); ?>
		<?php } else { ?>
			<?php get_template_part( 'templates/content/content-none' ); ?>
		<?php } // if/else() ?>
	</div><!-- #content -->
</section><!-- #primary -->