<?php
/**
 * The template used for displaying page content
 *
 * @package     WordPress
 * @subpackage  Snifter
 * @since       Snifter 1.0.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php get_template_part( 'templates/content/content-entry-content' ); ?>
</article><!-- #post-## -->
