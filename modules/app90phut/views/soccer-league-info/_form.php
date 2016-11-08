<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\app90phut\models\SoccerLeagueInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= "Sửa thông tin giải đấu" ?>
        </h3>
    </div>
    <div class="panel-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'ID')->textInput() ?>

        <?= $form->field($model, 'Name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'Name_VN')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'Name_VN_Unicode')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'Display_Order')->textInput() ?>



        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
