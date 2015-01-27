<?php
/**
 * Clean up wp_head()
 *
 * Remove unnecessary <link>'s
 * Remove inline CSS used by Recent Comments widget
 * Remove inline CSS used by posts with galleries
 * Remove self-closing tag and change ''s to "'s on rel_canonical()
 *
 * @package      WordPress
 * @subpackage   Snifter
 */

/**
 * Cleans up excess junk in wp_head.
 *
 * @see http://wpengineer.com/1438/wordpress-header/
 *
 * @return  Void
 */
function sn_head_cleanup() {
	// Originally from http://wpengineer.com/1438/wordpress-header/
	remove_action( 'wp_head', 'feed_links', 2 );
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );

	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );

	if ( !class_exists( 'WPSEO_Frontend' ) ) {
		remove_action( 'wp_head', 'rel_canonical' );
		add_action( 'wp_head', 'sn_rel_canonical' );
	} // if()
} // sn_head_cleanup()



/**
 * Handles adding a canonical link to the head.
 *
 * @return  Void
 */
function sn_rel_canonical() {
	global $wp_the_query;

	if ( !is_singular() ) {
		return;
	} // if()

	if ( !$id = $wp_the_query->get_queried_object_id() ) {
		return;
	} // if()

	$link = get_permalink( $id );
	echo "\t<link rel=\"canonical\" href=\"$link\">\n";
} // sn_rel_canonical()
add_action( 'init', 'sn_head_cleanup' );



/**
 * Remove the WordPress version from RSS feeds
 */
add_filter( 'the_generator', '__return_false' );



/**
 * Clean up language_attributes() used in <html> tag
 *
 * Change lang="en-US" to lang="en"
 * Remove dir="ltr"
 *
 * @return string Language attributes.
 */
function sn_language_attributes() {
	$attributes = array();
	$output = '';

	if ( function_exists( 'is_rtl' ) ) {
		if ( is_rtl() == 'rtl' ) {
			$attributes[] = 'dir="rtl"';
		} // if()
	} // if()

	$lang = get_bloginfo( 'language' );

	if ( $lang && $lang !== 'en-US' ) {
		$attributes[] = "lang=\"$lang\"";
	} else {
		$attributes[] = 'lang="en"';
	} // if/else()

	$output = implode( ' ', $attributes );
	$output = apply_filters( 'sn_language_attributes', $output );

	return $output;
} // sn_language_attributes()
add_filter( 'language_attributes', 'sn_language_attributes' );



/**
 * Manage output of wp_title()
 *
 * @see http://codex.wordpress.org/Function_Reference/wp_title
 *
 * @param  string $title The current page title.
 *
 * @return string         Title to be display when using wp_title().
 */
function sn_wp_title( $title ) {
	if ( is_feed() ) {
		return $title;
	} // if()

	$title .= get_bloginfo( 'name' );

	return $title;
} // sn_wp_title()
add_filter( 'wp_title', 'sn_wp_title', 10 );



/**
 * Clean up output of stylesheet <link> tags.
 *
 * @param  string $input The stylesheet link.
 *
 * @return string        The cleaned stylesheet link.
 */
