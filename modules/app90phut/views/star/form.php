<?php
/* @var $model app\models\bongda433\Post */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['name' => 'frmPost', 'enctype' => 'multipart/form-data']]);
//$type = $model->Type;
/* IMG */
$srcThumbnails = "/img/noimg.png";
$thumbnailsCover = "/img/noimg.png";
if ($model->Thumbnails != "") {
    $srcThumbnails = \Yii::$app->params['media90phut'] . $model->Thumbnails;
}
if ($model433->ThumbnailsCover != null && $model433->ThumbnailsCover != "") {

    $thumbnailsCover = \Yii::$app->params['media90phut'] . ltrim($model433->ThumbnailsCover, "90phut");
}
//echo $model433->ThumbnailsCover;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm bài tin ngôi sao</h3>
    </div>
    <div class="panel-body">

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

                    <div class="media-left">
                        <?=
                        Html::img($srcThumbnails, [
                            'id' => 'img-cover',
                            'data-src' => 'holder.js/95x64',
                            'class' => 'media-object imgPreview image-90phut-star',
                            'data-holder-rendered' => 'true',
                            'style' => 'width:142px;'
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
                            'class' => 'images',
                            'style' => 'width:142px;height:80px;'
                        ])
                        ?>
                        <?=
                                $form->field($model, 'Thumbnails')
                                ->hiddenInput(['id' => 'CoverImage'])
                                ->label(false);
                        ?>
                    </div>

                </div>
                <!--thêm mới-->

                <!--kết thúc-->
            </div>
            <div class="hrBorder" style="height:84px;"></div>
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
                            $form->field($model, 'IsPublic', array('template' => '{input}{label}<span class="textCheckBox">Hiển thị</span>'))
                            ->checkbox(array('id' => 'IsPublic'), false)
                            ->label("", array('for' => 'IsPublic', 'class' => 'label-primary'))
                    ?>
                </div>
                <?php
            }
            ?>
            <!--thêm mới-->

            <!--kết thúc-->
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12 remove-padding">
            <div class="col-md-6 remove-padding">
                <!--media categoriess-->
                <div class="media-list">
                    <div class="frm-group col-md-10" >
                        <label>Ảnh bìa 433</label>
                        <div class="post-avatar" style="position:relative;">
                            <?=
                            Html::img($thumbnailsCover, [
                                'id' => 'img-thumb-cover',
                                'alt' => '',
                                'data-src' => 'holder.js/125x80',
                                'class' => 'media-object media-object-avatar',
                                'data-holder-rendered' => 'true',
                                'style' => 'width:232px'
                            ]);
                            ?>

                            <span class="btn btn-default" style="width:100%;height:100%;position: absolute;top:0;left:0;opacity: 0;">Chọn ảnh
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
                                    'style' => 'top:0;left:0;width: 100%;height: 100%;'
                                ])
                                ?></span>
                        </div>
                        <?=
                        $form->field($model, 'thumbnailsCover')->hiddenInput(['id' => 'thumbnailsCover'])->label(false);
                        ?>
                    </div>
                    <!--kết thúc-->
                </div>

            </div>
            <div class="col-md-6 remove-padding">
                <div class="media-body">
                    <label>Chuyên mục 433</label>
                    <?=
                    $form->field($model, "CategoryID")->dropDownList($category433, array('class' => 'form-control dropdownCategories'))->label(false);
                    ?>
                </div>
                <!--kết thúc-->
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12 remove-padding">

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
            <div class="frm-group postAdv">
                <div class="controlAdv">
                    <img src="/img/load.gif" class="iconLoading" id="loadContent"/>
                    <div id="video-search">
                        <input type="text" id="video-search-text" placeholder="Tìm kiếm video"/>
                        <div id="video-search-detail"></div>
                    </div>
                    <span class="btn btn-default btn-xs" 
                          data-tag='Content' 
                          onClick="hastag();">
                        <i class="glyphicon glyphicon-tag"></i>
                    </span>
                    <span class="btn btn-default btn-xs">
                        <?= Html::fileInput('editorImg', '', ['add-image-editor' => 'Content', 'multiple' => 'multiple']) ?>
                        <i class="glyphicon glyphicon-picture"></i>
                    </span>
                    <span class="btn btn-default btn-xs">
                        <?= Html::fileInput('editorVideo', '', ['data-video-editor' => 'ContentExtend', 'accept' => 'video/mp4']) ?>
                        <i class="glyphicon glyphicon-film"></i>
                    </span>
                </div>

                <?= $form->field($model, "Contents")->textarea(array('id' => 'Content')); ?>

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
                            {name: 'alignment', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
                            {name: 'links', items: ['Link', 'Unlink']},
                        ]
                    };
                    CKEDITOR.replace('Content', config_long);
                </script>
            </div>

            <div class="frm-group postAdv">
                <div class="controlAdv postAdv">
                    <img src="/img/load.gif" class="iconLoading" id="loadContentExtend"/>
                    <div id="video-searchStar">
                        <input type="text" id="video-search-textStar" placeholder="Tìm kiếm video"/>
                        <div id="video-search-detailStar"></div>
                    </div>
                    <span class="btn btn-default btn-xs" 
                          data-tag='ContentExtend' 
                          onClick="hastag();">
                        <i class="glyphicon glyphicon-tag"></i>
                    </span>
                    <span class="btn btn-default btn-xs">
                        <?= Html::fileInput('editorImg', '', ['add-image-editor' => 'ContentExtend', 'multiple' => 'multiple']) ?>
                        <i class="glyphicon glyphicon-picture"></i>
                    </span>
                    <span class="btn btn-default btn-xs">
                        <?= Html::fileInput('editorVideo', '', ['data-video-editor' => 'ContentExtend', 'accept' => 'video/mp4']) ?>
                        <i class="glyphicon glyphicon-film"></i>
                    </span>
                </div>
                <?= $form->field($model, "ContentsExtend")->textarea(array('id' => 'ContentExtend')) ?>
                <script>
                    CKEDITOR.replace('ContentExtend', config_long);
                </script>
            </div>
            <div class="frm-group">
                <?= $form->field($model, "Keyword")->input('text', array('id' => 'Keyword')) ?>
            </div>
            <div class="frm-group">
                <?= $form->field($model, "Source")->input('text', array('id' => 'Source', 'value' => '90phut.vn')) ?>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12 remove-padding">
            <div class="button-control">
                <?= Html::input('hidden', 'redirect', 'star', ['id' => 'redirectFlag']); ?>
                <?= Html::submitButton('Xuất bản', ['onClick' => 'checkDir(1)', 'class' => 'btn btn-success']) ?>
                <?= Html::submitButton('Xuất bản & Tiếp tục', ['onClick' => 'checkDir(2)', 'class' => 'btn btn-success']) ?>
                <?= Html::submitButton('Ðóng', ['onClick' => 'location.href="/app90phut/star";return false;', 'class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>
</div>
<?php
ActiveForm::end();
?>