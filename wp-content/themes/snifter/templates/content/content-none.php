<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package     WordPress
 * @subpackage  Snifter
 * @since       Snifter 1.0.0
 */
?>
<div class="none-found">
	<?php if ( is_search() )  { ?>
	<p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>
	<?php get_search_form(); ?>
	<?php } else { ?>
	<p>It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.</p>
	<?php get_search_form(); ?>
	<?php } // if/else() ?>
</div><!-- .none-found -->
