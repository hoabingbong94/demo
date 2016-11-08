<div class="col-md-12 remove-padding frm-video">
    <div class="album-video albumPhoto">
        <ul id="listVideo">
            <?php
            echo $this->render('loadItemImage', ['listItems' => $listItem]);
            ?>
        </ul>
    </div>
</div>
<div class="modal fade in" id="Modle_Video_Highlight" tabindex="-1" role="dialog" aria-labelledby="Modle_Video_HighlightLable">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Thêm hình ảnh</h4>
            </div>
            <div class="modal-body">
                <!--Flag-->
                <input type="hidden" id="keyItemImage"/>
                <input type="hidden" id="flagAction"/>

                <!--Flag-->
                <div class="form-group col-xs-12">
                    <label>Tiêu đề</label>
                    <input id="title-album-photo" name="" class="form-control" type="text">
                </div>
                <div class="form-group col-xs-12">
                    <label>Chọn ảnh</label>
                    <input id="file-album-photo" name="" value="" type="file">
                </div>

                <div style="clear: both"></div>
            </div>
            <div class="modal-footer">
                <div id="button-add-video-highlight">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                    <button onClick="addTmpAlbumPhoto()" type="button" id="insert-video-hightlight" class="btn btn-primary">
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