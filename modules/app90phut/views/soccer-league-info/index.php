<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel mdm\admin\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Danh giải đấu</h3>
    </div>
    <div class="panel-body">

        <div class="user-index">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'ID',
                    'Name',
                    'Name_VN_Unicode',
                    'Display_Order',
//                    [
//                        'attribute' => 'status',
//                        'value' => function($model) {
//                            return $model->status == 0 ? 'Inactive' : 'Active';
//                        },
//                        'filter' => [
//                            0 => 'Inactive',
//                            1 => 'Active'
//                        ]
//                    ],
//                    [
//                        'class' => 'yii\grid\ActionColumn',
//                        'template' => '{view}{update}{delete}'
//                    ],
                    [
                        'attribute' => "",
                        'format' => 'raw',
                        'value' => function($model) {
                            return '<div class="btn-group">
                            <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown"
                                    class="btn btn-default btn-sm dropdown-toggle" type="button"><span
                                    class="glyphicon glyphicon-cog"></span> <span
                                    class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"></li>
                                <li><a href="/app90phut/soccer-league-info/update?id=' . $model->ID . '">Chỉnh sửa</a></li>  
                            </ul>
                        </div>';
                        }
                    ],
                ],
            ]);
            ?>
        </div>

    </div>
</div>