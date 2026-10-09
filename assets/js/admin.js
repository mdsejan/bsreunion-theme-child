/**
 * Theme Settings admin — WordPress Media Library integration for gallery image fields.
 *
 * Each gallery item is rendered by brc_render_image_field() as its own wrapper
 * (`.brc-image-field`) with a unique hidden input (`.brc-image-value`) and preview
 * (`.brc-image-preview`). To keep selections isolated we:
 *   1. resolve the wrapper from the clicked button via $(this).closest(), and
 *   2. create a brand-new wp.media frame per click so 'select' handlers never
 *      stack across different items (which caused every field to be overwritten
 *      with the last selected image).
 */
jQuery( function ( $ ) {
	'use strict';

	$( document ).on( 'click', '.brc-upload-btn', function ( e ) {
		e.preventDefault();

		// Scope strictly to THIS item's field wrapper.
		var $container = $( this ).closest( '.brc-image-field' );
		var $input     = $container.find( '.brc-image-value' );
		var $preview   = $container.find( '.brc-image-preview' );

		// Fresh frame per click: no shared frame, no stale/stacked select handlers.
		var frame = wp.media( {
			title   : 'স্মৃতির ক্যানভাস ছবি নির্বাচন',
			button  : { text: 'নির্বাচন করুন' },
			library : { type: 'image' },
			multiple: false
		} );

		frame.on( 'select', function () {
			var attachment = frame.state().get( 'selection' ).first().toJSON();
			// Only this item's input + preview are touched.
			$input.val( attachment.url );
			$preview.html( '<img src="' + attachment.url + '" style="max-width:120px;max-height:120px;border:1px solid #ddd;padding:3px;" />' );
		} );

		frame.open();
	} );

	$( document ).on( 'click', '.brc-remove-btn', function ( e ) {
		e.preventDefault();
		var $container = $( this ).closest( '.brc-image-field' );
		$container.find( '.brc-image-value' ).val( '' );
		$container.find( '.brc-image-preview' ).empty();
	} );
} );