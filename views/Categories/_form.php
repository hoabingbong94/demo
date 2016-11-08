<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\bongda433\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ParentID')->textInput() ?>

    <?= $form->field($model, 'Logo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CategoryName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'TitleAlias')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Keyword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'OrderIndex')->textInput() ?>

    <?= $form->field($model, 'Public')->textInput() ?>

    <?= $form->field($model, 'UserCreate')->textInput() ?>

    <?= $form->field($model, 'UserUpdate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
