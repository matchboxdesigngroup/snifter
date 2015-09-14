<?php
/**
 * SN Type Stub Class.
 *
 * @package Snifter
 */

/**
 * You basically need to change [stub/Stub] to be your post
 * type name and then add your custom meta if needed, if no
 * custom meta is needed then delete the get_custom_meta_fields.
 * Please do take a look at SN_Type_Base to see what parameters
 * and methods are already available to use.
 *
 * The properties of SN_Type_Base that you should/can alter are
 * all in __construct(). Anything thay isn't REQUIRED that you
 * do not use please remove before deploying to production. Also
 * any property that is optional has the defaults as an example.
 */

/**
 * This class can be used as a starting point to add new post types.
 *
 * @package      WordPress
 * @subpackage   Snifter
 *
 * @author       Matchbox Design Group <info@matchboxdesigngroup.com>
 */
class SN_Type_Stub extends SN_Type_Base {
	/**
	 * Holds all the transient keys for the cache.
	 *
	 * @var  array
	 */
	public $type_transients = array();



	/**
	 * The slug of the post types landing page if not post type archive.
	 *
	 * @var  string
	 */
	public $landing_page_slug = 'stub';



	/**
	 * The slug of the post types landing page template if not post type archive.
	 *
	 * @var  string
	 */
	public $landing_page_template = 'template-stub.php';
		/**
		* The posts types slug.
		*
		* @var  string
		*/
		public $post_type = 'stub';

		/**
		* Title of post type.
		*
		* @var  string
		*/
		public $post_type_title = 'Stubs';

		/**
		* Siglular post type title.
		*
		* @var  string
		*/
		public $post_type_single = 'Stub';


	/**
	 * Class constructor, handles instantiation functionality for the class
	 */
	function __construct() {
		// SN_Type_Base Properties.
		$this->_set_sn_type_base_options();

		parent::__construct();

		// Add filters and actions.
		$this->_add_type_actions_filters();
	} // __construct()



