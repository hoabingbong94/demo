function loaddatetime() {
    $('#datetimepicker2').datetimepicker({
        locale: 'vi',
        format: 'YYYY-MM-DD HH:mm:SS'
    });
}

function loaddatestart() {
    $('#startdate').datetimepicker({
        locale: 'vi',
        format: 'YYYY-MM-DD'
    });
}
function loaddateend() {
    $('#enddate').datetimepicker({
        locale: 'vi',
        format: 'YYYY-MM-DD'
    });
}

function loaddate() {
    $('#datetimepicker3').datetimepicker({
        locale: 'vi',
        format: 'YYYY-MM-DD'
    });
}

$(document).ready(function () {
    loaddatetime();
    loaddateend();
    loaddate();
    loaddatestart();
    loaddateend();
    preVideo('');
    preVideo('Ck');
});
function preVideo(type) {
    $("#uploadVideo" + type).on('change', function (e) {
        var file_video = $(this)[0].files[0];
        var objVideo = $("#preVideo" + type);
        var fileUrl = URL.createObjectURL(file_video);
        objVideo.attr('src', fileUrl);
        objVideo.stop();
        objVideo.get(0).play();
    });
}
function hastag() {
    $(document).on('click', 'span[data-tag]', function (e) {
        var tageditor = $(this).attr('data-tag');
        console.log(tageditor);
        var CKEDITOR = window.parent.CKEDITOR;
        if (tageditor == 'Content') {
            var g = CKEDITOR.instances.Content;
            if (CKEDITOR.env.ie) {
                selection = g.getSelection().document.$.selection.createRange().text;
            } else {
                selection = g.getSelection().getSelectedText();
            }
            CKEDITOR.instances.Content.insertHtml('[tag]' + selection + '[/tag]');
            CKEDITOR.dialog.getCurrent('').hide();

        } else if (tageditor == 'ContentExtend') {
            var g = CKEDITOR.instances.ContentExtend;
            if (CKEDITOR.env.ie) {
                selection = g.getSelection().document.$.selection.createRange().text;
            } else {
                selection = g.getSelection().getSelectedText();
            }
            CKEDITOR.instances.ContentExtend.insertHtml('[tag]' + selection + '[/tag]');
            CKEDITOR.dialog.getCurrent('').hide();

        } else if (tageditor == 'Tip') {
            var g = CKEDITOR.instances.Tip;
            if (CKEDITOR.env.ie) {
                selection = g.getSelection().document.$.selection.createRange().text;
            } else {
                selection = g.getSelection().getSelectedText();
            }
//            addtag(selection);
            CKEDITOR.instances.Tip.insertHtml('[tag]' + selection + '[/tag]');
            CKEDITOR.dialog.getCurrent().hide();
        } else if (tageditor == 'News') {
            var g = CKEDITOR.instances.News;
            if (CKEDITOR.env.ie) {
                selection = g.getSelection().document.$.selection.createRange().text;
            } else {
                selection = g.getSelection().getSelectedText();
            }
//            addtag(selection);
            CKEDITOR.instances.News.insertHtml('[tag]' + selection + '[/tag]');
            CKEDITOR.dialog.getCurrent().hide();
        }
    });
}
//function addimageedior() {
$(document).on('change', 'input[data-image-editor]', function (e) {
    var editor = $(this).attr('data-image-editor');
    $("#load" + editor).show();
    fd = new FormData();
    var file = [];
    for (var i = 0; i < $(this).get(0).files.length; i++) {
        file[i] = $(this).prop('files')[i];
        fd.append('file_up[' + i + ']', $(this).prop('files')[i]);
    }
    //console.log(file);
    var csrf = $("#_csrf").val();
    fd.append('_csrf', csrf);

    $.ajax({
        url: '/app433/post/upload-img',
        type: 'POST',
        data: fd,
        processData: false,
        contentType: false,
        success: function (data) {
            //console.log(data);
            //$('.upload-media .progress').hide();
            if (editor == "Content") {
                CKEDITOR.instances.Content.insertHtml(data);
            } else if (editor == "ContentExtend") {
                CKEDITOR.instances.ContentExtend.insertHtml(data);
            } else {
                //CKEDITOR.instances.editorlive.insertHtml(data);
            }
            $("#load" + editor).hide();
        },
        error: function (data) {
            //$('.upload-media .progress').hide();
            alert("Đã có lỗi. Upload thất bại");
            $("#load" + editor).hide();

        }

    });

});
$(document).on('change', 'input[data-video-editor]', function (e) {
    var editor = $(this).attr('data-video-editor');
    var file = $(this).prop('files')[0];
    fd = new FormData();
    fd.append('file_up', file);

    $.ajax({
        url: '/app433/post/upload-video',
        type: 'POST',
        data: fd,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data == "loi") {
                alert("Định dạng video không hợp lệ.")
            } else {
                //console.log(data);
                //$('.upload-media .progress').hide();
                if (editor == "Content") {
                    CKEDITOR.instances.Content.insertHtml(data);
                } else if (editor == "ContentExtend") {
                    CKEDITOR.instances.ContentExtend.insertHtml(data);
                } else {
                    //CKEDITOR.instances.editorlive.insertHtml(data);
                }
            }
        },
        error: function (data) {
            //$('.upload-media .progress').hide();
            alert("Đã có lỗi. Upload thất bại");

        }

    });

});
//}
function addAlbumVideo() {
    $("#flagAction").val("add");
    $("#Modle_Video_Highlight").modal('show');
}
function addTmpVideo() {
    $("#rotateLoad").show();
    $(".iconUpload").hide();
    var videoFile = $("#uploadVideo").prop('files')[0];
    var imagesFile = $("#upload-thumb-highlight").prop('files')[0];
    var title = $("#title-highlight").val();
    var order = $("#order-highlight").val();
    var id = $("#keyItemVideo").val();
    var frmData = new FormData();
    frmData.append('videoFile', videoFile);
    frmData.append('imagesFile', imagesFile);
    frmData.append('title', title);
    frmData.append('order', order);
    frmData.append('id', id);
    var action = "add-item-video";
    if ($("#flagAction").val() == "edit") {
        action = "edit-item-video";
    }
    $.ajax({
        url: '/app433/post/' + action,
        type: 'POST',
        data: frmData,
        processData: false,
        contentType: false,
        success: function (data) {
            $("#listVideo").html(data);
            $("#Modle_Video_Highlight").modal('hide');
            $("#title-highlight").val("");
            $("#order-highlight").val("");
            $("#uploadVideo").val("");
            $("#preVideo").attr("src", '');
            $("#upload-thumb-highlight").val("");
            $("#thumb-video-highlight").attr("src", '');
            $("#rotateLoad").hide();
            $(".iconUpload").show();
        }
    });
}
function removeItemVideo(id) {
    $.ajax({
        url: '/app433/post/remove-item-video',
        type: 'GET',
        data: {id: id},
        success: function (data) {
            $("#listVideo").html(data);
        }
    });
}
function loadItemVideo(id) {
    $.ajax({
        url: '/app433/post/load-item-video',
        type: 'GET',
        data: {id: id},
        success: function (data) {
            $("#flagAction").val("edit");
            var item = JSON.parse(data);
            $("#Modle_Video_Highlight").modal('show');
            $("#title-highlight").val(item.title);
            $("#keyItemVideo").val(id);
            $("#order-highlight").val(item.order);
            $("#video-preview-highlight").attr("src", item.video);
            $("#video-preview-highlight").get(0).play();
            $("#thumb-video-highlight").attr("src", item.images);
        }
    });
}
function addEvent() {
    var orderlast = $("#orderLive").val();
    $("#frmOrder").val(orderlast);
    $("#Modle_Live").modal('show');
    $("#actionEvent").val("add");
}
function resetFrmLive() {
    $("#type_event").val("");
    $("#minute").val("");
    $("#uploadVideo").val("");
    CKEDITOR.instances.Content.setData('');
    $("#preVideo").attr('src', '');
}
function addEventFrm() {
    var postId = $("#postId").val();
    var eventType = $("#type_event").val();
    var minute = $("#minute").val();
    var order = $("#frmOrder").val();
    var content = CKEDITOR.instances.Content.getSnapshot();
    var videoFile = $("#uploadVideo").prop('files')[0];
    var frmData = new FormData();
    frmData.append('videoFile', videoFile);
    frmData.append('postId', postId);
    frmData.append('eventType', eventType);
    frmData.append('minute', minute);
    frmData.append('content', content);
    frmData.append('order', order);
    frmData.append('_csrf', $("#_csrf").val());
    var action = "add-event";
    if ($("#actionEvent").val() == "edit") {
        action = "edit-event";
        frmData.append('id', $("#idEvent").val());
    }
    $.ajax({
        url: '/app433/post/' + action,
        type: 'POST',
        data: frmData,
        processData: false,
        contentType: false,
        success: function (data) {
            $("#Modle_Live").modal('hide');
            reloadLive(postId);
            resetFrmLive();
            $("#postId").val(postId);
            $("#type_event").val(0);
        }
    });
}
function reloadLive(postId) {
    $.ajax({
        url: '/app433/post/reload-event',
        type: 'GET',
        data: {postId: postId},
        success: function (data) {
            $("#reloadLive").html(data);
        }
    });
}
function loadVideoDemo(id) {
    $("#demoVideo").modal('show');
    var urlVideo = $("#tmpValue" + id).attr('data-media');
    $("#videoLiveDemo").attr("src", urlVideo);
    $("#videoLiveDemo").get(0).play();
}
function delLive(id, postId) {
    $.ajax({
        url: '/app433/post/del-event',
        type: 'GET',
        data: {id: id},
        success: function (data) {
            $("#live" + id).remove();
        }
    });
}
function loadEditEvent(id) {
    $.ajax({
        url: '/app433/post/find-by-event-id',
        type: 'GET',
        data: {id: id},
        success: function (data) {
            var data = JSON.parse(data);
            $("#actionEvent").val("edit");
            $("#Modle_Live").modal('show');
            $("#minute").val(data.Minute);
            $("#type_event").val(data.Type);
            $("#frmOrder").val(data.Order);
            $("#idEvent").val(id);
            var media = data.UrlVideo;
            $("#preVideo").attr('src', media);
            var content = data.Content;
            CKEDITOR.instances.Content.setData('');
            setTimeout(function () {
                CKEDITOR.instances.Content.insertHtml(content);
            }, 200);
        }
    });

}
function countChar(maxLenght, curent_length, element, cElement) {
    if (cElement == 0) {
        element.append("<span class='count'>" + curent_length + "/" + maxLenght + "</span>");
    } else {
        if (curent_length > maxLenght) {
            element.children("span").addClass('countErr');
        } else {
            element.children("span").removeClass('countErr');
        }
        element.children("span").html(curent_length + "/" + maxLenght);
    }
}
function strip(html) {
    var tmp = document.createElement("DIV");
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || "";
}

