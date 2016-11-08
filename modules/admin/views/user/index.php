<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel mdm\admin\models\searchs\User */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('rbac-admin', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Danh sách user</h3>
    </div>
    <div class="panel-body">
        <p>
        <?= Html::a('Tạo tài khoản', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
        <div class="user-index">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'username',
                    'fullname',
                    'created_at:date',
                    [
                        'attribute' => 'status',
                        'value' => function($model) {
                            return $model->status == 0 ? 'Inactive' : 'Active';
                        },
                        'filter' => [
                            0 => 'Inactive',
                            1 => 'Active'
                        ]
                    ],
//                    [
//                        'class' => 'yii\grid\ActionColumn',
//                        'template' => '{view}{update}{delete}'
//                    ],
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
                                <li><a href="/admin/assignment/view?id='.$model->id.'">Phân quyền</a></li>
                                <li><a href="/admin/user/update?id='.$model->id.'">Chỉnh sửa</a></li>
                                <!--<li><a href="/admin/user/delete?id='.$model->id.'" onClick="return confirm(\'Bạn muốn xóa tài khoản: '.$model->fullname.'\')">Xóa</a></li>-->
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