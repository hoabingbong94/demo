<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\app90phut\models\News */

$this->title = 'Update News: ' . $model->Title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Title, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
        'category' => $category,
        'categoryPc' => $categoryPc,
        'mes' => $mes
    ])
    ?>

</div>
