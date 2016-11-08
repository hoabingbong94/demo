<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\app90phut\models\SoccerMatchInfo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="soccer-match-info-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                <?= ($model->isNewRecord) ? "Thêm mới trận đấu" : "Sửa trận đấu" ?>
            </h3>
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'AwayID')->hiddenInput(['id' => 'AwayID'])->label(false) ?>
            <?= $form->field($model, 'HomeID')->hiddenInput(['id' => 'HomeID'])->label(false) ?>

            <div class="col-md-4">
                <?= $form->field($model, 'LeagueID')->textInput()->label("Mã giải đấu") ?>
            </div>   
            <div class="col-md-4 col-md-offset-2 boxCheckbox ">
                <?=
                        $form->field($model, 'ExtendAuto', array('template' => '<span class="textCheckBox">Tự động lấy dữ liệu</span><br/><br/>{input}{label}'))
                        ->checkbox(array('id' => 'ExtendAuto'), false)
                        ->label("", array('for' => 'ExtendAuto', 'class' => 'label-primary'))
                ?>
            </div>
            <div class="col-md-6">
                <div id="team-search">
                    <label>Tìm kiếm đội</label>
                    <input type="text" id="team-search-text"
                           placeholder="Nhập tên đội cần tìm"
                           class="form-control"/>

                    <div id="team-search-detail">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'HomeName')->textInput(['maxlength' => true, 'id' => 'HomeName']) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'AwayName')->textInput(['maxlength' => true, 'id' => 'AwayName']) ?>
            </div>

            <div class="col-md-4">
                <?= $form->field($model, 'StartTime')->textInput(['onClick' => 'loaddatetime();', 'id' => 'datetimepicker2'])->label("Thời gian bắt đầu") ?>
            </div>

            <div class="col-md-2">
                <?= $form->field($model, 'MinutePlaying')->textInput()->label("Phút đang đá") ?>
            </div>

            <div class="col-md-2">
                <?= $form->field($model, 'MinuteEx')->textInput()->label("Phút bù giờ") ?>
            </div>

            <div class="col-md-2">
                <?= $form->field($model, 'Score')->textInput()->label("Tỉ số") ?>
            </div>


            <div class="col-md-2">
                <label>Trạng thái</label>
                <?=
                $form->field($model, "MatchState")->dropDownList([0 => 'Đang đá', 1 => 'Chưa đá', 2 => 'Hoãn', 3 => 'Hoãn', 4 => 'Đá xong', 5 => 'Hủy'], array('class' => 'form-control dropdownCategories'))->label(false);
                ?>
            </div>

            <div class="clearfix"></div>
            <div class="form-group pull-right">
                <?= Html::submitButton($model->isNewRecord ? 'Thêm mới trận' : 'Cập nhật trận', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

