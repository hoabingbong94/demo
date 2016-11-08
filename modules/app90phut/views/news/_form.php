<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\app433\services\PostService;

/* @var $this yii\web\View */
/* @var $model app\modules\app90phut\models\News */
/* @var $form yii\widgets\ActiveForm */
$postService = new PostService();
?>

<div class="news-form">

    <?php
    $form = ActiveForm::begin(['options' => ['name' => 'frm-news', 'name' => 'frmNews', 'enctype' => 'multipart/form-data']]);

    $srcThumbnails = "/img/noImg.png";
    $thumbnailsCover = "/img/noimg.png";

    if ($model->Thumbnails != null and $model->Thumbnails != "") {
        $srcThumbnails = \Yii::$app->params['media90phut'] . $model->Thumbnails;
    }
    if ($model433->ThumbnailsCover != null && $model433->ThumbnailsCover != "") {

        $thumbnailsCover = \Yii::$app->params['media90phut'] . ltrim($model433->ThumbnailsCover, "90phut");
    }
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">

                <?= ($model->isNewRecord) ? "Thêm mới tin tức" : "Sửa tin tức" ?>
            </h3>
        </div>
        <div class="panel-body">
            <?php if (isset($mes) && $mes != '') { ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?= $mes; ?>
                </div>
            <?php } ?>

            <div class="col-md-8">
                <div class="col-md-4 boxCheckbox ">
                    <?=
                            $form->field($model, 'ExtendTop', array('template' => '<span class="textCheckBox">Top chuyên mục</span><br/><br/>{input}{label}'))
                            ->checkbox(array('id' => 'ExtendTop'), false)
                            ->label("", array('for' => 'ExtendTop', 'class' => 'label-primary'))
                    ?>
                </div>
                <!--                <div class="col-md-4 bootstrap-switch">
                <?php
//                            $form->field($model, 'ExtendHot', array('template' => '<span class="textCheckBox">Nổi bật</span><br/><br/>{input}{label}'))
//                            ->checkbox(array('id' => 'ExtendHot'), false)
//                            ->label("", array('for' => 'ExtendHot', 'class' => 'label-primary'))
                ?>
                                </div>
                                <div class="col-md-4 boxCheckbox">
                <?php
