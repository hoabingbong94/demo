<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\app90phut\models\SoccerMatchInfo */

$this->title = 'Create Soccer Match Info';
$this->params['breadcrumbs'][] = ['label' => 'Soccer Match Infos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="soccer-match-info-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