	/**
	 * Handles setting of the optional properties of SN_Type_Base
	 *
	 * return Void
	 */
	private function _set_sn_type_base_options() {
		/** @var array   The taxonomy "name" used in register_taxonomy() */
		$this->taxonomy_name = "{$this->post_type}-categories";

		/** @var array   Custom taxonomy labels used in register_taxonomy() */
		$this->custom_taxonomy_labels = array(
			'name'                       => _x( "{$this->post_type_single} Categories", 'taxonomy general name' ),
			'singular_name'              => _x( "{$this->post_type_single} Category", 'taxonomy singular name' ),
			'search_items'               => __( "Search {$this->post_type_single} Categories" ),
			'all_items'                  => __( "All {$this->post_type_single} Categories" ),
			'parent_item'                => __( "Parent {$this->post_type_single} Category" ),
			'parent_item_colon'          => __( "Parent {$this->post_type_single} Category:" ),
			'edit_item'                  => __( "Edit {$this->post_type_single} Category" ),
			'update_item'                => __( "Update {$this->post_type_single} Category" ),
			'add_new_item'               => __( "Add New {$this->post_type_single} Category" ),
			'new_item_name'              => __( "New {$this->post_type_single} Category Name" ),
			'menu_name'                  => __( "{$this->post_type_single} Categories" ),
			'view_item'                  => __( "View {$this->post_type_single} Category" ),
			'popular_items'              => __( "Popular {$this->post_type_single} Categories" ),
			'separate_items_with_commas' => __( "Separate {$this->post_type_single} Categories with commas" ),
			'add_or_remove_items'        => __( "Add or remove  {$this->post_type_single} Categories" ),
			'choose_from_most_used'      => __( "Choose from the most used {$this->post_type_single} Categories" ),
			'not_found'                  => __( "No  {$this->post_type_single} Categories found." ),
		);

		/** @var array   Custom taxonomy arguments used in register_taxonomy() */
		$this->custom_taxonomy_args = array(
			'hierarchical'      => true,
			// 'labels'          => This is handled by $this->custom_taxonomy_labels do not set directly
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'show_admin_column' => true,
			'query_var'         => $this->taxonomy_name,
			'rewrite'           => array(
				'slug'         => $this->post_type,
				'with_front'   => false,
				'hierarchical' => true,
			),
		);

		/** @var boolean  Disable/Enable Categories per post type */
		$this->disable_post_type_categories = false;

		/** @var array   Custom post type supports array used in register_post_type() */
		$this->custom_post_type_supports = array(
			'title',
			'editor',         // (content)
			'author',
			'thumbnail',      // (featured image) (current theme must also support Post Thumbnails)
			'excerpt',
			'trackbacks',
			'custom-fields',
			'comments',      // (also will see comment count balloon on edit screen)
			'revisions',     // (will store revisions)
			'page-attributes', // (template and menu order) (hierarchical must be true)
			'post-formats',
		);

		// To disable all supports except title, you should always support title no mater what.
		// $this->custom_post_type_supports = false;

		// Lower case post type labels.
		$lowercase_post_type_title  = strtolower( $this->post_type_title );
		$lowercase_post_type_single = strtolower( $this->post_type_single );

		/** @var array   The post types custom labels used in register_post_type() */
		$this->custom_post_type_labels = array(
			'name'                  => __( $this->post_type_title ),
			'singular_name'         => __( $this->post_type_single ),
			'add_new'               => __( "Add New {$this->post_type_single}" ),
			'add_new_item'          => __( "Add New {$this->post_type_single}" ),
			'edit_item'             => __( "Edit {$this->post_type_single}" ),
			'new_item'              => __( "New {$this->post_type_single}" ),
			'all_items'             => __( "All {$this->post_type_title}" ),
			'view_item'             => __( "View {$this->post_type_single}" ),
			'search_items'          => __( "Search {$this->post_type_title}" ),
			'not_found'             => __( "No {$lowercase_post_type_title} found" ),
			'not_found_in_trash'    => __( "No {$lowercase_post_type_title} found in Trash" ),
			'parent_item_colon'     => __( '' ),
			'menu_name'             => __( $this->post_type_title ),
			'featured_image'        => __( "{$this->post_type_single} Image" ),
			'set_featured_image'    => __( "Set {$lowercase_post_type_single} image" ),
			'remove_featured_image' => __( "Remove {$lowercase_post_type_single} image" ),
			'use_featured_image'    => __( "Use as {$lowercase_post_type_single} image" ),
		);

		/** @var array   Custom post type arguments used in register_post_type() */
		$this->custom_post_type_args = array(
			// 'labels'          => This is handled by $this->custom_post_type_labels do not set directly
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => $this->post_type, 'with_front' => false ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => true,
			'menu_position'      => 5,
			'can_export'         => true,
			'menu_icon'          => 'dashicons-edit',
			// 'supports'        => This is handled by $this->post_type_supports do not set directly
		);

		/** @var array   Used to disable the addition of the featured image column */
		$this->disable_image_column = false;
	} // _set_sn_type_base_options()



	/**
	 * Add post type actions & filters
	 */
	private function _add_type_actions_filters() {
		// Clears transients on post save
		add_action( 'save_post', array( &$this, 'clear_type_transients' ) );

		// Uncomment to redirect the single page to the landing page.
		// add_action( 'template_redirect', array( &$this, 'single_redirect' ) );
	} // _add_type_actions_filters()



	/**
	 * Clears all of the transients for the current post type.
	 *
	 * @todo  Make it easier to add type transients.
	 *
	 * <code>
	 * add_action( 'save_post', array( &$this, 'clear_type_transients' ) );
	 * </code>
	 *
	 * @param   integer  $post_id  The post id.
	 *
	 * @return  void
	 */
	public function clear_type_transients( $post_id ) {
		if ( get_post_type( $post_id ) != $this->post_type ) {
			return;
		} // if()

		foreach ( $this->type_transients as $transient ) {
			$this->delete_transient( $transient );
		} // foreach()
	} // clear_type_transients()



	/**
	 * Handles redirecting the single templates to the main team page.
	 *
	 * @return  void
	 */
	public function single_redirect() {
		if ( is_single() and get_post_type() == $this->post_type ) {
			wp_redirect( home_url( "/{$this->landing_page_slug}/" ), '301' );
			exit();
		} // if()
	} // single_redirect()
} // END Class SN_Type_Stub()

global $sn_stub;
$sn_stub = new SN_Type_Stub();
