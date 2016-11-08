<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\test\models\SoccerMatchInfo */

$this->title = 'Update Soccer Match Info: ' . $model->MatchID;
$this->params['breadcrumbs'][] = ['label' => 'Soccer Match Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->MatchID, 'url' => ['view', 'id' => $model->MatchID]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="soccer-match-info-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
