<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\app90phut\models\SoccerMatchInfo */

$this->title = $model->MatchID;
$this->params['breadcrumbs'][] = ['label' => 'Soccer Match Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soccer-match-info-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->MatchID], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->MatchID], [
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
            'AwayID',
            'AwayName',
            'HomeID',
            'HomeName',
            'MatchID',
            'MatchPeriod',
            'MatchState',
            'MinuteEx',
            'MinutePlaying',
            'Odds',
            'Score',
            'StartTime',
            'XHAway',
            'XHHome',
            'AName',
            'BName',
            'CAName',
            'CBName',
            'VName',
            'LeagueID',
            'TTUpdateFinishMatch',
            'ExtendAuto',
        ],
    ]) ?>

</div>
