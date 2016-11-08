<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\test\models\SoccerMatchInfoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Soccer Match Infos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soccer-match-info-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Soccer Match Info', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->MatchID), ['view', 'id' => $model->MatchID]);
        },
    ]) ?>
</div>
