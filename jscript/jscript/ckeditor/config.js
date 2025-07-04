﻿/*
Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

/*
Copyright (c) 2003-2009, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

// This file is not required by CKEditor and may be safely ignored.
// It is just a helper file that displays a red message about browser compatibility
// at the top of the samples (if incompatible browser is detected).

// Firebug has been presented some bugs with console. It must be "initialized"
// before the page load to work.
// FIXME: Remove the following in the future, if Firebug gets fixed.
if ( typeof console != 'undefined' )
	console.log();

if ( window.CKEDITOR ){
	(function()	{
		var showCompatibilityMsg = function(){
			var env = CKEDITOR.env;

			var html = '<p><strong>Your browser is not compatible with CKEditor.</strong>';

			var browsers = {
				gecko : 'Firefox 2.0',
				ie : 'Internet Explorer 6.0',
				opera : 'Opera 9.5',
				webkit : 'Safari 3.0'
			};

			var alsoBrowsers = '';

			for ( var key in env ){
				if ( browsers[ key ] ){
					if ( env[key] )
						html += ' CKEditor is compatible with ' + browsers[ key ] + ' or higher.';
					else
						alsoBrowsers += browsers[ key ] + '+, ';
				}
			}
			alsoBrowsers = alsoBrowsers.replace( /\+,([^,]+), $/, '+ and $1' );
			html += ' It is also compatible with ' + alsoBrowsers + '.';
			html += '</p><p>With non compatible browsers, you should still be able to see and edit the contents (HTML) in a plain text field.</p>';
			document.getElementById( 'alerts' ).innerHTML = html;
		};
		var onload = function()	{
			// Show a friendly compatibility message as soon as the page is loaded,
			// for those browsers that are not compatible with CKEditor.
			if ( !CKEDITOR.env.isCompatible )
				showCompatibilityMsg();
		};
		// Register the onload listener.
		if ( window.addEventListener )
			window.addEventListener( 'load', onload, false );
		else if ( window.attachEvent )
			window.attachEvent( 'onload', onload );
	})();
}
var toolBarSet = [
					['About', 'Source'],['-','Bold','Italic','Underline','StrikeThrough','Undo','Redo'],
					['Style','FontFormat','FontName','FontSize'],['Cut','Copy','Paste','PasteText','PasteWord'],
					['OrderedList','UnorderedList','-','Outdent','Indent'],
					['Link','Unlink','Anchor'],['Table','Image','Flash','Rule','SpecialChar'],
					
				];

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
};
