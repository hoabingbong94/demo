<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Login */

$this->title = Yii::t('rbac-admin', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-6 col-md-offset-3 login-form">
                <div class="panel panel-default panel-login">
                  
                    <div class="panel-body">

<div class="site-login">

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= 
                    Html::submitButton(Yii::t('rbac-admin', 'Login'), ['class' => 'btn btn-primary btn-login', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
</div>
                    </div>
                   
                <label class="copyright-login-form pull-right">HelloMedia © 2016</label>
                </div>

