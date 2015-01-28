jQuery((function($) {
	var meta = {};

	meta.changeChosen = function(e){
		if ( typeof e === 'undefined' ) {} //
		// this updates the hidden text box that holds selections
		var chosenElem = $('#' + e.currentTarget.id).val(),
				select_id  = e.currentTarget.id.replace('_multi_chosen', ''),
				textField  = $("#" + select_id)
		;
		textField.val(chosenElem);
	}; // meta.changeChosen()

	/**
	 * Sets up the chosen select
	 *
	 * @return Void
	 */
	meta.setupChosen = function() {
		var chosenElem = $('.sn-chosen-select');

		if ( chosenElem === 0 ) {
			return false;
		} // if()

		chosenElem.chosen({
			allow_single_deselect    : true,
			disable_search_threshold : 5
		});

		chosenElem.chosen().change(function(e){
			meta.changeChosen(e);
		});
	}; // meta.setupChosen()

	/**
	 * Sets up the meta date picker.
	 *
	 * @return Void
	 */
	meta.setupDatepicker = function() {
		var datePicker = $('.sn-datepicker');

		if ( datePicker.length === 0 ) {
			return false;
		} // if()

		var dateFormat = datePicker.data('format');
		console.log(dateFormat);
		dateFormat = (typeof dateFormat === 'undefined' || dateFormat === '' ) ? 'MM d, yy' : dateFormat;
		datePicker.datepicker({
			dateFormat  : dateFormat,
			changeMonth : true,
			changeYear  : true,
			yearRange   : '2000:2020',
		});
	}; // meta.setupDatepicker()

	/**
	 * Sets up the meta color picker.
	 *
	 * @return Void
	 */
	meta.setupColorPicker = function() {
		var colorPicker = $('.sn-color-picker');

		if ( colorPicker.length === 0 ) {
			return false;
		} // if()

		var options = {
			// you can declare a default color here,
			// or in the data-default-color attribute on the input
			defaultColor : false,
			// a callback to fire whenever the color changes to a valid color(optional args event, ui)
			change       : function() {},
			// a callback to fire when the input is emptied or an invalid color
			clear        : function() {},
			// hide the color picker controls on load
			hide         : true,
			// show a group of common colors beneath the square
			// or, supply an array of colors to customize further
			palettes     : true
		};
		colorPicker.wpColorPicker( options );
	}; // meta.setupColorPicker()

	/**
	 * Initializes the after title meta placeholder.
	 *
	 * @since   0.2.3
	 *
	 * @return  {Void}
	 */
	meta.initAfterTitlePlaceholder = function() {
		var elems = $('.after-title-placeholder');

		if ( elems.length === 0 ) {
			return;
		} // if()

		var inputs = elems.find('input');
		inputs.on('focus', function() {
			$(this).parent('.after-title-placeholder').removeClass('empty');
		});

		inputs.on('blur', function() {
			var that = $(this);

			if ( that.val() === '' ) {
				$(this).parent('.after-title-placeholder').addClass('empty');
			} // if()
		});

		inputs.on('change', function() {
			var that = $(this);

			if ( that.val() === '' ) {
				$(this).parent('.after-title-placeholder').addClass('empty');
			} // if()
		});
	}; // meta.initAfterTitlePlaceholder()

	/**
	 * Initializes all meta.
	 *
	 * @return Void
	 */
	meta.init = function() {
		meta.setupChosen();
		meta.setupDatepicker();
		meta.setupColorPicker();
		meta.initAfterTitlePlaceholder();
	}; // meta.init()

	/**
	 * Document ready
	 */
	$(document).ready(function() {
		meta.init();
	}); // $(document).ready()
})(jQuery));