<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->label('Tên tài khoản')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fullname')->label('Bút danh')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-user-password_hash">
        <label class="control-label" for="user-password_hash">Mật khẩu</label>
        <input type="text" id="user-password_hash" class="form-control" name="newpassword" value="">
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'status')->label('Trạng thái')->dropDownlist([1=>"Active",0=>"Deactive"]); ?>
    
    <?= $form->field($model, 'zoneid')->label('Zone mặc định')->dropDownlist([0=>"Zone chung",1=>"Zone 90phut",2=>"Zone bongda433"]); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : ' Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
