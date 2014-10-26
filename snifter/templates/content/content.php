<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package     WordPress
 * @subpackage  Snifter
 * @since       Snifter 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( is_search() ) { ?>
	<?php get_template_part( 'templates/content/content-entry-summary' ); ?>
	<?php } else { ?>
	<?php get_template_part( 'templates/content/content-entry-content' ); ?>
	<?php } // if() ?>
</article><!-- #post-## -->
