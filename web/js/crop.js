$(document).on('click', 'input[data-crop][accept="image/*"]', function (e) {
    $(this).val('');
});
$(document).on('change', 'input[data-crop][accept="image/*"]', function (e) {
    //var maxViewPortWidth = 510;
    var maxViewPortWidth = 250;
    var maxViewPortHeight = 350;
    var input_elem = $(e.target);
    input_elem.attr('data-path', "" + input_elem.val() + "}}}");
    var maxViewPortWidth = input_elem.attr('data-crop-width');
    var maxViewPortHeight = input_elem.attr('data-crop-height');

//    if (Math.abs(dataCropHeight - maxViewPortHeight) < Math.abs(dataCropWidth - maxViewPortWidth)) {
//        var ti_le = maxViewPortWidth / dataCropWidth;
//        maxViewPortHeight = Math.floor(dataCropHeight * ti_le);
//    } else {
//        var ti_le = maxViewPortHeight / dataCropHeight;
//        maxViewPortWidth = Math.floor(dataCropWidth * ti_le);
//    }
//    alert(maxViewPortWidth+"--"+maxViewPortHeight);
    //maxViewPortWidth=dataCropWidth;
    //maxViewPortHeight=dataCropHeight;
    if (maxViewPortWidth == maxViewPortHeight) {
        maxViewPortWidth = 250;
        maxViewPortHeight = 250;
    }
    var file_img = e.target.files[0];
    var url_blood = URL.createObjectURL(file_img);
    if (input_elem.attr('data-validate') == '1') {
        var size = parseInt(input_elem.attr('data-size'));
        var img = new Image();
        img.onload = function () {
            if (this.width > size) {
                bindHtml(maxViewPortWidth, maxViewPortHeight, url_blood, input_elem);
            } else {
                alert("Kích cỡ ảnh không đạt tiêu chuẩn.\n(Chiều rộng tối thiểu " + size + "px)");
            }
        };
        img.src = url_blood;
    } else {
        bindHtml(maxViewPortWidth, maxViewPortHeight, url_blood, input_elem);
    }

    //

});
function bindHtml(maxViewPortWidth, maxViewPortHeight, url_blood, input_elem) {
    var uniqui = Math.round(Math.random() * 9999) + 1;
    var html = '<div id="container-' + uniqui + '"><div id="layer-mask-list"\
        style="display:block;z-index:999;width:100%;height:100% ;position: fixed; top:0;left:0;background: #000000;opacity: 0.5">\
            </div>\
            <div id="box-crop-' + uniqui + '"\
        class="box-croppier" style="display: block">\
            <div class="item-crop-avatar">\
            <div id="upload-' + uniqui + '-show" data-test="1"></div>\
            <div style="clear: both"></div>\
            <button type="button" style="margin-bottom: 5px; margin-left: 5px;" id="upload-' + uniqui + '-close" class="btn btn-default button-close-crop">\
            Đóng\
            </button>\
            <button type="button" style="float: right;margin-bottom: 5px;margin-right: 5px;" id="upload-' + uniqui + '-result" class="btn btn-primary button-result-crop">\
            Cắt\
            </button>\
            </div>\
            </div></div>';
    $(document.body).append(html);
    if ($('#upload-' + uniqui + '-show').length >= 0) {
        var $uploadCropVideo = $('#upload-' + uniqui + '-show').croppie({
            viewport: {
                width: maxViewPortWidth,
                height: maxViewPortHeight
            },
            boundary: {
                width: 580,
                height: 400
            },
            exif: true
        });
        $uploadCropVideo.croppie('bind', {url: url_blood});
        $('#upload-' + uniqui + '-result').on('click', function (ev) {
            $uploadCropVideo.croppie('result', {
                type: 'canvas',
                size: 'original',
                format: 'png'
            }).then(function (resp) {
                $('#' + input_elem.attr('data-crop')).attr('src', resp);
                var path = input_elem.attr('data-path');
                path = path.replace(/^.*\\/, "");
                $('#' + input_elem.attr('data-value')).val(path + resp);
                $('#container-' + uniqui).remove();
            });
        });

        $('#upload-' + uniqui + '-close').on('click', function (ev) {
            $('#container-' + uniqui).remove();
        });
    }
}
function getImgSize(imgSrc) {
    var newImg = new Image();
    newImg.src = imgSrc;
    newImg.onload = function () {
        alert("ádsa");
        alert(this.width + 'x' + this.height);
    };

}
