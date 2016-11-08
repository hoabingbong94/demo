/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function genPreview(img_element, event) {
    var img = document.querySelector('#' + img_element);
    var file = event.target.files[0];
    img.src = URL.createObjectURL(file);
}

$(document).on('change', 'input[data-preview][accept="image/*"]', function (e) {
    var img_preview = $(this).attr('data-preview');
    genPreview(img_preview, e);
});


//function addimageedior() {
$(document).on('change', 'input[add-image-editor]', function (e) {
    var editor = $(this).attr('add-image-editor');
    fd = new FormData();
    $("#load" + editor).show();
    var file = [];
    for (var i = 0; i < $(this).get(0).files.length; i++) {
        file[i] = $(this).prop('files')[i];
        fd.append('file_up[' + i + ']', $(this).prop('files')[i]);
    }
    var csrf = $("#_csrf").val();
    fd.append('file_up', file);
    fd.append('_csrf', csrf);

    $.ajax({
        url: '/app90phut/upload/upload-img',
        type: 'POST',
        data: fd,
        processData: false,
        contentType: false,
        success: function (data) {
            if (editor == "Tip") {
                CKEDITOR.instances.Tip.insertHtml(data);
            }

            if (editor == "News") {
                CKEDITOR.instances.News.insertHtml(data);
            }

            if (editor == "Content") {
                CKEDITOR.instances.Content.insertHtml(data);
            }

            if (editor == "ContentExtend") {
                CKEDITOR.instances.ContentExtend.insertHtml(data);
            }

            $("#load" + editor).hide();
        },
        error: function (data) {
            alert("Đã có lỗi. Upload thất bại");
            $("#load" + editor).hide();
        }

    });

});

function insert_video(id) {

    var link = $("#" + id).attr("data-video");
    var avatar = $("#" + id).attr("data-avatar");
    var title = $("#" + id).attr("data-title");
    var string = "<video controls='controls' style='margin:0 auto'  height='250' id='video" + id + "' poster='" + avatar + "' width='320'\> " +
            " <source src='" + link + "' type='video/mp4' />" +
            " </video>";
    if (CKEDITOR.instances.Content)
    {
        CKEDITOR.instances.Content.insertHtml(string);
    } else {
        CKEDITOR.instances.News.insertHtml(string);
    }
    $("#video-search-detail").hide();
    $("#video-search-text").val(title);

}
function insert_videoStar(id) {

    var link = $("#" + id).attr("data-video");
    var avatar = $("#" + id).attr("data-avatar");
    var title = $("#" + id).attr("data-title");
    var string = "<video controls='controls' style='margin:0 auto'  height='250' id='video" + id + "' poster='" + avatar + "' width='320'\> " +
            " <source src='" + link + "' type='video/mp4' />" +
            " </video>";
    CKEDITOR.instances.ContentExtend.insertHtml(string);
    $("#video-search-detailStar").hide();
    $("#video-search-textStar").val(title);


}

function insert_team(id, type) {
    var name = $("#" + id).attr("data-name");

    console.log(name);
    console.log(type);

    if (type == 0) {
        $("#AwayID").val(id);
        $("#AwayName").val(name);
    } else {
        $("#HomeID").val(id);
        $("#HomeName").val(name);
    }
}

$(document).ready(function () {


    var refreshId;
    var refreshStar;
    $("#video-search").keyup(function (event) {
        $("#video-search-detail").show();
        clearInterval(refreshId);
        refreshId = setInterval(searchVideoAjax, 1000);
    });
    document.addEventListener("click", function () {
        $("#video-search-detail").hide();
    });
    document.addEventListener("click", function () {
        $("#video-search-detailStar").hide();
    });
    $("#video-searchStar").keyup(function (event) {
        $("#video-search-detailStar").show();
        clearInterval(refreshStar);
        refreshStar = setInterval(searchVideoAjaxStar, 1000);
    });

    function searchVideoAjax() {
        var keyword = "";
        keyword = $("#video-search-text").val();

        $.ajax({
            method: "GET",
            url: "/app90phut/news/search-video-ajax",
            data: {keyword: keyword}
        })
                .done(function (data) {
                    $("#video-search-detail").html(data);
                    clearInterval(refreshId);
                });
    }
    function searchVideoAjaxStar() {

        var keyword = "";
        keyword = $("#video-search-textStar").val();

        $.ajax({
            method: "GET",
            url: "/app90phut/star/search-video-ajax",
            data: {keyword: keyword}
        })
                .done(function (data) {
                    $("#video-search-detailStar").html(data);
                    clearInterval(refreshStar);
                });

    }

    $("#team-search-text").keyup(function (event) {
        $("#team-search-detail").show();
        clearInterval(refreshId);
        refreshId = setInterval(searchViaAjax, 1000);
    });

    document.addEventListener("click", function () {
        $("#team-search-detail").hide();
    });



    function searchViaAjax() {

        var keyword = "";
        keyword = $("#team-search-text").val();

        $.ajax({
            method: "GET",
            url: "/app90phut/soccer-match-info/search-team",
            data: {keyword: keyword}
        })
                .done(function (data) {
                    $("#team-search-detail").html(data);
                    clearInterval(refreshId);
                });

    }



});

$(document).on('change', 'input[add-video-editor]', function (e) {
    var editor = $(this).attr('add-video-editor');
    var file = $(this).prop('files')[0];
    fd = new FormData();
    fd.append('file_up', file);

    $.ajax({
        url: '/app90phut/upload/upload-video',
        type: 'POST',
        data: fd,
        processData: false,
        contentType: false,
        success: function (data) {
            if (data == "loi") {
                alert("Định dạng video không hợp lệ.")
            } else {

                if (editor == "News") {
                    CKEDITOR.instances.News.insertHtml(data);
                } else if (editor == "Tip") {
                    CKEDITOR.instances.Tip.insertHtml(data);
                } else {
                    //CKEDITOR.instances.editorlive.insertHtml(data);
                }
            }
        },
        error: function (data) {
            //$('.upload-media .progress').hide();
            alert("error");
            alert("Đã có lỗi. Upload thất bại");

        }

    });

});

//chuyen muc video quang huy
$(document).ready(function () {


    $("#video-type").change(function () {
        var type = $("#video-type").val();
        if (type == 1) {
            $("#video-frame").show();
            $("#video-file").hide();
            var frame = $("#video-link").val();
            if (frame == "") {
                $("#video-link").val("youtube/")
            }
        } else {
            $("#video-frame").hide();
            $("#video-file").show();
        }
    });
});