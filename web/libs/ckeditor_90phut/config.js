/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function (config) {
    // Define changes to default configuration here.
    // For complete reference see:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config
    config.width = '100%';
    config.extraPlugins = 'video,youtube,htmlbuttons,allmedias,smiley';
    config.language = "vi";
    config.allowedContent = true;
    config.enterMode = CKEDITOR.ENTER_BR;
    config.filebrowserImageBrowseUrl = 'http://services.90phut.vn/admin/css/ckfinder/ckfinder.html';
    config.filebrowserBrowseUrl = 'http://services.90phut.vn/admin/css/ckfinder/ckfinder.html';
    //filebrowserUploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    // The toolbar groups arrangement, optimized for two toolbar rows.

    /*config.htmlbuttons = [
     {
     name:'button1',
     icon:'icon1.png',
     html:'<table style="background:#E9EAED" border="0" cellpadding="1" cellspacing="1" style="width:100%"><tr><td style="width:70px"><img alt="" src="http://service.90phut.vn//admin/images/imagecontent/files/%26MaxW%3D640%26imageVersion%3Ddefault%26AR-140919479.jpg" style="height:75px !important; width:75px !important" /></td><td style="vertical-align: top;  text-align :left; text-decoration:none">dsfsdfsdfsddsf</td></tr></table>',
     title:'Thêm mới tip'
     },
     {
     name:'button2',
     icon:'icon2.png',
     html:'<table border="0" style="width:100%;background:#E9EAED"><tr><td><img alt="" src="http://service.90phut.vn//admin/images/imagecontent/files/%26MaxW%3D640%26imageVersion%3Ddefault%26AR-140919479.jpg" style="height:100% !important; width:100% !important" /></td></tr><tr><td style="vertical-align: top; text-decoration:none">dsfsdfsdfsddsf</td></tr></table>',
     title:'Thêm mới tip'
     },
     ];*/
    config.height = "500px";
    config.toolbarGroups = [
        {name: 'clipboard', groups: ['clipboard', 'undo']},
        {name: 'editing', groups: ['find', 'selection', 'spellchecker']},
        /*{ name: 'links' },*/
        {name: 'insert', items: ['Table']},
        //{ name: 'forms' },
        {name: 'tools'},
        {name: 'document', groups: ['mode', 'document', 'doctools']},
        {name: 'others'},

        {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
        {name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi']},
        {name: 'styles'},
        {name: 'colors'},


    ];
    config.toolbar = [
        {
            name: 'clipboard',
            groups: ['clipboard', 'undo'],
            items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
        },
        {name: 'editing', groups: ['find', 'selection', 'spellchecker'], items: ['Scayt']},
        {name: 'insert', items: ['Table', 'Image', 'Video', 'Smiley']},
        {name: 'tools', items: ['Maximize']},
        {name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source']},
        {
            name: 'basicstyles',
            groups: ['basicstyles', 'cleanup'],
            items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
        },
        {
            name: 'paragraph',
            groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
            items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
        },
        {name: 'styles', items: ['Format']},
        { name: 'links', items : [ 'Link','Unlink' ] }
    ];


    // Remove some buttons provided by the standard plugins, which are
    // not needed in the Standard(s) toolbar.
    //config.removeButtons = 'Underline,Subscript,Superscript';
    config.removeButtons = 'button3';
    config.htmlEncodeOutput= false,
    config.entities= false,

    CKEDITOR.config.fontSize_sizes = '8/8px;9/9px;10/10px;11/11px;12/12px;12a/13px;14/14px;15/15px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px';
    config.selectMultiple = true;
    // Set the most common block elements.
    config.format_tags = 'p;h1;h2;h3;pre';

    // Simplify the dialog windows.
    config.removeDialogTabs = 'image:advanced;link:advanced';
    config.smiley_images = ['match_action_1.png', 'match_action_2.png', 'match_action_3.png', 'match_action_5.png', 'match_action_6.png', 'match_action_7.png', 'match_action_8.png', 'match_action_11.png', 'match_action_14.png', 'ti_le.png', 'the_vang.png', 'the_do.png', 'kick_off.png', 'pen.png', 'phat_goc.png', 'ban_thang.png', 'thay_nguoi.png', 'doihinh_rasan.png'];
    config.smiley_descriptions = ['Sút vào', 'Thẻ vàng', 'Thẻ vàng thứ 2', 'Ra sân', 'Vào sân', 'Thẻ đỏ', '11m không vào', '11m vào', 'Sút phạt vào', 'Kiến tạo', 'Tỉ lệ', 'Thẻ vàng', 'Thẻ đỏ', 'Kick off', 'Penaty', 'Phạt góc', 'Bàn thắng', 'Thay người', 'Đội hình ra sân'];
};