if (typeof CKEDITOR.instances['Content'] != 'undefined') {
    CKEDITOR.instances['Content'].on('change', function () {
        var type = $("#post-type").val();
        if (type != "4") {
            var element = $(".control-label[for='Content']");
            var cElement = element.children("span").length;
            var plain_text_content = CKEDITOR.instances.Content.getSnapshot();
            var curent_length = strip(plain_text_content).split("[tag]").join("").split("[/tag]").join("").length;
            countChar(180, curent_length, element, cElement);
        }
    });
}

if (typeof CKEDITOR.instances['ContentExtend'] != 'undefined') {
    CKEDITOR.instances['ContentExtend'].on('change', function () {
        var element = $(".control-label[for='ContentExtend']");
        var cElement = element.children("span").length;
        var plain_text_content = CKEDITOR.instances.ContentExtend.getSnapshot();
        var curent_length = strip(plain_text_content).split("[tag]").join("").split("[/tag]").join("").length;
        countChar(320, curent_length, element, cElement);
    });
}
if (typeof CKEDITOR.instances['Description'] != 'undefined') {
    CKEDITOR.instances['Description'].on('change', function () {
        var element = $(".control-label[for='Description']");
        var cElement = element.children("span").length;
        var plain_text_content = CKEDITOR.instances.Description.getSnapshot();
        var curent_length = strip(plain_text_content).split("[tag]").join("").split("[/tag]").join("").length;
        countChar(145, curent_length, element, cElement);
    });
}
$(document).ready(function () {
    $("#Title").on('keypress', function () {
        var element = $(".control-label[for='Title']");
        var cElement = element.children("span").length;
        var curent_length = $("#Title").val().length;
        countChar(75, curent_length, element, cElement);
    });
    $("#TitleNewsHome").on('keypress', function () {
        var element = $(".control-label[for='TitleNewsHome']");
        var cElement = element.children("span").length;
        var curent_length = $("#TitleNewsHome").val().length;
        countChar(80, curent_length, element, cElement);
    });
    $("#Summary").on('keypress', function () {
        var element = $(".control-label[for='Summary']");
        var cElement = element.children("span").length;
        var curent_length = $("#Summary").val().length;
        countChar(145, curent_length, element, cElement);
    });
    $("#90phut-News-Summary").on('keypress', function () {
        var element = $(".control-label[for='90phut-News-Summary']");
        var cElement = element.children("span").length;
        var curent_length = $("#90phut-News-Summary").val().length;
        countChar(145, curent_length + 1, element, cElement);
    });
    $("#Videointo-Description").on('keypress', function () {
        var element = $(".control-label[for='Videointo-Description']");
        var cElement = element.children("span").length;
        var curent_length = $("#Videointo-Description").val().length;
        countChar(500, curent_length + 1, element, cElement);
    });
    $("#Video-Title").on('keypress', function () {
        var element = $(".control-label[for='Video-Title']");
        var cElement = element.children("span").length;
        var curent_length = $("#Video-Title").val().length;
        countChar(200, curent_length + 1, element, cElement);
    });
    $("#Cate-Title").on('keypress', function () {
        var element = $(".control-label[for='Cate-Title']");
        var cElement = element.children("span").length;
        var curent_length = $("#Cate-Title").val().length;
        countChar(200, curent_length + 1, element, cElement);
    });


    $("#post-categoryid").on('change', function () {
        var id = $(this).val();
        $.ajax({
            url: '/app433/post/get-img-categories',
            type: 'GET',
            data: {id: id},
            success: function (data) {
                $("#logoDefaultCategories").val(data);
            }
        });
    });

    var timeInterval = null;
    $("#matchId").on('keypress', function () {
        if (timeInterval) {
            clearInterval(timeInterval);
            timeInterval = null;
        }
        timeInterval = setInterval(function () {
            var keyword = $("#matchId").val();
            $.ajax({
                url: '/app433/post/search-match',
                type: 'GET',
                data: {keyword: keyword},
                success: function (data) {
                    $(".resultSearchMatch").show();
                    $("#dataSearchMatch").html(data);
                    clearInterval(timeInterval);
                }
            });
        }, 500);
    });
    $('.dropdown-submenu a').on("click", function (e) {
        $(this).next('ul').toggle();
        e.stopPropagation();
        e.preventDefault();
    });
});

