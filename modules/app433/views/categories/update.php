<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\bongda433\Categories */

$this->title = 'Update Categories: ' . $model->Title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Title, 'url' => ['view', 'id' => $model->CategoryID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Chỉnh sửa chuyên mục</h3>
    </div>
    <div class="panel-body">
        <div class="categories-update">

            <?=
            $this->render('_form', [
                'model' => $model,
                'categories' => $categories,
                'mes'=>$mes    
            ])
            ?>

        </div>
    </div>
</div>
