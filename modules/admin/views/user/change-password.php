<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\ChangePassword */

$this->title = Yii::t('rbac-admin', 'Change Password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Đổi mật khẩu</h3>
    </div>
    <div class="panel-body">
        <div class="site-signup">
           
            <p>Vui lòng điển thông tin sau để thay đổi mật khẩu:</p>

            <div class="col-md-12">
                <div class="col-lg-5 ">
                    <?php $form = ActiveForm::begin(['id' => 'form-change']); ?>
                    <?= $form->field($model, 'oldPassword')->passwordInput()->label("Mật khẩu cũ") ?>
                    <?= $form->field($model, 'newPassword')->passwordInput()->label("Mật khẩu mới") ?>
                        <?= $form->field($model, 'retypePassword')->passwordInput()->label("Nhập lại mật khẩu mới") ?>
                    <div class="form-group">
                    <?= Html::submitButton(Yii::t('rbac-admin', 'Lưu lại'), ['class' => 'btn btn-primary', 'name' => 'change-button']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
