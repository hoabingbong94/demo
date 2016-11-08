<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SoccerMatchInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Soccer Match Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soccer-match-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Soccer Match Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'AwayID',
            'AwayName',
            'HomeID',
            'HomeName',
            'MatchID',
            // 'MatchPeriod',
            // 'MatchState',
            // 'MinuteEx',
            // 'MinutePlaying',
            // 'Odds',
            // 'Score',
            // 'StartTime',
            // 'XHAway',
            // 'XHHome',
            // 'AName',
            // 'BName',
            // 'CAName',
            // 'CBName',
            // 'VName',
            // 'LeagueID',
            // 'TTUpdateFinishMatch',
            // 'ExtendAuto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
