<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\bongda433\Categories */
/* @var $form yii\widgets\ActiveForm */
$srcThumbnails = $srcCover = "/img/noImg.png";
if ($model->Logo != "") {
    $srcThumbnails = Yii::$app->params['imagePath'] . $model->Logo;
}
if ($model->Image_Cover != "") {
    $srcCover = Yii::$app->params['imagePath'] . $model->Image_Cover;
}
?>
  <?php if (isset($mes) && $mes != '') { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?= $mes; ?>
            </div>
  <?php } ?>

<div class="categories-form">
    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-4">
                <div class="media">
                        <div class="media-left">
                            <?=
                            Html::img($srcThumbnails, [
                                'id' => 'img-logo',
                                'alt' => '95x64',
                                'data-src' => 'holder.js/95x64',
                                'class' => 'media-object imgPreview',
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
                                'data-crop-width' => '80',
                                'data-crop-height' => '80',
                                'class' => 'images'
                            ])
                            ?>
                            <?=
                            $form->field($model, 'Logo')->hiddenInput(['id' => 'LogoImage'])->label(false);
                            ?>
                        </div>
                   
                </div>
    </div>
    <div class="col-md-8">
         <div class="media">
                        <div class="media-left">
                            <?=
                            Html::img($srcCover, [
                                'id' => 'img-cover',
                                'alt' => '95x64',
                                'data-src' => 'holder.js/95x64',
                                'class' => 'media-object coverPreview',
                                'data-holder-rendered' => 'true',
                            ]);
                            ?>
                            <?=
                            Html::fileInput('LogoImage', '', [
                                'id' => 'upload-cover',
                                'title' => 'Chọn ảnh bìa',
                                'accept' => 'image/*',
                                'data-value' => 'CoverImage',
                                'data-path' => '',
                                'data-crop' => 'img-cover',
                                'data-crop-width' => '580',
                                'data-crop-height' => '200',
                                'class' => 'cover'
                            ])
                            ?>
                            <?=
                            $form->field($model, 'Image_Cover')->hiddenInput(['id' => 'CoverImage'])->label(false);
                            ?>
                        </div>
                   
                </div>
    </div>
    
    <div class="clearfix"></div>
     <div class="col-md-6">  
    <?= $form->field($model, 'CategoryName')->label("Tên chuyên mục")->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6">
    <div class="media-body">
        <label>Chuyên mục cha</label>
        <?=
        $form->field($model, "ParentID")->dropDownList($categories, array('class' => 'form-control dropdownCategories'))->label(false);
        ?>

    </div>
    </div>
   
    <div class="col-md-6">  
    <?= $form->field($model, 'OrderIndex')->label("Thứ tự")->textInput() ?>
    </div>
    <div class="col-md-6">  
    <?= $form->field($model, 'TitleAlias')->label("Alias")->textInput() ?>
    </div>
        <div class="col-md-6">  
    <?= $form->field($model, 'Title')->label("SEO Title")->textInput() ?>
    </div>
    <div class="col-md-6">  
    <?= $form->field($model, 'Keyword')->label("SEO Keyword")->textInput() ?>
    </div>
     <div class="col-md-12">  
    <?= $form->field($model, 'Description')->label("SEO Description")->textArea() ?>
    </div>
    <div class="col-md-6">
                <label>Loại menu</label>
                <?=
                $form->field($model, "Style")->dropDownList([0 => 'Bình Thường', 1 => 'Hot', 2 => 'New'], array('class' => 'form-control dropdownCategories'))->label(false);
                ?>
            </div>
    <div class="col-md-6">  
          <div class="boxCheckbox pull-left">
              <label>Hiển thị</label>
                <?=
                        $form->field($model, 'Public', array('template' => '{input}{label}<span class="textCheckBox"></span>'))
                        ->checkbox(array('id' => 'Public'), false)
                        ->label("", array('for' => 'Public', 'class' => 'label-primary'))
                ?>
            </div>
    </div>
    
    
    <div class="col-md-12">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
