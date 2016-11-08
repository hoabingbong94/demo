<div class="col-md-12 remove-padding frm-video">
    <div class="album-video">
        <ul id="listVideo">
            <?php
            echo $this->render('loadItemVideo', ['listItems' => $listItem]);
            ?>
        </ul>
    </div>
</div>
<div class="modal fade in" id="Modle_Video_Highlight" tabindex="-1" role="dialog" aria-labelledby="Modle_Video_HighlightLable">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Thêm video</h4>
            </div>
            <div class="modal-body">
                <!--Flag-->
                <input type="hidden" id="keyItemVideo"/>
                <input type="hidden" id="flagAction"/>

                <!--Flag-->
                <div class="form-group col-xs-12">
                    <label>Tiêu đề</label>
                    <input id="title-album-video" name="" class="form-control" type="text">
                </div>
                <div class="col-xs-7">
                    <video id="preVideo" controls="" muted="true" src="" width="100%"></video>
                    <div style="margin-top: 10px; position: relative;">
                        <a class="btn btn-default">Chọn video
                            <input  style="position: absolute;top: 0;left: 0;opacity: 0;width: 100%;height: 100%;" id="uploadVideo" title="Chọn video" data-preview-highlight="video-preview-highlight" accept="video/mp4" type="file">
                        </a>
                    </div>
                </div>
                <div class="col-xs-5">
                    <div class="thumbnail" style="width: 200px; float: right">
                        <img src="/img/noimg.png" 
                             data-holder-rendered ="true" 
                             id="thumb-video-highlight" 
                             style="max-width: 205px; height:115px;float: right" 
                             width="100%">
                        <input id="upload-thumb-highlight" 
                               title="Chọn Avatar" 
                               accept="image/*" 
                               data-path="" 
                               data-value="videoPoster"
                               data-path=""
                               data-crop="thumb-video-highlight"
                               data-crop-width="480"
                               data-crop-height="270"
                               style="position: absolute; top:0; left: 0; width: 100%; height: 100%; opacity: 0;" 
                               type="file">
                        <input type="hidden" value="" id="videoPoster"/>
                    </div>
                </div>
                <div style="clear: both"></div>
            </div>
            <div class="modal-footer">
                <div id="button-add-video-highlight">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button onClick="addTmpAlbumVideo()" type="button" id="insert-video-hightlight" class="btn btn-primary">
                        <span id="rotateLoad"><i class="glyphicon glyphicon-repeat rotateLoad"></i></span>
                        <i class="glyphicon glyphicon-open iconUpload"></i>
                        Upload</button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .albumPhoto li{
        width: 80px !important;
        height: 115px !important;
        margin-bottom: 0px !important;
    }
    .albumPhoto li i.flag{
        width: 100%;
    }
    .albumPhoto li img{
        width: 100%;
    }
    .albumPhoto li span.flag{
        width: 100%;
        top: 20px;
        position: absolute;
        left: 0px;
    }
</style>