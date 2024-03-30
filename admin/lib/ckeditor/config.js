/**
 * @license Copyright (c) 2003-2023, CKSource Holding sp. z o.o. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

const setFont = [
	'Kanit',
	'Prompt;',
	'SF Thonburi',
	'Pridi',
	'IBM Plex Sans Thai',
	'CS PraJad',
	'Lato',
	'Montserrat',
	'Poppins',
	'Roboto',
	'Lunasima'
].join(';')
CKEDITOR.editorConfig = function (config) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.height = 400;
	//the next line add the new font to the combobox in CKEditor
	config.font_names = setFont + config.font_names
};
