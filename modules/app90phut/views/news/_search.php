<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\app90phut\models\NewsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'NewsID') ?>

    <?= $form->field($model, 'CategoryID') ?>

    <?= $form->field($model, 'Category') ?>

    <?= $form->field($model, 'Title') ?>

    <?php // echo $form->field($model, 'Summary') ?>

    <?php // echo $form->field($model, 'Thumbnails') ?>

    <?php // echo $form->field($model, 'ThumbnailsPc') ?>

    <?php // echo $form->field($model, 'CoverImage') ?>

    <?php // echo $form->field($model, 'Contents') ?>

    <?php // echo $form->field($model, 'ExtendContentMobile') ?>

    <?php // echo $form->field($model, 'Keyword') ?>

    <?php // echo $form->field($model, 'Author') ?>

    <?php // echo $form->field($model, 'Source') ?>

    <?php // echo $form->field($model, 'ReleaseDate') ?>

    <?php // echo $form->field($model, 'LikeCount') ?>

    <?php // echo $form->field($model, 'ViewCount') ?>

    <?php // echo $form->field($model, 'PostCount') ?>

    <?php // echo $form->field($model, 'ThumbnailsDesc') ?>

    <?php // echo $form->field($model, 'AudioPath') ?>

    <?php // echo $form->field($model, 'VideoPath') ?>

    <?php // echo $form->field($model, 'ExtendIsPublic') ?>

    <?php // echo $form->field($model, 'ExtendUserCreate') ?>

    <?php // echo $form->field($model, 'ExtendUpdateDate') ?>

    <?php // echo $form->field($model, 'ExtendUpdateTime') ?>

    <?php // echo $form->field($model, 'ExtendHot') ?>

    <?php // echo $form->field($model, 'ExtendGet') ?>

    <?php // echo $form->field($model, 'ExtendVip') ?>

    <?php // echo $form->field($model, 'ExtendUserUpdate') ?>

    <?php // echo $form->field($model, 'ExtendTop') ?>

    <?php // echo $form->field($model, 'ExtendUp') ?>

    <?php // echo $form->field($model, 'ExtendMatchID') ?>

    <?php // echo $form->field($model, 'ExtendHighLight')  ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
