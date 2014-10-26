<?php
/**
 * MDG Generic Class.
 */

/**
 * Contains methods/properties that can be used by all classes.
 *
 * All classes should at the very minimum extend SN_Utilities so they can
 * have easy access to all helper methods/properties.
 *
 * @package     WordPress
 * @subpackage  Snifter
 * @since       Snifter 1.0.0
 *
 * @author       Matchbox Design Group <info@matchboxdesigngroup.com>
 */
class SN_Utilities {
	/**
	 * Class Constructor
	 *
	 * @since   Snifter 1.0.0
	 *
	 * @return  Void
	 */
	public function __construct() {
	} // __construct()




	/**
	 * Checks the current host against the supplied hosts.
	 *
	 * @param   array    $http_hosts  The possible hosts to check against.
	 *
	 * @return  boolean               True if the current host matches any of the supplied hosts, false if not.
	 */
	public function check_hosts( $http_hosts = array() ) {
		$http_host = $_SERVER['HTTP_HOST'];

		// Check the possible HTTP hosts against the current HTTP host.
		if ( in_array( $http_host, $http_hosts ) ) {
			return true;
		} // if()

		// Check the possible HTTP hosts against the current HTTP host.
		foreach ( $http_hosts as $http_host ) {
			if ( strpos( $http_host, $host ) !== false ) {
				return true;
			} // if()
		} // foreach

		return false;
	} // check_hosts()



	/**
	 * Checks if the current HTTP host is localhost.
	 * Default possible HTTP hosts http://localhost, 127.0.0.1, 10.0.0.2, http://*.dev.
 	 *
 	 *
	 * <code>
	 * if ( $sn_utilities->is_localhost() ) {
	 *  // Do something localhost specific...
	 * } // if()
	 * </code
	 *
	 * @since   Snifter 1.0.0
	 *
	 * @return  boolean  If the current HTTP host is localhost.
	 */
	public function is_localhost() {
		// Default possible HTTP hosts URLs/IP addresses
		$http_hosts = array(
			'localhost',
			'127.0.0.1',
			'10.0.2.2',
			'.dev',
		);

		/**
		 * Allows for filtering of the possible HTTP hosts.
		 * Accepts name/IP like localhost/127.0.0.1 or a domain such as .dev.
		 *
		 * @since  Snifter  1.0.0
		 *
		 * @param  hosts  The possible HTTP hosts to check against.
		 */
		$http_hosts = apply_filters( 'sn_is_localhost_http_hosts', $http_hosts );

		return check_hosts( $http_hosts );
	} // is_localhost()



	/**
	 * Checks if the current host is a staging site.
	 *
	 * @since   Snifter 1.0.0
	 *
	 * @return  boolean  If the current host is a staging site.
	 */
	public function is_staging() {
		$http_hosts = array(
			'staging.',
			'dev.',
		);

		/**
		 * Allows for filtering of the possible HTTP hosts.
		 * Accepts name/IP like localhost/127.0.0.1 or a domain such as .dev.
		 *
		 * @since  Snifter  1.0.0
		 *
		 * @param  hosts  The possible HTTP hosts to check against.
		 */
		$http_hosts = apply_filters( 'sn_is_staging_http_hosts', $http_hosts );

		return check_hosts( $http_hosts );
	} // is_staging()



	/**
	 * Retrieves a page/post/custom post type ID when provided a slug.
	 *
	 * @since   Snifter 1.0.0
	 *
	 * @param   string   $slug  The slug of the page/post/custom post type you want an ID for.
	 *
	 * @return  integer         The ID of the page/post/custom post type
	 */
	public function get_id_by_slug( $slug ) {
		$page = get_page_by_path( $slug );
		if ( $page ){
			return $page->ID;
		} // if()

		return null;
	} // get_id_by_slug()



	/**
	 * Retrieves the YouTube video ID from the supplied embed code
	 *
	 * @param string  $embed YouTube embed code
	 *
	 * @return string        The YouTube video id.
	 */
	public function get_youtube_id( $embed ) {
		preg_match( '#(\.be/|/embed/|/v/|/watch\?v=)([A-Za-z0-9_-]{5,11})#', $embed, $matches );
		if ( isset( $matches[2] ) && $matches[2] != '' ) {
			$youtube_id = $matches[2];
		} // if()

		return $youtube_id;
	} // get_youtube_id()



	/**
	 * Get attachment ID from SRC URL.
	 *
	 * @param string  $attachment_url Absolute URI to an attachment
	 *
	 * @return integer Post ID
	 */
	public function get_attachment_id_from_src( $attachment_url ) {
		global $wpdb;
		$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$attachment_url'";
		$id    = $wpdb->get_var( $query );
		return $id;
	} // get_attachment_id_from_src()
} // END Class SN_Utilities()

global $sn_utilities;
$sn_utilities = new SN_Utilities();