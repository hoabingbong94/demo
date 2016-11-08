<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\app90phut\models\SoccerLeagueInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="soccer-league-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ID')->textInput() ?>

    <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Logo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CurrentRound')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Code_Param1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Code_Param2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Code_Param3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Code_Param4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Code_Param5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Code_Param6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Name_VN')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BXH')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Name_VN_Unicode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Display_Order')->textInput() ?>

    <?= $form->field($model, 'CategoryID')->textInput() ?>

    <?= $form->field($model, 'Product_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Service_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Images')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
