/* global wp */
jQuery((function($) {
	$(window).load(function(){
		var file_frame;

		// Handle Text Field Changes
		$('.sn-meta-upload').each(function(index, el) {
			var wrap        = $(el),
					srcField    = wrap.find('input[type="text"]'),
					idField     = wrap.find('input[type="hidden"]'),
					uploadthumb = wrap.find('.meta-upload-thumb')
			;

			srcField.off('change').on('change', function() {
				var val  = $(this).val();

				if (typeof val === 'undefined' && val === '' ) {
					return;
				} // if()

				uploadthumb.remove();
				idField.val('');
			});
		});

		/**
		* Attach Image
		*/
		// Uploading files
		$('.sn-meta-upload .upload-link').on('click', function( e ) {
			var metaWrap      = $(e.currentTarget).parent('.sn-meta-upload'),
					metaTextField = metaWrap.find('input[type="text"]'),
					metaSaveField = metaWrap.find('input[type="hidden"]')
			;

			e.preventDefault();

			// Create the media frame.
			file_frame = wp.media.frames.file_frame = wp.media({
				title: 'Upload a file',
				button: {
					text: 'Upload File'
				},
				multiple: false
			});

			file_frame.on( 'select', function() {
				var fileFrameJSON = file_frame.state().get('selection').toJSON(),
						fileUrl = fileFrameJSON[0].url,
						fileId = fileFrameJSON[0].id
				;

				metaTextField.val(fileUrl);
				metaSaveField.val(fileId);

				var ajaxParams = {
					action  : 'sn_meta_upload_thumb',
					fileSrc : fileUrl
				};
				$.getJSON(ajaxurl, ajaxParams, function(json) {
						var thumbElem = metaWrap.find('.meta-upload-thumb');
						thumbElem.prev('br').remove();
						thumbElem.remove();
						metaWrap.append(json);
				});
			});

			// Finally, open the modal
			file_frame.open();
		});

	}); // $(window).load()
})(jQuery));