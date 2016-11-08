<?php
/* @var $model app\models\bongda433\MatchTips */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['options' => ['name' => 'frmTips', 'enctype' => 'multipart/form-data']]);
/* IMG */
$srcThumbnails = "/img/noimg.png";
if ($model->Images != null) {
    $srcThumbnails = Yii::$app->params['pathMedia']."/" . $model->Images;
}
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm banner</h3>
    </div>
    <div class="panel-body">
        <div class="col-md-12 remove-padding">
            <div class="frm-group" style="margin-bottom: 0px;">
                <div class="boxCheckbox pull-left">
                    <?=
                            $form->field($model, 'Public', array('template' => '{input}{label}<span class="textCheckBox">Hiển thị</span>'))
                            ->checkbox(array('id' => 'Public'), false)
                            ->label("", array('for' => 'Public', 'class' => 'label-primary'))
                    ?>
                </div>
            </div>
            <div class="frm-group">
                <?= $form->field($model, "Title")->input('text', array('id' => 'Title')) ?>
            </div>
            <div class="frm-group">
                <label>Banner</label>
                <div class="post-avatar" style="position: relative">
                    <?=
                    Html::img($srcThumbnails, [
                        'id' => 'img-cover',
                        'alt' => '',
                        'data-src' => 'holder.js/125x80',
                        'class' => 'media-object media-object-avatar',
                        'data-holder-rendered' => 'true',
                        'style' => 'width:100px;height:200px;'
                    ]);
                    ?>

                    <?=
                    $form->field($model, 'Images')->hiddenInput(['id' => 'CoverImage'])->label(false);
                    ?>
                    <span class="btn btn-default selectImages">Chọn ảnh
                        <?=
                        Html::fileInput('CoverImage', '', [
                            'id' => 'upload-cover',
                            'title' => 'Chọn ảnh bìa',
                            'accept' => 'image/*',
                            'data-value' => 'CoverImage',
                            'data-path' => '',
                            'data-crop' => 'img-cover',
                            'data-crop-width' => '200',
                            'data-crop-height' => '400',
                            'class' => 'images inputFile',
                        ])
                        ?>
                    </span>
                </div>
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