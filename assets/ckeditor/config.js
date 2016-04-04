/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {

	config.skin='moono';
	// %REMOVE_START%
	// The configuration options below are needed when running CKEditor from source files.
	//config.plugins = 'dialogui,dialog,about,a11yhelp,dialogadvtab,basicstyles,bidi,blockquote,clipboard,button,panelbutton,panel,floatpanel,colorbutton,colordialog,templates,menu,contextmenu,div,resize,toolbar,elementspath,enterkey,entities,popup,filebrowser,find,fakeobjects,flash,floatingspace,listblock,richcombo,font,forms,format,horizontalrule,htmlwriter,iframe,wysiwygarea,image,indent,indentblock,indentlist,smiley,justify,menubutton,language,link,list,liststyle,magicline,maximize,newpage,pagebreak,pastetext,pastefromword,preview,print,removeformat,save,selectall,showblocks,showborders,sourcearea,specialchar,scayt,stylescombo,tab,table,tabletools,undo,wsc';
	config.plugins = 'menu,contextmenu,div,resize,toolbar,elementspath,enterkey,entities,popup,filebrowser,find,fakeobjects,flash,floatingspace,listblock,richcombo,font,forms,format,horizontalrule,htmlwriter,iframe,wysiwygarea,image,indent,indentblock,indentlist,smiley,justify,menubutton,language,link,list,liststyle,magicline,maximize,newpage,pagebreak,pastetext,pastefromword,preview,print,removeformat,save,selectall,showblocks,showborders,sourcearea,specialchar,scayt,stylescombo,tab,table,tabletools,undo,wsc';

	// Define changes to default configuration here. For example:
	 config.language = 'vi';
	 config.uiColor = '#2A3F54';
	config.backgroundColor = "rgba(26, 187, 156, 0.49)";
	config.enterMode = CKEDITOR.ENTER_BR;


	config.height = 200;
	config.toolbarCanCollapse = true;

	var base_url = 'http://local.studio/';
	config.filebrowserBrowseUrl =base_url + "assets/ckfinder/ckfinder.html";
	config.filebrowserImageBrowseUrl = base_url + "assets/ckfinder/ckfinder.html?type=Images";
	config.filebrowserFlashBrowseUrl = base_url + "assets/ckfinder/ckfinder.html?type=Flash";
	config.filebrowserUploadUrl = base_url + "assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files";
	config.filebrowserImageUploadUrl = base_url + "assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images";
	config.filebrowserFlashUploadUrl = base_url + "assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash";


};
