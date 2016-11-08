<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\bongda433\CategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Categories', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'CategoryID',
            'ParentID',
            'Logo',
            'CategoryName',
            'Title',
            // 'TitleAlias',
            // 'Keyword',
            // 'OrderIndex',
            // 'Public',
            // 'UserCreate',
            // 'UserUpdate',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