function sn_clean_style_tag( $input ) {
	preg_match_all( "!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches );
	// Only display media if it is meaningful
	$media = $matches[3][0] !== '' && $matches[3][0] !== 'all' ? ' media="' . $matches[3][0] . '"' : '';
	return '<link rel="stylesheet" href="' . $matches[2][0] . '"' . $media . '>' . "\n";
} // sn_clean_style_tag()
add_filter( 'style_loader_tag', 'sn_clean_style_tag' );



/**
 * Add and remove body_class() classes.
 *
 * @param  array $classes The current body classes.
 *
 * @return array          The filtered body classes.
 */
function sn_body_class( $classes ) {
	// Add post/page slug
	if ( is_single() || is_page() && !is_front_page() ) {
		$classes[] = basename( get_permalink() );
	} // if()

	// Remove unnecessary classes
	$home_id_class  = 'page-id-' . get_option( 'page_on_front' );
	$remove_classes = array(
		'page-template-default',
		$home_id_class,
	);
	$classes = array_diff( $classes, $remove_classes );

	// Strip `page-template-` from page templates.
	foreach ( $classes as $key => $value ) {
		$classes[$key] = str_replace( 'page-template-', '', $value );
	} // foreach

	return $classes;
} // sn_body_class()
add_filter( 'body_class', 'sn_body_class' );



/**
 * Wrap embedded media as suggested by Readability
 *
 * @link https://gist.github.com/965956
 * @link http://www.readability.com/publishers/guidelines#publisher
 *
 * @param   string  $cache    oEmbed cached value.
 * @param   string  $url      oEmbed URL.
 * @param   string  $attr     oEmbed attributes.
 * @param   string  $post_ID  oEmbed post ID.
 *
 * @return  string            Wrapped oEmbed.
 */
function sn_embed_wrap( $cache, $url, $attr = '', $post_ID = '' ) {
	return '<div class="entry-content-asset">' . $cache . '</div>';
} // sn_embed_wrap()
add_filter( 'embed_oembed_html', 'sn_embed_wrap', 10, 4 );



/**
 * Add Bootstrap thumbnail styling to images with captions
 * Use <figure> and <figcaption>
 *
 * @link http://justintadlock.com/archives/2011/07/01/captions-in-wordpress
 *
 * @param   string  $output   The caption shortcode output.
 * @param   array   $attr     Image caption shortcode attributes.
 * @param   string  $content  Image caption shortcode content.
 *
 * @return  string            The new caption shortcode output.
 */
function sn_caption( $output, $attr, $content ) {
	if ( is_feed() ) {
		return $output;
	} // if()

	$defaults = array(
		'id'      => '',
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => '',
	);

	$attr = shortcode_atts( $defaults, $attr );

	// If the width is less than 1 or there is no caption, return the content wrapped between the [caption] tags
	if ( $attr['width'] < 1 || empty( $attr['caption'] ) ) {
		return $content;
	} // if()

	// Set up the attributes for the caption <figure>
	$attributes  = ( !empty( $attr['id'] ) ? ' id="' . esc_attr( $attr['id'] ) . '"' : '' );
	$attributes .= ' class="thumbnail wp-caption ' . esc_attr( $attr['align'] ) . '"';
	$attributes .= ' style="width: ' . esc_attr( $attr['width'] ) . 'px"';

	$output  = '<figure' . $attributes .'>';
	$output .= do_shortcode( $content );
	$output .= '<figcaption class="caption wp-caption-text">' . $attr['caption'] . '</figcaption>';
	$output .= '</figure>';

	return $output;
} // sn_caption()
add_filter( 'img_caption_shortcode', 'sn_caption', 10, 3 );



/**
 * Remove unnecessary dashboard widgets
 *
 * @link http://www.deluxeblogtips.com/2011/01/remove-dashboard-widgets-in-wordpress.html
 *
 * @return Void
 */
function sn_remove_dashboard_widgets() {
	remove_meta_box( 'dashboard_incoming_links', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_plugins', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_secondary', 'dashboard', 'normal' );
} // sn_remove_dashboard_widgets()
add_action( 'admin_init', 'sn_remove_dashboard_widgets' );



/**
 * Clean up the_excerpt()
 *
 * @see http://codex.wordpress.org/Function_Reference/the_excerpt/
 *
 * @param   integer  $length  The word count of the excerpt.
 *
 * @return  Void
 */
function sn_excerpt_length( $length ) {
	return POST_EXCERPT_LENGTH;
} // sn_excerpt_length()
add_filter( 'excerpt_length', 'sn_excerpt_length' );



/**
 * Custom more text for the_excerpt().
 *
 * @see http://codex.wordpress.org/Function_Reference/the_excerpt/
 *
 * @param   string  $more  Current read more text.
 *
 * @return  string         New read more text.
 */
function sn_excerpt_more( $more ) {
	return ' &hellip; <a href="' . get_permalink() . '">' . __( 'Continued', 'sn' ) . '</a>';
} // sn_excerpt_more()
add_filter( 'excerpt_more', 'sn_excerpt_more' );



/**
 * Remove unnecessary self-closing tags
 *
 * @param   string  $input  The input to remove self-closing tags.
 *
 * @return  string          The input with unnecessary self-closing tags removed.
 */
function sn_remove_self_closing_tags( $input ) {
	return str_replace( ' />', '>', $input );
} // sn_remove_self_closing_tags()
add_filter( 'get_avatar',          'sn_remove_self_closing_tags' ); // <img />
add_filter( 'comment_id_fields',   'sn_remove_self_closing_tags' ); // <input />
add_filter( 'post_thumbnail_html', 'sn_remove_self_closing_tags' ); // <img />


/**
 * Don't return the default description in the RSS feed if it hasn't been changed
 *
 * @param   string  $bloginfo  Current blog description.
 *
 * @return  string             Current blog description or an empty string if it is default.
 */
function sn_remove_default_description( $bloginfo ) {
	$default_tagline = 'Just another WordPress site';
	return ( $bloginfo === $default_tagline ) ? '' : $bloginfo;
} // sn_remove_default_description
add_filter( 'get_bloginfo_rss', 'sn_remove_default_description' );



/**
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 *
 * @link http://txfx.net/wordpress-plugins/nice-search/
 */
function sn_nice_search_redirect() {

	global $wp_rewrite;
	if ( !isset( $wp_rewrite ) || !is_object( $wp_rewrite ) || !$wp_rewrite->using_permalinks() ) {
		return;
	} // if()

	$search_base = $wp_rewrite->search_base;
	if ( is_search() && !is_admin() && strpos( $_SERVER['REQUEST_URI'], "/{$search_base}/" ) === false ) {
		wp_redirect( home_url( "/{$search_base}/" . urlencode( get_query_var( 's' ) ) ) );
		exit();
	} // if()
} // sn_nice_search_redirect()
add_action( 'template_redirect', 'sn_nice_search_redirect' );



/**
 * Fix for empty search queries redirecting to home page
 *
 * @link http://wordpress.org/support/topic/blank-search-sends-you-to-the-homepage#post-1772565
 * @link http://core.trac.wordpress.org/ticket/11330
 *
 * @param   array  $query_vars  Current page query vars.
 *
 * @return  array               Current page query vars.
 */
function sn_request_filter( $query_vars ) {
	if ( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
		$query_vars['s'] = ' ';
	} // if()

	return $query_vars;
} // sn_request_filter()
add_filter( 'request', 'sn_request_filter' );



/**
 * Tell WordPress to use searchform.php from the templates/ directory. Requires WordPress 3.6+.
 *
 * @param   string  $form  Current search form.
 *
 * @return  string         Empty search form.
 */
function sn_get_search_form( $form ) {
	$form = '';
	locate_template( '/templates/searchform.php', true, false );
	return $form;
} // sn_get_search_form()
add_filter( 'get_search_form', 'sn_get_search_form' );
