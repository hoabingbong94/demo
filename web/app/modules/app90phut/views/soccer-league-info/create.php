<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\app90phut\models\SoccerLeagueInfo */

$this->title = 'Create Soccer League Info';
$this->params['breadcrumbs'][] = ['label' => 'Soccer League Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soccer-league-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
