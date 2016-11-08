<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\bongda433\Post */
/* @var $form ActiveForm */
?>
<div class="form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'CategoryID') ?>
        <?= $form->field($model, 'Type') ?>
        <?= $form->field($model, 'MatchID') ?>
        <?= $form->field($model, 'Recommened') ?>
        <?= $form->field($model, 'View') ?>
        <?= $form->field($model, 'UserCreate') ?>
        <?= $form->field($model, 'UserUpdate') ?>
        <?= $form->field($model, 'UserLiveEdit') ?>
        <?= $form->field($model, 'Live') ?>
        <?= $form->field($model, 'Pin') ?>
        <?= $form->field($model, 'PinVideo') ?>
        <?= $form->field($model, 'PinRecommened') ?>
        <?= $form->field($model, 'Public') ?>
        <?= $form->field($model, 'IsDelete') ?>
        <?= $form->field($model, 'Content') ?>
        <?= $form->field($model, 'ContentNone') ?>
        <?= $form->field($model, 'ContentExtend') ?>
        <?= $form->field($model, 'ContentExtendNone') ?>
        <?= $form->field($model, 'DatePublic') ?>
        <?= $form->field($model, 'DateCreate') ?>
        <?= $form->field($model, 'DateUpdate') ?>
        <?= $form->field($model, 'Title') ?>
        <?= $form->field($model, 'UrlVideoToken') ?>
        <?= $form->field($model, 'Thumbnails') ?>
        <?= $form->field($model, 'Thumb') ?>
        <?= $form->field($model, 'UrlVideo') ?>
        <?= $form->field($model, 'UrlVideo144p') ?>
        <?= $form->field($model, 'UrlVideo240p') ?>
        <?= $form->field($model, 'ThumbVideo') ?>
        <?= $form->field($model, 'Keyword') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- form -->
