<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\app90phut\models\SoccerLeagueInfoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="soccer-league-info-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?= $form->field($model, 'ID') ?>

    <?= $form->field($model, 'Name') ?>

    <?= $form->field($model, 'Logo') ?>

    <?= $form->field($model, 'CurrentRound') ?>

    <?= $form->field($model, 'Code_Param1') ?>

    <?php // echo $form->field($model, 'Code_Param2') ?>

    <?php // echo $form->field($model, 'Code_Param3') ?>

    <?php // echo $form->field($model, 'Code_Param4') ?>

    <?php // echo $form->field($model, 'Code_Param5') ?>

    <?php // echo $form->field($model, 'Code_Param6') ?>

    <?php // echo $form->field($model, 'Name_VN') ?>

    <?php // echo $form->field($model, 'BXH') ?>

    <?php // echo $form->field($model, 'Name_VN_Unicode') ?>

    <?php // echo $form->field($model, 'Display_Order') ?>

    <?php // echo $form->field($model, 'CategoryID') ?>

    <?php // echo $form->field($model, 'Product_ID') ?>

    <?php // echo $form->field($model, 'Service_ID') ?>

    <?php // echo $form->field($model, 'Images')  ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
