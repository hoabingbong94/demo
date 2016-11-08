<?php
/* @var $model app\models\bongda433\MatchTips */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['name' => 'frmTips', 'enctype' => 'multipart/form-data']]);
/* IMG */
$imgVideo = "/img/noimg.png";
if ($model->Avatar != null) {
    $imgVideo = "/service/" . $model->Avatar;
}
?>
<div class="module-90phut">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Thêm video</h3>
        </div>
        <div class="panel-body">

            <?php if (isset($mes) && $mes != '') { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?= $mes; ?>
                </div>
            <?php } ?>

            <div class="col-md-5">
                <!--media categoriess-->
                <div class="media-list">
                    <div class="media">
                        <div class="media-body">
                            <label>Chuyên mục mobile</label>
                            <?php
                            echo $form->field($model, "LeagueID")->dropDownList($categoriesVideo, ['class' => 'form-control dropdownCategories', 'id' => 'video-category'])->label(false);
                            ?>
                        </div>
                    </div>
                </div>
                <div id="show-type-video">
                    <div class="form-group field-video-type">
                        <label class="control-label" for="video-type">Loại Video</label>
                        <select id="video-type" class="form-control dropdownCategories" name="type">
                            <option value="0">Upload</option>
                            <option value="1">Youtube</option>
                        </select>
                    </div>

                </div>
                <div class="hrBorder"></div>
            </div>
            <div class="col-md-7">
                <style>
                    .pull-left{width:50%;}
                </style>
                <!--Control-->
                <?php
                if ($postService->getRole('publish')) {
                    ?>
                    <div class="boxCheckbox pull-left">
                        <?=
                                $form->field($model, 'IsPublic', array('template' => '{input}{label}<span class="textCheckBox">Hiển thị</span>'))
                                ->checkbox(array('id' => 'IsPublic'), false)
                                ->label("", array('for' => 'IsPublic', 'class' => 'label-primary'))
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="boxCheckbox pull-left">
                    <?=
                            $form->field($model, 'Top', array('template' => '{input}{label}<span class="textCheckBox">Ghim</span>'))
                            ->checkbox(array('id' => 'Top'), false)
                            ->label("", array('for' => 'Top', 'class' => 'label-primary'))
                    ?>
                </div>
                <div class="boxCheckbox pull-left">
                    <?=
                            $form->field($model, 'TopHot', array('template' => '{input}{label}<span class="textCheckBox">Ghim Chuyên mục</span>'))
                            ->checkbox(array('id' => 'TopHot'), false)
                            ->label("", array('for' => 'TopHot', 'class' => 'label-primary'))
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">

        <div class="panel-body">
            <div class="col-md-5">
                <!--media categoriess-->
                <div class="media-list">
                    <div class="media">
                        <div class="media-body">
                            <label>Chuyên mục PC</label>
                            <?php
                            echo $form->field($model, "Category")->dropDownList($categoriesPc, array('class' => 'form-control dropdownCategories'))->label(false);
                            ?>
                        </div>
                    </div>
                </div>
                <div class="hrBorder" style="height:73px;"></div>
            </div>
            <div class="col-md-7">
                <style>
                    .pull-left{width:50%;}
                </style>
                <!--Control-->
                <div class="boxCheckbox pull-left">
                    <?=
                            $form->field($model, 'TopVina', array('template' => '{input}{label}<span class="textCheckBox">Ghim Slider PC</span>'))
                            ->checkbox(array('id' => 'TopVina'), false)
                            ->label("", array('for' => 'TopVina', 'class' => 'label-primary'))
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12 remove-padding">
                <div class="frm-group">
                    <?= $form->field($model, "EventName")->input('text', array('id' => 'EventName')) ?>
                </div>
                <div class="col-md-12 remove-padding frm-video">
                    <div class="col-md-6  frm-video-box">
                        <div id="video-file">
                            <?= Html::label("Video file"); ?>
                            <?php
                            $videoFile = "";
                            if ($model->UrlVideo != "") {
                                $videoFile = '/service/' . $model->UrlVideo;
                            }
                            ?>
                            <video class="videoFile-video-90phut" id="preVideo" src="<?= $videoFile; ?>" loop="true" muted="true" poster="<?= '/service/' . $model->Avatar ?>" width="480" height="320" controls></video>
                            <div class="box-control">
                                <span class="btn btn-default">Chọn video</span>
                                <?php
                                if ($model->UrlVideo == "" || $model->UrlVideo == null) {
                                    $model->UrlVideo = "youtube/";
                                }
                                ?>
                                <?= $form->field($model, "UrlVideo")->fileInput(['accept' => 'video/mp4', 'id' => 'uploadVideo'])->label(false); ?>
                            </div>
                        </div>
                        <div id="video-frame" style="display:none">
                            <div class="form-group field-video-link has-success">
                                <label class="control-label" for="video-link">Youtube Iframe</label>
                                <textarea id="video-link" class="form-control" name="iframe" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6  frm-video-box" >
                        <?= Html::label("Poster video"); ?>

                        <?=
                        Html::img($imgVideo, [
                            'id' => 'img-video',
                            'data-src' => 'holder.js/95x64',
                            'class' => 'poster-video media-object poster-video-90phut',
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
                                'data-value' => 'videoPoster',
                                'data-path' => '',
                                'data-crop' => 'img-video',
                                'data-crop-width' => '480',
                                'data-crop-height' => '270',
                            ]);
                            ?>
                            <?= $form->field($model, 'Avatar')->hiddenInput(['id' => 'videoPoster'])->label(false); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-12 remove-padding">
                <div class="button-control">
                    <?= Html::submitButton('Lưu lại', ['name' => 'quit', 'class' => 'btn btn-success']) ?>
                    <?= Html::submitButton('Lưu lại & Tiếp tục', ['name' => 'continue', 'class' => 'btn btn-success']) ?>
                    <a href="<?= $urlback ?>" style="margin-left:20px" class="btn btn-default" >Thoát</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
ActiveForm::end();
?>
