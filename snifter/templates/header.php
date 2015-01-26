<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package     WordPress
 * @subpackage  Snifter
 * @since       Snifter 1.0.0
 */
?>
<header class="site-header" role="banner">
	<a class="logo" href="<?php echo esc_url( home_url() ); ?>/"><?php bloginfo( 'name' ); ?></a>
	<nav class="primary-navigation" role="navigation">
		<?php if ( has_nav_menu( 'primary_navigation' ) ) { ?>
			<?php wp_nav_menu( array( 'theme_location' => 'primary_navigation', 'menu_class' => 'primary-navigation-menu' ) ); ?>
		<?php } // if() ?>
	</nav>
</header>