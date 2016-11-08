<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

//use yii\widgets\

$srcIcon = "/img/noImg.png";
//$thumbnailsCover = "/img/noimg.png";

if ($model->Icon != null and $model->Icon != "") {
    $srcIcon = \Yii::$app->params['media'] . $model->Icon;
}
$form = ActiveForm::begin(['options' => ['name' => 'frmPost', 'enctype' => 'multipart/form-data']]);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm mới chuyên mục</h3>     
    </div>
    <div class="panel-body">
        <div class="col-md-12">
            <div class="col-md-3">
            <div class="frm-group boxCheckbox">
                    <?=
                            $form->field($model, 'Status', array('template' => '<span class="textCheckBox">Hiển thị</span><br/><br/>{input}{label}'))
                            ->checkbox(array('id' => 'Status'), false)
                            ->label("", array('for' => 'Status', 'class' => 'label-primary'))
                    ?>
                </div>
            </div>
            <div class="clear"></div>
            <div class="col-md-3"><div class="frm-group boxCheckbox">
                    <?=
                            $form->field($model, 'ShowHome', array('template' => '<span class="textCheckBox">Hiển thị trang chủ</span><br/><br/>{input}{label}'))
                            ->checkbox(array('id' => 'ShowHome'), false)
                            ->label("", array('for' => 'ShowHome', 'class' => 'label-primary'))
                    ?>
                </div>
            </div>

            <div class="col-md-4">
                <div class="frm-group field-Background">
                    <label class="control-label" for="Background">Màu menu</label>

                    <?= $form->field($model, "Background")->input('color', array('id' => 'Background', 'style' => 'width: 30%;border:none;border-radius:0px;box-shadow: none;'))->label(false) ?>
                </div>
            </div>
            <div class="col-md-2">
                <div class="news-thumbnails">
                    <label>Icon</label>
                    <div class="tip-avatar">
                        <?=
                        Html::img($srcIcon, [
                            'id' => 'img-logo',
                            'data-src' => 'holder.js/95x64',
                            'class' => 'media-object images-icon',
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
                            'data-crop-width' => '120',
                            'data-crop-height' => '120',
                            'class' => 'tip-images-icon'
                        ])
                        ?>
                        <?=
                        $form->field($model, 'Icon')->hiddenInput(['id' => 'LogoImage'])->label(false);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="col-md-12">
            <div class="frm-group field-CategoryName">
                <label class="control-label" for="Cate-Title">Tên chuyên mục</label>
                <?= $form->field($model, "Title")->input('text', array('id' => 'Cate-Title'))->label(false) ?>
            </div>
            <div class="frm-group field-Description">
                <label class="control-label" for="Description">Mô tả</label>
                <?= $form->field($model, "Description")->textarea()->label(false) ?>
            </div>
            <div class="frm-group field-Parent">
                <label class="control-label" for="ParentId">Chuyên mục gốc</label>
                <?=
                $form->field($model, "ParentId")->dropDownList($listCategories)->label(false);
                ?>
            </div>
            <div class="frm-group field-Order">
                <label class="control-label" for="Order">Thứ tự sắp xếp</label>
                <?= $form->field($model, "Order")->input('number', array('id' => 'Order'))->label(false) ?>
            </div>

        </div>
    </div>
</div>

<div class="col-md-12 ">
    <div class="button-control">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::submitButton('Ðóng', ['class' => 'btn btn-default', 'onclick' => 'history.go(-1);return false;']) ?>
    </div>
</div>

<?php
ActiveForm::end();
?>

