<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\bongda433\Categories */

$this->title = 'Create Categories';
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Thêm mới chuyên mục</h3>
    </div>
    <div class="panel-body">
        <div class="categories-create">

            <!--<h1><?= Html::encode($this->title) ?></h1>-->

            <?=
            $this->render('_form', [
                'model' => $model,
                'categories'=>$categories,
                'mes'=>$mes
            ])
            ?>

        </div>
    </div>
</div>