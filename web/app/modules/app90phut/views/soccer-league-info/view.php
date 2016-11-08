<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\app90phut\models\SoccerLeagueInfo */

$this->title = $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Soccer League Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soccer-league-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'Name',
            'Logo',
            'CurrentRound',
            'Code_Param1',
            'Code_Param2',
            'Code_Param3',
            'Code_Param4',
            'Code_Param5',
            'Code_Param6',
            'Name_VN',
            'BXH',
            'Name_VN_Unicode',
            'Display_Order',
            'CategoryID',
            'Product_ID',
            'Service_ID',
            'Images',
        ],
    ]) ?>

</div>