function checkDir(flag) {
    if (flag == 1) {
        $("#redirectFlag").val("post");
    } else if (flag == 2) {
        $("#redirectFlag").val("update");
    } else if (flag == 3) {
        $("#redirectFlag").val("close");
    }
}
function getHashTag(content) {
    var regex = /\[tag\].+?\[\/tag\]/g;
    var hash_map = content.match(regex);
    console.log(hash_map);
    if (hash_map != null) {
        for (var i = 0; i < hash_map.length; i++) {
            var tag = hash_map[i];
            var tmp_tag = tag.substr(5, tag.length - 11);
            var a_tag = '<a class="" href="#">' + tmp_tag + '</a>';
            content = content.replace(tag, a_tag);
        }
    }
    return content;
}
function changeSize() {
    var width = $("#selectDevice").val();
    $("#resizePreview").css('width', width);
    $("#resizePreview").addClass('previewIphone5');
}
function preview(type) {
    var content = CKEDITOR.instances.Content.getSnapshot();
    content = getHashTag(content);
    var logo;
    var img = $("#CoverImage").val();
    if (img == "") {
        logo = $("#logoDefaultCategories").val();
    } else {
        var imgSplit = img.split("}}}");
        logo = imgSplit[1];
    }
    if (type == 0) {
        $("#modal-preview").modal('show');
        var contentExtend = CKEDITOR.instances.ContentExtend.getSnapshot();
        contentExtend = getHashTag(contentExtend);
        var categories = $("#post-categoryid  option:selected").text();
        var find = '-';
        var re = new RegExp(find, 'g');
        categories = categories.replace(re, "");
        var keyword = $("#Keyword").val();
        var time = $("#post-datepublic").val();
        $("#preview-img").attr('src', logo);
        $("#preview-categoriesName").html(categories);
        $("#preview-ContentExtend").html(contentExtend);
        $("#preview-keyword").html("Từ khóa: <span>" + keyword + "</span>");
        $("#preview-time").html("Xuất bản lúc: <span>" + time + "</span>");
    }
    if (type == 4) {
        $("#modal-preview-long").modal('show');
        var title = $("#Title").val();
        var sapo = $("#Summary").val();
        $("#preview-title").html(title);
        $("#preview-sapo").html(sapo);
        $("#preview-cover").attr('style', "width:100%;height:250px;background: url('" + logo + "');background-size: cover;background-position: top;");
        $("#preview-contentlong").html(content);
    }
    $("#preview-Content").html(content);
    return false;
}
function selectMatch(matchId) {
    var info = $("#info" + matchId).attr("data-info");
    $("#setMatchId").val(matchId);
    $("#matchId").val(matchId + " | " + info);
    $(".resultSearchMatch").hide();
}
function popupChoiceTypeAdd() {
    $("#modal-add-post").modal('show');
}
function deletePost(id) {
    $.ajax({
        url: '/app433/post/delete-post',
        type: 'GET',
        data: {id: id},
        success: function (data) {
            $("#listPost" + id).remove();
        }
    });
}
function copyVideo(id, flag) {
    var urlVideo = $("#listVideo" + id).attr("data-video" + flag);
    var field = $("#copyVideo" + id);
    field = field.val(urlVideo);
    field.slideDown(200);
    field.focus();
    var lengthLink = field.val().length;
    field[0].setSelectionRange(0, lengthLink);
    var copysuccess = copySelectionText();
    $("#dropdown" + id).toggle();
    setTimeout(function () {
        field.slideUp(200);
    }, 5000);
}
function copyfieldvalue(id) {
    var field = $("#linkCopy" + id);
    field.slideDown(200);
    field.focus();
    var lengthLink = field.val().length;
    field[0].setSelectionRange(0, lengthLink);
    var copysuccess = copySelectionText();
    setTimeout(function () {
        field.slideUp(200);
    }, 5000);
}

