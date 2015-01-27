<?php
/**
 * SN Images Class.
 */

/**
 * Handles adding custom image sizes and other global image related functionality.
 *
 * @package      WordPress
 * @subpackage   Snifter
 * @since        Snifter 1.0.0
 *
 * @author       Matchbox Design Group <info@matchboxdesigngroup.com>
 */
class SN_Images {
	/**
	 * The available image sizes.
	 *
	 * @since Snifter 1.0.0
	 *
	 * @var  array
	 */
	public $image_sizes = array();



	/**
	 * Class constructor
	 *
	 * @since Snifter 1.0.0
	 */
	public function __construct() {
		// Custom Image Sizes
		$this->set_image_sizes();
		$this->register_sizes();

		// ajax response to return the reference grid
		add_action( 'wp_ajax_sn-image-reference-grid', array( $this, 'output_reference_grid' ) );
	} // __construct()




	/**
	 * Sets all of the custom image sizes
	 *
	 * <code>
	 * $this->set_image_sizes();
	 * </code>
	 *
	 * @since Snifter 1.0.0
	 *
	 * @return void
	 */
	public function set_image_sizes() {
		global $content_width;

		// Featured Image Size
		$this->image_sizes[] = array(
			'width'   => $content_width, // set in includes/init.php
			'height'  => '',
			'title'   => 'featured-image-size', // The default will be widthxheight but any string can be used
			'used_in' => array(
					'title' => 'Featured Image Size', // Title to be used in Media notification
					'link'  => '', // Link to an image of the created size to be used in Media notification
				)
		);

		// Featured image administrator column image size
		$this->image_sizes[] = array(
			'title'   => 'admin-list-thumb', // The default will be widthxheight but any string can be used
			'width'   => 100,
			'height'  => 100,
			'cropped' => true,
			'used_in' => array(
				'title'  => 'Example Size',    // Title to be used in Media notification
				'link'   => '',                // Link to an image of the created size to be used in Media notification
			)
		);
	} // function set_image_sizes()





	/**
	 * Registers all of the new image sizes for use in our theme
	 *
	 * @since Snifter 1.0.0
	 *
	 * <code>
	 * $this->image_sizes['example_size'] = array(
	 * 	'width'  => 220,
	 * 	'height' => 130,
	 * 	'title'  => '220x130', // The default will be widthxheight but any string can be used
	 * 	'used_in' => array(
	 *  	'title' => 'Example Size', // Title to be used in Media notification
	 *  	'link'  => '', // Link to an image of the created size to be used in Media notification
	 *  ),
	 * );
	 * </code>
	 *
	 * @return  void
	 */
	public function register_sizes() {
		// first set the thumb size and make sure that this theme supports thumbs
		if ( function_exists( 'add_theme_support' ) ) {
			add_theme_support( 'post-thumbnails' );
			set_post_thumbnail_size( 140, 140 ); // default Post Thumbnail dimensions
		} // if()

		// now add the sizes
		if ( function_exists( 'add_image_size' ) ) {
			foreach ( $this->image_sizes as $image_size ) {
				extract( $image_size );
				$width   = isset( $width ) ? $width : '';
				$height  = isset( $height ) ? $height : '';
				$title   = isset( $title ) ? $title : "{$width}x{$height}";
				$cropped = isset( $cropped ) ? $cropped : true;

				add_image_size(
					$title,  //title
					$width,  // width
					$height, // height
					$cropped // crop
				);
			}
			//add_image_size( 'homepage-thumb', 220, 180, true ); //(cropped)
		} // if()
	} // function register_sizes()



	/**
	 * Outputs the reference grid in the Media Library
	 *
	 * <code>
	 * add_action( 'wp_ajax_sn-image-reference-grid', array( $this, 'output_reference_grid' ) );
	 * </code>
	 *
	 * @since Snifter 1.0.0
	 *
	 * @return  void
	 */
	public function output_reference_grid() {
		echo $this->reference_grid_html();
		exit;
	} // output_reference_grid()



	/**
	 * Creates the HTML for the image size reference grid in the Media Library
	 *
	 * <code>
	 * $grid_html = $this->reference_grid_html();
	 * </code>
	 *
	 * @since Snifter 1.0.0
	 *
	 * @return String The HTML with all of the different custom image sizes
	 */
	public function reference_grid_html() {
		$html = '<ul class="image-reference-grid">';
		foreach ( $this->image_sizes as $image_size ) {
			extract( $image_size );
			extract( $used_in );

			$width  = isset( $width ) ? $width : '';
			$height = isset( $height ) ? $height : '';
			$title  = isset( $title ) ? $title : "{$width}x{$height}";
			$title  = "{$title} - {$width}px x {$height}px";

			$html .= '<li style="float: left;max-width: 100%; margin-right: 15px;">';
			$html .= "<p>{$title}</p>";
			if ( isset( $link ) and $link != '' ) {
				$html .= "Used in: <a href='{$link}' target='_blank'>{$title}</a>";
			} // if()
			$html .= "<img src='http://placehold.it/{$width}x{$height}' style='max-width: 100%;height:auto;' alt='{$title}' width='{$width}' height='{$height}'>";
			$html .= '</li>';
		} // foreach()
		$html .= '</ul>';

		return $html;
	} // function reference_grid_html()
} // END Class SN_Images()

global $sn_images;
$sn_images = new SN_Images();
