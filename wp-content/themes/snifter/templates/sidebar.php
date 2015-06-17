<?php
/**
 * The Sidebar containing the main widget area
 *
 * @package     WordPress
 * @subpackage  Snifter
 * @since       Snifter 1.0.0
 */
?>
<aside id="secondary" class="sidebar">
	<?php if ( is_active_sidebar( 'primary-sidebar' ) ) { ?>
	<div id="primary_sidebar" class="primary-sidebar widget-area" role="complementary">
		<?php dynamic_sidebar( 'primary-sidebar' ); ?>
	</div><!-- #primary_sidebar -->
	<?php } // if() ?>
</aside><!-- #secondary -->