//                            $form->field($model, 'ExtendUp', array('template' => '<span class="textCheckBox">Ghim nổi bật</span><br/><br/>{input}{label}'))
//                            ->checkbox(array('id' => 'ExtendUp'), false)
//                            ->label("", array('for' => 'ExtendUp', 'class' => 'label-primary'))
                ?>
                                </div>-->
                <div class="col-md-4 boxCheckbox">
                    <div class="form-group field-Free">
                        <span class="textCheckBox">Gim Slide PC</span><br><br>
                        <input type="checkbox" id="Pinpc"  name="Pinpc" value="1">
                        <label class="label-primary" for="Pinpc"></label>
                    </div>
                </div>
                <?php
                if ($postService->getRole('publish')) {
                    ?>
                    <div class="col-md-4 boxCheckbox">
                        <?=
                                $form->field($model, 'ExtendIsPublic', array('template' => '<span class="textCheckBox">Hiển thị</span><br/><br/>{input}{label}'))
                                ->checkbox(array('id' => 'ExtendIsPublic'), false)
                                ->label("", array('for' => 'ExtendIsPublic', 'class' => 'label-primary'))
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="col-md-4">
                <div class="news-thumbnails">
                    <label>Ảnh dại diện PC</label>
                    <div class="tip-avatar">
                        <?=
                        Html::img($srcThumbnails, [
                            'id' => 'img-logo',
                            'alt' => '95x64',
                            'data-src' => 'holder.js/95x64',
                            'class' => 'media-object tip-imgPreview',
                            'data-holder-rendered' => 'true',
                        ]);
                        ?>
                        <?=
                        Html::fileInput('LogoImage', '', [
                            'id' => 'upload-logo',
                            'title' => 'Chọn ảnh bìa',
                            'accept' => 'image/*',
                            'data-value' => 'LogoImage',
                            'data-path' => '',
                            'data-crop' => 'img-logo',
                            'data-crop-width' => '460',
                            'data-crop-height' => '270',
                            'class' => 'tip-images'
                        ])
                        ?>
                        <?=
                        $form->field($model, 'Thumbnails')->hiddenInput(['id' => 'LogoImage'])->label(false);
                        ?>


                    </div>


                </div>
            </div>
            <div class="clearfix" ></div>

            <div class="col-md-3">
                <label>DV nhà mạng</label>
                <?=
                $form->field($model, "ExtendVip")->dropDownList([0 => 'Tin thường', 1 => 'Tin GM', 2 => 'Tin VIP'], array('class' => 'form-control dropdownCategories'))->label(false);
                ?>

            </div>

            <div class="col-md-4">
                <label>Chuyên mục Mobile</label>
                <?=
                $form->field($model, "CategoryID")->dropDownList($category, array('class' => 'form-control dropdownCategories'))->label(false);
                ?>
            </div>

            <div class="col-md-5">
                <label>Chuyên mục Pc</label>
                <?=
                $form->field($model, "Category")->dropDownList($categoryPc, array('class' => 'form-control dropdownCategories'))->label(false);
                ?>
            </div>
            <div class="clearfix"></div>

        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-5">
                <label>Chuyên mục 433</label>
                <?=
                $form->field($model, "category433")->dropDownList($category433, array('class' => 'form-control dropdownCategories'))->label(false);
                ?>
            </div>
            <!--thêm mới-->
            <div class="frm-group col-md-7" >
                <label>Ảnh bìa 433</label>
                <div class="post-avatar">
                    <?=
                    Html::img($thumbnailsCover, [
                        'id' => 'img-thumb-cover',
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
                            'data-value' => 'thumbnailsCover',
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
                $form->field($model, 'thumbnailsCover')->hiddenInput(['id' => 'thumbnailsCover'])->label(false);
                ?>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <!--kết thúc-->
            <div class="frm-group col-md-12">
                <?= $form->field($model, "Title")->input('text')->label("Tiêu đề tin") ?>
            </div>
            <!--            <div class="frm-group col-md-4">
            <?php //  $form->field($model, "ExtendMatchID")->input('text')->label("Mã trận HighLight")     ?>
                        </div>-->
            <div class="frm-group col-md-12">
                <?= $form->field($model, 'Summary')->textArea(['rows' => '3', 'id' => '90phut-News-Summary'])->label("Mô tả ngắn") ?>
            </div>
            <div class="col-md-12">
                <div class="frm-group postAdv">
                    <div class="controlAdv">
                        <img src="/img/load.gif" class="iconLoading" id="loadNews"/>
                        <div id="video-search">
                            <input type="text" id="video-search-text" placeholder="Tìm kiếm video"/>
                            <div id="video-search-detail"></div>
                        </div>
                        <span class="btn btn-default btn-xs" 
                              data-tag='News' 
                              onClick="hastag();">
                            <i class="glyphicon glyphicon-tag"></i>
                        </span>
                        <span class="btn btn-default btn-xs">
                            <?= Html::fileInput('editorImg', '', ['add-image-editor' => 'News', 'multiple' => 'multiple']) ?>
                            <i class="glyphicon glyphicon-picture"></i>
                        </span>
                        <span class="btn btn-default btn-xs">
                            <?= Html::fileInput('editorVideo', '', ['add-video-editor' => 'News', 'accept' => 'video/mp4']) ?>
                            <i class="glyphicon glyphicon-film"></i>
                        </span>

                    </div>    
                    <?= $form->field($model, "Contents")->textarea(array('id' => 'News'))->label("Nội dung"); ?>

                </div>
            </div>
            <div class="frm-group col-md-12">
                <?= $form->field($model, "Keyword")->input('text')->label("Từ khóa") ?>
            </div>

            <div class="frm-group col-md-12">
                <?= $form->field($model, "Source")->input('text')->label("Nguồn") ?>
            </div>


            <div class="form-group pull-right">
                <?= Html::submitButton('Lưu lại', ['name' => 'quit', 'class' => 'btn btn-success']) ?>
                <?= Html::submitButton('Lưu lại & Tiếp tục', ['name' => 'continue', 'class' => 'btn btn-success']) ?>

                <a href="<?= $urlback ?>" style="margin-left:20px" class="btn btn-default" >Thoát</a>
            </div> 
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>

<script>
    var config_news = {
//        extraPlugins:'smiley',
        toolbar: [
            {name: 'colors', items: ['Source']},
            {
                name: 'basicstyles',
                groups: ['basicstyles', 'cleanup'],
                items: ['Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat']
            },
            {name: 'links', items: ['Link', 'Unlink']},
            '/',
            {
                name: 'clipboard',
                groups: ['clipboard', 'undo'],
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {name: 'insert', items: ['Table', 'Image', 'Smiley']},
            {name: 'styles', items: ['Format']},
            {name: 'tools', items: ['Maximize']},
            {
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']
            },
            {name: 'colors'}
        ],
        smiley_images: ['match_action_1.png', 'match_action_2.png', 'match_action_3.png', 'match_action_5.png', 'match_action_6.png', 'match_action_7.png', 'match_action_8.png', 'match_action_11.png', 'match_action_14.png', 'ti_le.png', 'the_vang.png', 'the_do.png', 'kick_off.png', 'pen.png', 'phat_goc.png', 'ban_thang.png', 'thay_nguoi.png', 'doihinh_rasan.png'],
        smiley_descriptions: ['Sút vào', 'Thẻ vàng', 'Thẻ vàng thứ 2', 'Ra sân', 'Vào sân', 'Thẻ đỏ', '11m không vào', '11m vào', 'Sút phạt vào', 'Kiến tạo', 'Tỉ lệ', 'Thẻ vàng', 'Thẻ đỏ', 'Kick off', 'Penaty', 'Phạt góc', 'Bàn thắng', 'Thay người', 'Đội hình ra sân'],
        height: 500,
    };

    CKEDITOR.replace('News', config_news);


</script>

