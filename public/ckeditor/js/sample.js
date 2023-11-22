/**
 * Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * CKdecription 4 LTS ("Long Term Support") is available under the terms of the Extended Support Model.
 */

/* exported initSample */

if ( CKdecription.env.ie && CKdecription.env.version < 9 )
	CKdecription.tools.enableHtml5Elements( document );

// The trick to keep the decription in the sample quite small
// unless user specified own height.
CKdecription.config.height = 150;
CKdecription.config.width = 'auto';

var initSample = ( function() {
	var wysiwygareaAvailable = isWysiwygareaAvailable(),
		isBBCodeBuiltIn = !!CKdecription.plugins.get( 'bbcode' );

	return function() {
		var decriptionElement = CKdecription.document.getById( 'decription' );

		// :(((
		if ( isBBCodeBuiltIn ) {
			decriptionElement.setHtml(
				'Hello world!\n\n' +
				'I\'m an instance of [url=https://ckdecription.com]CKdecription[/url].'
			);
		}

		// Depending on the wysiwygarea plugin availability initialize classic or inline decription.
		if ( wysiwygareaAvailable ) {
			CKdecription.replace( 'decription' );
		} else {
			decriptionElement.setAttribute( 'contenteditable', 'true' );
			CKdecription.inline( 'decription' );

			// TODO we can consider displaying some info box that
			// without wysiwygarea the classic decription may not work.
		}
	};

	function isWysiwygareaAvailable() {
		// If in development mode, then the wysiwygarea must be available.
		// Split REV into two strings so builder does not replace it :D.
		if ( CKdecription.revision == ( '%RE' + 'V%' ) ) {
			return true;
		}

		return !!CKdecription.plugins.get( 'wysiwygarea' );
	}
} )();