function copySelectionText() {
    var copysuccess // var to check whether execCommand successfully executed
    try {
        copysuccess = document.execCommand("copy") // run command to copy selected text to clipboard
    } catch (e) {
        copysuccess = false
    }
    return copysuccess
}
function openBoxInsertVideo() {
    $("#modal-insertLinkVideo").modal('show');
}
function insertVideoLink() {
    var linkVideo = $("#linkVideoInsertCk").val();
    var exSplit = linkVideo.split("|");

    if (linkVideo != "") {
        var CKEDITOR = window.parent.CKEDITOR;
        var videoHtml = "<video poster='" + exSplit[1] + "' style='width:100%;' controls='true'>" +
                "<source src='" + exSplit[0] + "' type='video/mp4'></video><br>";
        CKEDITOR.instances.Content.insertHtml(videoHtml);
        $("#modal-insertLinkVideo").modal('hide');
        $("#linkVideoInsertCk").val("");
        CKEDITOR.dialog.getCurrent('').hide();
    } else {
        alert('Url khong hop le');
    }
}
/*Block Notification*/
$(document).ready(function () {
    /*Notice News*/
    setInterval(scanNews, 15000);
    setInterval(getCountNews, 15000);
    /*Notice Tips*/
    setInterval(scanTips, 15000);
    setInterval(getCountTips, 15000);
});

