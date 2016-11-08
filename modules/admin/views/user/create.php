<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Admin */

$this->title = 'Create Admin';
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm mới tài khoản</h3>
    </div>
    <div class="panel-body">
        <div class="admin-create">
            <?=
            $this->render('_form_admin', [
                'model' => $model,
            ])
            ?>

        </div>
    </div>
</div>