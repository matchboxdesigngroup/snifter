<?php
/**
 * Handles adding JavaScript and CSS.
 *
 * @package      WordPress
 * @subpackage   Snifter
 */


/**
 * Enqueue front-end scripts and style-sheets
 *
 * @return Void
 */
function sn_enqueue_site_scripts() {
	global $is_IE;

	$theme           = wp_get_theme();
	$theme_version   = $theme->get( 'Version' );
	$theme_uri       = get_template_directory_uri();
	$child_theme_uri = get_stylesheet_directory_uri();
	$ltie9           = ( preg_match( '/(?i)msie [6-8]/', $_SERVER['HTTP_USER_AGENT'] ) and $is_IE );

	// CSS
	if ( $ltie9 ) {
		// CSS for IE.
		wp_enqueue_style(
			'sn_main_ltie9_css',
			"{$theme_uri}/assets/css/dist/main-ltie9.min.css",
			array(),
			$theme_version,
			'all'
		);
	} else {
		// CSS for good browsers.
		wp_enqueue_style(
			'sn_main_css',
			"{$theme_uri}/assets/css/dist/main.min.css",
			array(),
			$theme_version,
			'all'
		);
	} // if/else()

	// Register Environment JS
	wp_register_script(
		'sn_env_tests_js',
		"{$theme_uri}/assets/js/dist/env-tests.min.js",
		array(),
		$theme_version,
		false
	);
	wp_enqueue_script( 'sn_env_tests_js' );

	// Register Main JS
	wp_register_script(
		'sn_scripts_js',
		"{$theme_uri}/assets/js/dist/scripts.min.js",
		array( 'jquery-effects-core' ),
		$theme_version,
		true
	);
	wp_enqueue_script( 'sn_scripts_js' );
} // sn_enqueue_site_scripts()
add_action( 'wp_enqueue_scripts', 'sn_enqueue_site_scripts', 100 );



/**
 * Adds a global JS object.
 *
 * @return Void
 */
function sn_add_global_js() {
	global $is_IE;
	$ltie9 = ( preg_match( '/(?i)msie [6-8]/', $_SERVER['HTTP_USER_AGENT'] ) and $is_IE );

	// Add Global PHP -> JS
	$sn_globals = array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'isIE'    => ( $ltie9 and $is_IE ),
	);
	$sn_globals = json_encode( $sn_globals ); ?>
	<script>var SN_GLOBALS = <?php echo wp_kses( $sn_globals, 'data' ); ?>;</script>
<?php } // sn_add_global_js()
add_action( 'wp_head', 'sn_add_global_js' );



/**
 * Enqueue administrator scripts/styles.
 *
 * @return Void
 */
function sn_enqueue_admin_scripts() {
	$theme           = wp_get_theme();
	$theme_version   = $theme->get( 'Version' );
	$theme_uri       = get_template_directory_uri();
	$child_theme_uri = get_stylesheet_directory_uri();

	// Chosen CSS
	wp_register_style(
		'sn-chosen-css',
		"{$theme_uri}/assets/bower_components/chosen/chosen.min.css",
		array(),
		$theme_version,
		'all'
	);

	// jQuery UI CSS
	wp_register_style(
		'sn-jquery-ui-all-css',
		"{$theme_uri}/assets/bower_components/jquery.ui/themes/base/all.css",
		array(),
		$theme_version,
		'all'
	);

	// Administrator CSS
	wp_enqueue_style(
		'sn_admin_css',
		"{$theme_uri}/assets/dist/admin.min.css",
		array(
			'wp-color-picker',
			'sn-chosen-css',
			'sn-jquery-ui-all-css',
		),
		$theme_version,
		'all'
	);

	// Chosen JS
	wp_register_script(
		'sn-chosen-jquery-js',
		"{$theme_uri}/assets/bower_components/chosen/chosen.jquery.min.js",
		array(),
		$theme_version,
		true
	);

// Administrator JS
	wp_register_script(
		'sn_admin_scripts',
		"{$theme_uri}/assets/dist/admin.min.js",
		array(
			'jquery',
			'jquery-ui-datepicker',
			'wp-color-picker',
			'sn-chosen-jquery-js',
		),
		$theme_version,
		true
	);
	wp_enqueue_script( 'sn_admin_scripts' );
} // sn_enqueue_admin_scripts()
add_action( 'admin_enqueue_scripts', 'sn_enqueue_admin_scripts', 100 );



/**
 * Adds a global JS object for wp-admin.
 *
 * @return Void
 */
function sn_add_admin_global_js() {
	global $is_IE;
	$ltie9 = ( preg_match( '/(?i)msie [6-8]/', $_SERVER['HTTP_USER_AGENT'] ) and $is_IE );

	// Add Global PHP -> JS
	$sn_globals = array(
		'isIE' => $ltie9,
	);
	$sn_globals = json_encode( $sn_globals ); ?>
	<script>var SN_GLOBALS = <?php echo wp_kses( $sn_globals, 'data' ); ?>;</script>
<?php } // sn_add_admin_global_js()
add_action( 'admin_head', 'sn_add_admin_global_js' );



/**
 * Adds the favicon for the site, login, and administrator section.
 * Add favicon.png to /assets/img/.
 *
 * @return Void
 */
function sn_add_favicon() {
	echo '<link rel="icon" href="' . get_stylesheet_directory_uri() . '/assets/img/favicon.png" type="image/png">';
} // sn_add_favicon()
add_action( 'wp_head', 'sn_add_favicon' );
add_action( 'admin_head', 'sn_add_favicon' );



/**
 * Handles adding Google Analytics.
 *
 * <code>
 * add_action( 'wp_head', 'sn_google_analytics', 20 );
 * </code>
 *
 * @return Void
 */
function sn_google_analytics() { ?>
	<?php if ( GOOGLE_ANALYTICS_ID && ! current_user_can( 'manage_options' ) ) { ?>
	<script>
		(function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
		function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
		e=o.createElement(i);r=o.getElementsByTagName(i)[0];
		e.src='//www.google-analytics.com/analytics.js';
		r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
		ga( 'create', '<?php echo esc_attr( GOOGLE_ANALYTICS_ID ); ?>');ga('send','pageview' );
	</script>
	<?php } // if()
} // sn_google_analytics()
add_action( 'wp_head', 'sn_google_analytics', 20 );