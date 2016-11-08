<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\test\models\SoccerMatchInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="soccer-match-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'AwayID')->textInput() ?>

    <?= $form->field($model, 'AwayName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'HomeID')->textInput() ?>

    <?= $form->field($model, 'HomeName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MatchID')->textInput() ?>

    <?= $form->field($model, 'MatchPeriod')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'MatchState')->textInput() ?>

    <?= $form->field($model, 'MinuteEx')->textInput() ?>

    <?= $form->field($model, 'MinutePlaying')->textInput() ?>

    <?= $form->field($model, 'Odds')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Score')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'StartTime')->textInput() ?>

    <?= $form->field($model, 'XHAway')->textInput() ?>

    <?= $form->field($model, 'XHHome')->textInput() ?>

    <?= $form->field($model, 'AName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'BName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CAName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'CBName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VName')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'LeagueID')->textInput() ?>

    <?= $form->field($model, 'TTUpdateFinishMatch')->textInput() ?>

    <?= $form->field($model, 'ExtendAuto')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
