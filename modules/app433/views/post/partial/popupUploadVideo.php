<div class="modal fade in" id="Module_Video_CkEditor" tabindex="-1" role="dialog" aria-labelledby="Modle_Video_HighlightLable">
    <input type="hidden" id="ckInsertVideo"/>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Thêm video</h4>
            </div>
            <div class="modal-body">
                <div class="col-xs-7">
                    <video id="preVideoCk" controls="" muted="true" src="" width="100%"></video>
                    <div style="margin-top: 10px; position: relative;">
                        <a class="btn btn-default">Chọn video
                            <input  style="position: absolute;top: 0;left: 0;opacity: 0;width: 100%;height: 100%;" id="uploadVideoCk" title="Chọn video" data-preview-highlight="video-preview-highlight" accept="video/mp4" type="file">
                        </a>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="thumbnail" style="width: 142px;height:80px; float: right">
                        <img src="/img/noimg.png" 
                             data-holder-rendered ="true" 
                             id="thumb-video-ck" 
                             style="max-width: 142px; height:70px !important;float: right" 
                             width="100%">
                        <input id="upload-thumb-highlight" 
                               title="Chọn Avatar" 
                               accept="image/*" 
                               data-path="" 
                               data-value="videoPoster"
                               data-path=""
                               data-crop="thumb-video-ck"
                               data-crop-width="480"
                               data-crop-height="270"
                               style="position: absolute; top:0; left: 0; width: 100%; height: 100%; opacity: 0;" 
                               type="file">
                        <input type="hidden" id="videoPoster"/>
                    </div>
                </div>
                <div style="clear: both"></div>
            </div>
            <div class="modal-footer">
                <div id="button-add-video-highlight">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button onClick="uploadVideoCkeditor()" type="button" id="insert-video-hightlight" class="btn btn-primary">
                        <span id="rotateLoad"><i class="glyphicon glyphicon-repeat rotateLoad"></i></span>
                        <i id="iconUpload" class="glyphicon glyphicon-open iconUpload"></i>
                        Upload
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>