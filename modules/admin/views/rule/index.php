<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this  yii\web\View */
/* @var $model mdm\admin\models\BizRule */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\BizRule */

$this->title = Yii::t('rbac-admin', 'Rules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Danh sách Route</h3>
    </div>
    <div class="panel-body">
        <div class="role-index">

            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a(Yii::t('rbac-admin', 'Create Rule'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'name',
                        'label' => Yii::t('rbac-admin', 'Name'),
                    ],
//                    ['class' => 'yii\grid\ActionColumn',],
                     [
                        'attribute'=>"",
                        'format'=>'raw',
                        'value'=>function($model){
                            return '<div class="btn-group">
                            <button aria-expanded="false" aria-haspopup="true" data-toggle="dropdown"
                                    class="btn btn-default btn-sm dropdown-toggle" type="button"><span
                                    class="glyphicon glyphicon-cog"></span> <span
                                    class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header"></li>
                                <li><a href="#">Phân quyền</a></li>
                                <li><a href="#">Chỉnh sửa</a></li>
                                <li><a href="#">Xóa</a></li>
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