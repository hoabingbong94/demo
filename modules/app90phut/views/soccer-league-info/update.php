<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\app90phut\models\SoccerLeagueInfo */

$this->title = 'Update Soccer League Info: ' . $model->Name;
$this->params['breadcrumbs'][] = ['label' => 'Soccer League Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Name, 'url' => ['view', 'id' => $model->ID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="soccer-league-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
