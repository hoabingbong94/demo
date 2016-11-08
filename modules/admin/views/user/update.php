<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Admin */

$this->title = 'Update Admin: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Cập nhật tài khoản</h3>
    </div>
    <div class="panel-body">
        <div class="admin-update">

            <!--<h1><?= Html::encode($this->title) ?></h1>-->

            <?=
            $this->render('_form_admin', [
                'model' => $model,
            ])
            ?>

        </div>
    </div>
</div>