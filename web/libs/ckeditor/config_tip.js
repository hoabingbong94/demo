/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here.
    // For complete reference see:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config

    // The toolbar groups arrangement, optimized for two toolbar rows.
    config.allowedContent=true; 
    config.extraPlugins = 'smiley';
    config.toolbarGroups = [
       
        {name: 'tools'},
        {name: 'insert', items: ['Smiley']},
        {name: 'styles'},
        {name: 'colors'},
    ];
    config.toolbar = [
        {name: 'insert', items: ['Smiley']},
        {name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source']},
        {
            name: 'basicstyles',
            groups: ['basicstyles', 'cleanup'],
            items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
        },
        {name: 'styles'},
        {name: 'colors'}
       
    ];
    config.uiColor = '#F4F4F4';
    // Remove some buttons provided by the standard plugins, which are
    // not needed in the Standard(s) toolbar.
    config.removeButtons = 'Underline,Subscript,Superscript';

    // Set the most common block elements.
    config.format_tags = 'p;h1;h2;h3;pre';

    // Simplify the dialog windows.
    config.removeDialogTabs = 'image:advanced;link:advanced';
	config.enterMode=CKEDITOR.ENTER_BR;
           
            config.htmlEncodeOutput= false;
            config.entities= false;
            config.fillEmptyBlocks= false;
            config.forcePasteAsPlainText = true;
            config.pasteFromWordPromptCleanup = true;
            config.pasteFromWordRemoveFontStyles = true;
            config.ignoreEmptyParagraph = true;
            config.removeFormatAttributes = true;
};
