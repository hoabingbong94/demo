<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\RouteRule;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\AuthItem */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', $labels['Items']);
$this->params['breadcrumbs'][] = $this->title;

$rules = array_keys(Yii::$app->getAuthManager()->getRules());
$rules = array_combine($rules, $rules);
unset($rules[RouteRule::RULE_NAME]);
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Danh sách Role</h3>
    </div>
    <div class="panel-body">
        <div class="role-index">
    
            <p>
                <?= Html::a(Yii::t('rbac-admin', 'Create ' . $labels['Item']), ['create'], ['class' => 'btn btn-success']) ?>
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
//                    [
//                        'attribute' => 'ruleName',
//                        'label' => Yii::t('rbac-admin', 'Rule Name'),
//                        'filter' => $rules
//                    ],
                    [
                        'attribute' => 'description',
                        'label' => Yii::t('rbac-admin', 'Description'),
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
                                <!--<li><a href="/admin/permission/view?id='.$model->name.'">Phân quyền</a></li>-->
                                <li><a href="/admin/permission/update?id='.$model->name.'">Chỉnh sửa</a></li>
                                <li><a href="/admin/permission/delete?id='.$model->name.'" onClick="return confirm(\'Bạn muốn xóa quyền: '.$model->name.'\')">Xóa</a></li>
                            </ul>
                        </div>';
                        }
                    ],      
                ],
            ])
            ?>

        </div>
    </div>
</div>