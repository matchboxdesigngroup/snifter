<?php
/**
 * Theme wrapper
 *
 * @link http://scribu.net/wordpress/theme-wrappers.html
 *
 * @package      WordPress
 * @subpackage   Snifter
 */

/**
 * Retrieves the current template path.
 *
 * <code><?php include sn_template_path(); ?></code>
 *
 * @return  string  The template path.
 */
function sn_template_path() {
	return SN_Wrapping::$main_template;
} // sn_template_path()



/**
 * Retrieves the path to the sidebar template.
 *
 * <code><?php include sn_sidebar_path(); ?></code>
 *
 * @return  string  The sidebar template path.
 */
function sn_sidebar_path() {
	return new SN_Wrapping( 'templates/sidebar.php' );
}


/**
 * Handles the theme wrapper.
 */
class SN_Wrapping {
	/**
	 * Stores the full path to the main template file.
	 *
	 * @var  string
	 */
	static $main_template;

	/**
	 * Stores the base name of the template file; e.g. 'page' for 'page.php' etc.
	 *
	 * @var  string
	 */
	static $base;

	/**
	 * The templates slug (template name without .php)
	 *
	 * @var  string
	 */
	private $_slug;

	/**
	 * The templates.
	 *
	 * @var  array
	 */
	private $_templates;



	/**
	 * Class constructor.
	 *
	 * @param  string  $template  The template.
	 */
	public function __construct( $template = 'base.php' ) {
		$this->_slug      = basename( $template, '.php' );
		$this->_templates = array( $template );

		if ( self::$base ) {
			$str = substr( $template, 0, -4 );
			array_unshift( $this->_templates, sprintf( $str . '-%s.php', self::$base ) );
		} // if()
	} // __construct()



	/**
	 * Retrieves the template location as a string.
	 *
	 * <code><?php $template = $this->__toString(); ?></code>
	 *
	 * @return  string  The template location.
	 */
	public function __toString() {
		$this->_templates = apply_filters( 'sn_wrap_' . $this->_slug, $this->_templates );
		return locate_template( $this->_templates );
	} // __toString()


	/**
	 * Handles wrapping of the template.
	 *
	 * <code><?php add_filter( 'template_include', array( 'SN_Wrapping', 'wrap' ), 99 ); ?></code>
	 *
	 * @param   [type]  $main  [description]
	 *
	 * @return  [type]         [description]
	 */
	static function wrap( $main ) {
		self::$main_template = $main;
		self::$base = basename( self::$main_template, '.php' );

		if ( self::$base === 'index' ) {
			self::$base = false;
		} // if()

		return new SN_Wrapping();
	} // wrap()
} // SN_Wrapping
add_filter( 'template_include', array( 'SN_Wrapping', 'wrap' ), 99 );
