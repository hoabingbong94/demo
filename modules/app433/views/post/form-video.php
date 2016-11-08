<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['name' => 'frmPost', 'enctype' => 'multipart/form-data']]);
$array = array();
$type = $model->Type;
//foreach($categories as $k=> $rs){
//    $array[$k]=$rs['CategoryName'];
//}
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm bài tin</h3>
    </div>
    <div class="panel-body">
        <?=
        $form->field($model, 'Type')->hiddenInput()->label(false);
        ?>
        <div class="message"><?= $mes; ?></div>
        <div class="col-md-6 remove-padding">
            <!--media categoriess-->
            <div class="media-list">
                <div class="media">
                    <div class="media-left">
                        <a href="#"> 
                            <img id="img-cover" alt="95x64" data-src="holder.js/95x64"
                                 class="media-object"
                                 style="width: 90px; height: 90px;"
                                 src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNTRiODNlN2U0NyB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE1NGI4M2U3ZTQ3Ij48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMi40NTgzMzM5NjkxMTYyMTEiIHk9IjM2LjgiPjY0eDY0PC90ZXh0PjwvZz48L2c+PC9zdmc+"
                                 data-holder-rendered="true"> 
                        </a>
                        <input type="file" id="upload-cover"
                               title="Chọn Ảnh Bìa" accept="image/*" data-value="CoverImage" data-path=""
                               data-crop="img-cover" data-crop-width="80" data-crop-height="80"
                               class="images"/>
                               <?=
                               $form->field($model, 'Thumbnails')->hiddenInput(['id' => 'CoverImage'])->label(false);
                               ?>
                    </div>
                    <div class="media-body"><h4 class="media-heading">Chuyên mục</h4>
                        <?=
                        $form->field($model, "CategoryID")->dropDownList($categories, array('class' => 'form-control dropdownCategories'))->label(false);
                        ?>

                    </div>
                </div>
            </div>
            <div class="hrBorder"></div>
        </div>
        <div class="col-md-6 remove-padding">
            <!--Control-->
            <style>
                .pull-left{width:50%;}
            </style>
            <div class="boxCheckbox pull-left">
                <?=
                        $form->field($model, 'Public', array('template' => '{input}{label}<span class="textCheckBox">Hiển thị</span>'))
                        ->checkbox(array('id' => 'Public'), false)
                        ->label("", array('for' => 'Public', 'class' => 'label-primary'))
                ?>
            </div>
            <div class="boxCheckbox pull-left">
                <?=
                        $form->field($model, 'Pin', array('template' => '{input}{label}<span class="textCheckBox">Ghim</span>'))
                        ->checkbox(array('id' => 'Pin'), false)
                        ->label("", array('for' => 'Pin', 'class' => 'label-primary'))
                ?>
            </div>
            <div class="boxCheckbox pull-left">
                <?=
                        $form->field($model, 'PinVideo', array('template' => '{input}{label}<span class="textCheckBox">Ghim Video</span>'))
                        ->checkbox(array('id' => 'PinVideo'), false)
                        ->label("", array('for' => 'PinVideo', 'class' => 'label-primary'))
                ?>
            </div>
            <div class="boxCheckbox pull-left">
                <?=
                        $form->field($model, 'Recommened', array('template' => '{input}{label}<span class="textCheckBox">Đừng bỏ lỡ</span>'))
                        ->checkbox(array('id' => 'Recommened'), false)
                        ->label("", array('for' => 'Recommened', 'class' => 'label-primary'))
                ?>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12 remove-padding">
            <div class="frm-group">
                <label>Nội dung chính</label>
                <?= $form->field($model, "Content")->textarea(array('id' => 'Content'))->label(false) ?>
                <script>
                    CKEDITOR.replace('Content');
                </script>
            </div>
        </div>
        <div class="col-md-12 remove-padding frm-video">
            <div class="album-video">
                <ul id="listVideo">
                    <li onClick="addAlbumVideo();">
                        <i class="glyphicon glyphicon-film"></i>
                        <span>Thêm video</span>
                    </li>
                </ul>
            </div>
        </div>
        <!--test-->
        <div class="modal fade in" id="Modle_Video_Highlight" tabindex="-1" role="dialog" aria-labelledby="Modle_Video_HighlightLable">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Video HightLight</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group col-xs-8">
                            <label>Tiêu đề</label>
                            <input id="title-highlight" name="titleheighlight" class="form-control" data-char="100" value="" type="text">
                        </div>
                        <div class="form-group col-xs-4">
                            <label>Sắp xếp</label>
                            <input id="order-highlight" name="ordernumber" class="form-control" value="0" type="number">
                        </div>

                        <div class="col-xs-7">
                            <video id="video-preview-highlight" controls="" src="" width="100%"></video>
                            <div style="margin-top: 10px; position: relative;">
                                <a class="btn btn-default">Chọn video
                                    <input style="position: absolute;top: 0;left: 0;opacity: 0;width: 100%;height: 100%;" id="video-highlight" title="Chọn video" data-preview-highlight="video-preview-highlight" accept="video/mp4" type="file">
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-5">
                            <div class="thumbnail" style="width: 200px; float: right">
                                <img src="/img/noimg.png" 
                                     data-holder-rendered ="true" 
                                     id="thumb-video-highlight" 
                                     style="max-width: 205px; height:140px;float: right" 
                                     width="100%">
                                <input id="upload-thumb-highlight" 
                                       title="Chọn Avatar" 
                                       accept="image/*" 
                                       data-path="" 
                                       data-value="videoPoster"
                                       data-path=""
                                       data-crop="thumb-video-highlight"
                                       data-crop-width="150"
                                       data-crop-height="90"
                                       style="position: absolute; top:0; left: 0; width: 100%; height: 100%; opacity: 0;" 
                                       type="file">
                            </div>
                        </div>
                        <div style="clear: both"></div>
                    </div>
                    <div class="modal-footer">
                        <div id="button-add-video-highlight">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                            <button onClick="addTmpVideo()" type="button" id="insert-video-hightlight" class="btn btn-primary"><i class="glyphicon glyphicon-open"></i> Upload</button>
                        </div>
                        <img src="/resources/site/images/loading.gif" id="loadding-highlight" style="display:none" width="30px">
                    </div>
                </div>
            </div>
        </div>
        <!--End test-->
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12 remove-padding">
            <div class="button-control">
                <?= Html::submitButton('Đóng', ['class' => 'btn btn-default']) ?>
                <?= Html::submitButton('Gửi', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
</div>
<?php
ActiveForm::end();
?>