<?php
/* @var $model app\models\bongda433\Post */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['name' => 'frmPost', 'enctype' => 'multipart/form-data']]);
$type = $model->Type;
/* IMG */
$srcThumbnails = $srcThumbnailsCover = $srcThumbnailsStream = "/img/noimg.png";
if ($model->Thumbnails != "") {
    $srcThumbnails = $model->Thumbnails;
    if (strpos($model->Thumbnails, 'http://') === false) {
        $srcThumbnails = Yii::$app->params['pathMedia'] . $model->Thumbnails;
    }
}
if ($model->ThumbVideo != "") {
    $srcThumbnailsStream = Yii::$app->params['pathMedia'] . $model->ThumbVideo;
}
if ($model->ThumbnailsCover != "") {
    $srcThumbnailsCover = Yii::$app->params['pathMedia'] . $model->ThumbnailsCover;
}
echo Html::input('hidden', "newsId", $newsId);
echo Html::input('hidden', "starId", $starId);
echo Html::input('hidden', "ttvnId", $ttvnId);
if ($ttvnId != '') {
    echo Html::input('hidden', "urlvideo", $model->UrlVideo);
}
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm bài tin</h3>
    </div>
    <div class="panel-body">
        <?php
        echo $form->field($model, 'Type')
                ->hiddenInput(['id' => 'post-type'])
                ->label(false);
        if ($model->Type == 5) {
            echo $form->field($model, 'Live')
                    ->hiddenInput()
                    ->label(false);
        }
        ?>
        <?php if (isset($mes) && $mes != '') { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <?= $mes; ?>
            </div>
        <?php } ?>
        <div class="col-md-6 remove-padding">
            <!--media categoriess-->
            <div class="media-list">
                <div class="media">
                    <?php
                    if ($type != 4) {
                        ?>
                        <div class="media-left">
                            <?=
                            Html::img($srcThumbnails, [
                                'id' => 'img-cover',
                                'alt' => '95x64',
                                'data-src' => 'holder.js/95x64',
                                'class' => 'media-object imgPreview',
                                'data-holder-rendered' => 'true',
                            ]);
                            ?>
                            <?=
                            Html::fileInput('CoverImage', '', [
                                'id' => 'upload-cover',
                                'title' => 'Chọn ảnh bìa',
                                'accept' => 'image/*',
                                'data-value' => 'CoverImage',
                                'data-path' => '',
                                'data-crop' => 'img-cover',
                                'data-crop-width' => '80',
                                'data-crop-height' => '80',
                                'class' => 'images'
                            ])
                            ?>
                            <?=
                            $form->field($model, 'Thumbnails')->hiddenInput(['id' => 'CoverImage'])->label(false);
                            ?>
                            <div class="delImages" onClick="removeImages();"><i class="fa fa-times" aria-hidden="true"></i></div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="media-body">
                        <label>Chuyên mục</label>
                        <?php
                        echo $form->field($model, "CategoryID")
                                ->dropDownList($categories, array('class' => 'form-control dropdownCategories'))
                                ->label(false);
                        echo Html::input('hidden', '', 'logoCategories', ['id' => 'logoDefaultCategories']);
                        ?>
                    </div>
                </div>
            </div>
            <div class="hrBorder"></div>
        </div>
        <div class="col-md-6 remove-padding">
            <style>
                .pull-left{width:50%;}
            </style>
            <!--Control-->
            <?php
            if ($postService->getRole('publish')) {
                ?>
                <div class="boxCheckbox pull-left">
                    <?=
                            $form->field($model, 'Public', array('template' => '{input}{label}<span class="textCheckBox">Hiển thị</span>'))
                            ->checkbox(array('id' => 'Public'), false)
                            ->label("", array('for' => 'Public', 'class' => 'label-primary'))
                    ?>
                </div>
                <?php
            }
            ?>
            <?php
            if ($model->Type != 5 && $model->Type != 4) {
                ?>
                <div class="boxCheckbox pull-left">
                    <?=
                            $form->field($model, 'Pin', array('template' => '{input}{label}<span class="textCheckBox">Ghim</span>'))
                            ->checkbox(array('id' => 'Pin'), false)
                            ->label("", array('for' => 'Pin', 'class' => 'label-primary'))
                    ?>
                </div>
                <?php
            }
            ?>
            <?php
            //Only video
            if ($type == 1) {
                ?>
                <div class="boxCheckbox pull-left">
                    <?=
                            $form->field($model, 'PinVideo', array('template' => '{input}{label}<span class="textCheckBox">Ghim Video</span>'))
                            ->checkbox(array('id' => 'PinVideo'), false)
                            ->label("", array('for' => 'PinVideo', 'class' => 'label-primary'))
                    ?>
                </div>
                <div class="boxCheckbox pull-left">
                    <?=
                            $form->field($model, 'VideoHome', array('template' => '{input}{label}<span class="textCheckBox">Video nổi bật</span>'))
                            ->checkbox(array('id' => 'VideoHome'), false)
                            ->label("", array('for' => 'VideoHome', 'class' => 'label-primary'))
                    ?>
                </div>
                <?php
            }
            if ($model->Type != 5) {
                ?>
                <div class="boxCheckbox pull-left">
                    <?=
                            $form->field($model, 'Recommened', array('template' => '{input}{label}<span class="textCheckBox">Đừng bỏ lỡ</span>'))
                            ->checkbox(array('id' => 'Recommened'), false)
                            ->label("", array('for' => 'Recommened', 'class' => 'label-primary'))
                    ?>
                </div>
                <?php
            }
            if ($model->Type == 4) {
                ?>
                <div class="boxCheckbox pull-left">
                    <?=
                            $form->field($model, 'IsHotNews', array('template' => '{input}{label}<span class="textCheckBox">Ra trang chủ</span>'))
                            ->checkbox(array('id' => 'IsHotNews'), false)
                            ->label("", array('for' => 'IsHotNews', 'class' => 'label-primary'))
                    ?>
                </div>
                <?php
            }
            ?>
            <div class="boxCheckbox pull-left">
                <?=
                        $form->field($model, 'OnlyDesktop', array('template' => '{input}{label}<span class="textCheckBox">Desktop</span>'))
                        ->checkbox(array('id' => 'OnlyDesktop'), false)
                        ->label("", array('for' => 'OnlyDesktop', 'class' => 'label-primary'))
                ?>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12 remove-padding">
            <?php if ($type == 5) { ?>
                <div class="frm-group">
                    <div class="form-group">
                        <label class="control-label" for="matchId">Trận đấu</label>
                        <input value="<?= $matchInfo; ?>" 
                               placeholder="Nhập tên đội bóng" 
                               id="matchId" 
                               class="form-control" 
                               name="matchId" 
                               type="text">
                               <?=
                                       $form->field($model, 'MatchID')
                                       ->hiddenInput(['id' => 'setMatchId'])
                                       ->label(false);
                               ?>
                        <div class="resultSearchMatch">
                            <ul id="dataSearchMatch"></ul>
                        </div>
                    </div>
                </div>
                <?php
            }
            if ($type == 4) {
                ?>
                <div class="frm-group">
                    <?=
                            $form->field($model, "Title")
                            ->input('text', array('id' => 'Title'))
                    ?>
                </div>
                <div class="frm-group">
                    <?=
                            $form->field($model, "Summary")
                            ->textarea(array('id' => 'Summary'))
                    ?>
                </div>
                <div class="col-md-12">
                    <div class="frm-group col-md-5">
                        <label>Ảnh đại diện</label>
                        <div class="post-avatar">
                            <?=
                            Html::img($srcThumbnails, [
                                'id' => 'img-cover',
                                'alt' => '',
                                'data-src' => 'holder.js/125x80',
                                'class' => 'media-object media-object-avatar',
                                'data-holder-rendered' => 'true',
                            ]);
                            ?>
                            <?=
                            Html::fileInput('CoverImage', '', [
                                'id' => 'upload-cover',
                                'title' => 'Chọn ảnh bìa',
                                'accept' => 'image/*',
                                'data-value' => 'CoverImage',
                                'data-path' => '',
                                'data-crop' => 'img-cover',
                                'data-crop-width' => '580',
                                'data-crop-height' => '326',
                                'class' => 'images inputFile',
                            ])
                            ?>
                            <span class="btn btn-default">Chọn ảnh</span>
                        </div>
                        <?=
                        $form->field($model, 'Thumbnails')->hiddenInput(['id' => 'CoverImage'])->label(false);
                        ?>
                    </div>


                    <div class="frm-group col-md-7" >
                        <label>Ảnh bìa</label>
                        <div class="post-avatar">
                            <?=
                            Html::img($srcThumbnailsCover, [
                                'id' => 'img-thumb-cover',
                                'alt' => '',
                                'data-src' => 'holder.js/125x80',
                                'class' => 'media-object media-object-avatar',
                                'data-holder-rendered' => 'true',
                                'style' => 'width:232px'
                            ]);
                            ?>

                            <span class="btn btn-default" style="position: relative">Chọn ảnh
                                <?=
                                Html::fileInput('CoverImage', '', [
                                    'id' => 'upload-cover',
                                    'title' => 'Chọn ảnh bìa',
                                    'accept' => 'image/*',
                                    'data-value' => 'ThumbnailsCover',
                                    'data-path' => '',
                                    'data-crop' => 'img-thumb-cover',
                                    'data-crop-width' => '580',
                                    'data-crop-height' => '218',
                                    'data-validate' => '1',
                                    'data-size' => '853',
                                    'class' => 'images inputFile',
                                    'style' => 'top:0;left:0'
                                ])
                                ?></span>
                        </div>
                        <?=
                        $form->field($model, 'ThumbnailsCover')->hiddenInput(['id' => 'ThumbnailsCover'])->label(false);
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="clearfix"></div>
            <?php
            if ($type == 6) {
                ?>
                <div class="col-md-12">
                    <div class="frm-group col-md-5">
                        <label>Ảnh đại diện</label>
                        <div class="post-avatar">
                            <?=
                            Html::img($srcThumbnailsStream, [
                                'id' => 'img-cover-facebook',
                                'alt' => '',
                                'data-src' => 'holder.js/125x80',
                                'class' => 'media-object media-object-avatar',
                                'data-holder-rendered' => 'true',
                            ]);
                            ?>
                            <?=
                            Html::fileInput('CoverImageFacebook', '', [
                                'id' => 'upload-cover-facebook',
                                'title' => 'Chọn ảnh bìa',
                                'accept' => 'image/*',
                                'data-value' => 'imageShareFacebook',
                                'data-path' => '',
                                'data-crop' => 'img-cover-facebook',
                                'data-crop-width' => '580',
                                'data-crop-height' => '326',
                                'class' => 'images inputFile',
                            ])
                            ?>
                            <span class="btn btn-default">Chọn ảnh</span>
                        </div>
                        <?=
                        $form->field($model, 'ThumbVideo')->hiddenInput(['id' => 'imageShareFacebook'])->label(false);
                        ?>
                    </div>
                </div>
                <div class="clearfix"></div>
                <?php
                if (!$model->isNewRecord) {
                    ?>
                    <div class="frm-group">
                        <label class="control-label">Stream key</label>
                        <input class="form-control" type="text" name="streamKey" readonly="true" value="<?= $model->ID; ?>"/>
                    </div>
                    <div class="frm-group">
                        <label class="control-label">Stream link</label>
                        <input class="form-control" type="text" name="linkStream" readonly="true" value="rtmp://113.185.19.167/live?key=<?= $model->StreamKey ?>"/>
                    </div>
                    <?php
                }
            }
            ?>
            <div class="clearfix"></div>
            <div class="frm-group postAdv">
                <div class="controlAdv">
                    <img src="/img/load.gif" class="iconLoading" id="loadContent"/>
                    <span class="btn btn-default btn-xs" 
                          data-tag='Content' 
                          onClick="hastag();">
                        <i class="glyphicon glyphicon-tag"></i>
                    </span>
                    <span class="btn btn-default btn-xs">
                        <?= Html::fileInput('editorImg[]', '', ['data-image-editor' => 'Content', 'multiple' => 'multiple']) ?>
                        <i class="glyphicon glyphicon-picture"></i>
                    </span>
                    <?php if ($type == 4) { ?>
                        <span class="btn btn-default btn-xs" 
                              id="boxUploadVideo">
                            <i class="glyphicon glyphicon-film"></i>
                            <div class="DropdownUploadVideo">
                                <ul>
                                    <li><i class="glyphicon glyphicon-level-up"></i> Tải lên
                                        <?= Html::fileInput('editorVideo', '', ['data-video-editor' => 'Content', 'accept' => 'video/mp4']) ?>
                                    </li>
                                    <li onClick="openBoxInsertVideo();">
                                        <i class="glyphicon glyphicon-link"></i> Chèn link
                                    </li>
                                </ul>
                            </div>
                        </span>
                    <?php } else {
                        ?>
                        <span class="btn btn-default btn-xs" onClick="openPopupUploadVideoCkEdit('Content')">
                            <?php //echo Html::fileInput('editorVideo', '', ['data-video-editor' => 'Content', 'accept' => 'video/mp4']) ?>
                            <i class="glyphicon glyphicon-film"></i>
                        </span>
                        <?php
                        echo $this->render('partial/popupUploadVideo');
                    }
                    ?>
                </div>

                <?= $form->field($model, "Content")->textarea(array('id' => 'Content')); ?>
                <?php
                if ($type == 4) {
                    ?>
                    <script>
                        var config_long = {
                            toolbar: [
                                {name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source']},
                                {
                                    name: 'basicstyles',
                                    groups: ['basicstyles', 'cleanup'],
                                    items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
                                },
                                {name: 'colors', groups: ['colors']},
                                {name: 'links', items: ['Link', 'Unlink']},
                                {name: 'alignment', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']}
                            ]
                        };
                        CKEDITOR.replace('Content', config_long);
                    </script>
                    <?php
                } else {
                    ?>
                    <script>
                        CKEDITOR.replace('Content');
                    </script>
                    <?php
                }
                ?>
            </div>
            <?php
            if ($type == 0 || $type == 1) {
                ?>
                <div class="frm-group postAdv">
                    <div class="controlAdv">
                        <img src="/img/load.gif" class="iconLoading" id="loadContentExtend"/>
                        <span class="btn btn-default btn-xs" 
                              data-tag='ContentExtend' 
                              onClick="hastag();">
                            <i class="glyphicon glyphicon-tag"></i>
                        </span>
                        <span class="btn btn-default btn-xs">
                            <?= Html::fileInput('editorImg', '', ['data-image-editor' => 'ContentExtend', 'multiple' => 'multiple']) ?>
                            <i class="glyphicon glyphicon-picture"></i>
                        </span>
                        <span class="btn btn-default btn-xs" onClick="openPopupUploadVideoCkEdit('ContentExtend')">
                            <?php //echo  Html::fileInput('editorImg', '', ['data-video-editor' => 'ContentExtend', 'accept' => 'video/mp4']) ?>
                            <i class="glyphicon glyphicon-film"></i>
                        </span>
                    </div>
                    <?= $form->field($model, "ContentExtend")->textarea(array('id' => 'ContentExtend')) ?>
                    <script>
                        CKEDITOR.replace('ContentExtend');
                    </script>
                </div>
                <?php
            }
            ?>
            <div class="frm-group">
                <?= $form->field($model, "Keyword")->input('text', array('id' => 'Keyword')) ?>
            </div>
            <?php if ($type == 4) {
                ?>
                <div class="frm-group">
                    <?= $form->field($model, "Author")->input('text', array('id' => 'Author'))->label("Bút danh"); ?>
                </div>
                <?php
            }
            ?>
            <?php
            echo $form->field($model, 'DatePublic', ['template' => '{label}<div class="input-group date" onClick="loaddatetime();" id="datetimepicker2">{input}<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div>'])
                    ->input('text', ['class' => 'form-control'])->label("Giờ đăng");
            ?>
        </div>
        <?php
        if ($type == 1) {
            ?>
            <div class="col-md-12 remove-padding frm-video">
                <div class="col-md-6 remove-padding frm-video-box">
                    <?= Html::label("Video file"); ?>
                    <?php
                    $videoFile = "";
                    if ($model->UrlVideo != "/in.mp4") {
                        $videoFile = $model->UrlVideo;
                        if (strpos($model->UrlVideo, 'http://') === false) {
                            $videoFile = Yii::$app->params['pathMedia'] . $model->UrlVideo;
                        }
                    }
                    ?>
                    <video id="preVideo" src="<?= $videoFile; ?>" loop="true" muted="true" poster="<?= $model->ThumbVideo ?>" width="480" height="320" controls></video>
                    <div class="box-control">
                        <span class="btn btn-default">Chọn video</span>
                        <?= $form->field($model, "UrlVideo")->fileInput(['accept' => 'video/mp4', 'id' => 'uploadVideo'])->label(false); ?>
                    </div>
                </div>
                <div class="col-md-6 remove-padding frm-video-box">
                    <?= Html::label("Poster video"); ?>
                    <?php
                    $imgVideo = "/demo.jpg";
                    if ($model->ThumbVideo != "") {
                        $imgVideo = $model->ThumbVideo;
                        if (strpos($model->ThumbVideo, 'http://') === false) {
                            $imgVideo = Yii::$app->params['pathMedia'] . $model->ThumbVideo;
                        }
                    }
                    ?>
                    <?=
                    Html::img($imgVideo, [
                        'id' => 'img-video',
                        'data-src' => 'holder.js/95x64',
                        'class' => 'poster-video media-object',
                        'data-holder-rendered' => 'true',
                        'width' => '480',
                        'height' => '270'
                    ]);
                    ?>
                    <div class="box-control box-control-right">
                        <span class="btn btn-default">Chọn ảnh</span>
                        <?=
                        Html::fileInput("tmpPoster", '', [
                            'id' => 'upload-cover',
                            'accept' => 'image/*',
                            'data-value' => 'videoPoster2',
                            'data-path' => '',
                            'data-crop' => 'img-video',
                            'data-crop-width' => '480',
                            'data-crop-height' => '270',
                        ]);
                        ?>
                        <?= $form->field($model, 'ThumbVideo')->hiddenInput(['id' => 'videoPoster2'])->label(false); ?>
                    </div>
                </div>
            </div>
        <?php }
        ?>

    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <?php
            if ($type == 3) {
                echo $this->render('partial/popupAlbumVideo');
                ?>
                <div class="clearfix"></div>
                <div class="col-md-12 remove-padding frm-video">
                    <div class="album-video">
                        <ul id="listVideo">
                            <?php
                            if (isset($modelVideo) && count($modelVideo) > 0) {
                                foreach ($modelVideo as $k => $v) {
                                    echo '<li><div class="controlListVideo">' .
                                    '<span onClick="removeItemVideo(' . $k . ');"><i class="glyphicon glyphicon-trash"></i></span>' .
                                    '<span onClick="loadItemVideo(' . $k . ');"><i class="glyphicon glyphicon-pencil"></i></span>' .
                                    '</div><video src="' . \Yii::$app->params['pathMedia'] . $v['video'] . '" controls="true" poster="' . \Yii::$app->params['pathMedia'] . $v['images'] . '"/></li>';
                                }
                            }
                            ?>
                            <li onClick="addAlbumVideo();">
                                <i class="glyphicon glyphicon-film"></i>
                                <span>Thêm video</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12 remove-padding">
                <div class="button-control">
                    <?= Html::input('hidden', 'redirect', 'post', ['id' => 'redirectFlag']); ?>
                    <?= Html::submitButton('Xuất bản', ['onClick' => 'checkDir(1)', 'class' => 'btn btn-success']) ?>
                    <?= Html::submitButton('Preview', ['onClick' => 'preview(' . $model->Type . ');return false;', 'class' => 'btn btn-success']) ?>
                    <?= Html::submitButton('Xuất bản & Tiếp tục', ['onClick' => 'checkDir(2)', 'class' => 'btn btn-success']) ?>
                    <?= Html::submitButton('Ðóng', ['onClick' => 'location.href="/app433/post";return false;', 'class' => 'btn btn-default']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
echo $this->render('partial/preview');
echo $this->render('partial/previewLongNews');
echo $this->render('partial/popupInsertLinkVideo');
ActiveForm::end();
?>