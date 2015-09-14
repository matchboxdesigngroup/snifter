/* global pagenow */
jQuery( ( function( $ ) {
	var alerts = {};

	/**
	 * Adds an alert for all image sizes
	 *
	 * @todo make this work better.
	 *
	 * @return boolean false
	 */
	alerts.getImageReferenceGrid = function() {
		if ( pagenow !== 'upload' ) {
			return false;
		} // if()

		$( 'h2' ).after( '<div class="updated"><p><a href="#" id="image-size-reference-trigger">View image size reference.</a></p></div><div class="image-size-reference"></div>' );

		var trigger = $( '#image-size-reference-trigger' );
		var ajaxurl = ajaxurl;

		trigger.click( function() {
			$.get(
				ajaxurl,
				{ action : 'sn-image-reference-grid' },
				function( returnHtml ) {
					trigger.after(
						'<p class="sn-image-reference"><a href="#" id="hide-image-grid-reference">hide image sizes</a></p>' +
						'<p class="sn-image-reference">please note that image sizes may be smaller to fit into your screen</p>'
					);

					returnHtml = '<div class="sn-image-reference">' +
													returnHtml +
													'<div style="clear:both"></div>' +
												'</div>';

					$( '.image-size-reference' ).empty().append( returnHtml );

					trigger.hide();

					$( '#hide-image-grid-reference' ).click( function() {
						$( '.sn-image-reference' ).remove();
						trigger.show();
					} );

				} // end success function
			);
		} );

		return false;
	}; // alerts.getImageReferenceGrid()

	/**
	 * Initializes all administrator alerts
	 */
	alerts.init = function() {
		alerts.getImageReferenceGrid();
	}; // alerts.init()

	/**
	 * Document ready
	 */
	$( document ).ready( function() {
		alerts.init();
	} ); // $(document).ready()
} )( jQuery ) );
