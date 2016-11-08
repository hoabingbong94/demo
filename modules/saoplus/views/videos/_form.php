<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$srcIcon = "/img/noImg.png";
$imgVideo = "/img/noimg.png";

if ($model->Thumbnail != null and $model->Thumbnail != "") {
    $srcIcon = \Yii::$app->params['media'] . $model->Thumbnail;
}
if ($model->Thumbnail_Hq != null and $model->Thumbnail_Hq != "") {
    $imgVideo = \Yii::$app->params['media'] . $model->Thumbnail_Hq;
}
$form = ActiveForm::begin(['options' => ['name' => 'frmPost', 'enctype' => 'multipart/form-data']]);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= ($model->isNewRecord) ? "Thêm mới bài video" : "Sửa bài video" ?>
        </h3>     
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            <div class="col-md-4"><div class="frm-group boxCheckbox">
                    <?=
                            $form->field($model, 'Status', array('template' => '<span class="textCheckBox">Hiển thị</span><br/><br/>{input}{label}'))
                            ->checkbox(array('id' => 'Status'), false)
                            ->label("", array('for' => 'Status', 'class' => 'label-primary'))
                    ?>
                </div>
            </div>
            <div class="col-md-4"><div class="frm-group boxCheckbox">
                    <?=
                            $form->field($model, 'Pin_Slider', array('template' => '<span class="textCheckBox">Ghim Slider</span><br/><br/>{input}{label}'))
                            ->checkbox(array('id' => 'Pin_Slider'), false)
                            ->label("", array('for' => 'Pin_Slider', 'class' => 'label-primary'))
                    ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="frm-group">
                    <label class="control-label field-CategoriesID" for="CategoriesID">Chuyên mục</label>
                    <?=
                    $form->field($model, "CategoriesID")->dropDownList($listParent, array('class' => 'form-control dropdownCategories', 'min' => 1, 'id' => 'CategoriesID'))->label(false);
                    ?>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12">
            <div class="frm-group">
                <label class="control-label field-Title" for="Video-Title">Tiêu đề</label>
                <?= $form->field($model, "Title")->input('text', array('id' => 'Video-Title'))->label(false) ?>
            </div>
            <div class="frm-group ">
                <label class="control-label" for="Description">Mô tả</label>
                <?= $form->field($model, "Description")->textarea(['id' => 'Videointo-Description', 'col' => 3])->label(false) ?>
            </div>
            <div class="frm-group field-Keywords">
                <label class="control-label" for="Keywords">Từ khoá</label>
                <?= $form->field($model, "Keywords")->input('text', array('id' => 'Keywords'))->label(false) ?>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-6">
            <div class="news-thumbnails">
                <label>Ảnh đại diện HD</label>
                <div class="tip-avatar">
                    <?=
                    Html::img($imgVideo, [
                        'id' => 'img-video',
                        'data-src' => 'holder.js/95x64',
                        'class' => 'poster-video media-object poster-video-90phut video-star',
                        'data-holder-rendered' => 'true',
                        'width' => '250',
                        'height' => '180'
                    ]);
                    ?>
                    <div class="box-control box-control-right">
                        <?=
                        Html::fileInput("tmpPoster", '', [
                            'id' => 'upload-cover',
                            'accept' => 'image/*',
                            'data-value' => 'videoPoster',
                            'data-path' => '',
                            'data-validate' => '1',
                            'data-size' => '640',
                            'data-crop' => 'img-video',
                            'data-crop-width' => '480',
                            'data-crop-height' => '270',
                            'class' => 'images-hd uploads-images',
                        ]);
                        ?>
                        <?= $form->field($model, 'Thumbnail_Hq')->hiddenInput(['id' => 'videoPoster'])->label(false); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <!--Ảnh đại diệ HD-->
            <label class="clearfix">Video</label>
            <div id="video-file">
                <?php
                $videoFile = "";
                if ($model->VideoFile != "") {
                    $videoFile = \Yii::$app->params['media'] . $model->VideoFile;
                }
                ?>
                <video class="videoFile-video-90phut video-saoplus" id="preVideo" src="<?= $videoFile; ?>" loop="true" muted="true" poster="<?= \Yii::$app->params['media'] . $model->Thumbnail_Hq ?>" width="250" height="180" controls></video>
                <div class="box-control">
                    <span class="btn btn-default">Chọn video</span>
                    <?= $form->field($model, "VideoFile")->fileInput(['accept' => 'video/mp4', 'id' => 'uploadVideo'])->label(false); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12 ">
            <div class="button-control">
                <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                <?= Html::submitButton('Ðóng', ['class' => 'btn btn-default', 'onclick' => 'history.go(-1);return false;']) ?>
            </div>
        </div>
    </div>
</div>

<?php
ActiveForm::end();
?>

