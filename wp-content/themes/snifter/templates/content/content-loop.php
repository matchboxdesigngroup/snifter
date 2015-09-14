<?php
/**
 * Handles displaying the loop.
 *
 * @package     WordPress
 * @subpackage  Snifter
 * @since       Snifter 1.0.0
 */

?>
<div class="content-loop fitvid">
<?php while ( have_posts() ) { ?>
	<?php the_post(); ?>
	<?php the_content(); ?>
<?php } // while() ?>
</div>
