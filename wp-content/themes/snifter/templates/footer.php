<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package     WordPress
 * @subpackage  Snifter
 * @since       Snifter 1.0.0
 */
?>
<footer class="content-info" role="contentinfo">
	<div class="sidebar-footer">
		<?php dynamic_sidebar( 'sidebar-footer' ); ?>
	</div><?php // .sidebar-footer ?>
	<p>&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?></p>
	<a href="http://www.matchboxdesigngroup.com/" target="_blank">Web Design and Development by Matchbox</a>
</footer><?php // .content-info ?>

<div title="Back to Top" class="css3pie page-top-link back-to-top">
	<a href="#" class="css3pie">Return to top</a>
</div><?php //.back-to-top ?>
<?php wp_footer(); ?>