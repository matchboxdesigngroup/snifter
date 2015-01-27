<?php
/**
 * Snifter Type Page Class.
 */



/**
 * Handles anything custom for the default WordPress "post" post type.
 *
 * @package      WordPress
 * @subpackage   Snifter
 *
 * @author       Matchbox Design Group <info@matchboxdesigngroup.com>
 */
class SN_Type_Page extends SN_Type_Base {
	/**
	 * Holds all the transient keys for the cache.
	 *
	 * @param  array
	 */
	public $type_transients = array();



	/**
	 * The slug of the post types landing page if not post type archive.
	 *
	 * @var  string
	 */
	public $landing_page_slug = '';



	/**
	 * The slug of the post types landing page template if not post type archive.
	 *
	 * @var  string
	 */
	public $landing_page_template = '';



	/**
	 * Class constructor, handles instantiation functionality for the class
	 */
	function __construct() {
		/** @var string  REQUIRED slug for post type */
		$this->post_type        = 'page';

		/** @var string  REQUIRED title of post type */
		$this->post_type_title  = 'Pages';

		/** @var string  REQUIRED singular title */
		$this->post_type_single = 'Page';

		// MDG_Meta_Helper Properties
		$this->_set_sn_meta_helper_options();

		parent::__construct();
	} // __construct()



	/**
	 * Handles setting of the optional properties of SN_Meta_Helper
	 *
	 * return Void
	 */
	private function _set_sn_meta_helper_options() {
		/** @var array Meta box id(s) to be removed */
		$this->meta_boxes_to_remove = array(
			// array(
			//  'id'      => 'authordiv',
			//  'context' => 'normal',
			//  'page'    => $this->post_type,
			// ),
			// array(
			//  'id'      => 'categorydiv',
			//  'context' => 'side',
			//  'page'    => $this->post_type,
			// ),
			// array(
			//  'id'      => "{$this->post_type}-categorydiv",
			//  'context' => 'side',
			//  'page'    => $this->post_type,
			// ),
			// array(
			//  'id'      => 'commentstatusdiv',
			//  'context' => 'normal',
			//  'page'    => $this->post_type,
			// ),
			// array(
			//  'id'      => 'commentsdiv',
			//  'context' => 'normal',
			//  'page'    => $this->post_type,
			// ),
			// array(
			//  'id'      => 'formatdiv',
			//  'context' => 'normal',
			//  'page'    => $this->post_type,
			// ),
			// array(
			//  'id'      => 'pageparentdiv',
			//  'context' => 'side',
			//  'page'    => $this->post_type,
			// ),
			// array(
			//  'id'      => 'postexcerpt',
			//  'context' => 'normal',
			//  'page'    => $this->post_type,
			// ),
			// array(
			//  'id'      => 'revisionsdiv',
			//  'context' => 'normal',
			//  'page'    => $this->post_type,
			// ),
			// array(
			//  'id'      => 'slugdiv',
			//  'context' => 'normal',
			//  'page'    => $this->post_type,
			// ),
			// array(
			//  'id'      => 'submitdiv',
			//  'context' => 'side',
			//  'page'    => $this->post_type,
			// ),
			// array(
			//  'id'      => 'tagsdiv-post_tag',
			//  'context' => 'side',
			//  'page'    => $this->post_type,
			// ),
			// array(
			//  'id'      => 'trackbacksdiv',
			//  'context' => 'normal',
			//  'page'    => $this->post_type,
			// ),
		);
	} // _set_sn_meta_helper_options()


	/**
	 * Creates custom meta fields array.
	 *
	 * @return ArrayObject Custom meta fields
	 */
	public function get_custom_meta_fields() {
		$meta_fields = array();

		if ( ! $this->is_current_post_type() ) {
			return $meta_fields;
		} // if()

		return $meta_fields;
	} // get_custom_meta_fields()



	/**
	 * Creates custom meta fields array for display after the post title.
	 * Note: probably only should be textual inputs...
	 *
	 * @since   0.2.3
	 *
	 * @return  array Custom meta fields
	 */
	public function get_custom_after_title_meta_fields() {
		$meta_fields = array();

		if ( ! $this->is_current_post_type() ) {
			return $meta_fields;
		} // if()

		return $meta_fields;
	} // get_custom_after_title_meta_fields()




	/**
	 * Disables creating post type since post is a default post type
	 *
	 * @return Void
	 */
	public function register_post_type() {}
} // END Class SN_Type_Page()

global $sn_page;
$sn_page = new SN_Type_Page();