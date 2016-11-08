<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\app90phut\models\News */

$this->title = $model->Title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ID], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->ID], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ID',
            'NewsID',
            'CategoryID',
            'Category',
            'Title',
            'Summary',
            'Thumbnails',
            'ThumbnailsPc',
            'CoverImage',
            'Contents:ntext',
            'ExtendContentMobile:ntext',
            'Keyword',
            'Author',
            'Source',
            'ReleaseDate',
            'LikeCount',
            'ViewCount',
            'PostCount',
            'ThumbnailsDesc',
            'AudioPath',
            'VideoPath',
            'ExtendIsPublic',
            'ExtendUserCreate',
            'ExtendUpdateDate',
            'ExtendUpdateTime',
            'ExtendHot',
            'ExtendGet',
            'ExtendVip',
            'ExtendUserUpdate',
            'ExtendTop',
            'ExtendUp',
            'ExtendMatchID',
            'ExtendHighLight',
        ],
    ])
    ?>

</div>
