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

	/**
	 * Encode risky field values before the POST hits options.php.
	 *
	 * ModSecurity can reject an options.php POST whose raw body contains Bengali
	 * text or raw image/HTTP URLs. Any input flagged with `data-brc-encode` whose
	 * current value holds non-ASCII (Bengali) characters, an http(s)/ftp URL, or
	 * markup is base64-encoded on submit and prefixed with `brc:`. The server's
	 * brc_decode_encode_field() restores the original value in the sanitizer, so
	 * the transport is plain ASCII while what is stored stays exactly as typed.
	 */
	function brcB64( str ) {
		var bytes, i, bin;
		try {
			var enc = new TextEncoder();
			bytes = enc.encode( str );
		} catch ( e ) {
			bytes = null;
		}
		if ( bytes ) {
			bin = '';
			for ( i = 0; i < bytes.length; i += 0x8000 ) {
				bin += String.fromCharCode.apply( null, bytes.subarray( i, i + 0x8000 ) );
			}
			return btoa( bin );
		}
		return btoa( unescape( encodeURIComponent( str ) ) );
	}

	function brcNeedsEncode( val ) {
		if ( ! val ) {
			return false;
		}
		return /[^\x00-\x7F]/.test( val ) ||
			/\bhttps?:\/\/|ftp:\/\//i.test( val ) ||
			/<[^>]+>/.test( val );
	}

	$( 'form[data-brc-encode-form="1"]' ).on( 'submit', function () {
		var $inputs = $( this ).find( 'input[data-brc-encode="1"]' );
		$inputs.each( function () {
			var $this = $( this );
			if ( brcNeedsEncode( $this.val() ) ) {
				$this.val( 'brc:' + brcB64( $this.val() ) );
			}
		} );
		return true;
	} );
} );