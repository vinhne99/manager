/*
Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.skin = 'kama';
    config.language = 'vi';
    config.enterMode = CKEDITOR.ENTER_BR;

    config.height = 200;
    config.toolbarCanCollapse = true;

    config.filebrowserBrowseUrl =bath + "assets/ckfinder/ckfinder.html";
    config.filebrowserImageBrowseUrl = bath + "assets/ckfinder/ckfinder.html?type=Images";
    config.filebrowserFlashBrowseUrl = bath + "assets/ckfinder/ckfinder.html?type=Flash";
    config.filebrowserUploadUrl = bath + "assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files";
    config.filebrowserImageUploadUrl = bath + "assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images";
    config.filebrowserFlashUploadUrl = bath + "assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash";


};
