<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\app90phut\models\SoccerMatchInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="soccer-match-info-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'AwayID') ?>

    <?= $form->field($model, 'AwayName') ?>

    <?= $form->field($model, 'HomeID') ?>

    <?= $form->field($model, 'HomeName') ?>

    <?= $form->field($model, 'MatchID') ?>

    <?php // echo $form->field($model, 'MatchPeriod') ?>

    <?php // echo $form->field($model, 'MatchState') ?>

    <?php // echo $form->field($model, 'MinuteEx') ?>

    <?php // echo $form->field($model, 'MinutePlaying') ?>

    <?php // echo $form->field($model, 'Odds') ?>

    <?php // echo $form->field($model, 'Score') ?>

    <?php // echo $form->field($model, 'StartTime') ?>

    <?php // echo $form->field($model, 'XHAway') ?>

    <?php // echo $form->field($model, 'XHHome') ?>

    <?php // echo $form->field($model, 'AName') ?>

    <?php // echo $form->field($model, 'BName') ?>

    <?php // echo $form->field($model, 'CAName') ?>

    <?php // echo $form->field($model, 'CBName') ?>

    <?php // echo $form->field($model, 'VName') ?>

    <?php // echo $form->field($model, 'LeagueID') ?>

    <?php // echo $form->field($model, 'TTUpdateFinishMatch') ?>

    <?php // echo $form->field($model, 'ExtendAuto')  ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