function scanNews() {
    callNotice("notification", 0, "News", " tin");
}
function scanTips() {
    callNotice("notification/scan-tips", 0, "Tips", " nhận định");
}
function getCountNews() {
    callNotice("notification/count-notification?type=1", 1, "News", " tin");
}
function getCountTips() {
    callNotice("notification/count-notification?type=2", 1, "Tips", " nhận định");
}
function callNotice(url, flag, flagAction, text) {
    $.ajax({
        url: '/app433/' + url,
        type: 'GET',
        success: function (data) {
            if (data != "0") {
                setNotice(data, flag, flagAction, text);
            }
        }
    });
}
function setNotice(number, flag, flagAction, text) {
    $("#noticeContent" + flagAction).html("<b>90phut </b>đang có " + number + text + " mới chờ đăng.");
    if (flag == 1) {
        var notice = getCookie("notice");
        if (notice != "") {
        } else {
            setCookie("notice", flagAction, 0);
            $("#notice" + flagAction).slideDown(200);
        }
    } else {
        setCookie("notice", flagAction, 0);
        $("#notice" + flagAction).slideDown(200);
    }
    setTimeout(function () {
        $("#notice" + flagAction).slideUp(200);
    }, 20000);
}
function closeNotice(flag) {
    if (flag == 1) {
        $("#noticeNews").slideUp(200);
    } else {
        $("#noticeTips").slideUp(200);
    }
}
/*End Block Notification*/
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    //d.setHours(d.getHours + 4);
    d.setSeconds(d.getSeconds() + 60);
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ')
            c = c.substring(1);
        if (c.indexOf(name) == 0)
            return c.substring(name.length, c.length);
    }
    return "";
}
/*TMP 90phut*/
function addTmpAlbumPhoto() {
    var title = $("#title-album-photo").val();
    var imageFile = $("#file-album-photo").prop('files')[0];
    var key = $("#keyItemImage").val();
    var url = "add-item";
    if (key != "") {
        url = "update-item";
    }
    var frmData = new FormData();
    frmData.append('title', title);
    frmData.append('imageFile', imageFile);
    frmData.append('type', "0");
    frmData.append('key', key);
    $.ajax({
        url: '/app90phut/album/' + url,
        type: 'POST',
        data: frmData,
        processData: false,
        contentType: false,
        success: function (data) {
            $("#listVideo").html(data);
        }
    });
}
function addTmpAlbumVideo() {
    var title = $("#title-album-video").val();
    var videoFile = $("#uploadVideo").prop('files')[0];
    var imageFile = $("#videoPoster").val();
    var key = $("#keyItemVideo").val();
    var url = "add-item";
    if (key != "") {
        url = "update-item";
    }
    var frmData = new FormData();
    frmData.append('title', title);
    frmData.append('videoFile', videoFile);
    frmData.append('imageFile', imageFile);
    frmData.append('type', "1");
    frmData.append('key', key);
    $.ajax({
        url: '/app90phut/album/' + url,
        type: 'POST',
        data: frmData,
        processData: false,
        contentType: false,
        success: function (data) {
            $("#listVideo").html(data);
        }
    });
}
function removeItemAlbumImage(k, type) {
    $.ajax({
        url: '/app90phut/album/remove-item',
        type: 'GET',
        data: {id: k, type: type},
        success: function (data) {
            $("#itemAlbum" + k).remove();
        }
    });
}
function loadItemAlbumVideo(k, type) {
    $.ajax({
        url: '/app90phut/album/load-item',
        type: 'GET',
        data: {k: k, type: type},
        success: function (data) {
            var obj = JSON.parse(data);
            var title = obj.title;
            var fileName = obj.fileName;
            var fileVideo = obj.fileVideo;
            if (type == 1) {
                $("#title-album-video").val(title);
                $("#preVideo").attr('src', fileVideo);
                $("#preVideo").attr('poster', fileName);
                $("#thumb-video-highlight").attr('src', fileName);
                $("#keyItemVideo").val(k);
            } else {
                $("#title-album-photo").val(title);
                $("#keyItemImage").val(k);
            }
            $("#Modle_Video_Highlight").modal('show');
        }
    });
}
$(document).ready(function () {
    $(function () {
        $("#date ").datetimepicker({
            format: 'YYYY-MM-DD'
        });
        if (typeof $("#time") != 'undefined') {
            $("#time").mask('99:99:99');
        }
    });
});
function searchAdv() {
    $(".topOption").hide(100);
    $("#searchAdv").show(100);
}
function closeSearchAdv() {
    $(".topOption").show(100);
    $("#searchAdv").hide(100);
}
function report() {
    $("#btnSubmitReport").text("Gửi số liệu...");
    setTimeout(function () {
        $("#btnSubmitReport").text("Đang xử lí...");
        var type = $("#type").val();
        var typeReport = $("#typeReport").val();
        var order = $("#order").val();
        var userCreate = $("#userCreate").val();
        var date = $("#datetimepicker3").val();
        var enddate = $("#enddate").val();
        var typeView = $("#typeView").val();
        $.ajax({
            url: '/app90phut/report/report',
            type: 'GET',
            data: {
                type: type,
                typeReport: typeReport,
                order: order,
                userCreate: userCreate,
                date: date,
                enddate: enddate,
                typeView: typeView
            },
            success: function (data) {
                $("#btnSubmitReport").text("Đang nhận dữ liệu...");
                setTimeout(function () {
                    $("#btnSubmitReport").text("Thống kê");
                    $("#data-report").html(data);
                }, 1000);
            }
        });
    }, 500);
}
function reportView90phut() {
    $("#typeViewAll").remove();
    $("#typeStar").remove();
    $("#typeAlbum").remove();
    $("#userCreate").removeAttr('disabled');
    var select = $("#typeView").val();
    if (select === "view") {
        $("#userCreate").val('');
        $("#userCreate").attr('disabled', 'true');
        $("#type").append('<option id="typeViewAll" value="all">Tất cả</option>');
    } else {
        $("#type").append('<option id="typeStar" value="star">Ngôi sao</option><option id="typeAlbum" value="album">Bóng hồng</option>');
    }
}
function searchTeam(idElement) {
    $("#data-search" + idElement).show();
    var value = $("#" + idElement).val();
    $.ajax({
        url: "/app433/broadcast/search-team",
        type: 'GET',
        data: {keyword: value, idElement: idElement},
        success: function (data) {
            $("#data-search" + idElement).html(data);
        }
    });
}
function loadImg(teamId, element, teamName) {
    $("#img" + element).attr('src', 'http://static.bongdaplus.vn/Assets/Soccer/teams/' + teamId + '.png');
    $("#" + element).val(teamName);
    $("#inputId" + element).val(teamId);
    $("#data-search" + element).hide();
}
$(document).ready(function () {
    if (document.getElementById("colorTeamHome") != null) {
        var theInput = document.getElementById("colorTeamHome");
        theInput.addEventListener("input", function () {
            var colorCode = theInput.value;
            $("#inputColorhomeTeam").val(colorCode);
            $("#color-teamHome").attr('style', 'background:' + colorCode);
            $("#colorTeamHomeBtn").attr('style', 'background:' + colorCode);
        }, false);
    }
    if (document.getElementById("colorTeamAway") != null) {
        var theInputs = document.getElementById("colorTeamAway");
        theInputs.addEventListener("input", function () {
            var colorCode = theInputs.value;
            $("#inputColorawayTeam").val(colorCode);
            $("#color-teamAway").attr('style', 'background:' + colorCode);
            $("#colorTeamAwayBtn").attr('style', 'background:' + colorCode);
        }, false);
    }
});
function openPopupUploadVideoCkEdit(ckEditer) {
    $("#ckInsertVideo").val(ckEditer);
    $("#Module_Video_CkEditor").modal('show');
}
function uploadVideoCkeditor() {
    $("#rotateLoad").show();
    $("#iconUpload").hide();
    var videoFile = $("#uploadVideoCk").prop('files')[0];
    var imageFile = $("#videoPoster").val();
    var url = "upload-video-poster";
    var frmData = new FormData();
    frmData.append('videoFile', videoFile);
    frmData.append('imageFile', imageFile);

    $.ajax({
        url: '/app433/post/' + url,
        type: 'POST',
        data: frmData,
        processData: false,
        contentType: false,
        success: function (data) {
            $("#rotateLoad").hide();
            $("#iconUpload").show();
            $("#Module_Video_CkEditor").modal('hide');
            var editor = $("#ckInsertVideo").val();
            if (data == "loi") {
                alert("Định dạng video không hợp lệ.")
            } else {
                if (editor == "Content") {
                    CKEDITOR.instances.Content.insertHtml(data);
                } else if (editor == "ContentExtend") {
                    CKEDITOR.instances.ContentExtend.insertHtml(data);
                }
            }
        }
    });
}