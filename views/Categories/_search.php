<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\bongda433\CategoriesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'CategoryID') ?>

    <?= $form->field($model, 'ParentID') ?>

    <?= $form->field($model, 'Logo') ?>

    <?= $form->field($model, 'CategoryName') ?>

    <?= $form->field($model, 'Title') ?>

    <?php // echo $form->field($model, 'TitleAlias') ?>

    <?php // echo $form->field($model, 'Keyword') ?>

    <?php // echo $form->field($model, 'OrderIndex') ?>

    <?php // echo $form->field($model, 'Public') ?>

    <?php // echo $form->field($model, 'UserCreate') ?>

    <?php // echo $form->field($model, 'UserUpdate') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
