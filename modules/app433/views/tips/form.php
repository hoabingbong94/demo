<?php
/* @var $model app\models\bongda433\MatchTips */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['name' => 'frmTips', 'enctype' => 'multipart/form-data']]);
/* IMG */
$srcThumbnails = "/img/noimg.png";
if ($model->Image != null) {
    $srcThumbnails = "http://localhost:81/" . $model->Image;
}
echo $form->field($model, 'MatchID')->hiddenInput()->label(false);
echo $form->field($model, 'Author')->hiddenInput()->label(false);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm bài nhận định</h3>
    </div>
    <div class="panel-body">

        <?php if (isset($mes) && $mes != '') { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?= $mes; ?>
            </div>
        <?php } ?>

        <div class="col-md-6 remove-padding">
            <!--media categoriess-->
            <div class="media-list">
                <div class="media">
                    <div class="media-body">
                        <label>Chuyên mục</label>
                        <?php
                        echo $form->field($model, "CategoryID")->dropDownList($categories, array('class' => 'form-control dropdownCategories'))->label(false);
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
            <div class="boxCheckbox pull-left">
                <?=
                        $form->field($model, 'Public', array('template' => '{input}{label}<span class="textCheckBox">Hiển thị</span>'))
                        ->checkbox(array('id' => 'Public'), false)
                        ->label("", array('for' => 'Public', 'class' => 'label-primary'))
                ?>
            </div>
            <div class="boxCheckbox pull-left">
                <?=
                        $form->field($model, 'pin', array('template' => '{input}{label}<span class="textCheckBox">Ghim</span>'))
                        ->checkbox(array('id' => 'pin'), false)
                        ->label("", array('for' => 'pin', 'class' => 'label-primary'))
                ?>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12 remove-padding">
            <div class="frm-group">
                <?= $form->field($model, "Title")->input('text', array('id' => 'Title')) ?>
            </div>
            <div class="frm-group postAdv">
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
                    $form->field($model, 'Image')->hiddenInput(['id' => 'CoverImage'])->label(false);
                    ?>
                    <span class="btn btn-default" style="position: relative">Chọn ảnh
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
                            'style' => 'top:0;left:0'
                        ])
                        ?></span>
                </div>
            </div>
            <div class="frm-group">
                <?= $form->field($model, "Description")->textarea(array('id' => 'Description')) ?>

            </div>

            <div class="frm-group postAdv">
                <div class="controlAdv">
                    <span class="btn btn-default btn-xs" data-tag='Content' onClick="hastag();">
                        <i class="glyphicon glyphicon-tag"></i>
                    </span>
                    <span class="btn btn-default btn-xs">
                        <?= Html::fileInput('editorImg', '', ['data-image-editor' => 'Content']) ?>
                        <i class="glyphicon glyphicon-picture"></i>
                    </span>
                    <span class="btn btn-default btn-xs">
                        <?= Html::fileInput('editorVideo', '', ['data-video-editor' => 'Content', 'accept' => 'video/mp4']) ?>
                        <i class="glyphicon glyphicon-film"></i>
                    </span>
                </div>

                <?= $form->field($model, "Tips")->textarea(array('id' => 'Content')); ?>
                <script>
                    var config_long = {
                        toolbar: [
                            {name: 'document', groups: ['mode', 'document', 'doctools'], items: ['Source']},
                            {
                                name: 'basicstyles',
                                groups: ['basicstyles', 'cleanup'],
                                items: ['Bold', 'Italic', 'Strike', '-', 'RemoveFormat']
                            },
                            {name: 'alignment', items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']}
                        ]
                    };
                    CKEDITOR.replace('Content', config_long);
                </script>
            </div>
            <div class="frm-group">
                <?= $form->field($model, "Keyword")->input('text', array('id' => 'Keyword')) ?>
            </div>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12 remove-padding">
            <div class="button-control">
                <?= Html::input('hidden', 'redirect', 'post', ['id' => 'redirectFlag']); ?>
                <?= Html::submitButton('Xuất bản', ['onClick' => 'checkDir(1)', 'class' => 'btn btn-success']) ?>
                <?= Html::submitButton('Xuất bản & Tiếp tục', ['onClick' => 'checkDir(2)', 'class' => 'btn btn-success']) ?>
                <?= Html::submitButton('Ðóng', ['onClick' => 'location.href="/app433/post";return false;', 'class' => 'btn btn-default']) ?>
            </div>
        </div>
    </div>
</div>
<?php
ActiveForm::end();
?>